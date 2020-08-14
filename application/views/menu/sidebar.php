<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGASI UTAMA</li>
        <li <?php if($this->session->userdata('menu') == "Beranda"){echo "class='active'";}?>>
          <a href="<?php echo base_url()?>">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
          </a>
        </li>        
        <li <?php if($this->session->userdata('menu') == "Aduan Masyarakat"){echo "class='active'";}?>>
          <a href="<?=base_url()?>Aduan/Masuk">
            <i class="fa fa-envelope-o"></i> <span>Aduan Masyarakat</span>
          </a>
        </li> 
        <?php if($this->session->userdata('lvl_admin')=="2"){?>  
        <li class="header">MASTER DATA</li>
        <li <?php if($this->session->userdata('menu') == "Kegiatan"){echo "class='active'";}?>>
          <a href="<?= base_url()?>Kegiatan/Menu">
            <i class="fa fa-folder"></i> <span>Kegiatan Pembangunan</span>
          </a>
        </li>         
        <li <?php if($this->session->userdata('menu') == "Bidang Kegiatan"){echo "class='active'";}?>>
          <a href="<?= base_url()?>Bidang">
            <i class="fa fa-list-alt"></i> <span>Bidang Kegiatan</span>
          </a>
        </li>
         <?php }?> 
        <li <?php if($this->session->userdata('menu') == "Pagu Anggaran"){echo "class='active'";}?>>
          <a href="<?= base_url()?>PaguAnggaran/Tahun/<?=date('Y')+1?>">
            <i class="fa fa-money"></i> <span>Pagu Anggaran</span>
          </a>
        </li>
        <?php if($this->session->userdata('lvl_admin')=="2"){?>  
        <li <?php if($this->session->userdata('menu') == "Kriteria"){echo "class='active'";}?>>
          <a href="<?= base_url()?>Kriteria">
            <i class="fa fa-database"></i> <span>Kriteria</span>
          </a>
        </li>
        <li <?php if($this->session->userdata('menu') == "Bobot"){echo "class='active'";}?>>
          <a href="<?=base_url()?>Bobot/Tahun/<?php echo date('Y')+1;?>">
            <i class="fa fa-balance-scale"></i> <span>Bobot Kriteria</span>
          </a>
        </li>
        <?php }?> 
         <li class="header">RENCANA PEMBANGUNAN</li>
        <li <?php if($this->session->userdata('menu') == "Rencana Pembangunan"){echo "class='active'";}?>>
          <a href="<?=base_url()?>Rencana_Pembangunan/Tahun/<?php echo date('Y')+1;?>/1">
            <i class="fa fa-building-o"></i> <span>Rencana Pembangunan</span>
          </a>
        </li>
        <li <?php if($this->session->userdata('menu') == "Prioritas Pembangunan"){echo "class='active'";}?>>
          <a href="<?=base_url()?>Prioritas/Tahun/<?php echo date('Y')+1;?>/1">
            <i class="fa fa-filter"></i> <span>Prioritas Pembangunan</span>
          </a>
        </li>
        <li <?php if($this->session->userdata('menu') == "Pelaksanaan Pembangunan"){echo "class='active'";}?>>
          <a href="<?=base_url()?>Pelaksanaan_Pembangunan/Tahun/<?php echo date('Y')+1;?>/1">
            <i class="fa fa-star"></i> <span>Pelaksanaan Pembangunan</span>
          </a>
        </li>  
        <li <?php if($this->session->userdata('menu') == "Cetak Laporan"){echo "class='active'";}?>>
          <a href="<?=base_url()?>Laporan/Tahun/<?php echo date('Y')+1;?>/1">
            <i class="fa fa-print"></i> <span>Cetak Laporan</span>
          </a>
        </li>  
        <li class="header">PENGGUNA SISTEM</li>
        <?php if($this->session->userdata('lvl_admin')=="2"){?>
        <li <?php if($this->session->userdata('menu') == "Admin"){echo "class='active'";}?>>
          <a href="<?=base_url()?>Admin/Admin">
            <i class="fa fa-users"></i> <span>Data Admin</span>
          </a>
        </li>
        <?php }?>
        <li <?php if($this->session->userdata('menu') == "Pelapor"){echo "class='active'";}?>>
          <a href="<?=base_url()?>Pelapor">
            <i class="fa fa-users"></i> <span>Data Pelapor Aduan</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>