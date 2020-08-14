<?php 
  $warna=array("aqua","green","yellow","red","purple","aqua","green","yellow","red","purple");  
  foreach ($no as $no) {
          # code...
          $kd_bidang=$no['kd_bidang'];
          $pagu=$no['pagu'];
          $nm_bidang=$no['nm_bidang'];
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
        PELAKSANAAN PEMBANGUNAN TAHUN <?=$this->session->userdata('tahun')?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">PELAKSANAAN PEMBANGUNAN</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
     <div class="row">  
         <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="box">
              <div class="box-header">
                <?php echo form_open_multipart('Pelaksanaan_Pembangunan');?>
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
          <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-<?=$warna[$nomor]?>">
              <?=$this->Pelaksanaan_model->jml($thn_filter,$d['kd_bidang'])?>     
            </span>
            <div class="info-box-content">
            <?php if($kd_bidang==$d['kd_bidang']){?><font color="red"><?php }?>  
            <b><?=$d['nm_bidang']?></b>    
            <?php if($kd_bidang==$d['kd_bidang']){?></font>
            <?php }if ($kd_bidang!= $d['kd_bidang']) {?>
                <a href="<?= base_url()?>Pelaksanaan_Pembangunan/Tahun/<?=$thn_filter?>/<?=$d['kd_bidang']?>" type="button" class="btn btn-default form-control">Lihat Daftar Pelaksanaan</a>
              <?php }?>         
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
              <h3><?=$this->Pelaksanaan_model->totaladuan($thn_filter,$kd_bidang,'1')?></h3>

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
              <h3><?=$this->Pelaksanaan_model->totaladuan($thn_filter,$kd_bidang,'2')?></h3>

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
              <h3><?=$this->Pelaksanaan_model->totaladuan($thn_filter,$kd_bidang,'3')?></h3>

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
              <p>Total Anggaran Pelaksanaan Pembangunan Yang Diterima</p>
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
              <h3 class="box-title">DATA PELAKSANAAN PEMBANGUNAN <?=$nm_bidang?> TAHUN <?=$thn_filter?></h3>       
            </div>
            <?php if($this->session->userdata('lvl_admin')=="1"){?>
            <div class="box-header">
              <div class="row">
                <div class="col-md-2">
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahdata" <?php if(empty($rencana)){echo 'disabled';}?>>
                    Tambah Data
                  </button>
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
                  <th>Pelaksanaan Pembangunan</th>
                  <th>Tanggal Pelaksanaan</th>
                  <th>Status Pengajuan</th>
                  <?php if($this->session->userdata('lvl_admin')=="1"||$this->session->userdata('lvl_admin')=="3"){?>
                  <th>Aksi</th>
                  <?php }?>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($pelaksanaan as $d) {?>
                    <tr>
                      <td>
                        <?=$d['kd_rencana']?>
                      <?php if($d['status_pelaksanaan']=="3"){?>  
                        <div class="attachment-block clearfix">
                         <img class="attachment-img" src="<?=base_url()?>asset/foto_pembangunan/<?=$d['foto_lokasi_terbaru']?>" alt="Attachment Image" id="image-preview">
                       </div>
                       <?php if($this->session->userdata('lvl_admin')=="1"){?>
                       <a type="button" data-toggle="modal" data-target="#modal-editfoto" type="button" class="btn btn-success" title="Ubah Foto" onclick="previewImage1('<?=base_url()?>asset/foto_pembangunan/<?=$d["foto_lokasi_terbaru"]?>','<?=$d["kd_rencana"]?>','<?=$thn_filter?>','<?=$d["kd_bidang"]?>');"><i class="fa fa-edit"></i> Ubah Foto</a>
                       <?php }}?>
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
                                  <td class="mailbox-subject" colspan="2">Rp <?=number_format($d['biaya'],0,',','.')?></td>
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
                               <tr>
                                  <td style="width: 150px">Status Pelaksanaan</td>
                                  <td colspan="2"><?php if($d['status_pelaksanaan']=="1"){?>Belum Dikerjakann<?php }elseif($d['status_pelaksanaan']=="2"){?>Dikerjakan<?php }elseif($d['status_pelaksanaan']=="3"){?>Selesai Dikerjakan<?php }?></td>
                               </tr>
                              </tbody>
                            </table>
                            <!-- /.table -->
                          </div>
                      </td>
                      <td>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                              <tbody>
                                <tr>
                                  <td class="mailbox-name">Tanggal Mulai</td>
                                  <td class="mailbox-subject"><?=date('d-m-Y',strtotime($d['tgl_mulai']))?></td>
                                </tr>
                                <tr>
                                  <td class="mailbox-name">Tanggal Akhir</td>
                                  <td class="mailbox-subject"><?=date('d-m-Y',strtotime($d['tgl_akhir']))?></td>
                                </tr>
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
                          <a type="button" class="btn btn-warning" title="Tambah Referensi Aduan" href="<?php echo base_url('index.php')?>/Rencana_Pembangunan/Referensi/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>"><i class="fa fa-eye"></i></a>
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
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-editdata" title="Edit" href="#" onclick="edit('<?=$d["kd_rencana"]?>','<?=$d['nm_kegiatan']?>','<?=$d['rt']?>','<?=$d['rw']?>','<?=$d['tgl_mulai']?>','<?=$d['tgl_akhir']?>')"><i class="fa fa-edit"></i></button>
                        <a type="button" class="btn btn-danger tombol-hapus" title="Hapus" href="<?php echo base_url('index.php')?>/Pelaksanaan_Pembangunan/Hapus/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>/"><i class="fa fa-trash-o"></i></a>
                        <?php }elseif ($d['status_pengajuan']=="3") {?>
                         <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-editdata" title="Edit" href="#" onclick="edit('<?=$d["kd_rencana"]?>','<?=$d['nm_kegiatan']?>','<?=$d['rt']?>','<?=$d['rw']?>','<?=$d['tgl_mulai']?>','<?=$d['tgl_akhir']?>')"><i class="fa fa-edit"></i></button>
                        <a type="button" class="btn btn-danger tombol-hapus" title="Hapus" href="<?php echo base_url('index.php')?>/Rencana_Pembangunan/Hapus/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>/"><i class="fa fa-trash-o"></i></a>
                        <a href="#" data-toggle="modal" data-target="#modal-terimadata" type="button" class="btn btn-info" title="Ajukan Kembali" onclick="terima('<?=$d["kd_bidang"]?>','<?=$d['kd_rencana']?>','<?=$thn_filter?>','<?=$d['status_pengajuan']?>')"><i class="fa fa-check"></i></a>
                        <?php }elseif($d['status_pengajuan']=="2"){?>
                        <a type="button" class="btn btn-warning" title="Tambah Referensi Aduan" href="<?php echo base_url('index.php')?>/Rencana_Pembangunan/Referensi/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>"><i class="fa fa-eye"></i></a>
                        <p></p><p><?=count($this->ReferensiAduan_model->cari($d['kd_rencana']))?> Referensi Aduan Masyarakat</p>
                        <?php }?>
                      </td>
                      <?php }elseif($this->session->userdata('lvl_admin')=="3"){?>
                      <td>
                        <?php if($d['status_pengajuan']=="1"){?>
                        <a href="#" data-toggle="modal" data-target="#modal-terimadata" type="button" class="btn btn-primary" title="Terima Rencana" onclick="terima('<?=$d["kd_bidang"]?>','<?=$d['kd_rencana']?>','<?=$thn_filter?>','<?=$d['status_pengajuan']?>')"><i class="fa fa-check"></i></a>
                        <a href="#" data-toggle="modal" data-target="#modal-tolakdata" type="button" class="btn btn-danger" title="Tolak Rencana" onclick="tolak('<?=$d["kd_bidang"]?>','<?=$d['kd_rencana']?>','<?=$thn_filter?>')"><i class="fa fa-close"></i></a>
                        <?php }elseif ($d['status_pengajuan']=="3") {?>
                        <a href="#" data-toggle="modal" data-target="#modal-terimadata" type="button" class="btn btn-primary" title="Terima Rencana" onclick="terima('<?=$d["kd_bidang"]?>','<?=$d['kd_rencana']?>','<?=$thn_filter?>','<?=$d['status_pengajuan']?>')"><i class="fa fa-check"></i></a>
                        <?php }else{?>
                        </a>
                       <a href="#" data-toggle="modal" data-target="#modal-tolakdata" type="button" class="btn btn-danger" title="Tolak Rencana" onclick="tolak('<?=$d["kd_bidang"]?>','<?=$d['kd_rencana']?>','<?=$thn_filter?>','<?=$d['status_pengajuan']?>')"><i class="fa fa-close"></i></a>
                        <a type="button" class="btn btn-warning" title="Lihat Referensi Aduan" href="<?php echo base_url('index.php')?>/Rencana_Pembangunan/Referensi/<?=$d['kd_bidang']?>/<?=$d['kd_rencana']?>/<?=$thn_filter?>"><i class="fa fa-eye"></i></a>
                        <p></p><p><?=count($this->ReferensiAduan_model->cari($d['kd_rencana']))?> Referensi Aduan Masyarakat</p>
                        <?php }?>
                      </td>
                      <?php }?>
                    </tr>
                  <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode Rencana</th>
                  <th>Pelaksanaan Pembangunan</th>                  
                  <th>Tanggal Pelaksanaan</th>
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
     <!-- /.modal tambah data -->
    <div class="modal fade" id="modal-tambahdata">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Pelaksanaan</h4>
              </div>
              <?php echo form_open_multipart('Pelaksanaan_Pembangunan/Tambah');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Rencana Kegiatan</label>

                      <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" id="kd_rencana" name="kd_rencana">
                          <?php foreach ($rencana as $r) {?>                          
                          <option value="<?=$r['kd_rencana']?>"><?=$r['nm_kegiatan']?>, Lokasi RT <?=$r['rt']?> / RW <?=$r['rw']?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Tanggal Mulai</label>

                      <div class="col-sm-9">
                       <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Tanggal Mulai" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Tanggal Akhir</label>

                      <div class="col-sm-9">
                       <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" placeholder="Tanggal Akhir" required>
                      </div>
                    </div>
                     <input type="hidden" class="form-control" id="kd_bdg" name="kd_bdg" value="<?=$kd_bdg?>">
                     <input type="hidden" class="form-control" id="thn" name="thn" value="<?=$thn_filter?>">
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info pull-right">Simpan</button>
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
     <!-- /.modal tambah data -->
    <div class="modal fade" id="modal-editdata">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data Pelaksanaan</h4>
              </div>
              <?php echo form_open_multipart('Pelaksanaan_Pembangunan/Edit');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Rencana Kegiatan</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kegiatan" disabled>
                        <input type="hidden" class="form-control" id="kd_rencana_edit" name="kd_rencana_edit" placeholder="Nama Kegiatan">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Tanggal Mulai</label>

                      <div class="col-sm-9">
                       <input type="date" class="form-control" id="tgl_mulai_edit" name="tgl_mulai_edit" placeholder="Tanggal Mulai" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Tanggal Akhir</label>

                      <div class="col-sm-9">
                       <input type="date" class="form-control" id="tgl_akhir_edit" name="tgl_akhir_edit" placeholder="Tanggal Akhir" required>
                      </div>
                    </div>
                     <input type="hidden" class="form-control" id="kd_bdg_edit" name="kd_bdg_edit" value="<?=$kd_bdg?>">
                     <input type="hidden" class="form-control" id="thn_edit" name="thn_edit" value="<?=$thn_filter?>">
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success pull-right">Ubah</button>
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
    <div class="modal fade" id="modal-terimadata">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Catatan</h4>
              </div>
              <?php echo form_open_multipart('Pelaksanaan_Pembangunan/TerimaPelaksanaan');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <textarea class="form-control" placeholder="Tulisakan alasan mengapa aduan diterima" id="catatan" name="catatan"></textarea>
                        <input type="hidden" class="form-control" id="kd_bidang" name="kd_bidang">
                        <input type="hidden" class="form-control" id="kd_rencana_terima" name="kd_rencana_terima">
                        <input type="hidden" class="form-control" id="th" name="th">
                        <input type="hidden" class="form-control" id="st" name="st">
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
              <?php echo form_open_multipart('Pelaksanaan_Pembangunan/TolakPelaksanaan');?>          
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
              <?php echo form_open_multipart('Pelaksanaan_Pembangunan/UbahFoto');?>          
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
function edit(kd_rencana,nm_kegiatan,rt,rw,tgl_mulai,tgl_akhir) {
  // body...
   document.getElementById('kd_rencana_edit').value=kd_rencana ;
   document.getElementById('nama').value=nm_kegiatan+", Lokasi RT "+rt+"/ RW "+rw;
   document.getElementById('tgl_mulai_edit').value=tgl_mulai ;
   document.getElementById('tgl_akhir_edit').value=tgl_akhir ;
}
function tolak(kd_bidang,kd_rencana,tahun) {
    // body...
    document.getElementById('kd_bidang_tolak').value=kd_bidang;
     document.getElementById('kd_rencana_tolak').value=kd_rencana;
    document.getElementById('th_tolak').value=tahun;
  }
  function terima(kd_bidang,kd_rencana,tahun,status_pengajuan) {
    // body...
    document.getElementById('kd_bidang').value=kd_bidang;
     document.getElementById('kd_rencana_terima').value=kd_rencana;
    document.getElementById('th').value=tahun;
    document.getElementById('st').value=status_pengajuan;
  }
  function previewImage() {
    document.getElementById("image-preview1").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("foto_edit").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview1").src = oFREvent.target.result;
    };
  };
  function previewImage1(foto_lokasi,kd_rencana,thn_filter,kd_bidang) {
    document.getElementById("foto_edit").value="";
    document.getElementById("foto_edit1").value=foto_lokasi;
    document.getElementById("foto_kd_bidang").value=kd_bidang;
    document.getElementById("foto_th").value=thn_filter;
    document.getElementById("foto_rencana").value=kd_rencana;
    document.getElementById("image-preview1").src = foto_lokasi;
  };
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
</script>
</body>
</html>
