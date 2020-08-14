<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {

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
        $this->load->model('Kegiatan_model');
        $this->load->model('TopikAduan_model');
        $this->load->model('Dusun_model');
        $this->load->model('Aduan_model');
        if($this->session->userdata('statuslogin') != "masuk"){
			redirect(base_url());
		}else if($this->session->userdata('statuslogin') == "kunci"){
			redirect(base_url());
		}
    }
	public function index()
	{
		$data = $this->Kegiatan_model->get_all();
		$nomor=$this->Kegiatan_model->nomor();
		$datatopik = $this->TopikAduan_model->get_all();
		$nomortopik=$this->TopikAduan_model->nomor();
		$datadusun = $this->Dusun_model->get_all();
		$nomordusun=$this->Dusun_model->nomor();

		$d = array('data'=>$data,'nomor'=>$nomor,'datatopik'=>$datatopik,'nomortopik'=>$nomortopik,'datadusun'=>$datadusun,'nomordusun'=>$nomordusun );
		$this->load->view('data_kegiatan',$d);
	}
	public function Menu()
	{
		# code...
		$data_session = array('menu' => 'Kegiatan','submenu'=>'Kegiatan');
		$this->session->set_userdata($data_session);
		redirect('Kegiatan');
	}
	public function tambahkegiatan()
	{
		$data_session = array('menu' => 'Kegiatan','submenu'=>'Kegiatan');
		$this->session->set_userdata($data_session);
			
		$data=array(
			'kd_kegiatan'=>$this->input->post('kd_kegiatan'),
			'nm_kegiatan'=>$this->input->post('nm_kegiatan')
		);
		$this->Kegiatan_model->simpan($data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Ditambahkan');
			redirect('Kegiatan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Ditambahkan');			
			echo '<script>window.history.back();</script>';
		}
	}
	public function tambahtopik()
	{
		$data_session = array('menu' => 'Kegiatan','submenu'=>'Topik');
		$this->session->set_userdata($data_session);
			
		$data=array(
			'kd_topik'=>$this->input->post('kd_topik'),
			'nm_topik'=>$this->input->post('nm_topik')
		);
		$this->TopikAduan_model->simpan($data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Ditambahkan');
			redirect('Kegiatan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Ditambahkan');			
			echo '<script>window.history.back();</script>';
		}
	}
	public function tambahdusun()
	{
		$data_session = array('menu' => 'Kegiatan','submenu'=>'Dusun');
		$this->session->set_userdata($data_session);
			
		$data=array(
			'kd_dusun'=>$this->input->post('kd_dusun'),
			'rw'=>$this->input->post('rw'),
			'jml_rt'=>$this->input->post('jml_rt')
		);
		$this->Dusun_model->simpan($data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Ditambahkan');
			redirect('Kegiatan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Ditambahkan');			
			echo '<script>window.history.back();</script>';
		}
	}
	public function editkegiatan()
	{
		$data_session = array('menu' => 'Kegiatan','submenu'=>'Kegiatan');
		$this->session->set_userdata($data_session);
		
		$data=array(
			'kd_kegiatan'=>$this->input->post('kd_kegiatan_edit'),
			'nm_kegiatan'=>$this->input->post('nm_kegiatan_edit')
		);
		$this->Kegiatan_model->ubah($this->input->post('kd_kegiatan_edit'),$data);
		if ($this->db->affected_rows() > 0) {			
			$this->session->set_flashdata('flash','Diubah');			
			redirect('Kegiatan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Diubah');			
			echo '<script>window.history.back();</script>';
		}
		redirect('Kegiatan');
	}
	public function edittopik()
	{
		$data_session = array('menu' => 'Kegiatan','submenu'=>'Topik');
		$this->session->set_userdata($data_session);
		
		$data=array(
			'kd_topik'=>$this->input->post('kd_topik_edit'),
			'nm_topik'=>$this->input->post('nm_topik_edit')
		);
		$this->TopikAduan_model->ubah($this->input->post('kd_topik_edit'),$data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Diubah');			
			redirect('Kegiatan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Diubah');			
			echo '<script>window.history.back();</script>';
		}
		redirect('Kegiatan');
	}
	public function editdusun()
	{
		$data_session = array('menu' => 'Kegiatan','submenu'=>'Dusun');
		$this->session->set_userdata($data_session);
		
		$data=array(
			'kd_dusun'=>$this->input->post('kd_dusun_edit'),
			'rw'=>$this->input->post('rw_edit'),
			'jml_rt'=>$this->input->post('jml_rt_edit')
		);
		$this->Dusun_model->ubah($this->input->post('kd_dusun_edit'),$data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Diubah');			
			redirect('Kegiatan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Diubah');			
			echo '<script>window.history.back();</script>';
		}
		redirect('Kegiatan');
	}
	public function hapus($kd_kegiatan)
	{
		$data_session = array('menu' => 'Kegiatan','submenu'=>'Kegiatan');
		$this->session->set_userdata($data_session);

		$this->Kegiatan_model->hapus($kd_kegiatan);
		if ($this->db->affected_rows() > 0) {			
			$this->session->set_flashdata('flash','Dihapus');
			redirect('Kegiatan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');			
			echo '<script>window.history.back();</script>';
		}
	}
	public function hapustopik($kd_topik)
	{
		$data_session = array('menu' => 'Kegiatan','submenu'=>'Topik');
		$this->session->set_userdata($data_session);

		$this->TopikAduan_model->hapus($kd_topik);
		if ($this->db->affected_rows() > 0) {			
			$this->session->set_flashdata('flash','Dihapus');
			redirect('Kegiatan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');			
			echo '<script>window.history.back();</script>';
		}
	}
	public function hapusdusun($kd_dusun)
	{
		$data_session = array('menu' => 'Kegiatan','submenu'=>'Dusun');
		$this->session->set_userdata($data_session);

		$this->Dusun_model->hapus($kd_dusun);
		if ($this->db->affected_rows() > 0) {			
			$this->session->set_flashdata('flash','Dihapus');
			redirect('Kegiatan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');			
			echo '<script>window.history.back();</script>';
		}
	}
}
