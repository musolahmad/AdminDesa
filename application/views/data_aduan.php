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
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
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
                  <span class="label label-info pull-right"><?=$jm?></span></a></li>
                <li <?php if ($this->session->userdata('aduan')=='Hari Ini'){echo 'class="active"';}?>><a href="<?=base_url()?>Aduan/HariIni"><i class="fa fa-clock-o"></i> Aduan Hari Ini
                  <span class="label label-primary pull-right"><?=$jh?></span></a></li>
                <li <?php if ($this->session->userdata('aduan')=='Belum di Baca'){echo 'class="active"';}?>><a href="<?=base_url()?>Aduan/BlmBaca"><i class="fa fa-book"></i> Aduan Belum di Baca
                  <span class="label label-warning pull-right"><?=$jb?></span></a></li>
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
              <h3 class="box-title">Daftar Aduan <?=$this->session->userdata('aduan')?></h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive mailbox-messages">              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Aduan</th>
                  <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>
                  <?php if ($this->session->userdata('aduan')=='Masuk'){ foreach ($jml_masuk as $j) {
                      if ($j['status_aduan']=='Masuk') {
                        # code...
                        $status_aduan = '<span class="label label-info pull-right">Menunggu Verifikasi</span>';
                      }elseif ($j['status_aduan']=='Diterima') {
                        # code...
                        $status_aduan = '<span class="label label-success pull-right">Diterima</span>';
                      }elseif ($j['status_aduan']=='Diajukan') {
                        # code...
                        $status_aduan = '<span class="label label-primary pull-right">Diajukan</span>';
                      }else{
                        $status_aduan = '<span class="label label-danger pull-right">Ditolak</span>';
                      }
                  ?>                   
                  <tr>
                    <td class="mailbox-name"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.$j['nm_user'].'</b>'; }else{echo $j['nm_user'];}?></a></td>
                    <td class="mailbox-subject"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.substr($j['nm_topik'],0,20).'</b>'; }else{echo substr($j['nm_topik'],0,20);}?> - <?=substr($j['deskripsi'],0,50)?>... <?=$status_aduan?></a></td>
                    <td class="mailbox-date"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.date('d-m-Y H:i:s',strtotime($j['tgl_aduan'])).'</b>'; }else{echo date('d-m-Y H:i:s',strtotime($j['tgl_aduan']));}?></a></td>
                  </tr>
                  <?php }}elseif ($this->session->userdata('aduan')=='Hari Ini'){ foreach ($jml_hariini as $j) {
                      if ($j['status_aduan']=='Masuk') {
                        # code...
                        $status_aduan = '<span class="label label-info pull-right">Menunggu Verifikasi</span>';
                      }elseif ($j['status_aduan']=='Diterima') {
                        # code...
                        $status_aduan = '<span class="label label-success pull-right">Diterima</span>';
                      }elseif ($j['status_aduan']=='Diajukan') {
                        # code...
                        $status_aduan = '<span class="label label-primary pull-right">Diajukan</span>';
                      }else{
                        $status_aduan = '<span class="label label-danger pull-right">Ditolak</span>';
                      }
                  ?>                   
                  <tr>
                    <td class="mailbox-name"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.$j['nm_user'].'</b>'; }else{echo $j['nm_user'];}?></a></td>
                    <td class="mailbox-subject"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.substr($j['nm_topik'],0,20).'</b>'; }else{echo substr($j['nm_topik'],0,20);}?> - <?=substr($j['deskripsi'],0,50)?>... <?=$status_aduan?></a></td>
                    <td class="mailbox-date"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.date('d-m-Y H:i:s',strtotime($j['tgl_aduan'])).'</b>'; }else{echo date('d-m-Y H:i:s',strtotime($j['tgl_aduan']));}?></a></td>
                  </tr>
                  <?php }}elseif ($this->session->userdata('aduan')=='Diterima'){ foreach ($jml_diterima as $j) {
                    if ($j['status_aduan']=='Masuk') {
                        # code...
                        $status_aduan = '<span class="label label-info pull-right">Menunggu Verifikasi</span>';
                      }elseif ($j['status_aduan']=='Diterima') {
                        # code...
                        $status_aduan = '<span class="label label-success pull-right">Diterima</span>';
                      }elseif ($j['status_aduan']=='Diajukan') {
                        # code...
                        $status_aduan = '<span class="label label-primary pull-right">Diajukan</span>';
                      }else{
                        $status_aduan = '<span class="label label-danger pull-right">Ditolak</span>';
                      }
                  ?>                   
                  <tr>
                    <td class="mailbox-name"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.$j['nm_user'].'</b>'; }else{echo $j['nm_user'];}?></a></td>
                    <td class="mailbox-subject"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.substr($j['nm_topik'],0,20).'</b>'; }else{echo substr($j['nm_topik'],0,20);}?> - <?=substr($j['deskripsi'],0,50)?>... <?=$status_aduan?></a></td>
                    <td class="mailbox-date"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.date('d-m-Y H:i:s',strtotime($j['tgl_aduan'])).'</b>'; }else{echo date('d-m-Y H:i:s',strtotime($j['tgl_aduan']));}?></a></td>
                  </tr>
                  <?php }}elseif ($this->session->userdata('aduan')=='Belum di Baca'){ foreach ($jml_blmbaca as $j) {
                    if ($j['status_aduan']=='Masuk') {
                        # code...
                        $status_aduan = '<span class="label label-info pull-right">Menunggu Verifikasi</span>';
                      }elseif ($j['status_aduan']=='Diterima') {
                        # code...
                        $status_aduan = '<span class="label label-success pull-right">Diterima</span>';
                      }elseif ($j['status_aduan']=='Diajukan') {
                        # code...
                        $status_aduan = '<span class="label label-primary pull-right">Diajukan</span>';
                      }else{
                        $status_aduan = '<span class="label label-danger pull-right">Ditolak</span>';
                      }
                  ?>                   
                 <tr>
                    <td class="mailbox-name"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.$j['nm_user'].'</b>'; }else{echo $j['nm_user'];}?></a></td>
                    <td class="mailbox-subject"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.substr($j['nm_topik'],0,20).'</b>'; }else{echo substr($j['nm_topik'],0,20);}?> - <?=substr($j['deskripsi'],0,50)?>... <?=$status_aduan?></a></td>
                    <td class="mailbox-date"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.date('d-m-Y H:i:s',strtotime($j['tgl_aduan'])).'</b>'; }else{echo date('d-m-Y H:i:s',strtotime($j['tgl_aduan']));}?></a></td>
                  </tr>
                  <?php }}elseif ($this->session->userdata('aduan')=='Ditolak'){ foreach ($jml_ditolak as $j) {
                    if ($j['status_aduan']=='Masuk') {
                        # code...
                        $status_aduan = '<span class="label label-info pull-right">Menunggu Verifikasi</span>';
                      }elseif ($j['status_aduan']=='Diterima') {
                        # code...
                        $status_aduan = '<span class="label label-success pull-right">Diterima</span>';
                      }elseif ($j['status_aduan']=='Diajukan') {
                        # code...
                        $status_aduan = '<span class="label label-primary pull-right">Diajukan</span>';
                      }else{
                        $status_aduan = '<span class="label label-danger pull-right">Ditolak</span>';
                      }
                  ?>                   
                  <tr>
                    <td class="mailbox-name"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.$j['nm_user'].'</b>'; }else{echo $j['nm_user'];}?></a></td>
                    <td class="mailbox-subject"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.substr($j['nm_topik'],0,20).'</b>'; }else{echo substr($j['nm_topik'],0,20);}?> - <?=substr($j['deskripsi'],0,50)?>... <?=$status_aduan?></a></td>
                    <td class="mailbox-date"><a href="<?=base_url()?>Aduan/Baca/<?=$j['kd_aduan']?>" style="color: black;"><?php if($j['dibaca']=='T'){echo '<b>'.date('d-m-Y H:i:s',strtotime($j['tgl_aduan'])).'</b>'; }else{echo date('d-m-Y H:i:s',strtotime($j['tgl_aduan']));}?></a></td>
                  </tr>
                  <?php }}?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>Aduan</th>
                  <th>Tanggal</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
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
  function tambah() {
    // body...
    document.getElementById('nm_admin').value="";
    document.getElementById('lvl_admin').value="1";
    document.getElementById('alamat').value="";
    document.getElementById('pass').value="";
    document.getElementById('tgl_lahir').value="";
    document.getElementById('no_telp').value="";
  }
  function edit(kd_admin,nm_admin,tgl_lahir,alamat,pass,no_telp,lvl_admin) {
    // body...
    document.getElementById('kd_admin_edit').value=kd_admin;
    document.getElementById('kd_admin_edit1').value=kd_admin;
    document.getElementById('nm_admin_edit').value=nm_admin;
    document.getElementById('lvl_admin_edit').value=lvl_admin;
    document.getElementById('alamat_edit').value=alamat;
    document.getElementById('pass_edit').value=pass;
    document.getElementById('tgl_lahir_edit').value=tgl_lahir;
    document.getElementById('no_telp_edit').value=no_telp;
  }

</script>
</body>
</html>