<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelaksanaan_Pembangunan extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Aduan_model'); 
        $this->load->model('Pelaksanaan_model');  
        $this->load->model('RencanaPembangunan_model');            
        $this->load->model('KriteriaKegiatan_model');  
        $this->load->model('ReferensiAduan_model');
        if($this->session->userdata('statuslogin') != "masuk"){
			redirect(base_url());
		}else if($this->session->userdata('statuslogin') == "kunci"){
			redirect(base_url());
		}
    }
    public function index()
	{
		redirect('Pelaksanaan_Pembangunan/Tahun/'.$this->input->post('tahun').'/1');
	}
	public function tahun($tahun,$kd_bidang)
	{
		if ($kd_bidang==1) {
			# code...
			$no=$this->Pelaksanaan_model->no($tahun);
		}else{
			$no=$this->Pelaksanaan_model->no1($tahun,$kd_bidang);
		}
		foreach ($no as $n) {
			# code...
			$kd_bidang=$n['kd_bidang'];
		}
		$data_session = array(
						'menu' => 'Pelaksanaan Pembangunan',
						'tahun'=>$tahun
						);
		$this->session->set_userdata($data_session);	
		$rencana=$this->RencanaPembangunan_model->rencana2($tahun,$kd_bidang);
		$pelaksanaan=$this->Pelaksanaan_model->pelaksanaan($tahun,$kd_bidang);	
		$data = array(
			'daftar' => $this->Pelaksanaan_model->get_all($tahun),
			 'total' => $this->Pelaksanaan_model->totalanggaran($tahun,$kd_bidang),
			 'no' => $no,
			 'rencana' =>$rencana,
			 'pelaksanaan'=>$pelaksanaan,
			 'kd_bdg'=>$kd_bidang
		);
		$this->load->view('data_pelaksanaan',$data);
	}
	public function tambah()
	{
		# code...
		$th_anggaran=$this->input->post('thn');
		$th_mulai =date('Y',strtotime($this->input->post('tgl_mulai')));
		if ($th_anggaran != $th_mulai) {
			$this->session->set_flashdata('error','Tanggal Mulai Harus Sesuai Tahun Anggaran');
			echo '<script>window.history.back();</script>';
		}elseif($this->input->post('tgl_mulai')>$this->input->post('tgl_akhir')){
			$this->session->set_flashdata('error','Tanggal Akhir Tidak Boleh Kurang Dari Tanggal Awal');
			echo '<script>window.history.back();</script>';
		}else{
			$data=array(
					'kd_rencana'=>$this->input->post('kd_rencana'),
					'tgl_mulai'=>$this->input->post('tgl_mulai'),
					'tgl_akhir'=>$this->input->post('tgl_akhir'),
					'status_pengajuan'=>'1',
					'catatan'=>'-',
					'status_pelaksanaan'=>'1'
			);
			$this->Pelaksanaan_model->simpan($data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('flash','Ditambahkan');
				redirect('Pelaksanaan_Pembangunan/Tahun/'.$this->input->post('thn').'/'.$this->input->post('kd_bdg'));
			}else{
				$this->session->set_flashdata('error','Data Ditambahkan');
				echo '<script>window.history.back();</script>';
			}
		}
	}
	public function edit()
	{
		# code...
		$th_anggaran=$this->input->post('thn_edit');
		$th_mulai =date('Y',strtotime($this->input->post('tgl_mulai_edit')));
		if ($th_anggaran != $th_mulai) {
			$this->session->set_flashdata('error','Tanggal Mulai Harus Sesuai Tahun Anggaran');
			echo '<script>window.history.back();</script>';
		}elseif($this->input->post('tgl_mulai_edit')>$this->input->post('tgl_akhir_edit')){
			$this->session->set_flashdata('error','Tanggal Akhir Tidak Boleh Kurang Dari Tanggal Awal');
			echo '<script>window.history.back();</script>';
		}else{
			$data=array(
					'tgl_mulai'=>$this->input->post('tgl_mulai_edit'),
					'tgl_akhir'=>$this->input->post('tgl_akhir_edit')
			);
			$this->Pelaksanaan_model->ubah($this->input->post('kd_rencana_edit'),$data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('flash','Diubah');
				redirect('Pelaksanaan_Pembangunan/Tahun/'.$this->input->post('thn_edit').'/'.$this->input->post('kd_bdg_edit'));
			}else{
				$this->session->set_flashdata('error','Data Diubah');
				echo '<script>window.history.back();</script>';
			}
		}
	}
	public function hapus($kd_bidang,$kd_rencana,$tahun)
	{
		# code...
		$this->Pelaksanaan_model->hapus($kd_rencana);	
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Dihapus');
			redirect('Pelaksanaan_Pembangunan/Tahun/'.$tahun.'/'.$kd_bidang);
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');
			echo '<script>window.history.back();</script>';
		}
	}
	public function terimapelaksanaan()
	{
		# code...
		if ($this->input->post('st')=="3") {
			# code...
			if ($this->session->userdata('lvl_admin')=="1") {
				# code...
				$status_pengajuan="1";
			}else{
				$status_pengajuan="2";
			}
			
		}else{
			$status_pengajuan="2";
		}
		$data=array(
					'status_pengajuan'=>$status_pengajuan,
					'catatan'=>$this->input->post('catatan')
			);
			$this->Pelaksanaan_model->ubah($this->input->post('kd_rencana_terima'),$data);
			if ($this->db->affected_rows() > 0) {
				if ($status_pengajuan=='2') {
					$this->session->set_flashdata('flash','Diterima');
				}else{
					$this->session->set_flashdata('flash','Diajukan Kembali');
				}
				redirect('Pelaksanaan_Pembangunan/Tahun/'.$this->input->post('th').'/'.$this->input->post('kd_bidang'));
			}else{
				$this->session->set_flashdata('error','Data Gagal Diubah');
				echo '<script>window.history.back();</script>';
			}
	}
	public function tolakpelaksanaan()
	{
		$data=array(
					'status_pengajuan'=>'3',
					'catatan'=>$this->input->post('catatan')
			);
			$this->Pelaksanaan_model->ubah($this->input->post('kd_rencana_tolak'),$data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('flash','Ditolak');
				redirect('Pelaksanaan_Pembangunan/Tahun/'.$this->input->post('th_tolak').'/'.$this->input->post('kd_bidang_tolak'));
			}else{
				$this->session->set_flashdata('error','Data Gagal Diubah');
				echo '<script>window.history.back();</script>';
			}
	}
	public function ubahfoto()
	{
		$foto = "";
        $nmfile=date('ymdhis');
        $config['upload_path']          = './asset/foto_pembangunan/';
        $config['allowed_types']        = 'jpeg|gif|jpg|png';
        $config['max_size'] = '3072'; //maksimum besar file 3M
        $config['file_name'] = $nmfile;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('foto_edit')){
            $this->session->set_flashdata('error', 'Foto tidak sesuai format / Resolusi Terlalu Besar');
            echo '<script>window.history.back();</script>';
        }else{ 
        	if (is_file('./asset/foto_pembangunan/'.$this->input->post('foto_edit1'))) {
			    unlink('./asset/foto_pembangunan/'.$this->input->post('foto_edit1'));
			}
			$gbr = $this->upload->data();
            $foto = $gbr['file_name'];
            $data=array(					
            	'foto_lokasi_terbaru'=> $foto
			);
			$this->Pelaksanaan_model->ubah($this->input->post('foto_rencana'),$data);
			$this->session->set_flashdata('flash','Diubah');
			redirect('Pelaksanaan_Pembangunan/Tahun/'.$this->input->post('foto_th').'/'.$this->input->post('foto_kd_bidang'));
        }
	}
}