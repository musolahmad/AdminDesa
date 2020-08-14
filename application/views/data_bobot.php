<?php 
  $kd_kegiatan='';
  if (empty($nomor)) {
    # code...
    $kd_kegiatan="KP01";
  }else{
    foreach ($nomor as $n) {
    $nilai = substr($n['kd_kegiatan'], 2)+1;
    }
    if ($nilai<10) {
      # code...
      $kd_kegiatan="KP0".$nilai;
    }else{
      $kd_kegiatan="KP".$nilai;
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
        BOBOT KRITERIA TAHUN <?php echo $this->session->userdata('tahun')?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">BOBOT KRITERIA</li>
      </ol>
    </section>

    <!-- Main content -->      
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <?php echo form_open_multipart('Bobot');?>
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
                  <button type="submit" class="btn btn-warning form-control">Lihat Data</button>
                </div>
              </div>
            </form>
          </div>  
        </div>
        <?php if(empty($data)){?>
         <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="callout callout-warning" style="margin-bottom: 0!important;">
              <h4><i class="fa fa-warning"></i> Perhatian:</h4>
                Silahkan isi <b>Pagu Anggaran</b> tahun <b><?=$thn_filter?></b> terlebih dahulu sebelum mengisi <b>Bobot Kriteria</b> tahun <b><?=$thn_filter?></b>
            </div>
        </div>  
        <?php }else{ foreach ($data as $d) {?>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$d['nm_bidang']?> [ TOTAL PAGU ANGGARAN Rp <?=number_format($d['pagu'],0,',','.')?> ]</h3>
              <?php $cari=$this->RencanaPembangunan_model->rencana($thn_filter,$d['kd_bidang']);
                if (empty($cari)) {?>
                  <a type="button" href="<?php echo base_url('index.php');?>/Bobot/Tambah/<?=$d['kd_bidang']?>/<?php echo $thn_filter;?>" class="btn btn-primary pull-right">Tambah Data</a>
               <?php }?>              
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
               <!-- /.box-header -->
             <div class="col-md-12 table-responsive mailbox-messages">
              <table class="table table-condensed">                 
                <?php  
                    $this->load->model('BobotKriteria_model');
                    $kr = $this->BobotKriteria_model->cari($d['kd_bidang'],$thn_filter);
                    if( ! empty($kr)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)?>
                      <tr>
                        <th>Kode Bobot</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot %</th>
                        <th>Nilai Parameter (P)</th>
                        <?php $cari=$this->RencanaPembangunan_model->rencana($thn_filter,$d['kd_bidang']);
                          if (empty($cari)) {?>
                            <th>Aksi</th>
                         <?php }?>  
                      </tr>
                    <?php
                      foreach($kr as $kr){ // Lakukan looping pada variabel siswa dari controller
                    ?> 
                      <tr>
                        <td><?=$kr['kd_bobot']?></td>
                        <td><?=$kr['nm_kriteria']?></td>
                        <td><?=$kr['bobot']?> %</td>
                        <td><?=$kr['parameter']?></td>
                        <td>
                            <?php $cari=$this->RencanaPembangunan_model->rencana($thn_filter,$d['kd_bidang']);
                              if (empty($cari)) {?>
                                <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-editdata" onclick="edit('<?=$kr["kd_bobot"]?>','<?=$d["nm_bidang"]?>','<?=$kr["nm_kriteria"]?>','<?=$kr["bobot"]?>','<?php echo $thn_filter?>','<?=$d["kd_bidang"]?>','<?=$kr["parameter"]?>')"><i class="fa fa-edit"></i> Edit</a>
                                <a type="button" class="btn btn-danger tombol-hapus" href="<?php echo base_url('index.php')?>/Bobot/Hapus/<?=$kr['kd_bobot']?>/<?php echo $thn_filter?>"><i class="fa fa-trash-o"></i> Hapus</a>
                             <?php }?>  
                        </td>
                      </tr>
                <?php }}else{?>
                       <tr><td>Tidak ada data</td></tr> 
                <?php }?>          
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- /.col -->
        <?php }}?>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <!-- /.modal edit data -->
    <div class="modal fade" id="modal-editdata">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data Bobot Kriteria</h4>
              </div>
              <?php echo form_open_multipart('Bobot/EditBobot');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Kode Bobot</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="kd_bobot1" placeholder="Kode Bobot" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_bobot" name="kd_bobot" placeholder="Kode Bobot" required>
                        <input type="hidden" class="form-control" id="thn_filter" name="thn_filter">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Bidang</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_kegiatan_edit" name="nm_kegiatan_edit" placeholder="Nama Kegiatan" required disabled="true">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Kriteria</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_kriteria" name="nm_kriteria" placeholder="Nama Kegiatan" required disabled="true">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Bobot Kriteria</label>

                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="bobot" name="bobot" placeholder="Bobot" required min="1" max="100">                        
                        <input type="hidden" class="form-control" id="bobotedit1" name="bobotedit1">
                        <input type="hidden" class="form-control" id="kd_bidang" name="kd_bidang">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nilai Parameter (P)</label>

                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="parameter" name="parameter" placeholder="parameter" required min="1">     
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Ubah</button><th>
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

<?php $this->load->view('menu/script');?>

<script>
  $(function () {
    $('.select2').select2()
  })
  function tambah() {
    // body...
    document.getElementById('nm_kegiatan').value="";
  }
  function edit(kd_bobot,nm_kegiatan_edit,nm_kriteria,bobot,thn_filter,kd_bidang,parameter) {
    // body...
    document.getElementById('kd_bobot').value=kd_bobot;
    document.getElementById('kd_bidang').value=kd_bidang;
    document.getElementById('kd_bobot1').value=kd_bobot;
    document.getElementById('nm_kegiatan_edit').value=nm_kegiatan_edit;
    document.getElementById('nm_kriteria').value=nm_kriteria;
    document.getElementById('bobot').value=bobot;
    document.getElementById('bobotedit1').value=bobot;
    document.getElementById('thn_filter').value=thn_filter;
    document.getElementById('parameter').value=parameter;
  }

</script>
</body>
</html>
