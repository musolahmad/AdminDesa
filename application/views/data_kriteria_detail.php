<?php 
foreach ($data_kriteria as $dk) {
    # code...
    $nm_kriteria = $dk['nm_kriteria'];
    $kd_kriteria =$dk['kd_kriteria'];
  }
  $kd_dtl_kriteria='';
  if (empty($nomor)) {
    # code...
    $kd_dtl_kriteria=substr($kd_kriteria, 2)."01";
  }else{
    foreach ($nomor as $n) {
    $kd_dtl_kriteria = $n['kd_dtl_kriteria']+1;
    }
    $kd_dtl_kriteria="0".$kd_dtl_kriteria;
  }
 
?>
<!DOCTYPE html>
<html>
<?php $this->load->view('menu/head')?>
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
        Detail Kriteria <?php echo $nm_kriteria?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Kriteria <?php echo $nm_kriteria?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <div class="row">
                <div class="col-md-12">
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahdata" onclick="tambah();">
                    Tambah Data
                  </button>
                  <a type="button" class="btn btn-default pull-right" href="<?php echo base_url('index.php');?>/Kriteria">
                    Kembali
                  </a>
                 </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive mailbox-messages">              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Kode Detail Kriteria</th>
                  <th>Nama Detail Kriteria Pembangunan</th>
                  <th>Rating / Nilai</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $d) {?>
                    <tr>
                      <td><?=$d['kd_dtl_kriteria']?></td>
                      <td><?=$d['nm_dtl_kriteria']?></td>
                      <td><?=$d['nilai_dtl_kriteria']?></td>
                      <td>
                        <a href="#" class="btn btn-success" title="Edit" data-toggle="modal" data-target="#modal-editdata" onclick="edit('<?=$d["kd_dtl_kriteria"]?>','<?=$d["nm_dtl_kriteria"]?>','<?=$d["nilai_dtl_kriteria"]?>')"><i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url('index.php')?>/Kriteria/HapusDetail/<?=$d['kd_dtl_kriteria']?>/<?=$d['kd_kriteria']?>" class="tombol-hapus btn btn-danger" title="Hapus"><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>
                  <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode Detail Kriteria</th>
                  <th>Nama Detail Kriteria Pembangunan</th>
                  <th>Rating / Nilai</th>
                  <th>Aksi</th>
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
    </section>
    <!-- /.content -->
    <!-- /.modal tambah data -->
    <div class="modal fade" id="modal-tambahdata">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Detail Kriteria</h4>
              </div>
              <?php echo form_open_multipart('Kriteria/TambahKriteriaDetail');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Kode Detail Kriteria</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?php echo $kd_dtl_kriteria;?>" placeholder="Kode Detail Kriteria" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_dtl_kriteria" name="kd_dtl_kriteria" value="<?php echo $kd_dtl_kriteria;?>" placeholder="Kode Detail Kriteria" required>
                        <input type="hidden" class="form-control" id="kd_kriteria" name="kd_kriteria" value="<?php echo $kd_kriteria;?>" placeholder="Kode Detail Kriteria" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Nama Detail Kriteria</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="nm_dtl_kriteria" name="nm_dtl_kriteria" placeholder="Nama Detail Kriteria" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Rating / Nilai</label>
                      <div class="col-sm-8">
                        <input type="number" class="form-control" id="nilai_dtl_kriteria" name="nilai_dtl_kriteria" min="1" max="100">
                      </div>
                    </div>
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
    <!-- /.modal edit data -->
    <div class="modal fade" id="modal-editdata">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data Detail Kriteria</h4>
              </div>
              <?php echo form_open_multipart('Kriteria/EditDetailKriteria');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Kode Detail Kriteria</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="kd_dtl_kriteria_edit1" name="kd_dtl_kriteria_edit1" placeholder="Kode Detail Kriteria" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_dtl_kriteria_edit" name="kd_dtl_kriteria_edit" placeholder="Kode Detail Kriteria" required>
                        <input type="hidden" class="form-control" id="kd_kriteria_edit" name="kd_kriteria_edit" value="<?php echo $kd_kriteria;?>" placeholder="Kode Detail Kriteria" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Nama Detail Kriteria</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="nm_dtl_kriteria_edit" name="nm_dtl_kriteria_edit" placeholder="Nama Detail Kriteria" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Rating / Nilai</label>
                      <div class="col-sm-8">
                        <input type="number" class="form-control" id="nilai_dtl_kriteria_edit" name="nilai_dtl_kriteria_edit" min="1" max="100">
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
<?php $this->load->view('menu/script')?>

<script>
  $(function () {
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
  function tambah() {
    // body...
    document.getElementById('nm_kriteria').value="";
    document.getElementById('nilai').value="";
  }
  function edit(kd_dtl_kriteria_edit,nm_dtl_kriteria,nilai_dtl_kriteria_edit) {
    // body...
    document.getElementById('kd_dtl_kriteria_edit').value=kd_dtl_kriteria_edit;
    document.getElementById('kd_dtl_kriteria_edit1').value=kd_dtl_kriteria_edit;
    document.getElementById('nm_dtl_kriteria_edit').value=nm_dtl_kriteria;
    document.getElementById('nilai_dtl_kriteria_edit').value=nilai_dtl_kriteria_edit;
  }

</script>
</body>
</html>
