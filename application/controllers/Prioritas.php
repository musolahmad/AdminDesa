<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prioritas extends CI_Controller {

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
        $this->load->model('Bidang_model');
        $this->load->model('Kegiatan_model');
        $this->load->model('BobotKriteria_model');
        $this->load->model('KriteriaDetail_model');
        $this->load->model('KriteriaKegiatan_model');
        $this->load->model('Selisih_model');
        $this->load->model('Aduan_model');
        $this->load->model('Promethee_model');        
        if($this->session->userdata('statuslogin') != "masuk"){
			redirect(base_url());
		}else if($this->session->userdata('statuslogin') == "kunci"){
			redirect(base_url());
		}
    }
    public function index()
	{
		$tahun=$this->input->post('tahun');
		redirect('Prioritas/Tahun/'.$tahun.'/1');
	}
	public function tahun($tahun,$kd_bidang)
	{
		if ($kd_bidang=="1") {
			# code...
			$nomor=$this->RencanaPembangunan_model->nomor($tahun);
			foreach ($nomor as $n) {
				$kd_bidang=$n['kd_bidang'];
			}
		}else{
			$nomor=$this->RencanaPembangunan_model->bidang($tahun,$kd_bidang);
		}
		$datarencana = $this->RencanaPembangunan_model->rencana1($tahun,$kd_bidang);
		$data_session = array(
						'menu' => 'Prioritas Pembangunan',
						'tahun'=>$tahun
						);
		$this->session->set_userdata($data_session);
		$data = $this->RencanaPembangunan_model->get_all($tahun);
		$this->load->view('data_perhitungan',['data'=>$data,'no'=>$nomor,'datarencana'=>$datarencana]);
	}
	public function cek()
	{
		# code...
		print_r($this->Promethee_model->prioritas('2020','BK02'));
	}
}
