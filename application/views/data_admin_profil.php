<?php 
  foreach ($data as $d) {
    $nm_admin=$d['nm_pegawai'];
    $jabatan=$d['nm_jabatan'];
    $kd_admin=$d['kd_admin'];
    $lvl_admin=$d['lvl_admin'];
    $email=$d['email'];
    $foto_profil=$d['foto_profil'];
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
        Profil Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profil Admin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong>
                <div class="col-sm-6"><i class="fa fa-key margin-r-5"></i> Kode Admin </div>
                <div class="col-sm-6 text-muted"><?=$kd_admin?></div>
              </strong>
              <br>
              <hr>
              <strong>
                <div class="col-sm-6"><i class="fa fa-user margin-r-5"></i> Nama Admin </div>
                <div class="col-sm-6 text-muted"><?=$nm_admin?></div>
              </strong>
              <br>
              <hr>
              <strong>
                <div class="col-sm-6"><i class="fa fa-bars margin-r-5"></i> Jabatan </div>
                <div class="col-sm-6 text-muted"><?=$jabatan?></div>
              </strong>
              <br>
              <hr>
              <strong>
                <div class="col-sm-6"><i class="fa fa-envelope margin-r-5"></i> Email </div>
                <div class="col-sm-12 text-muted"><?=$email;?></div>
              </strong>
              <br>
              <hr>
              <strong>
                <div class="col-sm-6"><i class="fa fa-level-up margin-r-5"></i> Level Admin </div>
                <div class="col-sm-6 text-muted"><?php if ($lvl_admin=="1") {echo "Admin";}else{echo "Super Admin";}?></div>
              </strong>
              <br>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li <?php if($this->session->userdata('ubah') == 'pass'){echo 'class="active"';}?>><a href="#password" data-toggle="tab">Ubah Password</a></li>
              <li <?php if($this->session->userdata('ubah') == 'profil'){echo 'class="active"';}?>><a href="#profil" data-toggle="tab">Ubah Profil</a></li>
              <li <?php if($this->session->userdata('ubah') == 'foto'){echo 'class="active"';}?>><a href="#foto" data-toggle="tab">Ubah Foto</a></li>
            </ul>
            <div class="tab-content">
              <div class="<?php if($this->session->userdata('ubah') == 'pass'){echo 'active';}?> tab-pane" id="password">
                <form class="form-horizontal" <?php echo form_open_multipart('Admin/UbahPass');?>
                  <div class="form-group">
                    <label for="password_lama" class="col-sm-2 control-label">Password Lama</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password_baru" class="col-sm-2 control-label">Password Baru</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Password Baru" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password_confirm" class="col-sm-2 control-label">Konfirmasi Password Baru</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Konfirmasi Password Baru" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Ubah Password</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="<?php if($this->session->userdata('ubah') == 'profil'){echo 'active';}?> tab-pane" id="profil"> 
                 <form class="form-horizontal" <?php echo form_open_multipart('Admin/UbahProfil');?>
                  <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label">Nama</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nm_pegawai" name="nm_pegawai" value="<?=$nm_admin?>" placeholder="Nama" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" name="email" value="<?=$email?>" placeholder="Email" required>
                      <input type="hidden" class="form-control" id="email1" name="email1" value="<?=$email?>" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Ubah Profil</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->         
              <!-- /.tab-pane -->
              <div class="<?php if($this->session->userdata('ubah') == 'foto'){echo 'active';}?> tab-pane" id="foto"> 
                 <form class="form-horizontal" <?php echo form_open_multipart('Admin/UbahFoto');?>
                  <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label">Upload Foto Profil</label>

                    <div class="col-sm-10">
                      <input type="file" id="foto_profil" name="foto_profil" onchange="previewImage();" required>
                      <input type="hidden" class="form-control" id="kd_admin" name="kd_admin" value="<?=$kd_admin?>">
                      <input type="hidden" class="form-control" id="foto" name="foto" value="<?=$foto_profil?>">
                      <p class="help-block">Upload File berupa JPG, JPEG atau PNG</p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <div class="attachment-block clearfix">
                         <img class="attachment-img" src="<?=base_url()?>asset/foto_profil/<?=$foto_profil?>" alt="Attachment Image" id="image-preview">
                     </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Ubah Foto</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->         
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
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