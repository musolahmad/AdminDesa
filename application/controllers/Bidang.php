<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidang extends CI_Controller {

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
        $this->load->model('Bidang_model');
        $this->load->model('Kriteria_model');
        if($this->session->userdata('statuslogin') != "masuk"){
			redirect(base_url());
		}else if($this->session->userdata('statuslogin') == "kunci"){
			redirect(base_url());
		}
    }
	public function index()
	{
		$data_session = array('menu' => 'Bidang Kegiatan');
		$this->session->set_userdata($data_session);
		$data = $this->Bidang_model->get_all();
		$this->load->view('data_bidang',['data'=>$data]);
	}
	public function tambahbidang()
	{
		$nomor=$this->Bidang_model->nomor();
		if (empty($nomor)) {
			# code...
			$kd_bidang='1';
		}else{
			foreach ($nomor as $n) {
				# code...
				$kd_bidang=$n['kd_bidang']+1;
			}
		}
		$data=array(
			'kd_bidang'=>$kd_bidang,
			'nm_bidang'=>$this->input->post('nm_bidang'),
			'jns_akun'=>$this->input->post('jns_akun'),
			'kd_induk'=>'0',
			'tipe_akun'=>'1'
		);
		$this->Bidang_model->simpan($data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Ditambahkan');
			redirect('Bidang');
		}else{
			$this->session->set_flashdata('error','Data Gagal Ditambahkan');
			echo '<script>window.history.back();</script>';
		}
	}
	public function tambahakun()
	{
		$nomor=$this->Bidang_model->nomorakun($this->input->post('kd_bidang_1'));
		if (empty($nomor)) {
			# code...
			$kd_bidang=$this->input->post('kd_bidang_1').'1';
		}else{
			foreach ($nomor as $n) {
				# code...
				$kd_bidang=$n['kd_bidang']+1;
			}
		}
		$data=array(
			'kd_bidang'=>$kd_bidang,
			'nm_bidang'=>$this->input->post('nm_bidang_1'),
			'jns_akun'=>$this->input->post('jns_akun_1'),
			'kd_induk'=>$this->input->post('kd_bidang_1'),
			'tipe_akun'=>$this->input->post('tipe_akun')
		);
		$this->Bidang_model->simpan($data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Ditambahkan');
			redirect('Bidang');
		}else{
			$this->session->set_flashdata('error','Data Gagal Ditambahkan');
			echo '<script>window.history.back();</script>';
		}
	}
	public function editbidang()
	{
		$data=array(
			'kd_bidang'=>$this->input->post('kd_bidang_edit'),
			'nm_bidang'=>$this->input->post('nm_bidang_edit')
		);
		$this->Bidang_model->ubah($this->input->post('kd_bidang_edit'),$data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Diubah');
			redirect('Bidang');
		}else{
			$this->session->set_flashdata('error','Data Gagal Diubah');
			echo '<script>window.history.back();</script>';
		}
	}
	public function hapus($kd_bidang)
	{
		$this->Bidang_model->hapus($kd_bidang);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Dihapus');
			redirect('Bidang');
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');
			echo '<script>window.history.back();</script>';
		}
	}
}
