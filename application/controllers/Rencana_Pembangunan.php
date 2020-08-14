<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rencana_Pembangunan extends CI_Controller {

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
        $this->load->model('Bidang_model');
        $this->load->model('ReferensiAduan_model');
        $this->load->model('Aduan_model');    
        $this->load->model('Dusun_model');
        $this->load->model('Kegiatan_model');
        $this->load->model('BobotKriteria_model');
        $this->load->model('KriteriaDetail_model');
        $this->load->model('KriteriaKegiatan_model');
        $this->load->model('Selisih_model');
        $this->load->model('Promethee_model');
        $this->load->model('Komentar_model');    
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
		$tahun=$this->input->post('tahun');
		redirect('Rencana_Pembangunan/Tahun/'.$tahun.'/1');
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
		$datarencana = $this->RencanaPembangunan_model->rencana($tahun,$kd_bidang);
		$total = $this->RencanaPembangunan_model->totalanggaran($tahun,$kd_bidang);
		$data_session = array(
						'menu' => 'Rencana Pembangunan',
						'tahun'=>$tahun
						);
		$this->session->set_userdata($data_session);
		$data = $this->RencanaPembangunan_model->get_all($tahun);
		$this->load->view('data_rencana_pembangunan',['data'=>$data,'no'=>$nomor,'datarencana'=>$datarencana,'total'=>$total]);
	}
	public function tambah($tahun,$kd_bidang)
	{
		if ($this->session->userdata('lvl_admin')=="1") {
			# code...
		$bidang = $this->Bidang_model->cari($kd_bidang);
		$data = $this->Kegiatan_model->get_all();
        $kriteria=$this->BobotKriteria_model->cari($kd_bidang,$tahun);
        $dusun = $this->Dusun_model->get_all();
        $jml_rt = $this->Dusun_model->rt();
		$data_session = array(
						'menu' => 'Rencana Pembangunan',
						'tahun'=>$tahun
						);
		$this->session->set_userdata($data_session);
		$d = array('bidang'=>$bidang,'data'=>$data,'kriteria'=>$kriteria,'dusun'=>$dusun,'jml_rt'=>$jml_rt);
		$this->load->view('data_rencana_tambah',$d);
		}else{
			redirect('Rencana_Pembangunan/Tahun/'.$tahun.'/'.$kd_bidang);
		}
	}
	public function edit($kd_bidang,$kd_rencana,$tahun)
	{
		if ($this->session->userdata('lvl_admin')=="1") {
		$bidang = $this->Bidang_model->cari($kd_bidang);
		$data = $this->Kegiatan_model->get_all();
		$rw=$this->RT_RW_model->nomor();
        $rt=$this->RT_RW_model->rt();
        $dataedit=$this->RencanaPembangunan_model->cari($kd_rencana);
		$data_session = array(
						'menu' => 'Rencana Pembangunan',
						'tahun'=>$tahun
						);
		$this->session->set_userdata($data_session);
		$this->load->view('data_rencana_edit',['dataedit'=>$dataedit,'bidang'=>$bidang,'data'=>$data,'rw'=>$rw,'rt'=>$rt]);
		}else{
			redirect('Rencana_Pembangunan/Tahun/'.$tahun.'/'.$kd_bidang);
		}
	}
	public function Referensi($kd_bidang,$kd_rencana,$tahun)
	{
		$dataedit=$this->RencanaPembangunan_model->cari($kd_rencana);
		$web = $this->Web_model->get_all();
		$this->load->view('data_referensi_pembangunan',['dataedit'=>$dataedit,'web'=>$web]);
	}
	public function Kembali($tahun,$kd_bidang)
	{
		if ($this->session->userdata('menu')=='Rencana Pembangunan') {
			# code...
			redirect('Rencana_Pembangunan/Tahun/'.$tahun.'/'.$kd_bidang);
		}else{
			redirect('Pelaksanaan_Pembangunan/Tahun/'.$tahun.'/'.$kd_bidang);
		}
	}
	public function ubahfoto()
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
        	if (is_file('./asset/foto_pembangunan/'.$this->input->post('foto_edit1'))) {
			    unlink('./asset/foto_pembangunan/'.$this->input->post('foto_edit1'));
			}
			$gbr = $this->upload->data();
            $foto = $gbr['file_name'];
            $data=array(					
            	'foto_lokasi'=> $foto
			);
			$this->RencanaPembangunan_model->ubah($this->input->post('foto_rencana'),$data);
			$this->session->set_flashdata('flash','Diubah');
			redirect('Rencana_Pembangunan/Tahun/'.$this->input->post('foto_th').'/'.$this->input->post('foto_kd_bidang'));
        }
	}
	public function ubahRAB()
	{
		$rab = "";
        $nmfile=date('ymdhis');
        $config['upload_path']          = './asset/file_rab/';
        $config['allowed_types']        = 'pdf';
        $config['max_size'] = '3072'; //maksimum besar file 3M
        $config['file_name'] = $nmfile;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file_edit')){
            $this->session->set_flashdata('error', 'File tidak sesuai format / Resolusi Terlalu Besar');
            echo '<script>window.history.back();</script>';
        }else{ 
        	if (is_file('./asset/file_rab/'.$this->input->post('file_edit1'))) {
			    unlink('./asset/file_rab/'.$this->input->post('file_edit1'));
			}
			$gbr = $this->upload->data();
            $rab = $gbr['file_name'];
            $data=array(					
            	'file_rab'=> $rab
			);
			$this->RencanaPembangunan_model->ubah($this->input->post('file_rencana'),$data);
			$this->session->set_flashdata('flash','Diubah');
			redirect('Rencana_Pembangunan/Tahun/'.$this->input->post('file_th').'/'.$this->input->post('file_kd_bidang'));
        }
	}
	public function tambahdata()
	{
		$file_rab = "";
        $nmfile=date('ymdhis');
        $config['upload_path']          = './asset/file_rab/';
        $config['allowed_types']        = 'pdf';
        $config['max_size'] = '3072'; //maksimum besar file 3M
        $config['file_name'] = $nmfile;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('rab')){
            $this->session->set_flashdata('error', 'File Rencana Anggaran Biaya tidak sesuai format');
            echo '<script>window.history.back();</script>';
        }else{
			$gbr = $this->upload->data();
		    $file_rab = $gbr['file_name'];
			
			$foto = "";
			$nmfile=date('ymdhis');
			$config2['upload_path']          = './asset/foto_pembangunan/';
			$config2['allowed_types']        = 'jpeg|gif|jpg|png';
			$config2['max_size'] = '3072'; //maksimum besar file 3M
			$config2['file_name'] = $nmfile;
			$this->upload->initialize($config2);
			$this->load->library('upload', $config2);
			if ( ! $this->upload->do_upload('foto')){
				if (is_file('./asset/file_rab/'.$file_rab)) {
					unlink('./asset/file_rab/'.$file_rab);
				}
				$this->session->set_flashdata('error', 'Foto tidak sesuai format');
				echo '<script>window.history.back();</script>';
			}else{
				$gbr = $this->upload->data();
				$foto = $gbr['file_name'];

				$datarencana = $this->RencanaPembangunan_model->kd_rencana($this->input->post('tahun'),$this->input->post('kd_bidang'));
				if (empty($datarencana)) {
					$kd_rencana = substr($this->input->post('tahun'), 2).$this->input->post('kd_bidang')."001";
				}else{
					foreach ($datarencana as $d) {
						# code...
						$kd_rencana=$d['kd_rencana']+1;
					}
				}
				$data=array(
						'kd_rencana'=>$kd_rencana,
						'kd_bidang'=>$this->input->post('kd_bidang'),
						'tahun'=>$this->input->post('tahun'),
						'kd_kegiatan'=>$this->input->post('kd_kegiatan'),
						'kd_dusun'=>$this->input->post('kd_dusun'),
						'rt'=>$this->input->post('rt'),
						'biaya'=>str_replace('.', '', $this->input->post('biaya')),
						'status_pengajuan'=>'1',
						'catatan'=>'-',
						'foto_lokasi'=> $foto,
						'file_rab'=>$file_rab
				);
				$this->RencanaPembangunan_model->simpan($data);
				$kd_bobot=$this->input->post('kd_bobot');
				$jml= count($kd_bobot);
				$no=[];
				$nomor=1;
				$kd_dtl_kriteria=$this->input->post('kd_dtl_kriteria');
				$kd_bobot=$this->input->post('kd_bobot');
				for($x=0;$x<$jml;$x++){
					$no[$x]="0".$nomor;
					$data=array(
						'kd_nilai_kriteria'=>$kd_rencana.$no[$x],
						'kd_rencana'=>$kd_rencana,
						'kd_bobot'=>$kd_bobot[$x],
						'kd_dtl_kriteria'=>$kd_dtl_kriteria[$x]
					);
					$this->KriteriaKegiatan_model->simpan($data);
					$nomor++;
				}
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('flash','Ditambahkan');
					redirect('Rencana_Pembangunan/Tahun/'.$this->input->post('tahun').'/'.$this->input->post('kd_bidang'));
				}else{
					$this->session->set_flashdata('error','Data Ditambahkan');
					echo '<script>window.history.back();</script>';
				}
			}
		}
	}
	public function ajukankembali()
	{
		# code...
		$kd_rencana=$this->input->post('kd_rencana2');
		$data=array(
						'status_pengajuan'=>'1',
						'catatan'=>$this->input->post('catatan2')
				);
				$this->RencanaPembangunan_model->ubah($kd_rencana,$data);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('flash','Diubah');
					redirect('Rencana_Pembangunan/Tahun/'.$this->input->post('th2').'/'.$this->input->post('kd_bidang2'));
				}else{
					$this->session->set_flashdata('error','Data Gagal Diubah');
					echo '<script>window.history.back();</script>';
				}
	}
	public function terimarencana(){
		$cek=$this->Pelaksanaan_model->cari($this->input->post('kd_rencana'));
		if (empty($cek)) {
			$kd_rencana=$this->input->post('kd_rencana');			
			if ($this->input->post('st_pengajuan')=="3") {
				$data=array(
						'status_pengajuan'=>'2',
						'catatan'=>$this->input->post('catatan')
				);
				$this->RencanaPembangunan_model->ubah($kd_rencana,$data);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('flash','Diubah');
					redirect('Rencana_Pembangunan/Tahun/'.$this->input->post('th').'/'.$this->input->post('kd_bidang'));
				}else{
					$this->session->set_flashdata('error','Data Gagal Diubah');
					echo '<script>window.history.back();</script>';
				}
			}else{
				$data=array(
						'status_pengajuan'=>'2',
						'catatan'=>$this->input->post('catatan')
				);
				$this->RencanaPembangunan_model->ubah($kd_rencana,$data);

				$inputselisih=$this->KriteriaKegiatan_model->lihat($kd_rencana);
				foreach ($inputselisih as $i) {
					# code...
					$data1=array('kd_nilai_kriteria_1'=>$i['kd_nilai_kriteria'],'kd_nilai_kriteria_2'=>$i['kd_nilai_kriteria']);
					$this->Selisih_model->simpan($data1);
					$selisih=$this->KriteriaKegiatan_model->get_all($i['kd_bobot'],$this->input->post('kd_bidang'),$kd_rencana);
					foreach ($selisih as $s) {
						# code...
						$data2=array('kd_nilai_kriteria_1' =>$i['kd_nilai_kriteria'],'kd_nilai_kriteria_2' => $s['kd_nilai_kriteria']);
						$this->Selisih_model->simpan($data2);
						$data3=array('kd_nilai_kriteria_1' => $s['kd_nilai_kriteria'],'kd_nilai_kriteria_2' =>$i['kd_nilai_kriteria']);
						$this->Selisih_model->simpan($data3);
					}
				}
				$data_session = array('alert' => 'ubah');
				$this->session->set_userdata($data_session);
				redirect('Rencana_Pembangunan/Lihat/'.$this->input->post('th').'/'.$this->input->post('kd_bidang'));
			}
		}else{
			$this->session->set_flashdata('error','Data Tidak bisa diubah');
			echo '<script>window.history.back();</script>';
		}	
	}
	public function lihat($tahun,$kd_bidang)
	{
		# code..
		$datarencana = $this->RencanaPembangunan_model->rencana1($tahun,$kd_bidang);
		$x=0;$yz=[];$r1=[];
		foreach ($datarencana as $d1) {
			$r1[$x]=$d1['kd_rencana'];
			$yz[$x]= $this->RencanaPembangunan_model->rencana1($tahun,$kd_bidang);
			$y=0;$xz=[];$r2=[];$zx=[];
			foreach ($yz[$x] as $d2) {
				# code...
				$z=0;$zz=[];$r3=[];
				$r2[$y]=$d2['kd_rencana'];
				$selisih=$this->Selisih_model->get_all($r1[$x],$r2[$y]);
				foreach ($selisih as $sl) {
					# code...
					$r3[$z]=$sl['kd_nilai_kriteria_1'];
					$zz[$z]=(((($sl['nilai1']*$sl['bobot'])/100)-(($sl['nilai2']*$sl['bobot'])/100))/$sl['parameter'])/$this->RencanaPembangunan_model->totaladuan($tahun,$kd_bidang,'2');					
					$z++;					
				}
				$zx[$y]=round(array_sum($zz),3);
				$y++;
			}
			$data=array(
				'kd_rencana' => $r1[$x],
				'nilai_leaving_flow'=>array_sum($zx),
				'nilai_entering_flow'=>-array_sum($zx),
				'nilai_net_flow'=>array_sum($zx)-(-array_sum($zx))
			);
			$cari = $this->Promethee_model->cari($r1[$x]);
			if (empty($cari)) {
					# code...
				$this->Promethee_model->simpan($data);	
			}else{
				$this->Promethee_model->ubah($r1[$x],$data);	
			}
			$x++;
		}
		if ($this->session->userdata('alert')=="ubah") {
			# code...
			$this->session->set_flashdata('flash','Diubah');
		}else{
			$this->session->set_flashdata('flash','Dihapus');
		}
		redirect('Rencana_Pembangunan/Tahun/'.$tahun.'/'.$kd_bidang);
		
	}
	public function tolakrencana()
	{
		$cek=$this->Pelaksanaan_model->cari($this->input->post('kd_rencana_tolak'));
		if (empty($cek)) {
			# code...
			$kd_rencana=$this->input->post('kd_rencana_tolak');
			$data=array(
					'status_pengajuan'=>'3',
					'catatan'=>$this->input->post('catatan_tolak')
			);
			$this->RencanaPembangunan_model->ubah($kd_rencana,$data);
			$this->Promethee_model->hapus($kd_rencana);
			$data=$this->KriteriaKegiatan_model->cek($kd_rencana);
			foreach ($data as $d) {
				# code...
				$this->Selisih_model->hapus1($d['kd_nilai_kriteria']);
				$this->Selisih_model->hapus2($d['kd_nilai_kriteria']);
			}

			$hapusreferensi=$this->ReferensiAduan_model->cari($kd_rencana);
			if (!empty($hapusreferensi)) {
				foreach ($hapusreferensi as $hs) {
					# code...
					$this->Komentar_model->hapus($hs['kd_komentar']);
					$this->ReferensiAduan_model->hapus($hs['kd_aduan']);
				}

			}

			$data_session = array('alert' => 'ubah');
			$this->session->set_userdata($data_session);
			redirect('Rencana_Pembangunan/Lihat/'.$this->input->post('th_tolak').'/'.$this->input->post('kd_bidang_tolak'));
		}else{
			$this->session->set_flashdata('error','Data Tidak bisa diubah');
			echo '<script>window.history.back();</script>';
		}
		
	}
	public function hapus($kd_bidang,$kd_rencana,$tahun,$foto,$file_rab)
	{
		if (is_file('./asset/foto_pembangunan/'.$foto)) {
		    unlink('./asset/foto_pembangunan/'.$foto);
		}
		if (is_file('./asset/file_rab/'.$file_rab)) {
		    unlink('./asset/file_rab/'.$file_rab);
		}
		$data=$this->KriteriaKegiatan_model->cek($kd_rencana);
		foreach ($data as $d) {
			# code...
			$this->KriteriaKegiatan_model->hapus($d['kd_nilai_kriteria']);
		}
		$this->RencanaPembangunan_model->hapus($kd_rencana);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Ditambahkan');
			redirect('Rencana_Pembangunan/Lihat/'.$tahun.'/'.$kd_bidang);
		}else{
			$this->session->set_flashdata('error','Data Gagal Ditambahkan');
			echo '<script>window.history.back();</script>';
		}
	}
	public function ubahdata()
	{
		$data=array(
					'kd_rencana'=>$this->input->post('kd_rencana'),
					'kd_bidang'=>$this->input->post('kd_bidang'),
					'tahun'=>$this->input->post('tahun'),
					'kd_kegiatan'=>$this->input->post('kd_kegiatan'),
					'kd_dusun'=>$this->input->post('kd_dusun'),
					'rt'=>$this->input->post('rt'),
					'biaya'=>$this->input->post('biaya')
			);
			$this->RencanaPembangunan_model->ubah($this->input->post('kd_rencana'),$data);
			$kd_bobot=$this->input->post('kd_bobot');
			$kd_nilai_kriteria=$this->input->post('kd_nilai_kriteria');
			$jml= count($kd_bobot);
			$kd_dtl_kriteria=$this->input->post('kd_dtl_kriteria');
			$kd_bobot=$this->input->post('kd_bobot');
			for($x=0;$x<$jml;$x++){
				$data=array(
					'kd_nilai_kriteria'=>$kd_nilai_kriteria[$x],
					'kd_rencana'=>$this->input->post('kd_rencana'),
					'kd_bobot'=>$kd_bobot[$x],
					'kd_dtl_kriteria'=>$kd_dtl_kriteria[$x]
				);
				$this->KriteriaKegiatan_model->ubah($kd_nilai_kriteria[$x],$data);
			}		
			$this->session->set_flashdata('flash','Diubah');
			redirect('Rencana_Pembangunan/Tahun/'.$this->input->post('tahun').'/'.$this->input->post('kd_bidang'));
	}
	public function tambahreferensi($kd_aduan,$kd_bidang,$kd_rencana,$tahun)
	{
		# code...
		$data=array('status_aduan'=>'Diajukan');
		$this->Aduan_model->ubah($kd_aduan,$data);		
		$nomor=$this->Komentar_model->nomor();
		if (empty($nomor)) {
			# code...
			$kd_komentar = $kd_aduan.'001';
		}else{
			foreach ($nomor as $n) {
				# code...
				$kd_komentar = $n['kd_komentar']+1;
			}
		}
		$dataterima=array(
			'kd_komentar' => $kd_komentar,
			'kd_aduan'=> $kd_aduan,
			'kd_admin'=> $this->session->userdata('kode_admin'),
			'isi_komentar'=>'Aduan Sudah Diajukan Untuk Rencana Pembangunan Oleh Admin',
			'dibaca'=> 'T'
		 );
		$this->Komentar_model->simpan($dataterima);
		$data1=array('kd_aduan'=>$kd_aduan,'kd_rencana'=>$kd_rencana);
		$this->ReferensiAduan_model->simpan($data1);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Ditambahkan');
			redirect('Rencana_Pembangunan/Referensi/'.$kd_bidang.'/'.$kd_rencana.'/'.$tahun);
		}else{
			$this->session->set_flashdata('error','Data Gagal Ditambahkan');
			echo '<script>window.history.back();</script>';
		}
	}
	public function hapusreferensi($kd_aduan,$kd_bidang,$kd_rencana,$tahun)
	{
		# code...
		$this->ReferensiAduan_model->hapus($kd_aduan);
		$isi_komentar='Aduan Sudah Diajukan Untuk Rencana Pembangunan Oleh Admin';
		$this->Komentar_model->hapusisi($isi_komentar);
		$data=array('status_aduan'=>'Diterima');
		$this->Aduan_model->ubah($kd_aduan,$data);	
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Dihapus');
			redirect('Rencana_Pembangunan/Referensi/'.$kd_bidang.'/'.$kd_rencana.'/'.$tahun);
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');
			echo '<script>window.history.back();</script>';
		}
	}
}
