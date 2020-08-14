<?php 
foreach ($web as $w) {
  # code...
  $web_admin=$w['web_admin'];
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
		  DATA PELAPOR <p><small>Total Semua <b><?=$jml;?></b></small></p>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">DATA PELAPOR</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <?php foreach ($data as $d) {?>
        <div class="col-md-4">
            <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><?=$d['nm_user']?></h3> <span class='text-muted'><?php if($d['status_user']=="1"){echo "User Non Aktif";}elseif($d['status_user']=="2"){echo "User Aktif";}else{echo "User di Blokir";}?></span>
              <?php if($d['status_user']=="1"){}elseif($d['status_user']=="2"){?>
              <a href="<?=base_url()?>Pelapor/User/<?=$d['kd_user']?>/<?=$d['status_user']?>">
                <div class="box-tools pull-right">
                  <span class="label label-danger">Blokir User</span>
                </div>
              </a>  
              <?php }else{?> 
              <a href="<?=base_url()?>Pelapor/User/<?=$d['kd_user']?>/<?=$d['status_user']?>">
                <div class="box-tools pull-right">
                  <span class="label label-success">Aktifkan User</span>
                </div> 
              </a> 
              <?php }?>
                  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
				<div class="attachment-block clearfix">
                         <img class="attachment-img" src="<?=$web_masyarakat?>asset/foto_profil/<?=$d['foto_profil']?>" alt="Attachment Image" id="image-preview">
                 </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li>Email<p><b><?=$d['email']?></b><p></li>
                    <li>Jenis Kelamin<p><b><?php if($d['jns_kelamin']=="P"){echo "Perempuan";}else{echo "Laki-laki";}?></b></p></li>
                    <li>Tanggal Lahir<p><b><?=date('d-m-Y',strtotime($d['tgl_lahir']));?></b></p></li>
                    <li>Alamat<p><b><?=$d['alamat']?></b><p></li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Total Aduan
                  <span class="pull-right text-blue"><?=$this->Aduan_masyarakat_model->jmltotal($d['kd_user'])?></span></a></li>
                <li><a href="#">Aduan Belum di Proses <span class="pull-right text-yellow"><?=$this->Aduan_masyarakat_model->jmlmasuk($d['kd_user'])+$this->Aduan_masyarakat_model->jmldiajukan($d['kd_user'])?></span></a>
                </li>
                <li><a href="#">Aduan Diterima
                  <span class="pull-right text-green"><?=$this->Aduan_masyarakat_model->jmlditerima($d['kd_user'])?></span></a></li>
                <li><a href="#">Aduan Ditolak
                  <span class="pull-right text-red"><?=$this->Aduan_masyarakat_model->jmlditolak($d['kd_user'])?></a></li>
              </ul>
            </div>
            <!-- /.footer -->
          </div>
        </div>
        <?php }?>
         <div class="col-md-12">
        <center><?= $this->pagination->create_links();?></center>
        </div>
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
    document.getElementById('nm_bidang').value="";
  }
  function edit(kd_bidang_edit,nm_bidang_edit) {
    // body...
    document.getElementById('kd_bidang_edit').value=kd_bidang_edit;
     document.getElementById('kd_bidang_edit1').value=kd_bidang_edit;
    document.getElementById('nm_bidang_edit').value=nm_bidang_edit;
  }

</script>
</body>
</html>
