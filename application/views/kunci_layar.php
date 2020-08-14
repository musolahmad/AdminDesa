<!DOCTYPE html>
<html>
<?php $this->load->view('menu/head')?>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->

<div class="lockscreen-wrapper">
  <div class="flash-confirm" data-flashconfirm="<?=$this->session->flashdata('error');?>"></div>
      <?php if($this->session->flashdata('error')):?>
      <?php endif;?>
  <div class="lockscreen-logo">
    <a href=""><b>Prioritas</b> Dana Desa</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name"><?=$this->session->userdata('nama');?></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php echo base_url()?>asset/dist/img/admin.png" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" <?php echo form_open_multipart('Login/BukaKunci');?> 
      <div class="input-group">
        <input type="password" class="form-control" placeholder="password" id="password" name="password" required>

        <div class="input-group-btn">
          <button type="button" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Masukan password untuk membuka kunci layar
  </div>
  <div class="text-center">
    <a href="<?=base_url('index.php')?>/Login/Logout">Atau Masuk Sebagai Admin Lain</a>
  </div>
  <div class="lockscreen-footer text-center">
    
  </div>
</div>
<!-- /.center -->
<?php $this->load->view('menu/script')?>
</body>
</html>
