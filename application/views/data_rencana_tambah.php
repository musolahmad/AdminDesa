<?php
foreach ($bidang as $b) {
  # code...
  $kd_bidang=$b['kd_bidang'];
  $nm_bidang=$b['nm_bidang'];
}
foreach ($jml_rt as $r) {
  # code...
  $jml_rt=$r['jml_rt'];
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
        TAMBAH RENCANA PEMBANGUNAN
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">TAMBAH RENCANA PEMBANGUNAN</li>
      </ol>
    </section>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Rencana Pembangunan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open_multipart('Rencana_Pembangunan/TambahData');?>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputFile">Bidang</label>
                  <p class="help-block"><?=$nm_bidang?></p>
                  <input type="hidden" class="form-control" value="<?=$kd_bidang?>" id="kd_bidang" name="kd_bidang">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Tahun Anggaran</label>
                  <p class="help-block"><?=$this->session->userdata('tahun')?></p>
                  <input type="hidden" class="form-control" value="<?=$this->session->userdata('tahun')?>" id="tahun" name="tahun">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kegitan</label>
                  <select class="form-control select2" style="width: 100%;" id="kd_kegiatan" name="kd_kegiatan">
                   <?php foreach ($data as $k) {?> 
                   <option value="<?=$k['kd_kegiatan']?>"><?=$k['nm_kegiatan']?></option>
                   <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Lokasi</label>
                </div>
             
                <div class="form-group col-md-6">
                    <label>RT</label>
                    <select class="form-control select2" style="width: 100%;" id="rt" name="rt">
                      <?php $n=1; for ($i=0; $i <$jml_rt ; $i++) {
                          if ($n<10) {
                            # code...
                            $n='0'.$n;
                          }
                        ?> 
                        <option value="<?=$n?>"><?=$n?></option>                      
                      <?php $n++;}?>
                    </select>
                  </div>
                  <!-- /.form-group -->
                    <div class="form-group col-md-6">
                    <label>RW</label>
                    <select class="form-control select2" style="width: 100%;" id="kd_dusun" name="kd_dusun">
                      <?php foreach ($dusun as $t) {?> 
                        <option value="<?=$t['kd_dusun']?>"><?php if($t['rw']<10){echo "0".$t['rw'];}else{echo $t['rw'];}?></option>                      
                      <?php }?>
                    </select>
                  <!-- /.input group -->
                  </div>
                  <!-- /.form-group -->
                <div class="form-group">
                  <label for="exampleInputFile">Pagu Anggaran</label>
                  <input type="text" class="form-control uang" id="biaya" name="biaya" required min="0">
                </div>
				 <div class="form-group">                    
                    <label for="foto">Upload Rencana Anggaran Biaya</label>
                    <input type="file" id="rab" name="rab" required>
                    <p class="help-block">Upload File berupa PDF</p>
                  </div>
                <div class="form-group">                    
                    <label for="foto">Upload Foto Lokasi</label>
                    <input type="file" id="foto" name="foto" onchange="previewImage();" required>
                    <p class="help-block">Upload File berupa JPG, JPEG atau PNG</p>
                  </div>
                  <div class="form-group"> 
                     <div class="attachment-block clearfix">
                         <img class="attachment-img" src="<?=base_url()?>asset/foto_pembangunan/no_image.png" alt="Attachment Image" id="image-preview">
                     </div>
                  </div> 
               <div class="form-group">
                   <label for="exampleInputPassword1">Kriteria</label>
                    <div class="box-body no-padding table-responsive mailbox-messages">
                    <table class="table table-condensed">
                      <tr>
                        <th style="width: 10px">No</th>
                        <th>Nama Kriteria</th>
                        <th>[ Nilai ] Detail Kriteria</th>
                      </tr>
                      <?php $no=0; foreach ($kriteria as $k) {$no=$no+1;?>
                      <tr>
                        <td><?=$no?></td>
                        <td><?=$k['nm_kriteria']?></td>
                        <td>
                          <input type="hidden" class="form-control" value="<?=$k['kd_bobot']?>" id="kd_bobot[]" name="kd_bobot[]">
                          <select class="form-control select2" id="kd_dtl_kriteria[]" name="kd_dtl_kriteria[]" style="width: 100%;">
                          <?php $detail=$this->KriteriaDetail_model->get_all($k['kd_kriteria']);
                            foreach ($detail as $kd) {?>
                            <option value="<?=$kd['kd_dtl_kriteria']?>">[ <?=$kd['nilai_dtl_kriteria']?> ] <?=$kd['nm_dtl_kriteria']?></option>
                          <?php } ?>
                          </select>
                        </td>
                      </tr>
                      <?php }?>
                    </table>
                  </div>
               </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a type="button" href="<?=base_url('index.php')?>/Rencana_Pembangunan/Tahun/<?=$this->session->userdata('tahun')?>/<?=$kd_bidang?>" class="btn btn-default">Kembali</a>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
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
     $( '.uang' ).mask('000.000.000', {reverse: true});
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
  function previewImage() {
    document.getElementById("image-preview").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("foto").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    };
  };
</script>
</body>
</html>
