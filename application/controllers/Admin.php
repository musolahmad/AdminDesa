<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        $this->load->model('Penyusun_model');
        $this->load->model('Aduan_model');
        if($this->session->userdata('statuslogin') != "masuk"){
			redirect(base_url());
		}else if($this->session->userdata('statuslogin') == "kunci"){
			redirect(base_url());
		}
    }
    public function admin()
    {
    	# code...
    	$data_session = array('menu' => 'Admin','tampil'=>'admin');
		$this->session->set_userdata($data_session);
		redirect('Admin');
    }
	public function index()
	{
		$data_session = array('menu' => 'Admin');
		$this->session->set_userdata($data_session);
		$data = $this->Admin_model->get_all();
		$nomor=$this->Admin_model->nomor();
		$penyusun= $this->Penyusun_model->get_all();
		$this->load->view('data_admin',['data'=>$data,'nomor'=>$nomor,'penyusun'=>$penyusun]);
	}
	public function tambah()
	{
		$nomor=$this->Admin_model->nomor();
		$this->load->view('data_admin_tambah',['nomor'=>$nomor]);
	}
	public function edit($kd_admin)
	{
		$data=$this->Admin_model->cari($kd_admin);
		$this->load->view('data_admin_edit',['data'=>$data]);
	}
	public function profil()
	{
		
		$data = $this->Admin_model->cari($this->session->userdata('kode_admin'));
		$this->load->view('data_admin_profil',['data'=>$data]);
	}
	public function menu(){
		$data_session = array('menu' => 'Admin','ubah'=>'pass');
		$this->session->set_userdata($data_session);
		redirect('Admin/Profil');
	}
	public function simpan()
	{
		
		$cekemailadmin = $this->Admin_model->cekemailadmin($this->input->post('email'));
        	if (empty($cekemailadmin)) {
        		# code...
        		$cekemailuser= $this->Admin_model->cekemailuser($this->input->post('email'));
        		if (empty($cekemailuser)) {
        			# code...
        			$foto_profil = "";
			        $nmfile = date('ymdhis');
			        $config['upload_path']          = './asset/foto_profil/';
			        $config['allowed_types']        = 'jpeg|gif|jpg|png';
			        $config['max_size'] = '3072'; //maksimum besar file 3M
			        $config['file_name'] = $nmfile;
			        $this->load->library('upload', $config);
			        if ( ! $this->upload->do_upload('foto_profil')){
			            $this->session->set_flashdata('error', 'Foto tidak sesuai format');
			            echo '<script>window.history.back();</script>';
			        }else{
			            $gbr = $this->upload->data();
			            $foto_profil = $gbr['file_name'];
						$data=array(
							'kd_admin'=>$this->input->post('kd_admin'),
							'nm_pegawai'=>$this->input->post('nm_pegawai'),
							'nm_jabatan'=>$this->input->post('nm_jabatan'),
							'email'=>$this->input->post('email'),
							'pass'=>password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
							'lvl_admin'=>$this->input->post('lvl_admin'),
							'foto_profil'=>$foto_profil
						);
						$this->Admin_model->simpan($data);
						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('flash','Ditambahkan');			
						    redirect('Admin');
						}else{
							$this->session->set_flashdata('error','Data Gagal Ditambahkan');
							echo '<script>window.history.back();</script>';
						}
					}
        			
        		}else{
        			$this->session->set_flashdata('error', 'Email sudah terdaftar!');
            		echo '<script>window.history.back();</script>';
        		}
        	}else{
        		$this->session->set_flashdata('error', 'Email sudah terdaftar!');
            	echo '<script>window.history.back();</script>';
        	}		

	}
	public function ubah()
	{
		if ($this->input->post('email')==$this->input->post('emaillama')) {
			if ($this->input->post('pass')=='') {
				$pass=$this->input->post('pass_lama');
			}else{
				$pass=password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
			}
			$nmfile=$_FILES['foto_profil']['name'];
			if ($nmfile=="") {
				$data=array(
					'nm_pegawai'=>$this->input->post('nm_pegawai'),
					'nm_jabatan'=>$this->input->post('nm_jabatan'),
					'email'=>$this->input->post('email'),
					'pass'=>$pass,
					'lvl_admin'=>$this->input->post('lvl_admin')
				);
				$this->Admin_model->ubah($this->input->post('kd_admin'),$data);
				if ($this->db->affected_rows() > 0) {
					if($this->session->userdata('kode_admin')==$this->input->post('kd_admin')){
								$password=$pass;
								$nama=$this->input->post('nm_pegawai');
								$lvl_admin=$this->input->post('lvl_admin');
								$foto=$foto_profil;
								$data_session = array('Password'=>$password,'nama'=>$nama,'foto'=>$foto,'lvl_admin'=>$lvl_admin);
								$this->session->set_userdata($data_session);	
							}		
					$this->session->set_flashdata('flash','Diubah');			
				    redirect('Admin');
				}else{
				    $this->session->set_flashdata('error','Data Gagal Diubah');
					echo '<script>window.history.back();</script>';
				}
			}else{
				$foto_profil = "";
			    $nmfile = date('ymdhis');
			    $config['upload_path']          = './asset/foto_profil/';
			    $config['allowed_types']        = 'jpeg|gif|jpg|png';
			    $config['max_size'] = '3072'; //maksimum besar file 3M
			    $config['file_name'] = $nmfile;
			    $this->load->library('upload', $config);
			    if ( ! $this->upload->do_upload('foto_profil')){
			            $this->session->set_flashdata('error', 'Foto tidak sesuai format');
			            echo '<script>window.history.back();</script>';
			     }else{
			     	if (is_file('./asset/foto_profil/'.$this->input->post('foto'))) {
					    unlink('./asset/foto_profil/'.$this->input->post('foto'));
					}
			            $gbr = $this->upload->data();
			            $foto_profil = $gbr['file_name'];
						$data=array(
							'nm_pegawai'=>$this->input->post('nm_pegawai'),
							'nm_jabatan'=>$this->input->post('nm_jabatan'),
							'email'=>$this->input->post('email'),
							'pass'=>$this->input->post('pass'),
							'lvl_admin'=>$this->input->post('lvl_admin'),
							'foto_profil'=>$foto_profil
						);
						$this->Admin_model->ubah($this->input->post('kd_admin'),$data);
						if ($this->db->affected_rows() > 0) {
							if($this->session->userdata('kode_admin')==$this->input->post('kd_admin')){
								$password=$this->input->post('pass');
								$nama=$this->input->post('nm_pegawai');
								$lvl_admin=$this->input->post('lvl_admin');
								$foto=$foto_profil;
								$data_session = array('Password'=>$password,'nama'=>$nama,'foto'=>$foto,'lvl_admin'=>$lvl_admin);
								$this->session->set_userdata($data_session);	
							}	
							$this->session->set_flashdata('flash','Diubah');						
						    redirect('Admin/Admin');
						}else{
							$this->session->set_flashdata('error','Data Gagal Diubah');
							echo '<script>window.history.back();</script>';
						}
				}
			}
		}else{
			$cekemailadmin = $this->Admin_model->cekemailadmin($this->input->post('email'));
        	if (empty($cekemailadmin)) {
        		# code...
        		$cekemailuser= $this->Admin_model->cekemailuser($this->input->post('email'));
        		if (empty($cekemailuser)) {
        			# code...
        			# code...
					$nmfile=$_FILES['foto_profil']['name'];
					if ($nmfile=="") {
						$data=array(
							'nm_pegawai'=>$this->input->post('nm_pegawai'),
							'nm_jabatan'=>$this->input->post('nm_jabatan'),
							'email'=>$this->input->post('email'),
							'pass'=>$this->input->post('pass'),
							'lvl_admin'=>$this->input->post('lvl_admin')
						);
						$this->Admin_model->ubah($this->input->post('kd_admin'),$data);
						if ($this->db->affected_rows() > 0) {
							if($this->session->userdata('kode_admin')==$this->input->post('kd_admin')){
										$password=$this->input->post('pass');
										$nama=$this->input->post('nm_pegawai');
										$lvl_admin=$this->input->post('lvl_admin');
										$foto=$foto_profil;
										$data_session = array('Password'=>$password,'nama'=>$nama,'foto'=>$foto,'lvl_admin'=>$lvl_admin);
										$this->session->set_userdata($data_session);	
									}		
							$this->session->set_flashdata('flash','Diubah');			
						    redirect('Admin/Admin');
						}else{
						    $this->session->set_flashdata('error','Data Gagal Diubah');
							echo '<script>window.history.back();</script>';
						}
					}else{
						$foto_profil = "";
					    $nmfile = date('ymdhis');
					    $config['upload_path']          = './asset/foto_profil/';
					    $config['allowed_types']        = 'jpeg|gif|jpg|png';
					    $config['max_size'] = '3072'; //maksimum besar file 3M
					    $config['file_name'] = $nmfile;
					    $this->load->library('upload', $config);
					    if ( ! $this->upload->do_upload('foto_profil')){
					            $this->session->set_flashdata('error', 'Foto tidak sesuai format');
					            echo '<script>window.history.back();</script>';
					     }else{
					     	if (is_file('./asset/foto_profil/'.$this->input->post('foto'))) {
							    unlink('./asset/foto_profil/'.$this->input->post('foto'));
							}
					            $gbr = $this->upload->data();
					            $foto_profil = $gbr['file_name'];
								$data=array(
									'nm_pegawai'=>$this->input->post('nm_pegawai'),
									'nm_jabatan'=>$this->input->post('nm_jabatan'),
									'email'=>$this->input->post('email'),
									'pass'=>$this->input->post('pass'),
									'lvl_admin'=>$this->input->post('lvl_admin'),
									'foto_profil'=>$foto_profil
								);
								$this->Admin_model->ubah($this->input->post('kd_admin'),$data);
								if ($this->db->affected_rows() > 0) {
									if($this->session->userdata('kode_admin')==$this->input->post('kd_admin')){
										$password=$this->input->post('pass');
										$nama=$this->input->post('nm_pegawai');
										$lvl_admin=$this->input->post('lvl_admin');
										$foto=$foto_profil;
										$data_session = array('Password'=>$password,'nama'=>$nama,'foto'=>$foto,'lvl_admin'=>$lvl_admin);
										$this->session->set_userdata($data_session);	
									}	
									$this->session->set_flashdata('flash','Diubah');						
								    redirect('Admin/Admin');
								}else{
									$this->session->set_flashdata('error','Data Gagal Diubah');
									echo '<script>window.history.back();</script>';
								}
						}
					}
        			
        		}else{
        			$this->session->set_flashdata('error', 'Email sudah terdaftar!');
            		echo '<script>window.history.back();</script>';
        		}
        	}else{
        		$this->session->set_flashdata('error', 'Email sudah terdaftar!');
            	echo '<script>window.history.back();</script>';
        	}		
		}

	}
	public function ubahprofil()
	{
		if ($this->input->post('email')==$this->input->post('email1')) {
			# code...
			$data=array(
						'email'=>$this->input->post('email'),
						'nm_pegawai'=>$this->input->post('nm_pegawai')
					);
					$this->Admin_model->ubah($this->session->userdata('kode_admin'),$data);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('flash','Diubah');			
					    $data_session = array('menu' => 'Admin','ubah'=>'profil','nama'=>$this->input->post('nm_pegawai'));
						$this->session->set_userdata($data_session);
						redirect('Admin/Profil');
					}else{
						$this->session->set_flashdata('error','Data Gagal Diubah');
						echo '<script>window.history.back();</script>';
					}
		}else{
			$cekemailadmin = $this->Admin_model->cekemailadmin($this->input->post('email'));
        	if (empty($cekemailadmin)) {
        		# code...
        		$cekemailuser= $this->Admin_model->cekemailuser($this->input->post('email'));
        		if (empty($cekemailuser)) {
        			# code...
        			$data=array(
						'email'=>$this->input->post('email'),
						'nm_pegawai'=>$this->input->post('nm_pegawai')
					);
					$this->Admin_model->ubah($this->session->userdata('kode_admin'),$data);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('flash','Diubah');			
					    $data_session = array('menu' => 'Admin','ubah'=>'profil');
						$this->session->set_userdata($data_session);
						redirect('Admin/Profil');
					}else{
						$this->session->set_flashdata('error','Data Gagal Diubah');
						echo '<script>window.history.back();</script>';
					}
        		}else{
        			$this->session->set_flashdata('error', 'Email sudah terdaftar!');
            		echo '<script>window.history.back();</script>';
        		}
        	}else{
        		$this->session->set_flashdata('error', 'Email sudah terdaftar!');
            	echo '<script>window.history.back();</script>';
        	}		
		}
	}
	public function ubahpass()
	{
		if (password_verify($this->session->userdata('Password'), $this->input->post('password_lama'))) {
			$this->session->set_flashdata('error', 'Password Lama Salah! silahkan masukkan password lama yang benar!');
		}elseif ($this->input->post('password_baru')!=$this->input->post('password_confirm')) {
			$this->session->set_flashdata('error', 'Konfirmasi Password Baru Salah! silahkan masukkan konfirmasi password baru yang benar!');
		}else{
			$pass=password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT);
			$data=array(
			'pass'=>$pass
			);
			$this->Admin_model->ubah($this->session->userdata('kode_admin'),$data);
			if ($this->db->affected_rows() > 0) {
				$data_session = array('Password'=>$pass,'menu' => 'Admin','ubah'=>'pass');
				$this->session->set_userdata($data_session);
				$this->session->set_flashdata('flash','Diubah');
				redirect('Admin/Profil');
			}else{
				$this->session->set_flashdata('error','Data Gagal Diubah');	
				$data_session = array('menu' => 'Admin','ubah'=>'pass');
				$this->session->set_userdata($data_session);		
				echo '<script>window.history.back();</script>';
			}
		}		
	}
	public function hapus($kd_admin,$foto)
	{
		if (is_file('./asset/foto_profil/'.$foto)) {
				    unlink('./asset/foto_profil/'.$foto);
		}
		$this->Admin_model->hapus($kd_admin);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Dihapus');			
			redirect('Admin/Admin');
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');		
			echo '<script>window.history.back();</script>';
		}
	}
	public function ubahfoto()
	{
		$nmfile=date('ymdhis');
		$config['upload_path']          = './asset/foto_profil/';
		$config['allowed_types']        = 'jpeg|gif|jpg|png';
		$config['max_size'] = '3072'; //maksimum besar file 3M
		$config['file_name'] = $nmfile;
		$this->load->library('upload', $config);
		    if ( ! $this->upload->do_upload('foto_profil')){
		            $this->session->set_flashdata('error', 'Foto tidak sesuai format');
		            echo '<script>window.history.back();</script>';
		    }else{
		        	if (is_file('./asset/foto_profil/'.$this->input->post('foto'))) {
					    unlink('./asset/foto_profil/'.$this->input->post('foto'));
					}
		            $gbr = $this->upload->data();
		            $foto_profil = $gbr['file_name'];
					$data=array(
						'foto_profil'=>$foto_profil
					);
					$this->Admin_model->ubah($this->input->post('kd_admin'),$data);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('flash','Diubah');
						$data_session = array('menu' => 'Admin','ubah'=>'foto','foto'=>$foto_profil);
						$this->session->set_userdata($data_session);
						redirect('Admin/Profil');
					}else{
						$this->session->set_flashdata('error','Data Gagal Diubah');
						echo '<script>window.history.back();</script>';
					}
				}
	}
	public function Status($kd_admin,$status_admin)
	{
		# code...
		if ($status_admin=='1') {
			# code...
			$status='2';	

		}else{
			$status='1';
		}
		$data=array(
			'status_admin'=>$status
		);
		$this->Admin_model->ubah($kd_admin,$data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Diubah');			
			redirect('Admin');
		}else{
			$this->session->set_flashdata('error','Data Gagal Diubah');		
			echo '<script>window.history.back();</script>';
		}
	}

	public function TambahPenyusun()
	{
		# code...
		$data_session = array('menu' => 'Admin','tampil'=>'penyusun');
		$this->session->set_userdata($data_session);
		
		$th=$this->Penyusun_model->cari($this->input->post('tahun'));
		if (empty($th)) {
			# code...
			$data=array(
				'th_penyusunan'=>$this->input->post('tahun'),
				'kd_ketua'=>$this->input->post('kd_ketua'),
				'kd_penanggungjawab'=>$this->input->post('kd_penangungjawab')
			);
			$this->Penyusun_model->simpan($data);
			if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Disimpan');			
			redirect('Admin');
			}else{
				$this->session->set_flashdata('error','Data Gagal Disimpan');		
				echo '<script>window.history.back();</script>';
			}
		}else{
			
			$this->session->set_flashdata('error','Tim Penyusunan Tahun '.$this->input->post('tahun').' Sudah Ada');		
			echo '<script>window.history.back();</script>';
		}	
	}
	public function EditPenyusun()
	{
		# code...
		$data_session = array('menu' => 'Admin','tampil'=>'penyusun');
		$this->session->set_userdata($data_session);
		
		$data=array(
			'th_penyusunan'=>$this->input->post('th_edit1'),
			'kd_ketua'=>$this->input->post('kd_ketua_edit'),
			'kd_penanggungjawab'=>$this->input->post('kd_penanggungjawab_edit')
		);
		$this->Penyusun_model->ubah($this->input->post('th_edit1'),$data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Diubah');			
			redirect('Admin');
		}else{
			$this->session->set_flashdata('error','Data Gagal Diubah');		
			echo '<script>window.history.back();</script>';
		}
	}
}