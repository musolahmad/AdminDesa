<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
        $this->load->model('Admin_model');
        $this->load->helper(array('captcha'));
    }
    public function create_captcha(){
        $option = array (
            'img_path' => './files/captcha/',
            'img_url' => base_url('files/captcha'),
            'img_width' => '150',
            'img_height' => '40',
            'word_length'   => 5,
            'font_size'     => 30,
            'pool' => '0123456789',
            'expiration' => 7200
        );

        $cap = create_captcha($option);
        $image = $cap['image'];

        $this->session->set_userdata('captchaword', $cap['word']);
        return $image;
    }
    public function check_captcha(){
        if ($this->input->post('captcha') == $this->session->userdata('captchaword')) {
            return true;
        }else{
            return false;
        }
    }
    public function KunciLayar(){
    	$data_session = array('statuslogin'=>'kunci','menu'=>'Kunci Layar');
		$this->session->set_userdata($data_session);
		redirect(base_url());
    }
	public function index()
	{
		if($this->session->userdata('statuslogin') == "masuk"){
			$data_session = array('menu'=>'Beranda');
			$this->session->set_userdata($data_session);
			redirect(base_url('index.php')."/Beranda");			
		}elseif($this->session->userdata('statuslogin') == "kunci"){
			$data_session = array('menu'=>'Kunci Layar');
			$this->session->set_userdata($data_session);
			$this->load->view('kunci_layar');
		}else{
			$data_session = array('menu'=>'Login');	
			$this->session->set_userdata($data_session);	
			$data['image'] = $this->create_captcha();
        	$this->load->view('login', $data);		
        }
		
	}
	public function LupaPassword()
	{
		if($this->session->userdata('statuslogin') == "masuk"){
			$data_session = array('menu'=>'Beranda');
			redirect(base_url()."Beranda");			
		}elseif($this->session->userdata('statuslogin') == "kunci"){
			$data_session = array('menu'=>'Kunci Layar');
			$this->load->view('kunci_layar');
		}else{
			$data_session = array('menu'=>'Login');		
			$data['image'] = $this->create_captcha();
        	$this->load->view('lupa_password', $data);
		}
		$this->session->set_userdata($data_session);
	}
	public function aksilogin()
	{
		$kd_admin=$this->input->post('kd_admin');
		$pass=$this->input->post('pass');
		$lihat=$this->Admin_model->cari($kd_admin);
		$kode_admin="";
		$password="";
		$nama="";
		$lvl_admin="";
		if (empty($lihat)) {
			$cekemail=$this->Admin_model->cekemaillogin($kd_admin);
			if (empty($cekemail)) {
				# code...
				$this->session->set_flashdata('error', 'Email Salah! silahkan masukkan kode admin atau email yang benar!');
            	echo '<script>window.history.back();</script>';
			}else{
				foreach ($cekemail as $l) {
					$kode_admin=$l['kd_admin'];
					$password=$l['pass'];
					$nama=$l['nm_pegawai'];
					$lvl_admin=$l['lvl_admin'];
					$foto=$l['foto_profil'];
					$status_admin=$l['status_admin'];
				}

				if ($pass != $password) {
					$this->session->set_flashdata('error', 'Password Salah! silahkan masukkan Password yang benar!');
	            	echo '<script>window.history.back();</script>';
				}elseif ($status_admin != '1') {
					$this->session->set_flashdata('error', 'Akun Dinonaktifkan! silahkan hubungi super admin!');
	            	echo '<script>window.history.back();</script>';
				}else if ($this->input->post('captcha') != $this->session->userdata('captchaword')) {
		            $this->session->set_flashdata('error', 'Kode Captcha Salah! silahkan masukkan kode captcha yang benar!');
		            echo '<script>window.history.back();</script>';
		        }else{
		        	$data_session = array('statuslogin'=>'masuk','Password'=>$password,'nama'=>$nama,'kode_admin'=>$kode_admin,'foto'=>$foto,'lvl_admin'=>$lvl_admin);
					$this->session->set_userdata($data_session);			
					$this->session->set_flashdata('berhasil', $nama);
					redirect(base_url());	
		        }
			}
			
		}else{
			foreach ($lihat as $l) {
				$kode_admin=$l['kd_admin'];
				$password=$l['pass'];
				$nama=$l['nm_pegawai'];
				$lvl_admin=$l['lvl_admin'];
				$foto=$l['foto_profil'];
				$status_admin=$l['status_admin'];
			}

			if ($pass != $password) {
				$this->session->set_flashdata('error', 'Password Salah! silahkan masukkan Password yang benar!');
	           	echo '<script>window.history.back();</script>';
			}elseif ($status_admin != '1') {
				$this->session->set_flashdata('error', 'Akun Dinonaktifkan! silahkan hubungi super admin!');
	           	echo '<script>window.history.back();</script>';
			}else if ($this->input->post('captcha') != $this->session->userdata('captchaword')) {
	            $this->session->set_flashdata('error', 'Kode Captcha Salah! silahkan masukkan kode captcha yang benar!');
	            echo '<script>window.history.back();</script>';
	        }else{
	        	$data_session = array('statuslogin'=>'masuk','Password'=>$password,'nama'=>$nama,'kode_admin'=>$kode_admin,'foto'=>$foto,'lvl_admin'=>$lvl_admin);
				$this->session->set_userdata($data_session);
				$this->session->set_flashdata('berhasil', $nama);
				redirect(base_url());	
	        }
		}	
		
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
	public function bukakunci(){
		if($this->input->post('password') != $this->session->userdata('Password')){
			$this->session->set_flashdata('error', 'Password Salah! silahkan masukkan Password yang benar!');
            echo '<script>window.history.back();</script>';
		}else{
	        $data_session = array('statuslogin'=>'masuk');
			$this->session->set_userdata($data_session);
			redirect(base_url());	
	    }
	}
	public function KirimPassword()
	{
		# code...
		$email=$this->input->post('kd_admin');
		$cekemail = $this->Admin_model->cekemailadmin($email);
		if (empty($cekemail)) {
			# code...
			$this->session->set_flashdata('error', 'Email yang Anda masukan Tidak Terdaftar! silahkan masukkan Email yang benar!');
            echo '<script>window.history.back();</script>';
		}else{
			foreach ($cekemail as $c) {
				# code...
				$password = $c['pass'];
				$nm_user = $c['nm_pegawai'];
			}
				 $from_email = "jeruksaridesa@gmail.com"; 
				 $to_email = $email; 

				 $config = Array(
							'protocol' => 'smtp',
							'smtp_host' => 'ssl://smtp.googlemail.com',
							'smtp_port' => 465,
							'smtp_user' => $from_email,
							'smtp_pass' => 'tirtopekalongan',
							'mailtype'  => 'html', 
							'charset'   => 'utf-8'
					);

				 $this->load->library('email', $config);
				 $this->email->set_newline("\r\n");   

				 $this->email->from($from_email, 'Desa Jeruksari'); 
				 $this->email->to($to_email);
				 $this->email->subject('[Sistem Prioritas Pembangunan Desa] Lupa Password'); 
				 $this->email->message('
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="border-collapse: collapse;">
                            <tr>
                                <td align="center" bgcolor="#F5FFFA">
                                    <h1>Sistem Prioritas Pembangunan Desa Jeruksari</h1>
                                    <p>Jalan Raya Jeruksari no 381 Desa Jeruksari, Kecamatan Tirto, Kabupaten Pekalongan</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 30px 10px 30px;">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td >
                                                <p>Yth. Bpk/Ibu/Sdr/i '.$nm_user.',</p>

                                                <p>Terima Kasih telah menggunakan Sistem Prioritas Pembangunan Desa Jeruksari<br>
                                                Berikut ini  password anda di Sistem Prioritas Pembangunan Desa Jeruksari:</p>
                                                <table align="center" cellpadding="0" cellspacing="0" width="50%">
                                                    <td align="center" bgcolor="#6495ED">
                                                        <p><b><font size="5" color="white">Password Anda : '.$password.'</font></b></p>
                                                    </td>
                                                </table>                                
                                                <p>Kami perlu memastikan bahwa email Anda benar dan tidak disalahgunakan oleh pihak yang tidak berkepentingan.</p>

                                                Salam hormat kami,<br>
                                                Admin Sistem Prioritas Pembangunan Desa Jeruksari
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#98FB98" style="padding: 10px 10px 10px 30px;">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td>
                                                Surel ini dikirimkan secara otomatis dan tidak untuk dibalas. Terima kasih.
                                            </td>
                                        </tr>
                                    </table>
                                </td>   
                            </tr>
                        </table>
                        '); 

				 //Send mail 
				 if($this->email->send()){
						$this->session->set_flashdata('flash','Dikirim Silahkan Cek Email Anda');
                        redirect(base_url());
				 }else {
					  show_error($this->email->print_debugger());
					  return false;
				 }						
		}
	}
}