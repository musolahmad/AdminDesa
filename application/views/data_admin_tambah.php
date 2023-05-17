<?php 
  $kd_admin='';
  $lvl_admin='1';
  if (empty($nomor)) {
    # code...
    $kd_admin="ADM001";
  }else{
    $nilai = substr($nomor->kd_admin, 3)+1;
    if ($nilai<10) {
      # code...
      $kd_admin="ADM00".$nilai;
    }elseif ($nilai<100) {
    
      $kd_admin="ADM0".$nilai;
    }else{
      $kd_admin="ADM".$nilai;
    }
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
        Tambah Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?=base_url();?>Admin"><i class="fa fa-user"></i> Admin</a></li>
        <li class="active">Tambah Admin</li>
      </ol>
    </section>

    <!-- Main content -->
   <!-- Main content -->
    <section class="content">

     <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
          <?php echo form_open_multipart('Admin/Simpan');?>            
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Tambah Admin</h3>
              </div>
              <div class="box-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Kode Admin</label>
                  <input type="text" class="form-control" placeholder="Kode Admin" value="<?=$kd_admin;?>" required disabled="true">
                  <input type="hidden" class="form-control" id="kd_admin" name="kd_admin" value="<?=$kd_admin;?>" placeholder="Kode Admin" required>
                  <!-- /.input group -->
                </div>
                <div class="form-group">
                  <label>Nama Perangkat Desa</label>
                  <input type="text" class="form-control" id="nm_pegawai" name="nm_pegawai" placeholder="Nama Perangkat Desa" required>
                  <!-- /.input group -->
                </div>    
               <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" class="form-control" id="nm_jabatan" name="nm_jabatan" placeholder="Jabatan" required>
                </div>
                <!-- /.form group -->
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" required >
                  <!-- /.input group -->
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required >
                  <!-- /.input group -->
                </div>
                <div class="form-group">
                  <label>Level Admin</label>
                  <select class="form-control select2" style="width: 100%;" id="lvl_admin" name="lvl_admin">
                    <option value="1">Admin</option>
                    <option value="2">Super Admin</option>
                    <option value="3">Verifikator</option>
                  </select>
                  <!-- /.input group -->
                </div>
                <div class="form-group">                    
                    <label for="foto_profil">Upload Foto Profil</label>
                    <input type="file" id="foto_profil" name="foto_profil" onchange="previewImage();" required>
                    <p class="help-block">Upload File berupa JPG, JPEG atau PNG</p>
                  </div>
                  <div class="form-group"> 
                     <div class="attachment-block clearfix">
                         <img class="attachment-img" src="<?=base_url()?>asset/dist/img/images.png" alt="Attachment Image" id="image-preview">
                     </div>
                  </div> 
              </div>
             <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">                
                <a type="button" href="<?=base_url()?>Admin/Admin" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>

            </form>
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
        <div class="col-md-3"></div>
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
     // Format nomor HP.
    $('.select2').select2()
  })
  function previewImage() {
    document.getElementById("image-preview").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("foto_profil").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    };
  };

</script>
</body>
</html>
