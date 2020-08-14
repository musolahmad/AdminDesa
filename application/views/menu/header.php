 <?php 
 $jml_blmbaca=$this->Aduan_model->jml_blmbaca();
$jml=0;
foreach ($jml_blmbaca as $jm) {
  # code...
  $jml=$jml+$jm['jml'];
}
$web=$this->Aduan_model->get_all_web();
foreach ($web as $w) {
  # code...
  $web_masyarakat=$w['web_masyarakat'];
}
 ?>
 <header class="main-header">

    <!-- Logo -->
    <a href="<?=base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>DD</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Prioritas</b> Dana Desa</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <?php if (!empty($jml_blmbaca)) {?>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-danger"><?=$jml?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?=$jml?> Aduan Belum di Baca</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php $jml_blmbaca=$this->Aduan_model->jml_blmbaca1();
                  foreach ($jml_blmbaca as $jml) {?>
                    <li><!-- start message -->
                    <a href="<?=base_url()?>Aduan/Baca/<?=$jml['kd_aduan']?>">
                      <div class="pull-left">
                        <img src="<?=$web_masyarakat?>asset/foto_profil/<?=$jml['foto_profil']?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        <?=$jml['nm_user']?>
                        <small><i class="fa fa-clock-o"></i></small>
                      </h4>
                      <p><?=substr($jml['nm_topik'], 0, 20) . '...'?></p>
                    </a>
                  </li>
                  <!-- end message -->
                  <?php }?>                  
                </ul>
              </li>
              <li class="footer"><a href="<?=base_url('index.php')?>/Aduan/BlmBaca">Lihat Semua Pesan Belum di Baca</a></li>
            </ul>
          </li>
          <?php }?>
          <li class="dropdown messages-menu user-menu">
               <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?=base_url()?>asset/foto_profil/<?=$this->session->userdata('foto')?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?=$this->session->userdata('nama')?></span>
              </a>
              
            <ul class="dropdown-menu">
              <li class="header">Pilih Menu</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="<?=base_url('index.php');?>/Admin/Menu">
                      <div class="pull-left">
                        <img src="<?php echo base_url()?>asset/dist/img/admin.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Ubah
                      </h4>
                      <p>Profil & Password</p>
                    </a>
                  </li>
                  <!-- end message -->
                   <li><!-- start message -->
                    <a href="<?=base_url();?>Login/KunciLayar">
                      <div class="pull-left">
                        <img src="<?php echo base_url()?>asset/dist/img/gembok.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Kunci
                      </h4>
                      <p>Layar Sistem</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li><!-- start message -->
                    <a href="<?=base_url();?>Login/Logout" class="tombol-confirm">
                      <div class="pull-left">
                        <img src="<?php echo base_url()?>asset/dist/img/logout.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Keluar
                      </h4>
                      <p>Sistem</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">-- --</a></li>
            </ul>
            </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>