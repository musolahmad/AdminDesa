<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aduan extends CI_Controller {

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
        $this->load->model('ReferensiAduan_model');
        $this->load->model('RencanaPembangunan_model');
        $this->load->model('Komentar_model');        
        $this->load->model('Web_model');     
        if($this->session->userdata('statuslogin') != "masuk"){
			redirect(base_url());
		}else if($this->session->userdata('statuslogin') == "kunci"){
			redirect(base_url());
		}
    }
	public function index()
	{
		$data=array(
			'jml_masuk'=>$this->Aduan_model->jml_masuk(),		
			'jml_hariini'=>$this->Aduan_model->jml_hariini(),
			'jml_blmbaca'=>$this->Aduan_model->jml_blmbaca(),
			'jml_diterima'=>$this->Aduan_model->jml_diterima(),
			'jml_ditolak'=>$this->Aduan_model->jml_ditolak()
		);		
		$this->load->view('data_aduan',$data);
	}
	public function baca($kd_aduan)
	{
		$kd_aduan=$kd_aduan;
		$data=array(
			'dibaca'=>'Y'
		);
		$this->Aduan_model->ubah($kd_aduan,$data);
		$data1=array(
			'jml_masuk'=>$this->Aduan_model->jml_masuk(),		
			'jml_hariini'=>$this->Aduan_model->jml_hariini(),
			'jml_blmbaca'=>$this->Aduan_model->jml_blmbaca(),
			'jml_diterima'=>$this->Aduan_model->jml_diterima(),
			'jml_ditolak'=>$this->Aduan_model->jml_ditolak(),
			'cari'=>$this->Aduan_model->cari($kd_aduan),
			'data'=>$this->Komentar_model->get_all($kd_aduan),
			'web' => $this->Web_model->get_all()
		);	
		$this->load->view('data_aduan_baca',$data1);
	}
	public function hariini()
	{
		$data_session = array('menu' => 'Aduan Masyarakat','aduan'=>'Hari Ini');
		$this->session->set_userdata($data_session);
		redirect('Aduan');
	}
	public function masuk()
	{
		$data_session = array('menu' => 'Aduan Masyarakat','aduan'=>'Masuk');
		$this->session->set_userdata($data_session);
		redirect('Aduan');
	}
	public function blmbaca()
	{
		$data_session = array('menu' => 'Aduan Masyarakat','aduan'=>'Belum di Baca');
		$this->session->set_userdata($data_session);
		redirect('Aduan');
	}
	public function diterima()
	{
		$data_session = array('menu' => 'Aduan Masyarakat','aduan'=>'Diterima');
		$this->session->set_userdata($data_session);
		redirect('Aduan');
	}
	public function ditolak()
	{
		$data_session = array('menu' => 'Aduan Masyarakat','aduan'=>'Ditolak');
		$this->session->set_userdata($data_session);
		redirect('Aduan');
	}
	public function terima($kd_aduan)
	{
		$data=array(
			'status_aduan'=>'Diterima'
		);
		$this->Aduan_model->ubah($kd_aduan,$data);
		$nomor=$this->Komentar_model->nomor();
		if (empty($nomor)) {
			# code...
			$kd_komentar = $kd_aduan.'001';
		}else{
			foreach ($nomor as $n) {
				# code...
				$kd_komentar = $n['kd_komentar']+1;
			}
		}
		$dataterima=array(
			'kd_komentar' => $kd_komentar,
			'kd_aduan'=> $kd_aduan,
			'kd_admin'=> $this->session->userdata('kode_admin'),
			'isi_komentar'=>'Aduan telah diterima oleh Admin',
		 );
		$this->Komentar_model->simpan($dataterima);
		redirect('Aduan/Baca/'.$kd_aduan);
	}
	public function hapusaduan($kd_aduan,$foto)
	{
		
		$this->Aduan_model->hapus($kd_aduan);
		if ($this->db->affected_rows() > 0) {
			$web = $this->Web_model->get_all();
			foreach ($web as $w) {
			  # code...
			  $web_masyarakat=$w['web_masyarakat'];
			}
			echo '<script>window.location="'.$web_masyarakat.'Aduan/hapusfotoaduan/'.$foto.'";</script>';
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');
			echo '<script>window.history.back();</script>';
		}
	}
	public function aduankembali()
	{
			$data_session = array('menu' => 'Aduan Masyarakat','aduan'=>'Masuk');
			$this->session->set_userdata($data_session);
			$this->session->set_flashdata('flash','Dihapus');
			redirect('Aduan');
	}
	public function tolak($kd_aduan)
	{
		$data=array(
			'status_aduan'=>'Ditolak'
		);
		$this->Aduan_model->ubah($kd_aduan,$data);
		$nomor=$this->Komentar_model->nomor();
		if (empty($nomor)) {
			# code...
			$kd_komentar = $kd_aduan.'001';
		}else{
			foreach ($nomor as $n) {
				# code...
				$kd_komentar = $n['kd_komentar']+1;
			}
		}
		$dataterima=array(
			'kd_komentar' => $kd_komentar,
			'kd_aduan'=> $kd_aduan,
			'kd_admin'=> $this->session->userdata('kode_admin'),
			'isi_komentar'=>'Aduan telah ditolak oleh Admin',
		 );
		$this->Komentar_model->simpan($dataterima);
		redirect('Aduan/Baca/'.$kd_aduan);
	}
	public function komentar($kd_aduan)
	{
		# code...
		$nomor=$this->Komentar_model->nomor();
		if (empty($nomor)) {
			# code...
			$kd_komentar = $kd_aduan.'001';
		}else{
			foreach ($nomor as $n) {
				# code...
				$kd_komentar = $n['kd_komentar']+1;
			}
		}
		$dataterima=array(
			'kd_komentar' => $kd_komentar,
			'kd_aduan'=> $kd_aduan,
			'kd_admin'=> $this->session->userdata('kode_admin'),
			'isi_komentar'=>$this->input->post('komentar'),
		 );
		$this->Komentar_model->simpan($dataterima);
		redirect('Aduan/Baca/'.$kd_aduan);
	}
	public function ubahterima($kd_aduan,$kd_komentar)
	{
		# code...
		$data=array(
			'status_aduan'=>'Diterima'
		);
		$this->Aduan_model->ubah($kd_aduan,$data);
		$dataterima=array(
			
			'isi_komentar'=>'Aduan telah diterima oleh Admin'
		 );
		$this->Komentar_model->ubah($kd_komentar,$dataterima);
		redirect('Aduan/Baca/'.$kd_aduan);
	}
	public function ubahtolak($kd_aduan,$kd_komentar)
	{
		# code...
		$data=array(
			'status_aduan'=>'Ditolak'
		);
		$this->Aduan_model->ubah($kd_aduan,$data);
		$dataterima=array(
			
			'isi_komentar'=>'Aduan telah ditolak oleh Admin'
		 );
		$this->Komentar_model->ubah($kd_komentar,$dataterima);
		redirect('Aduan/Baca/'.$kd_aduan);
	}
	public function editkomentar()
	{
		# code...
		$dataterima=array(
			
			'isi_komentar'=>$this->input->post('isi_komentar')
		 );
		$this->Komentar_model->ubah($this->input->post('kd_komentar'),$dataterima);
		redirect('Aduan/Baca/'.$this->input->post('kd_aduan'));
	}
	public function hapus($kd_aduan,$kd_komentar)
	{
		$this->Komentar_model->hapus($kd_komentar);
		redirect('Aduan/Baca/'.$kd_aduan);
	}
}
