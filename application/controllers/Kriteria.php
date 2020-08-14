<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

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
        $this->load->model('Kriteria_model');
        $this->load->model('KriteriaDetail_model');
        $this->load->model('Aduan_model');
        if($this->session->userdata('statuslogin') != "masuk"){
			redirect(base_url());
		}else if($this->session->userdata('statuslogin') == "kunci"){
			redirect(base_url());
		}
    }
	public function index()
	{
		$data_session = array('menu' => 'Kriteria');
		$this->session->set_userdata($data_session);
		$data = $this->Kriteria_model->get_all();
		$nomor=$this->Kriteria_model->nomor();
		$this->load->view('data_kriteria',['data'=>$data,'nomor'=>$nomor]);
	}
	public function tambahkriteria()
	{
		$data=array(
			'kd_kriteria'=>$this->input->post('kd_kriteria'),
			'nm_kriteria'=>$this->input->post('nm_kriteria')
		);
		$this->Kriteria_model->simpan($data);		
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Ditambahkan');
			redirect('Kriteria');
		}else{
			$this->session->set_flashdata('error','Data Gagal Ditambahkan');
			echo '<script>window.history.back();</script>';
		}
	}
	public function editkriteria()
	{
		$data=array(
			'kd_kriteria'=>$this->input->post('kd_kriteria_edit'),
			'nm_kriteria'=>$this->input->post('nm_kriteria_edit')
		);
		$this->Kriteria_model->ubah($this->input->post('kd_kriteria_edit'),$data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Diubah');
			redirect('Kriteria');
		}else{
			$this->session->set_flashdata('error','Data Gagal Diubah');
		}
	}
	public function hapus($kd_kriteria)
	{
		$this->Kriteria_model->hapus($kd_kriteria);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Dihapus');
			redirect('Kriteria');
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');
			echo '<script>window.history.back();</script>';
		}
	}
	public function detail($kd_kriteria)
	{
		
		$data_kriteria=$this->Kriteria_model->cari($kd_kriteria);
		$data=$this->KriteriaDetail_model->get_all($kd_kriteria);
		$nomor=$this->KriteriaDetail_model->nomor($kd_kriteria);
		$this->load->view('data_kriteria_detail',['data_kriteria'=>$data_kriteria,'data'=>$data,'nomor'=>$nomor]);
	}
	public function tambahkriteriadetail()
	{
		$data=array(
			'kd_dtl_kriteria'=>$this->input->post('kd_dtl_kriteria'),
			'kd_kriteria'=>$this->input->post('kd_kriteria'),
			'nm_dtl_kriteria'=>$this->input->post('nm_dtl_kriteria'),
			'nilai_dtl_kriteria'=>$this->input->post('nilai_dtl_kriteria')
		);
		$this->KriteriaDetail_model->simpan($data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Ditambahkan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Ditambahkan');
		}
		redirect('Kriteria/Detail/'.$this->input->post('kd_kriteria'));
	}
	public function EditDetailKriteria()
	{
		$data=array(
			'kd_dtl_kriteria'=>$this->input->post('kd_dtl_kriteria_edit'),
			'kd_kriteria'=>$this->input->post('kd_kriteria_edit'),
			'nm_dtl_kriteria'=>$this->input->post('nm_dtl_kriteria_edit'),
			'nilai_dtl_kriteria'=>$this->input->post('nilai_dtl_kriteria_edit')
		);
		$this->KriteriaDetail_model->ubah($this->input->post('kd_dtl_kriteria_edit'),$data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Ditambahkan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Ditambahkan');
		}
		redirect('Kriteria/Detail/'.$this->input->post('kd_kriteria_edit'));
	}
	public function hapusdetail($kd_dtl_kriteria,$kd_kriteria)
	{
		$this->KriteriaDetail_model->hapus($kd_dtl_kriteria);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Dihapus');
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');
		}
		redirect('Kriteria/Detail/'.$kd_kriteria);
	}
}
