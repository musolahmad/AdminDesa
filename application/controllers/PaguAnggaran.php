<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaguAnggaran extends CI_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
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
    redirect('PaguAnggaran/Tahun/'.$tahun); 
  }
  public function tahun($tahun){
    $data_session = array('menu' => 'Pagu Anggaran');
    $this->session->set_userdata($data_session);
    $data = $this->PaguAnggaran_model->get_all($tahun);
    $list = $this->Bidang_model->listbidang($tahun);
    $pendapatan=$this->PaguAnggaran_model->totalpendapatan($tahun);
    $pengeluaran=$this->PaguAnggaran_model->totalpengeluaran($tahun);
    $this->load->view('data_pagu',['data'=>$data,'tahun'=>$tahun,'list'=>$list,'pendapatan'=>$pendapatan,'pengeluaran'=>$pengeluaran]);
  }
  public function tambah()
  {
    # code...
    $data=array(
      'kd_pagu'=>substr($this->input->post('tahun'), 2).$this->input->post('kd_bidang'),
      'kd_bidang'=>$this->input->post('kd_bidang'),
      'tahun'=>$this->input->post('tahun'),
      'pagu'=>str_replace('.', '', $this->input->post('pagu'))
    );
    $this->PaguAnggaran_model->simpan($data);
    if ($this->db->affected_rows() > 0) {
       redirect('PaguAnggaran/updatepagu/'.$this->input->post('kd_bidang').'/'.$this->input->post('tahun').'/'.str_replace('.', '', $this->input->post('pagu')).'/Ditambahkan');
    }else{
      $this->session->set_flashdata('error','Data Gagal Ditambahkan');      
      echo '<script>window.history.back();</script>';
    }
  }
  public function updatepagu($kd_bidang,$tahun,$pagu,$status){
    $cari=$this->Bidang_model->cari($kd_bidang);
      foreach ($cari as $c) {
        # code...
        $kd_induk=$c['kd_induk'];
      }
      if ($kd_induk==0) {
        # code...
        $this->session->set_flashdata('flash',$status);
        redirect('PaguAnggaran/Tahun/'.$tahun); 
      }else{
        $cekpagu=$this->PaguAnggaran_model->cari(substr($tahun, 2).$kd_induk);
        if (empty($cekpagu)) {
          # code...
          $data=array(
            'kd_pagu'=>substr($tahun, 2).$kd_induk,
            'kd_bidang'=>$kd_induk,
            'tahun'=>$tahun,
            'pagu'=>$pagu
          );
          $this->PaguAnggaran_model->simpan($data);
          redirect('PaguAnggaran/updatepagu/'.$kd_induk.'/'.$tahun.'/'.$pagu.'/'.$status);
        }else{
           $updateakun= $this->PaguAnggaran_model->cariakun($kd_induk,$tahun);
           foreach ($updateakun as $p) {
             # code...
            $pagu=$p['pagu'];
           }
           $data=array(
            'kd_pagu'=>substr($tahun, 2).$kd_induk,
            'kd_bidang'=>$kd_induk,
            'tahun'=>$tahun,
            'pagu'=>$pagu
          );
          $this->PaguAnggaran_model->ubah(substr($tahun, 2).$kd_induk,$data);
          redirect('PaguAnggaran/updatepagu/'.$kd_induk.'/'.$tahun.'/'.$pagu.'/'.$status);
        }        
      }
  }
  public function ubah()
  {
    # code...
    $data=array(
      'pagu'=>str_replace('.', '', $this->input->post('pagu_edit'))
    );
    $this->PaguAnggaran_model->ubah($this->input->post('kd_pagu_edit'),$data);
    if ($this->db->affected_rows() > 0) {
      redirect('PaguAnggaran/updatepagu/'.substr($this->input->post('kd_pagu_edit'), 2).'/'.$this->input->post('tahun_edit').'/'.str_replace('.', '', $this->input->post('pagu_edit')).'/Diubah');
    }else{
      $this->session->set_flashdata('error','Data Gagal Diubah');      
      echo '<script>window.history.back();</script>';
    }
  }
  public function hapus($kd_pagu,$tahun)
  {
    $this->PaguAnggaran_model->hapus($kd_pagu);
    if ($this->db->affected_rows() > 0) {
      redirect('PaguAnggaran/updatepagu/'.substr($kd_pagu, 2).'/'.$tahun.'/0/Diubah');
      $this->session->set_flashdata('flash','Dihapus');
      redirect('PaguAnggaran/Tahun/'.$tahun);
    }else{
      $this->session->set_flashdata('error','Data Gagal Dihapus');
      echo '<script>window.history.back();</script>';
    }
  }
}