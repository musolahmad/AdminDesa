<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
        $this->load->model('Penyusun_model');
        $this->load->model('Laporan_model');
        $this->load->model('BobotKriteria_model');
		$this->load->model('Promethee_model');
        $this->load->model('KriteriaKegiatan_model');
        if($this->session->userdata('statuslogin') != "masuk"){
			redirect(base_url());
		}else if($this->session->userdata('statuslogin') == "kunci"){
			redirect(base_url());
		}
    }
    public function index()
	{
		redirect('Laporan/Tahun/'.$this->input->post('tahun').'/1');
	}
    public function Tahun($tahun,$no)
	{
		$data_session = array(
						'menu' => 'Cetak Laporan',
						'tahun'=>$tahun
						);
		$this->session->set_userdata($data_session);
		if ($no=='1') {
			# code...
			$laporan=$this->Laporan_model->rencana($tahun);
		}if ($no=='2') {
			# code...
			$laporan=$this->Laporan_model->prioritas($tahun);
		}if ($no=='3') {
			# code...
			$laporan=$this->Laporan_model->pelaksanaan($tahun);
		}
		$data=array(
			'no'=>$no,
			'laporan'=>$laporan
		);
		$this->load->view('laporan',$data);
	}
	 public function cetak($tahun,$no)
	{
		$tim=$this->Penyusun_model->cari($tahun);
		if (empty($tim)) {
			# code...
			$this->session->set_flashdata('error','Tim Penyusun Pembangunan Belum Diisi, Silahkan isi terlebih dahulu');		
			redirect('Laporan/Tahun/'.$tahun.'/'.$no);
		}else{
			$data_session = array(
						'menu' => 'Cetak Laporan',
						'tahun'=>$tahun
						);
			$this->session->set_userdata($data_session);		
			if ($no=='1') {
				# code...
				$laporan=$this->Laporan_model->rencana($tahun);
			}if ($no=='2') {
				# code...
				$laporan=$this->Laporan_model->prioritas($tahun);
			}if ($no=='3') {
				# code...
				$laporan=$this->Laporan_model->pelaksanaan($tahun);
			}
			$data=array(
				'no'=>$no,
				'laporan'=>$laporan,
				'tim'=>$tim
			);
			$this->load->view('laporan/cek_laporan',$data);
		}
	}

}
