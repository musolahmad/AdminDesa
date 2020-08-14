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
$warna=array("aqua","green","yellow","red","purple","aqua","green","yellow","red","purple");
$warna2=array("purple","red","aqua","green","yellow","purple","red","aqua","green","yellow");

foreach ($web as $w) {
  # code...
  $web_admin=$w['web_admin'];
  $web_masyarakat=$w['web_masyarakat'];
}
?>
<!DOCTYPE html>
<html>
<head>
 <?php $this->load->view('menu/head') ?>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="flash-berhasil" data-flashberhasil="<?=$this->session->flashdata('berhasil');?>"></div>
<?php if($this->session->flashdata('berhasil')):?>
<?php endif;?>
<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
      <?php if($this->session->flashdata('flash')):?>
      <?php endif;?>
<div class="wrapper">
  <!--header-->
  <?php $this->load->view('menu/header') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('menu/sidebar') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Beranda
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Beranda</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-lg-2 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$jm?></h3>

              <p>Aduan Masuk</p>
            </div>
            <div class="icon">
              <i class="fa fa-inbox"></i>
            </div>
            <a href="<?=base_url('index.php')?>/Aduan/Masuk" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-2 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?=$jh?></h3>

              <p>Aduan Hari Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>
            <a href="<?=base_url()?>Aduan/HariIni" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-2 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$jb?></h3>

              <p>Aduan Belum Di Baca</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="<?=base_url()?>Aduan/BlmBaca" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-2 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$jtm?></h3>

              <p>Aduan Diterima</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-square"></i>
            </div>
            <a href="<?=base_url()?>Aduan/Diterima" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-2 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$jtl?></h3>

              <p>Aduan Ditolak</p>
            </div>
            <div class="icon">
              <i class="fa fa-close"></i>
            </div>
            <a href="<?=base_url()?>Aduan/Ditolak" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-2 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>2</h3>

              <p>Alamat Website</p>
            </div>
            <div class="icon">
              <i class="fa fa-internet-explorer"></i>
            </div>
            <a data-toggle="modal" data-target="#modal-ubahweb" class="small-box-footer" onclick="web('<?=$web_admin?>','<?=$web_masyarakat?>')">Ubah Alamat Website<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->
        
      </div>
     <?php if(!empty($agenda)){?><h3>Agenda Bulan Ini</h3><?php }?> 
     <?php foreach ($agenda as $d) {?>
        <div class="row">       
          <div class="col-md-12">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><?=$d['nm_kegiatan']?> Lokasi RT <?=$d['rt']?> / RW <?=$d['rw']?></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">  
          
                  <div class="col-md-6">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">                      
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <?php $fotoaduan=$this->Pembangunan_model->cari2($d['kd_rencana']);
                        $no=1;
                        foreach ($fotoaduan as $f) {?>
                      <li data-target="#carousel-example-generic" data-slide-to="<?=$no?>" class="<?php if($no==0){echo 'active';}?>"></li>
                      <?php $no++;}?>
                      <li data-target="#carousel-example-generic" data-slide-to="<?=$no+1?>" class="<?php if($no==0){echo 'active';}?>"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="<?=base_url()?>asset/foto_pembangunan/<?=$d['foto_lokasi']?>" alt="Foto Lokasi">
                        <div class="carousel-caption">
                          Foto Lokasi Sebelum Perbaikan
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
                      <div class="item <?php if($no==0){echo 'active';}?>">
                        <img src="<?=base_url()?>asset/foto_pembangunan/<?=$d['foto_lokasi_terbaru']?>" alt="<?=$f['nm_topik']?>">
                        <div class="carousel-caption">
                          Foto Lokasi Sesudah Perbaikan
                        </div>
                      </div>
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
                  <div class="box">
                <!-- /.box-header -->
                <div class="table-responsive mailbox-messages">
                   <table class="table table-hover table-striped">
                    <tr>
                      <td style="width: 150px">Pagu Anggaran</td>
                      <td colspan="2">Rp <?=number_format($d['biaya'],0,',','.')?></td>
                    </tr>
                    <tr>
                      <td style="width: 150px">Status Pelaksanaan</td>
                      <td colspan="2"><?php if($d['status_pelaksanaan']=="1"){?>Belum Dikerjakann<?php }elseif($d['status_pelaksanaan']=="2"){?>Dikerjakan<?php }elseif($d['status_pelaksanaan']=="3"){?>Selesai Dikerjakan<?php }?></td>
                    </tr>
                    <tr>
                       <td><b>Kriteria Penilaian</b></td>
                       <td><b>Nilai</b></td>
                       <td><b>Detail Kriteria</b></td>
                    </tr>
                    <?php 
                      $kriteria = $this->Pembangunan_model->lihat($d['kd_rencana']);
                      foreach ($kriteria as $k) {?>
                    <tr>
                      <td ><?=$k['nm_kriteria']?></td>
                      <td><?=$k['nilai_dtl_kriteria']?></td>
                      <td><?=$k['nm_dtl_kriteria']?></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <td style="width: 150px"><b>Tanggal Mulai</b></td>
                      <td class="2"><b><?=date('d-m-Y',strtotime($d['tgl_mulai']));?></b></td>
                    </tr>
                    <tr>
                      <td style="width: 150px"><b>Tanggal Berakhir</b></td>
                      <td colspan="2"><b><?=date('d-m-Y',strtotime($d['tgl_akhir']));?></b></td>
                    </tr>
                  </table>
                  <br>
                  <?php if($this->session->userdata('lvl_admin')=="1"){?>
                  <?php if($d['status_pelaksanaan']=="1"){?>
                    <a type="button" href="<?=base_url()?>Beranda/UbahStatus/<?=$d['kd_rencana']?>/<?=$this->session->userdata('tahun')?>" class="btn btn-success form-control">Kerjakan Pembangunan</a>
                  <?php }elseif($d['status_pelaksanaan']=="2"){?>
                    <a type="button" data-toggle="modal" data-target="#modal-tambahfoto" class="btn btn-warning form-control" onclick="previewImage1('<?=$d["kd_rencana"]?>','<?=$this->session->userdata('tahun')?>','<?=base_url()?>asset/foto_pembangunan/no_image.png');">Pembangunan Selesai</a>
                  <?php }}?> 
                </div>
              </div>
              </div>
                </div>

              </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        <?php }?> 
     <div class="row">  
         <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="box">
              <div class="box-header">
                <?php echo form_open_multipart('Beranda/Lihatanggaran');?>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label>Filter Tahun</label>
                      <select class="form-control select2" style="width: 100%;" id="tahun" name="tahun">
                       <?php
                       $thn_filter = $this->session->userdata('tahun');
                       $thn_skr = date('Y')+1;
                       for ($x=$thn_skr; $x >=2015; $x--) { 
                       ?> 
                       <option <?php if($x==$thn_filter) echo "selected='selected'"?> value="<?php echo $x;?>"><?php echo $x;?></option>
                       <?php } ?>
                      </select>
                    </div>
                  </div>      
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Lihat Data</label>
                      <button type="submit" class="btn btn-primary form-control">Lihat Data</button>
                    </div>
                  </div>
                </form>
            </div>  
          </div>  
        </div> 
      </div>      
      <h3>Rencana Pembangunan Tahun <?=$thn_filter?></h3>
      <div class="row">
      <?php 
      $nomor=0;
      if (empty($rencana)) {?>
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="callout callout-warning" style="margin-bottom: 0!important;">
              <h4><i class="fa fa-warning"></i> Perhatian:</h4>
                Silahkan isi <b>Bobot Kriteria</b> tahun <b><?=$thn_filter?></b> terlebih dahulu sebelum mengisi <b>Daftar Rencana Pembangunan</b> tahun <b><?=$thn_filter?></b>
            </div>
        </div>
      <?php }else{
      foreach ($rencana as $d) {          
        ?>  
       <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-<?=$warna[$nomor]?>">
            <div class="inner">
              <h3>
                <?php $jml = $this->RencanaPembangunan_model->jml($thn_filter,$d['kd_bidang']);
                if (empty($jml)) {
                  echo "0";
                }else{
                  foreach ($jml as $j) {
                    echo $j['jml'];
                    $jum=$j['jml'];
                  }
                }
              ?>      
              </h3>

              <p><?=$d['nm_bidang']?></p>
               <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            </div>
            <a href="<?=base_url()?>Rencana_Pembangunan/Tahun/<?=$thn_filter?>/<?=$d['kd_bidang']?>" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <?php $nomor++;}}?>
      </div>
      <?php if (empty($rencana)) {?>
      <br>
      <?php }?>
      <h3>Pelaksanaan Pembangunan Tahun <?=$thn_filter?></h3>
      <div class="row">
      <?php 
      if(empty($daftar)){?>
       <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="callout callout-warning" style="margin-bottom: 0!important;">
              <h4><i class="fa fa-warning"></i> Perhatian:</h4>
                <b>Rencana Pembangunan</b> tahun <b><?=$thn_filter?></b> belum ada yang diterima
            </div>
        </div>  
       <?php }else{?>
        <?php $nomor=0;        
        foreach ($daftar as $d) {          
          ?>
       <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-<?=$warna2[$nomor]?>">
            <div class="inner">
              <h3>
                <?=$this->Pelaksanaan_model->jml($thn_filter,$d['kd_bidang'])?>    
              </h3>

              <p><?=$d['nm_bidang']?></p>
               <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            </div>
            <a href="<?= base_url()?>Pelaksanaan_Pembangunan/Tahun/<?=$thn_filter?>/<?=$d['kd_bidang']?>" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <?php $nomor++;}}?>
      </div>
      <?php if (empty($daftar)) {?>
      <br>
      <?php }?>
      <?php if(empty($apbdes)){?>
      <div class="row">
      <div class="col-sm-12">
            <div class="callout callout-warning" style="margin-bottom: 0!important;">
              <h4><i class="fa fa-warning"></i> Perhatian:</h4>
                Silahkan isi <b>Pagu Anggararan</b> tahun <b><?=$thn_filter?></b> terlebih dahulu sebelum mengisi <b>Daftar APBDes</b> tahun <b><?=$thn_filter?></b>
            </div>
        </div>
      </div>    
      <?php }else{?>
      <div class="row">
        <div class="col-sm-6">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-Info">
            <div class="box-header with-border">
              <h3 class="box-title">Pendapatan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <tbody>
                  <?php foreach ($apbdes as $p) {?>  
                  <tr>
                    <td><?php if($p['tipe_akun']==1){?><font <?php if($p['kd_induk']==0){echo 'style="color: red"';}?>><b><?php }?><?=$p['nm_bidang']?><?php if($p['tipe_akun']==1){?></b></font><?php }?></td>
                    <td>Rp</td>
                    <td class="pull-right"><?php if($p['tipe_akun']==1){?><font <?php if($p['kd_induk']==0){echo 'style="color: red"';}?>><b><?php }?><?=number_format($p['pagu'],0,',','.')?><?php if($p['tipe_akun']==1){?></b></font><?php }?></td>
                  </tr>
                  <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-sm-6">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-Info">
            <div class="box-header with-border">
              <h3 class="box-title">Belanja</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <tbody>
                  <?php foreach ($belanja as $p) {?>  
                  <tr>
                    <td><?php if($p['tipe_akun']==1){?><font <?php if($p['kd_induk']==0){echo 'style="color: red"';}?>><b><?php }?><?=$p['nm_bidang']?><?php if($p['tipe_akun']==1){?></b></font><?php }?></td>
                    <td>Rp</td>
                    <td class="pull-right"><?php if($p['tipe_akun']==1){?><font <?php if($p['kd_induk']==0){echo 'style="color: red"';}?>><b><?php }?><?=number_format($p['pagu'],0,',','.')?><?php if($p['tipe_akun']==1){?></b></font><?php }?></td>
                  </tr>
                  <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <?php }?>
    </section>
  </div>
  <!-- /.content-wrapper -->
<!-- /.modal edit data -->
    <div class="modal fade" id="modal-tambahfoto">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Foto</h4>
              </div>
              <?php echo form_open_multipart('Beranda/FotoPelaksanaan');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="file" id="foto_edit" name="foto_edit" onchange="previewImage();" required>
                        <input type="text" id="kd_rencana_pelaksanaan" name="kd_rencana_pelaksanaan" hidden>
                        <input type="text" id="tahun_pelaksanaan" name="tahun_pelaksanaan" hidden>
                        <p class="help-block">Upload File berupa JPG, JPEG atau PNG</p>
                        <div class="attachment-block clearfix">
                         <img class="attachment-img" src="<?=base_url()?>asset/foto_pembangunan/no_image.png" alt="Attachment Image" id="image-preview1">
                     </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger pull-right">Upload Foto Lokasi</button><th>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                  </div>
                  <!-- /.box-footer -->
                </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  <!-- /.footer -->
  <!-- /.modal edit data web-->
    <div class="modal fade" id="modal-ubahweb">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Web</h4>
              </div>
              <?php echo form_open_multipart('Beranda/UbahWeb');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="web_admin" class="col-sm-4 control-label">Website Admin</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="web_admin" name="web_admin" placeholder="Web Admin" >
                         <input type="hidden" class="form-control" id="th_web" name="th_web" value="<?=$thn_filter?>" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="web_admin" class="col-sm-4 control-label">Website Masyarakat</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="web_masyarakat" name="web_masyarakat" placeholder="Web Masyarakat" >
                      </div>
                    </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Ubah Web</button><th>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                  </div>
                  <!-- /.box-footer -->
                </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  <!-- /.footer -->
  <?php $this->load->view('menu/footer') ?>

  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<?php $this->load->view('menu/script')?>
<script>
  $(function () {
    $('.select2').select2()
  })
  function previewImage() {
    document.getElementById("image-preview1").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("foto_edit").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview1").src = oFREvent.target.result;
    };
  };
  function previewImage1(kd_rencana,tahun,foto) {
    document.getElementById("image-preview1").src = foto;
    document.getElementById("kd_rencana_pelaksanaan").value = kd_rencana;
    document.getElementById("tahun_pelaksanaan").value = tahun;
  };
  function web(web_admin,web_masyarakat) {
    document.getElementById("web_admin").value = web_admin;
    document.getElementById("web_masyarakat").value = web_masyarakat;
  };
</script>
</body>
</html>