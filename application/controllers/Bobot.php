<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bobot extends CI_Controller {

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
        $this->load->model('Kegiatan_model');
        $this->load->model('Bidang_model');
        $this->load->model('RencanaPembangunan_model');
        $this->load->model('BobotKriteria_model');        
        $this->load->model('PaguAnggaran_model');
        if($this->session->userdata('statuslogin') != "masuk"){
			redirect(base_url());
		}else if($this->session->userdata('statuslogin') == "kunci"){
			redirect(base_url());
		}
    }
	public function index()
	{
		$tahun=$this->input->post('tahun');
		redirect('Bobot/Tahun/'.$tahun);
	}
	public function tahun($tahun)
	{
		
		$data_session = array(
						'menu' => 'Bobot',
						'tahun'=>$tahun
						);
		$this->session->set_userdata($data_session);
		$data = $this->PaguAnggaran_model->get_all_bobot($tahun);
		$this->load->view('data_bobot',['data'=>$data]);
	}
	public function tambah($kd_bidang,$tahun)
	{
		$data_session = array(
						'menu' => 'Bobot',
						'tahun'=>$tahun
						);
		$this->session->set_userdata($data_session);
		$data1 = array(
			'data' => $this->BobotKriteria_model->cari($kd_bidang,$tahun) , 
			'bidang' => $this->Bidang_model->cari($kd_bidang),
			'list' => $this->BobotKriteria_model->listkriteria($kd_bidang,$tahun)
		);
		$this->load->view('data_bobot_tambah',$data1);
	}
	public function editbobot()
	{
		$nilaibobot=$this->BobotKriteria_model->totalbobot($this->input->post('kd_bidang'));
		if (empty($nilaibobot)) {
			$total = 0;
		}else{
			foreach ($nilaibobot as $n) {
				# code...
				$total=$n['nilai'];
			}
		}
		$bobot=$this->input->post('bobot');
		$bobotedit=$this->input->post('bobotedit1');
		$total=$total+$bobot-$bobotedit;
		if ($total>100) {
			$this->session->set_flashdata('error','Total bobot tidak boleh lebih dari 100%');
			echo '<script>window.history.back();</script>';
		}else{
			$tahun=$this->input->post('thn_filter');
			$data=array(
				'bobot'=>$this->input->post('bobot'),
				'parameter'=>$this->input->post('parameter')
			);
			$this->BobotKriteria_model->ubah($this->input->post('kd_bobot'),$data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('flash','Diubah');
				redirect('Bobot/Tahun/'.$tahun);
			}else{
				$this->session->set_flashdata('error','Data Gagal Diubah');			
				echo '<script>window.history.back();</script>';
			}
		}
	}
	public function tambahbobot()
	{
		$nilaibobot=$this->BobotKriteria_model->totalbobot($this->input->post('kd_bidang'),$this->input->post('tahun'));
		if (empty($nilaibobot)) {
			$total = 0;
		}else{
			foreach ($nilaibobot as $n) {
				# code...
				$total=$n['nilai'];
			}
		}
		$bobot=$this->input->post('bobot');
		$total=$total+$bobot;
		if ($total>100) {
			$this->session->set_flashdata('error','Total bobot tidak boleh lebih dari 100%');
			echo '<script>window.history.back();</script>';
		}else{
			$data=array(
				'kd_bobot'=>substr($this->input->post('tahun'), 2).$this->input->post('kd_bidang').substr($this->input->post('kd_kriteria'),2),
				'kd_bidang'=>$this->input->post('kd_bidang'),
				'kd_kriteria'=>$this->input->post('kd_kriteria'),
				'tahun'=>$this->input->post('tahun'),
				'bobot'=>$this->input->post('bobot'),
				'parameter'=>$this->input->post('parameter')
			);
			$this->BobotKriteria_model->simpan($data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('flash','Ditambahkan');
				redirect('Bobot/Tambah/'.$this->input->post('kd_bidang').'/'.$this->input->post('tahun'));
			}else{
				$this->session->set_flashdata('error','Data Gagal Ditambahkan');
				echo '<script>window.history.back();</script>';
			}
		}
	}
	public function bobotedit()
	{
		
		$bobotedit=$this->input->post('bobotlama');
		$nilaibobot=$this->BobotKriteria_model->totalbobot($this->input->post('kd_bidangedit'),$this->input->post('tahunedit'));
		if (empty($nilaibobot)) {
			$total = 0;
		}else{
			foreach ($nilaibobot as $n) {
				# code...
				$total=$n['nilai'];
			}
		}
		$bobot=$this->input->post('bobotedit');
		$total=$total+$bobot-$bobotedit;
		if ($total>100) {
			$this->session->set_flashdata('error','Total bobot tidak boleh lebih dari 100%');
			echo '<script>window.history.back();</script>';
		}else{
			$data=array(
				'bobot'=>$this->input->post('bobotedit'),
				'parameter'=>$this->input->post('parameteredit')
			);
			$this->BobotKriteria_model->ubah($this->input->post('kd_bobot'),$data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('flash','Diubah');
				redirect('Bobot/Tambah/'.$this->input->post('kd_bidangedit').'/'.$this->input->post('tahunedit'));
			}else{
				$this->session->set_flashdata('error','Data Gagal Diubah');
				echo '<script>window.history.back();</script>';
			}
		}
	}
	public function hapus($kd_bobot,$tahun)
	{
		$this->BobotKriteria_model->hapus($kd_bobot);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Dihapus');
			redirect('Bobot/Tahun/'.$tahun);
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');
			echo '<script>window.history.back();</script>';
		}
	}
	public function hapusedit($kd_bobot,$tahun,$kd_bidang)
	{
		$this->BobotKriteria_model->hapus($kd_bobot);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Dihapus');
			redirect('Bobot/Tambah/'.$kd_bidang.'/'.$tahun);
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');
			echo '<script>window.history.back();</script>';
		}
	}
}
