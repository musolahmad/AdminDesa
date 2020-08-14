<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelapor extends CI_Controller {

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
        $this->load->model('Pelapor_model');
         $this->load->model('Aduan_masyarakat_model');
         $this->load->model('Aduan_model');
		 $this->load->model('Web_model');     
        if($this->session->userdata('statuslogin') != "masuk"){
			redirect(base_url());
		}else if($this->session->userdata('statuslogin') == "kunci"){
			redirect(base_url());
		}
    }
	public function index()
	{
		$data_session = array('menu' => 'Pelapor');
		$this->session->set_userdata($data_session);
		$page=12;
		//pagintioan 
		$jml=$this->Pelapor_model->jml();
		$config['base_url'] = base_url().'Pelapor/Index';
		$config['total_rows']=$jml;
		$config['per_page'] = $page;
		$start = $this->uri->segment(3);

		// Style Pagination
		// Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
		$config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        
        $config['first_link']      = 'First'; 
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link']       = 'Last'; 
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        
        $config['next_link']       = '&raquo'; 
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        
        $config['prev_link']       = '&laquo'; 
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        
        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
         
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        // End style pagination

		$this->pagination->initialize($config); // Set konfigurasi paginationnya
		$data=$this->Pelapor_model->get_all($config['per_page'],$start);
		$this->load->view('data_pelapor',['data'=>$data,'jml'=>$jml,'web' => $this->Web_model->get_all()]);
	}
	public function user($kd_user,$status_user)
	{
		if ($status_user=="2") {
			$status_user="3";
		}elseif ($status_user=="3") {
			# code...
			$status_user="2";
		}
		$data=array('status_user'=>$status_user);
		$this->Pelapor_model->ubah($kd_user,$data);
		if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('flash','Dibuah'); 
            redirect('Pelapor');
						
        }else{
           	$this->session->set_flashdata('error','Status User gagal di Ubah');
            echo '<script>window.history.back();</script>';
        }   
	}
}