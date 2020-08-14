<?php 
  $warna=array("aqua","green","yellow","red","purple","aqua","green","yellow","red","purple");
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
        RENCANA PEMBANGUNAN TAHUN <?=$this->session->userdata('tahun')?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">RENCANA PEMBANGUNAN</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
     <div class="row">  
         <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="box">
              <div class="box-header">
                <?php echo form_open_multipart('Rencana_Pembangunan');?>
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
        <?php 
        $nomor=0;
        if (empty($data)) {?>
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="callout callout-warning" style="margin-bottom: 0!important;">
              <h4><i class="fa fa-warning"></i> Perhatian:</h4>
                Silahkan isi <b>Bobot Kriteria</b> tahun <b><?=$thn_filter?></b> terlebih dahulu sebelum mengisi <b>Daftar Rencana Pembangunan</b> tahun <b><?=$thn_filter?></b>
            </div>
        </div>  
        <?php }else{
        foreach ($data as $d) {          
        ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-<?=$warna[$nomor]?>">
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
            </span>
            <div class="info-box-content">
            <?php foreach ($no as $n){$pagu=$n['pagu'];if ($n['kd_bidang']== $d['kd_bidang']){?>
             <p><b><font color="red"><?=$d['nm_bidang']?></font></b></p>            
            <?php }else{?>
            <p><b><?=$d['nm_bidang']?></b></p>
             <?php }if ($n['kd_bidang']!= $d['kd_bidang']) {?>
                <a href="<?=base_url()?>Rencana_Pembangunan/Tahun/<?=$thn_filter?>/<?=$d['kd_bidang']?>" type="button" class="btn btn-default form-control">Lihat Daftar Rencana</a>
              <?php }}?>               
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <?php $nomor++;}?>
      </div>
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$this->RencanaPembangunan_model->totaladuan($thn_filter,$n['kd_bidang'],'1')?></h3>

              <p>Menunggu Verifikasi</p>
            </div>
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$this->RencanaPembangunan_model->totaladuan($thn_filter,$n['kd_bidang'],'2')?></h3>

              <p>Ajuan Diterima</p>
            </div>
            <div class="icon">
               <i class="fa fa-check-square"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$this->RencanaPembangunan_model->totaladuan($thn_filter,$n['kd_bidang'],'3')?></h3>

              <p>Ajuan Ditolak</p>
            </div>
            <div class="icon">
              <i class="fa fa-close"></i>
            </div>
          </div>
        </div>
      </div>
       <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>Rp <?=number_format($pagu,0,',','.')?></h3>

              <p>Pagu Anggaran</p>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">              
              <?php 
              if (empty($total)) {
                # code...
                $total='0';
              }else{
              foreach ($total as $t) {
                # code...
                $total=$t['biaya'];
              }}?>
              <h3>Rp <?=number_format($total,0,',','.')?></h3>
              <p>Total Anggaran Rencana Pembangunan Yang Diterima</p>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Rp <?=number_format($pagu-$total,0,',','.')?></h3>

              <p>Sisa Anggaran</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">  
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">                 
              <h3 class="box-title">RENCANA PEMBANGUNAN <?php foreach ($no as $n) {echo $n['nm_bidang']." TAHUN ".$thn_filter;$kd_bidang=$n['kd_bidang'];}?>    
              </h3>       
            </div>
            <?php if($this->session->userdata('lvl_admin')=="1"){?>
            <div class="box-header">
              <div class="row">
                <div class="col-md-2">
                   <a type="button" class="btn btn-primary" href="<?=base_url()?>Rencana_Pembangunan/Tambah/<?=$thn_filter?>/<?=$kd_bidang?>">
                    Tambah Data
                  </a>
                 </div>
              </div>
            </div>
            <?php }?>
            <!-- /.box-header -->
            <div class="box-body table-responsive mailbox-messages">              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Kode Rencana</th>
                  <th>Detail Rencana Kegiatan</th>
                  <th>Status Pengajuan</th>
                  <?php if($this->session->userdata('lvl_admin')=="1"||$this->session->userdata('lvl_admin')=="3"){?>
                  <th>Aksi</th>
                  <?php }?>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($datarencana as $d) {?>
                    <tr>
                      <td>
                        <?=$d['kd_rencana']?>
                        <div class="attachment-block clearfix">
                         <img class="attachment-img" src="<?=base_url()?>asset/foto_pembangunan/<?=$d['foto_lokasi']?>" alt="Attachment Image" id="image-preview">
                       </div>
                       <?php if($this->session->userdata('lvl_admin')=="1"){?>
                       <a type="button" data-toggle="modal" data-target="#modal-editfoto" type="button" class="btn btn-success" title="Ubah Foto" onclick="previewImage1('<?=base_url()?>asset/foto_pembangunan/<?=$d["foto_lokasi"]?>','<?=$d["foto_lokasi"]?>','<?=$d["kd_rencana"]?>','<?=$thn_filter?>','<?=$d["kd_bidang"]?>');"><i class="fa fa-edit"></i> Ubah Foto</a>
                       <?php }?>
                      </td>
                      <td>
                           <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                              <tbody>
                                <tr>
                                  <td class="mailbox-name">BIDANG</td>
                                  <td class="mailbox-subject" colspan="2"><?=$d['nm_bidang']?></td>
                                </tr>
                                <tr>
                                  <td class="mailbox-name">Kegiatan</td>
                                  <td class="mailbox-subject" colspan="2"><?=$d['nm_kegiatan']?></td>
                                </tr>
                                <tr>
                                  <td class="mailbox-name">Lokasi</td>
                                  <td class="mailbox-subject" colspan="2">RT <?=$d['rt']?> / RW <?=$d['rw']?></td>
                                </tr>
                                <tr>
                                  <td class="mailbox-name">Pagu Anggaran</td>
                                  <td class="mailbox-subject" colspan="2">
									  Rp <?=number_format($d['biaya'],0,',','.')?> 
									  <a data-toggle="modal" data-target="#modal-rab" onclick="cek_rab('<?=base_url()?>asset/file_rab/<?=$d["file_rab"]?>','<?=$d["file_rab"]?>','<?=$d["kd_rencana"]?>','<?=$thn_filter?>','<?=$d["kd_bidang"]?>');">[Cek Detail Anggaran]</a>
								  </td>
                                </tr>
                                <tr>
                                  <td class="mailbox-name"><b>Kriteria Penilaian</b></td>
                                  <td class="mailbox-subject"><b>Nilai</b></td>
                                  <td class="mailbox-subject"><b>Detail Kriteria</b></td>
                                </tr>
                                <?php 
                                  $kriteria = $this->KriteriaKegiatan_model->lihat($d['kd_rencana']);
                                  foreach ($kriteria as $k) {?>
                                   <tr>
                                    <td class="mailbox-name"><?=$k['nm_kriteria']?></td>
                                    <td class="mailbox-subject"><?=$k['nilai_dtl_kriteria']?></td>
                                    <td class="mailbox-subject"><?=$k['nm_dtl_kriteria']?></td>
                                  </tr>
                                <?php }?>
                              </tbody>
                            </table>
                            <!-- /.table -->
                          </div>
                      </td>
                      <td>
                        <?php if($d['status_pengajuan']=="2"){?>
                        <span class="label label-success">Ajuan Diterima</span>
                        <?php }if($d['status_pengajuan']=="3"){?>
                        <span class="label label-danger">Ajuan Ditolak</span>
                        <?php }?>
                        <?php if($d['status_pengajuan']=="3"||$d['status_pengajuan']=="2"){?>
                        <p></p><p>Catatan</p><p><?=$d['catatan']?></p>
                        <?php if($d['status_pengajuan']=="2"){
                          if($this->session->userdata('lvl_admin')=="2"){?>
                          <a type="button" class="btn btn-warning" title="Lihat Referensi Aduan" href="<?php echo base_url()?>Rencana_Pembangunan/Referensi/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>"><i class="fa fa-eye"></i></a>
                          <p></p><p><?=count($this->ReferensiAduan_model->cari($d['kd_rencana']))?> Referensi Aduan Masyarakat</p>
                        <?php }}?>
                        <?php }elseif($d['status_pengajuan']=="1"&&$d['catatan']=="-"){?>
                        <span class="label label-info">Dalam Proses Pengajuan</span>
                        <?php }elseif($d['status_pengajuan']=="1"&&$d['catatan']!="-"){?>
                        <span class="label label-primary">Dalam Proses Pengajuan Kembali</span>
                        <p></p><p>Catatan</p><p><?=$d['catatan']?></p>
                        <?php }?>
                      </td>
                      <?php if($this->session->userdata('lvl_admin')=="1"){?>
                      <td>
                        <?php if($d['status_pengajuan']=="1"){?>
                        <a type="button" class="btn btn-success" title="Edit" href="<?php echo base_url('index.php')?>/Rencana_Pembangunan/Edit/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>/<?=$d['status_pengajuan']?>"><i class="fa fa-edit"></i></a>
                        <a type="button" class="btn btn-danger tombol-hapus" title="Hapus" href="<?php echo base_url('index.php')?>/Rencana_Pembangunan/Hapus/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>/<?=$d['foto_lokasi']?>/<?=$d['file_rab']?>"><i class="fa fa-trash-o"></i></a>
                        <?php }elseif ($d['status_pengajuan']=="3") {?>
                        <a type="button" class="btn btn-success" title="Edit" href="<?php echo base_url('index.php')?>/Rencana_Pembangunan/Edit/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>/<?=$d['status_pengajuan']?>"><i class="fa fa-edit"></i></a>
                        <a type="button" class="btn btn-danger tombol-hapus" title="Hapus" href="<?php echo base_url('index.php')?>/Rencana_Pembangunan/Hapus/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>/<?=$d['foto_lokasi']?>/<?=$d['file_rab']?>"><i class="fa fa-trash-o"></i></a>
                        <a href="#" data-toggle="modal" data-target="#modal-dataedit" type="button" class="btn btn-info" title="Ajukan Kembali" onclick="dataedit('<?=$d["kd_bidang"]?>','<?=$d['kd_rencana']?>','<?=$thn_filter?>','<?=$d['status_pengajuan']?>')"><i class="fa fa-check"></i></a>
                        <?php }elseif($d['status_pengajuan']=="2"){?>
                        <a type="button" class="btn btn-warning" title="Lihat Referensi Aduan" href="<?php echo base_url()?>Rencana_Pembangunan/Referensi/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>"><i class="fa fa-eye"></i></a>
                        <p></p><p><?=count($this->ReferensiAduan_model->cari($d['kd_rencana']))?> Referensi Aduan Masyarakat</p>
                        <?php }?>
                      </td>
                      <?php }elseif($this->session->userdata('lvl_admin')=="3"){?>
                      <td>
                        <?php if($d['status_pengajuan']=="1"){?>
                        <a href="#" data-toggle="modal" data-target="#modal-editdata" type="button" class="btn btn-primary" title="Terima Rencana" onclick="edit('<?=$d["kd_bidang"]?>','<?=$d['kd_rencana']?>','<?=$thn_filter?>','<?=$d['status_pengajuan']?>')"><i class="fa fa-check"></i></a>
                        <a href="#" data-toggle="modal" data-target="#modal-tolakdata" type="button" class="btn btn-danger" title="Tolak Rencana" onclick="tolak('<?=$d["kd_bidang"]?>','<?=$d['kd_rencana']?>','<?=$thn_filter?>','<?=$d['status_pengajuan']?>')"><i class="fa fa-close"></i></a>
                        <?php }elseif ($d['status_pengajuan']=="3") {?>
                        <a href="#" data-toggle="modal" data-target="#modal-editdata" type="button" class="btn btn-primary" title="Terima Rencana" onclick="edit('<?=$d["kd_bidang"]?>','<?=$d['kd_rencana']?>','<?=$thn_filter?>')"><i class="fa fa-check"></i></a>
                        <?php }else{?>
                        </a>
                       <a href="#" data-toggle="modal" data-target="#modal-tolakdata" type="button" class="btn btn-danger" title="Tolak Rencana" onclick="tolak('<?=$d["kd_bidang"]?>','<?=$d['kd_rencana']?>','<?=$thn_filter?>','<?=$d['status_pengajuan']?>')"><i class="fa fa-close"></i></a>
                        <a type="button" class="btn btn-warning" title="Lihat Referensi Aduan" href="<?php echo base_url()?>Rencana_Pembangunan/Referensi/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>"><i class="fa fa-eye"></i></a>
                        <p></p><p><?=count($this->ReferensiAduan_model->cari($d['kd_rencana']))?> Referensi Aduan Masyarakat</p>
                        <?php }?>
                      </td>
                      <?php }?>
                    </tr>
                  <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode Bidang</th>
                  <th>Detail Rencana Kegiatan</th>
                  <th>Status Pengajuan</th>
                  <?php if($this->session->userdata('lvl_admin')=="1"||$this->session->userdata('lvl_admin')=="3"){?>
                  <th>Aksi</th>
                  <?php }?>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?php }?>
    </section>
    <!-- /.content -->
     <!-- /.modal edit data -->
    <div class="modal fade" id="modal-editdata">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Catatan</h4>
              </div>
              <?php echo form_open_multipart('Rencana_Pembangunan/TerimaRencana');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <textarea class="form-control" placeholder="Tulisakan alasan mengapa aduan diterima" id="catatan" name="catatan"></textarea>
                        <input type="hidden" class="form-control" id="kd_bidang" name="kd_bidang">
                         <input type="hidden" class="form-control" id="st_pengajuan" name="st_pengajuan">
                        <input type="hidden" class="form-control" id="kd_rencana" name="kd_rencana">
                        <input type="hidden" class="form-control" id="th" name="th">
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Kirim</button><th>
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
     <!-- /.modal edit data -->
    <div class="modal fade" id="modal-dataedit">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Catatan</h4>
              </div>
              <?php echo form_open_multipart('Rencana_Pembangunan/AjukanKembali');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <textarea class="form-control" placeholder="Tulisakan alasan mengapa aduan diterima" id="catatan2" name="catatan2"></textarea>
                        <input type="hidden" class="form-control" id="kd_bidang2" name="kd_bidang2">
                         <input type="hidden" class="form-control" id="st_pengajuan2" name="st_pengajuan2">
                        <input type="hidden" class="form-control" id="kd_rencana2" name="kd_rencana2">
                        <input type="hidden" class="form-control" id="th2" name="th2">
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Kirim</button><th>
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
     <!-- /.modal edit data -->
    <div class="modal fade" id="modal-tolakdata">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Catatan</h4>
              </div>
              <?php echo form_open_multipart('Rencana_Pembangunan/TolakRencana');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <textarea class="form-control" placeholder="Tulisakan alasan mengapa aduan ditolak" id="catatan_tolak" name="catatan_tolak"></textarea>
                        <input type="hidden" class="form-control" id="kd_bidang_tolak" name="kd_bidang_tolak">
                        <input type="hidden" class="form-control" id="kd_rencana_tolak" name="kd_rencana_tolak">
                        <input type="hidden" class="form-control" id="th_tolak" name="th_tolak">
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger pull-right">Kirim</button><th>
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
    <!-- /.modal edit data -->
    <div class="modal fade" id="modal-editfoto">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Foto</h4>
              </div>
              <?php echo form_open_multipart('Rencana_Pembangunan/UbahFoto');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="file" id="foto_edit" name="foto_edit" onchange="previewImage();" required>
                        <input type="text" id="foto_edit1" name="foto_edit1" hidden>
                        <input type="text" id="foto_kd_bidang" name="foto_kd_bidang" hidden>
                        <input type="text" id="foto_rencana" name="foto_rencana" hidden>
                        <input type="text" id="foto_th" name="foto_th" hidden>
                        <p class="help-block">Upload File berupa JPG, JPEG atau PNG</p>
                        <div class="attachment-block clearfix">
                         <img class="attachment-img" src="<?=base_url()?>asset/foto_pembangunan/no_image.png" alt="Attachment Image" id="image-preview1">
                     </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger pull-right">Ubah Foto</button><th>
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
<!-- /.modal cek rab -->
    <div class="modal fade" id="modal-rab">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Rencana Anggaran Biaya</h4>
              </div>
              <?php echo form_open_multipart('Rencana_Pembangunan/UbahRAB');?>   
				<div id="detail_rab">
				</div>
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <div class="col-sm-12">
						  <label>Pilih File Untuk Mengganti Data</label>  
                        <input type="file" id="file_edit" name="file_edit" required>
                        <input type="text" id="file_edit1" name="file_edit1" hidden>
                        <input type="text" id="file_kd_bidang" name="file_kd_bidang" hidden>
                        <input type="text" id="file_rencana" name="file_rencana" hidden>
                        <input type="text" id="file_th" name="file_th" hidden>
                        <p class="help-block">Upload File berupa PDF</p>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <?php if($this->session->userdata('lvl_admin')=="1"){?>
					  <button type="submit" class="btn btn-danger pull-right">Ubah RAB</button><th>
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kembali</button>
					<?php }else{?>  
					  <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Kembali</button>
					<?php }?>    
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
function edit(kd_bidang,kd_rencana,tahun,status_pengajuan) {
    // body...
    document.getElementById('kd_bidang').value=kd_bidang;
     document.getElementById('kd_rencana').value=kd_rencana;
    document.getElementById('th').value=tahun;
    document.getElementById('st_pengajuan').value=status_pengajuan;
  }
  function dataedit(kd_bidang,kd_rencana,tahun,status_pengajuan) {
    // body...
    document.getElementById('kd_bidang2').value=kd_bidang;
     document.getElementById('kd_rencana2').value=kd_rencana;
    document.getElementById('th2').value=tahun;
    document.getElementById('st_pengajuan2').value=status_pengajuan;
  }
  function tolak(kd_bidang,kd_rencana,tahun) {
    // body...
    document.getElementById('kd_bidang_tolak').value=kd_bidang;
     document.getElementById('kd_rencana_tolak').value=kd_rencana;
    document.getElementById('th_tolak').value=tahun;
  }
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
	function cek_rab(rab_pdf,file_rab,kd_rencana,thn_filter,kd_bidang){
		document.getElementById("detail_rab").innerHTML =' <iframe src="'+rab_pdf+'" frameborder="0" height="500px" width="100%"></iframe>';
		document.getElementById("file_edit").value="";
		document.getElementById("file_edit1").value=file_rab;
		document.getElementById("file_kd_bidang").value=kd_bidang;
		document.getElementById("file_th").value=thn_filter;
		document.getElementById("file_rencana").value=kd_rencana;
	}
  function previewImage() {
    document.getElementById("image-preview1").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("foto_edit").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview1").src = oFREvent.target.result;
    };
  };
  function previewImage1(foto_lokasi,nm_foto,kd_rencana,thn_filter,kd_bidang) {
    document.getElementById("foto_edit").value="";
    document.getElementById("foto_edit1").value=nm_foto;
    document.getElementById("foto_kd_bidang").value=kd_bidang;
    document.getElementById("foto_th").value=thn_filter;
    document.getElementById("foto_rencana").value=kd_rencana;
    document.getElementById("image-preview1").src = foto_lokasi;
  };
</script>
</body>
</html>
