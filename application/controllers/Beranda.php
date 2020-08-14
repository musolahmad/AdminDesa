<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

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
        $this->load->model('RencanaPembangunan_model');
        $this->load->model('Pelaksanaan_model'); 
        $this->load->model('PaguAnggaran_model');
        $this->load->model('BobotKriteria_model');
        $this->load->model('KriteriaKegiatan_model');
        $this->load->model('Selisih_model');
        $this->load->model('Promethee_model');   
        $this->load->model('Aduan_model');
        $this->load->model('Pembangunan_model');
        $this->load->model('Web_model');     
        if($this->session->userdata('statuslogin') != "masuk"){
			redirect(base_url());
		}else if($this->session->userdata('statuslogin') == "kunci"){
			redirect(base_url());
		}
    }
    public function index()
	{
		redirect('Beranda/Tahun/'.(date('Y')+1));
	}
	public function Beranda()
	{
		redirect('Beranda/Tahun/'.(date('Y')+1));
	}
	public function tahun($tahun)
	{
		$data_session = array(
						'menu' => 'Beranda',
						'tahun'=>$tahun
						);
		$this->session->set_userdata($data_session);
		$data=array(
			'jml_masuk'=>$this->Aduan_model->jml_masuk(),		
			'jml_hariini'=>$this->Aduan_model->jml_hariini(),
			'jml_blmbaca'=>$this->Aduan_model->jml_blmbaca(),
			'jml_diterima'=>$this->Aduan_model->jml_diterima(),
			'jml_ditolak'=>$this->Aduan_model->jml_ditolak(),
			'apbdes'=>$this->PaguAnggaran_model->get_all_beranda($tahun,'1'),
			'belanja'=>$this->PaguAnggaran_model->get_all_beranda($tahun,'2'),
			'rencana' => $this->RencanaPembangunan_model->get_all($tahun),
			'web' => $this->Web_model->get_all(),
			'daftar' => $this->Pelaksanaan_model->get_all($tahun),
			'agenda' => $this->Pelaksanaan_model->get_all_bulan(date('Y'),date('m'))
		);		
		$this->load->view('beranda',$data);
	}
	public function lihatanggaran()
	{
		# code...
		redirect('Beranda/Tahun/'.$this->input->post('tahun'));

	}
	public function UbahStatus($kd_rencana,$tahun)
	{
		# code...
		$data=array(
					'status_pelaksanaan'=>'2'
			);
			$this->Pelaksanaan_model->ubah($kd_rencana,$data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('flash','Diubah');
				redirect('Beranda/Tahun/'.$tahun);
			}else{
				$this->session->set_flashdata('error','Data Diubah');
				echo '<script>window.history.back();</script>';
			}
	}
	public function FotoPelaksanaan()
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
        	$gbr = $this->upload->data();
            $foto = $gbr['file_name'];
            $data=array(		
            	'status_pelaksanaan'=>'3',		
            	'foto_lokasi_terbaru'=> $foto
			);
			$this->Pelaksanaan_model->ubah($this->input->post('kd_rencana_pelaksanaan'),$data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('flash','Diubah');
				redirect('Beranda/Tahun/'.$this->input->post('tahun_pelaksanaan'));
			}else{
				$this->session->set_flashdata('error','Data Diubah');
				echo '<script>window.history.back();</script>';
			}
        }
	}
	public function UbahWeb()
	{
		# code...
		$data=array(
					'web_admin'=>$this->input->post('web_admin'),
					'web_masyarakat'=>$this->input->post('web_masyarakat')
			);
			$this->Web_model->ubah('1',$data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('flash','Diubah');
				redirect('Beranda/Tahun/'.$this->input->post('th_web'));
			}else{
				$this->session->set_flashdata('error','Data Diubah');
				echo '<script>window.history.back();</script>';
			}
	}
}
