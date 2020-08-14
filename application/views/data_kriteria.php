<?php 
  $kd_kriteria='';
  if (empty($nomor)) {
    # code...
    $kd_kriteria="KR01";
  }else{
    foreach ($nomor as $n) {
    $nilai = substr($n['kd_kriteria'], 2)+1;
    }
    if ($nilai<10) {
      # code...
      $kd_kriteria="KR0".$nilai;
    }else{
      $kd_kriteria="KR".$nilai;
    }
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
        KRITERIA PEMBANGUNAN
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">KRITERIA PEMBANGUNAN</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">                 
              <h3 class="box-title">Data Kriteria Pembangunan</h3>       
            </div>
            <div class="box-header">
              <div class="row">
                <div class="col-md-2">
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahdata" onclick="tambah();">
                    Tambah Data
                  </button>
                 </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive mailbox-messages">              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Kode Kriteria</th>
                  <th>Nama Kriteria Pembangunan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $d) {?>
                    <tr>
                      <td><?=$d['kd_kriteria']?></td>
                      <td><?=$d['nm_kriteria']?></td>
                      <td>
                        <a href="#" class="btn btn-success" title="Edit" data-toggle="modal" data-target="#modal-editdata" onclick="edit('<?=$d["kd_kriteria"]?>','<?=$d["nm_kriteria"]?>')"><i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url('index.php')?>/Kriteria/Hapus/<?=$d['kd_kriteria']?>" class="tombol-hapus btn btn-danger" title="Hapus"><i class="fa fa-trash-o"></i></a>
                        <a class="btn btn-warning" title="Detail Kriteria" href="<?php echo base_url('index.php')?>/Kriteria/Detail/<?=$d['kd_kriteria']?>"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                  <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode Kriteria</th>
                  <th>Nama Kriteria Pembangunan</th>
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
                <h4 class="modal-title">Tambah Data Kriteria</h4>
              </div>
              <?php echo form_open_multipart('Kriteria/TambahKriteria');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Kode Kriteria</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?php echo $kd_kriteria;?>" placeholder="Kode Kriteria" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_kriteria" name="kd_kriteria" value="<?php echo $kd_kriteria;?>" placeholder="Kode Kriteria" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Kriteria</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_kriteria" name="nm_kriteria" placeholder="Nama Kriteria" required>
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
                <h4 class="modal-title">Edit Data Kriteria</h4>
              </div>
              <?php echo form_open_multipart('Kriteria/EditKriteria');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Kode Kriteria</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="kd_kriteria_edit1" name="kd_kriteria_edit1" placeholder="Kode Kriteria" required disabled="true">
                         <input type="hidden" class="form-control" id="kd_kriteria_edit" name="kd_kriteria_edit" placeholder="Kode Kriteria" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Kriteria</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_kriteria_edit" name="nm_kriteria_edit" placeholder="Nama Kriteria" required>
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
  }
  function edit(kd_kriteria_edit,nm_kriteria_edit) {
    // body...
    document.getElementById('kd_kriteria_edit').value=kd_kriteria_edit;
    document.getElementById('kd_kriteria_edit1').value=kd_kriteria_edit;
    document.getElementById('nm_kriteria_edit').value=nm_kriteria_edit;
  }

</script>
</body>
</html>
