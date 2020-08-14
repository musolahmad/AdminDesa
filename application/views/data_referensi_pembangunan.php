<?php
  foreach ($dataedit as $e) {
    # code...
    $bidang=$e['nm_bidang'];
    $kd_bidang=$e['kd_bidang'];
    $kd_rencana=$e['kd_rencana'];
    $nm_kegiatan=$e['nm_kegiatan'];
    $tahun=$e['tahun'];
    $rt=$e['rt'];
    $rw=$e['rw'];
    $anggaran=$e['biaya'];
    $kd_dusun=$e['kd_dusun'];    
    $foto_lokasi=$e['foto_lokasi'];
  }
  foreach ($web as $w) {
  # code...
  $web_masyarakat=$w['web_masyarakat'];
}
?>
<!DOCTYPE html>
<html>
<?php $this->load->view('menu/head') ?>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

  <!--header-->
  <?php $this->load->view('menu/header') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('menu/sidebar') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
      <?php if($this->session->flashdata('flash')):?>
      <?php endif;?>
      <div class="flash-confirm" data-flashconfirm="<?=$this->session->flashdata('error');?>"></div>
      <?php if($this->session->flashdata('error')):?>
      <?php endif;?>
      <h1>
        REFERENSI PEMBANGUNAN        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Beranda"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">REFERENSI PEMBANGUNAN</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$bidang." TAHUN ".$tahun?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
            <div class="col-md-6">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">                      
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <?php $fotoaduan=$this->Pembangunan_model->cari2($kd_rencana);
                        $no=1;
                        foreach ($fotoaduan as $f) {?>
                      <li data-target="#carousel-example-generic" data-slide-to="<?=$no?>" class="<?php if($no==0){echo 'active';}?>"></li>
                      <?php $no++;}?>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="<?=base_url()?>asset/foto_pembangunan/<?=$foto_lokasi?>" alt="Foto Lokasi">
                        <div class="carousel-caption">
                          Foto Lokasi
                        </div>
                      </div>
                      <?php 
                        $no=1;
                        foreach ($fotoaduan as $f) {?>
                      <div class="item <?php if($no==0){echo 'active';}?>">
                        <img src="<?=$web_masyarakat?>asset/foto_aduan/<?=$f['foto']?>" alt="<?=$f['nm_topik']?>">
                        <div class="carousel-caption">
                          <?=$f['nm_topik']?>
                        </div>
                      </div>
                      <?php $no++;}?>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                </div>
              <div class="col-md-6">  
              <table class="table table-striped">
                <tr>
                  <td style="width: 150px">Kegiatan</td>
                  <td colspan="2"><?=$nm_kegiatan?></td>
                </tr>
                <tr>
                  <td style="width: 150px">Lokasi</td>
                  <td colspan="2">RT <?=$rt?> RW <?=$rw?></td>
                </tr>
                <tr>
                  <td style="width: 150px">Pagu Anggaran</td>
                  <td colspan="2">Rp <?=number_format($anggaran,2,'.',',')?></td>
                </tr>
                  <tr>
                       <td><b>Kriteria Penilaian</b></td>
                       <td><b>Nilai</b></td>
                       <td><b>Detail Kriteria</b></td>
                    </tr>
                    <?php 
                      $kriteria = $this->Pembangunan_model->lihat($kd_rencana);
                      foreach ($kriteria as $k) {?>
                    <tr>
                      <td ><?=$k['nm_kriteria']?></td>
                      <td><?=$k['nilai_dtl_kriteria']?></td>
                      <td><?=$k['nm_dtl_kriteria']?></td>
                    </tr>
                    <?php }?>
                <!-- /.box-body -->
                 <tr>
                  <td colspan="3" style="width: 150px"><a type="button" href="<?=base_url()?>Rencana_Pembangunan/Kembali/<?=$this->session->userdata('tahun')?>/<?=$kd_bidang?>" class="btn btn-default">Kembali</a></td>
                </tr>                 
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <?php if($this->session->userdata('lvl_admin')=="1"){?>
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Aduan Masyarakat</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive mailbox-messages">              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Aduan</th>
                  <th style="width: 40px">Aksi</th>
                </tr>
                </thead>
                <tbody>                
                <?php $aduan=$this->Aduan_model->cekaduan($kd_dusun,$rt);
                  $no=1;
                  if (empty($aduan)) {?>
                   <tr>
                    <th style="width: 10px">#</th>
                    <th>Tidak Ada Aduan Terbaru</th>
                    <th style="width: 40px">#</th>
                  </tr>
                  <?php }else{
                  foreach ($aduan as $a) {
                  ?>
                  <tr>
                    <td><?=$no?>.</td>
                    <td>
                        <?=$a['nm_topik']?> Lokasi RT <?=$a['rt']?> RW <?=$a['rw']?>
                        <br>
                        Pelapor : <?=$a['nm_user']?>
                        <br>
                        Tanggal : <?=date('d-M-Y H:i:s',strtotime($a['tgl_aduan']))?>
                        <hr>
                        <?=$a['deskripsi']?>
                        <img class="img-responsive pad" src="<?=$web_masyarakat?>asset/foto_aduan/<?=$a['foto']?>" alt="Photo">
                    </td>
                    <td><a href="<?=base_url()?>Rencana_Pembangunan/TambahReferensi/<?=$a['kd_aduan']?>/<?=$kd_bidang?>/<?=$kd_rencana?>/<?=$tahun?>"><span class="badge bg-red">Pilih Aduan</span></a></td>
                  </tr>
                  <?php $no++;}}?>
                 </tbody> 
                 <tfoot>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Aduan</th>
                  <th style="width: 40px">Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <?php }?>
        <!-- /.col -->
        <?php if($this->session->userdata('lvl_admin')=="1"){?>
        <div class="col-md-6">
        <?php }else{?>
        <div class="col-md-12">
        <?php }?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Referensi Rencana Pembangunan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding table-responsive mailbox-messages">
              <table class="table table-striped">
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Aduan</th>
                  <?php if($this->session->userdata('lvl_admin')=="1"){?>
                  <th style="width: 40px">Aksi</th>
                  <?php }?>
                </tr>
                <?php $aduan=$this->ReferensiAduan_model->cari($kd_rencana);
                  $no=1;
                  if (empty($aduan)) {?>
                   <tr>
                    <th style="width: 10px">#</th>
                    <th>Tidak Ada Aduan</th>
                    <?php if($this->session->userdata('lvl_admin')=="1"){?>
                    <th style="width: 40px">#</th>
                    <?php }?>
                  </tr>
                  <?php }else{
                  foreach ($aduan as $aa) {
                    $kd_aduan=$this->Aduan_model->cari($aa['kd_aduan']);
                    foreach ($kd_aduan as $a) {                    
                  ?>
                  <tr>
                    <td><?=$no?>.</td>
                    <td>
                        <?=$a['nm_topik']?> Lokasi RT <?=$a['rt']?> RW <?=$a['rw']?>
                        <br>
                        Pelapor : <?=$a['nm_user']?>
                        <br>
                        Tanggal : <?=date('d-M-Y H:i:s',strtotime($a['tgl_aduan']))?>
                        <hr>
                        <?=$a['deskripsi']?>
                        <img class="img-responsive pad" src="<?=$web_masyarakat?>asset/foto_aduan/<?=$a['foto']?>" alt="Photo">
                    </td>
                    <?php if($this->session->userdata('lvl_admin')=="1"){?>
                    <td><a href="<?=base_url()?>Rencana_Pembangunan/HapusReferensi/<?=$a['kd_aduan']?>/<?=$kd_bidang?>/<?=$kd_rencana?>/<?=$tahun?>"><span class="badge bg-red">Hapus Referensi</span></a></td>
                    <?php }?>
                  </tr>
                  <?php } $no++;}}?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- /.footer -->
  <?php $this->load->view('menu/footer') ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php $this->load->view('menu/script')?>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
