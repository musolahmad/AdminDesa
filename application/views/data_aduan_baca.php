<?php 
$jm=0;$jh=0;$jb=0;$jtm=0;$jtl=0;
foreach ($jml_masuk as $j) {
  # code...
  $jm=$jm+$j['jml'];
}
foreach ($jml_hariini as $j) {
  # code...
  $jh=$jh+$j['jml'];
}
foreach ($jml_blmbaca as $j) {
  # code...
  $jb=$jb+$j['jml'];
}
foreach ($jml_diterima as $j) {
  # code...
  $jtm=$jtm+$j['jml'];
}
foreach ($jml_ditolak as $j) {
  # code...
  $jtl=$jtl+$j['jml'];
}
foreach ($cari as $d) {
  # code...
  $kd_aduan=$d['kd_aduan'];
  $nm_user=$d['nm_user'];
  $email=$d['email'];
  $topik_aduan=$d['nm_topik'];
  $tgl_aduan=date('d-M-Y H:i:s',strtotime($d['tgl_aduan']));
  $deskripsi=$d['deskripsi'];
  $foto=$d['foto'];
  $status_aduan=$d['status_aduan'];
  $lokasi = "RT ".$d['rt']." RW ".$d['rw'];
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
    <div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
      <?php if($this->session->flashdata('flash')):?>
      <?php endif;?>
      <div class="flash-confirm" data-flashconfirm="<?=$this->session->flashdata('error');?>"></div>
      <?php if($this->session->flashdata('error')):?>
      <?php endif;?>
      
    <section class="content-header">
      <h1>
        Aduan Masyarakat
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Beranda"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Aduan Masyarakat</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li <?php if ($this->session->userdata('aduan')=='Masuk'){echo 'class="active"';}?>><a href="<?=base_url()?>Aduan/Masuk"><i class="fa fa-inbox"></i> Aduan Masuk
                  <span class="label label-warning pull-right"><?=$jm?></span></a></li>
                <li <?php if ($this->session->userdata('aduan')=='Hari Ini'){echo 'class="active"';}?>><a href="<?=base_url()?>Aduan/HariIni"><i class="fa fa-clock-o"></i> Aduan Hari Ini
                  <span class="label label-primary pull-right"><?=$jh?></span></a></li>
                <li <?php if ($this->session->userdata('aduan')=='Belum di Baca'){echo 'class="active"';}?>><a href="<?=base_url()?>Aduan/BlmBaca"><i class="fa fa-book"></i> Aduan Belum di Baca
                  <span class="label label-info pull-right"><?=$jb?></span></a></li>
                <li <?php if ($this->session->userdata('aduan')=='Diterima'){echo 'class="active"';}?>><a href="<?=base_url()?>Aduan/Diterima"><i class="fa fa-check-square"></i> Aduan Diterima
                  <span class="label label-success pull-right"><?=$jtm?></span></a></li>
                <li <?php if ($this->session->userdata('aduan')=='Ditolak'){echo 'class="active"';}?>><a href="<?=base_url()?>Aduan/Ditolak"><i class="fa fa-close"></i> Aduan Ditolak
                  <span class="label label-danger pull-right"><?=$jtl?></span></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Baca Aduan</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?=$topik_aduan?> Lokasi <?=$lokasi?></h3>
                <h5>Pelapor : <?=$nm_user?> [<?=$email?>]
                  <span class="mailbox-read-time pull-right"><?=$tgl_aduan?></span></h5>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <?php if($status_aduan=="Masuk"){?>
                <div class="btn-group pull-right">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Pilih Tindakan
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?=base_url()?>Aduan/Terima/<?=$kd_aduan?>"><i class="fa fa-check-square"></i> Terima Aduan</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=base_url()?>Aduan/Tolak/<?=$kd_aduan?>"><i class="fa fa-close"></i> Tolak Aduan</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=base_url()?>Aduan/HapusAduan/<?=$kd_aduan?>/<?=$foto?>"><i class="fa fa-trash-o"></i> Hapus Aduan</a></li>
                  </ul>
                </div>
              <?php }?>  
               <?=$deskripsi?>
               
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <ul class="mailbox-attachments clearfix">
                <img class="img-responsive pad" src="<?=$web_masyarakat?>asset/foto_aduan/<?=$foto?>" alt="Photo">
              </ul>
            </div>
            <!-- /.box-footer -->
            <div class="box-footer box-comments">
              <?php foreach ($data as $d) {?>
            
              <div class="box-comment">
                <!-- User image -->
                
                <?php
                  $kd_admin = $d['kd_admin'];
                  $user="";
                  $lihat=$this->Komentar_model->admin($kd_admin);
                  foreach ($lihat as $l) {$nm_admin=$l['nm_pegawai'];$jbt=$l['nm_jabatan'];?>
                     <img class="img-circle img-sm" src="<?=base_url()?>asset/foto_profil/<?=$l['foto_profil']?>" alt="User Image">
                  <?php  }
                  $isi_komentar = $d['isi_komentar'];
                  if ($kd_admin==$this->session->userdata('kode_admin')||$user=="user") {    
                  if ( $isi_komentar!="Aduan Sudah Diajukan Untuk Rencana Pembangunan Oleh Admin") {  
                    if ($isi_komentar=="Aduan telah ditolak oleh Admin" AND $status_aduan=="Diajukan") {
                                                       # code...
                    }elseif ($isi_komentar=="Aduan telah diterima oleh Admin" AND $status_aduan=="Diajukan") {
                                                       # code...
                    }else{                                 
                ?>
                 <div class="btn-group pull-right">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <?php
                      
                      if ($isi_komentar=="Aduan telah ditolak oleh Admin") {                       
                    ?>
                    <li><a href="<?=base_url('index.php')?>/Aduan/ubahterima/<?=$kd_aduan?>/<?=$d['kd_komentar']?>"><i class="fa fa-check-square"></i> Terima Aduan</a></li>
                    <?php }elseif ($isi_komentar=="Aduan telah diterima oleh Admin") {?>
                    <li><a href="<?=base_url('index.php')?>/Aduan/ubahtolak/<?=$kd_aduan?>/<?=$d['kd_komentar']?>"><i class="fa fa-close"></i> Tolak Aduan</a></li>
                    <?php }elseif ($user=="user") {?>
                    <li><a href="<?=base_url('index.php')?>/Aduan/Hapus/<?=$kd_aduan?>/<?=$d['kd_komentar']?>"><i class="fa fa-trash-o"></i> Hapus</a></li>
                    <?php }else{?>
                    <li><a href="#" data-toggle="modal" data-target="#modal-editdata" onclick="edit('<?=$kd_aduan?>','<?=$d["kd_komentar"]?>','<?=$d["isi_komentar"]?>')"><i class="fa fa-edit"></i> Edit</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=base_url('index.php')?>/Aduan/Hapus/<?=$kd_aduan?>/<?=$d['kd_komentar']?>"><i class="fa fa-trash-o"></i> Hapus</a></li>
                    <?php }?>
                  </ul>
                </div>
                <?php }}}?>
                <div class="comment-text">
                      <span class="username">
                        <?=$nm_admin?> <span class="text-muted"><?=$jbt?></span>
                        <p><span class="text-muted"><?=date('d-M-Y H:i:s',strtotime($d['tgl_komentar']));?></span></p>
                      </span><!-- /.username -->
                 <?=$d['isi_komentar']?>
                 <?php if ($isi_komentar=="Aduan Sudah Diajukan Untuk Rencana Pembangunan Oleh Admin") {
                      $lihat=$this->ReferensiAduan_model->lihat($d['kd_aduan']);
                      foreach ($lihat as $l) {
                        $kd_rencana=$l['kd_rencana'];
                        $cari=$this->RencanaPembangunan_model->cari($l['kd_rencana']);
                        foreach ($cari as $c) {?>
                         <a href="<?=base_url('index.php')?>/Rencana_Pembangunan/Referensi/<?=$c['kd_bidang']?>/<?=$kd_rencana?>/<?=$c['tahun']?>">[ Lihat Referensi Rencana Pembangunan ]</a> 
                  <?php }}}?>
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
              <?php }?>
              </div>
              <!-- /.box-comment -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
    $('.select2').select2()
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