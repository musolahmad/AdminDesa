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
       BIDANG KEGIATAN / AKUN REKENING
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">BIDANG & AKUN REKENING</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">                 
              <h3 class="box-title">Data Bidang / Akun Rekening</h3>       
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
              <table class="table table-hover table-striped">
                <thead>
                <tr>
                  <th>Kode Bidang / Rekening</th>
                  <th>Nama Bidang / Akun Rekening</th>
                  <th>Jenis Akun</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $d) {?>
                    <tr>
                      <td><?=$d['kd_bidang']?></td>
                      <td><?=$d['nm_bidang']?></td>
                      <td><?php if($d['jns_akun']==1){echo 'Debet';}else{echo 'Kredit';}?></td>
                      <td>
                        <a href="#" class="btn btn-success" title="Edit" data-toggle="modal" data-target="#modal-editdata" onclick="edit('<?=$d["kd_bidang"]?>','<?=$d["nm_bidang"]?>')"><i class="fa fa-edit"></i></a>                        
                        <?php if($d['tipe_akun']==1){?>
                        <a href="#" class="btn btn-primary" title="Tambah Akun" data-toggle="modal" data-target="#modal-tambahakun" onclick="tambahakun('<?=$d["kd_bidang"]?>','<?=$d["jns_akun"]?>')"><i class="fa fa-plus"></i></a>
                        <?php }
                          $cek=$this->Bidang_model->nomorakun($d['kd_bidang']);
                          if (empty($cek)) {?>
                        <a href="<?php echo base_url('index.php')?>/Bidang/Hapus/<?=$d['kd_bidang']?>" class="tombol-hapus btn btn-danger" title="Hapus"><i class="fa fa-trash-o"></i></a>
                        <?php }?>
                      </td>
                    </tr>
                  <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode Bidang / Rekening</th>
                  <th>Nama Bidang / Akun Rekening</th>
                  <th>Jenis Akun</th>
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
                <h4 class="modal-title">Tambah Data Akun</h4>
              </div>
              <?php echo form_open_multipart('Bidang/TambahBidang');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Akun</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_bidang" name="nm_bidang" placeholder="Nama Akun" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Jenis Akun</label>

                      <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" id="jns_akun" name="jns_akun">
                          <option value="1">Debet</option>
                          <option value="2">Kredit</option>
                        </select>
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
     <!-- /.modal tambah data -->
    <div class="modal fade" id="modal-tambahakun">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Akun</h4>
              </div>
              <?php echo form_open_multipart('Bidang/TambahAkun');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Akun</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_bidang_1" name="nm_bidang_1" placeholder="Nama Akun" required>
                        <input type="hidden" class="form-control" id="kd_bidang_1" name="kd_bidang_1">
                        <input type="hidden" class="form-control" id="jns_akun_1" name="jns_akun_1">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Tipe Akun</label>

                      <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" id="tipe_akun" name="tipe_akun">
                          <option value="1">Induk</option>
                          <option value="2">Bukan Induk</option>
                        </select>
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
                <h4 class="modal-title">Edit Data Bidang</h4>
              </div>
              <?php echo form_open_multipart('Bidang/EditBidang');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Kode Bidang</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="kd_bidang_edit1" placeholder="Kode Bidang" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_bidang_edit" name="kd_bidang_edit" placeholder="Kode Bidang" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Bidang</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_bidang_edit" name="nm_bidang_edit" placeholder="Nama Bidang" required>
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
  function tambah() {
    // body...
    document.getElementById('nm_bidang').value="";
  }
  function tambahakun(kd_bidang,jns_akun){
    document.getElementById('nm_bidang_1').value="";
    document.getElementById('kd_bidang_1').value=kd_bidang;
     document.getElementById('jns_akun_1').value=jns_akun;
  }
  function edit(kd_bidang_edit,nm_bidang_edit) {
    // body...
    document.getElementById('kd_bidang_edit').value=kd_bidang_edit;
     document.getElementById('kd_bidang_edit1').value=kd_bidang_edit;
    document.getElementById('nm_bidang_edit').value=nm_bidang_edit;
  }

</script>
</body>
</html>
