<!DOCTYPE html>
<html>
<?php $this->load->view('menu/head')?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
      <?php if($this->session->flashdata('flash')):?>
      <?php endif;?>
  <div class="flash-confirm" data-flashconfirm="<?=$this->session->flashdata('error');?>"></div>
      <?php if($this->session->flashdata('error')):?>
      <?php endif;?>
  <div class="login-logo">
    <a href=""><b>Prioritas</b> Dana Desa</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Selamat Datang, Silahkan Login</p>

    <form action="<?php echo base_url();?>Login/AksiLogin" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Kode Admin / Email" id="kd_admin" name="kd_admin" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
       <div class="row">
        <div class="col-xs-6">
          <?= $image ?>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <input type="text" class="form-control" placeholder="Kode Captcha" id="captcha" name="captcha" required>
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6"><a href="<?php echo base_url();?>Login/LupaPassword"><center>Lupa Password? <p>Klik Disini.<p></center></a></div>
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>      
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php $this->load->view('menu/script')?>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
