<?php 
  $kd_kegiatan='';
  $kd_topik='';
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
  if (empty($nomortopik)) {
    # code...
    $kd_topik="TP01";
  }else{
    foreach ($nomortopik as $n) {
    $nilai = substr($n['kd_topik'], 2)+1;
    }
    if ($nilai<10) {
      # code...
      $kd_topik="TP0".$nilai;
    }else{
      $kd_topik="TP".$nilai;
    }
  }
  if (empty($nomordusun)) {
    # code...
    $kd_dusun="DS01";
  }else{
    foreach ($nomordusun as $n) {
    $nilai = substr($n['kd_dusun'], 2)+1;
    }
    if ($nilai<10) {
      # code...
      $kd_dusun="DS0".$nilai;
    }else{
      $kd_dusun="DS".$nilai;
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
        KEGIATAN PEMBANGUNAN
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">KEGIATAN PEMBANGUNAN</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li <?php if($this->session->userdata('submenu') == 'Kegiatan'){echo 'class="active"';}?>><a href="#activity" data-toggle="tab">Data Kegiatan Pembangunan</a></li>
              <li <?php if($this->session->userdata('submenu') == 'Topik'){echo 'class="active"';}?>><a href="#timeline" data-toggle="tab">Topik Aduan</a></li>
              <li <?php if($this->session->userdata('submenu') == 'Dusun'){echo 'class="active"';}?>><a href="#settings" data-toggle="tab">Data Dusun</a></li>
            </ul>
            <div class="tab-content">
              <div class="<?php if($this->session->userdata('submenu') == 'Kegiatan'){echo 'active';}?> tab-pane" id="activity">
                <!-- Post -->
                 <div class="box-header">
                    <div class="row">
                      <div class="col-md-2">
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahkegiatan" onclick="tambah();">
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
                        <th>Kode Kegitan</th>
                        <th>Nama Kegiatan Pembangunan</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data as $d) {?>
                          <tr>
                            <td><?=$d['kd_kegiatan']?></td>
                            <td><?=$d['nm_kegiatan']?></td>
                            <td>
                              <a href="#" class="btn btn-success" title="Edit" data-toggle="modal" data-target="#modal-editkegiatan" onclick="edit('<?=$d["kd_kegiatan"]?>','<?=$d["nm_kegiatan"]?>')"><i class="fa fa-edit"></i></a>
                              <a href="<?php echo base_url('index.php')?>/Kegiatan/Hapus/<?=$d['kd_kegiatan']?>" class="btn btn-danger tombol-hapus" title="Hapus"><i class="fa fa-trash-o"></i></a>
                            </td>
                          </tr>
                        <?php }?>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Kode Kegitan</th>
                        <th>Nama Kegiatan Pembangunan</th>
                        <th>Aksi</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="<?php if($this->session->userdata('submenu') == 'Topik'){echo 'active';}?> tab-pane" id="timeline">
                <!-- The timeline -->
                <div class="box-header">
                    <div class="row">
                      <div class="col-md-2">
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahtopik" onclick="tambahtopik();">
                          Tambah Data
                        </button>
                       </div>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body table-responsive mailbox-messages">              
                    <table id="example3" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Kode Topik Aduan</th>
                        <th>Nama Topik Aduan</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($datatopik as $d) {?>
                          <tr>
                            <td><?=$d['kd_topik']?></td>
                            <td><?=$d['nm_topik']?></td>
                            <td>
                              <a href="#" class="btn btn-success" title="Edit" data-toggle="modal" data-target="#modal-edittopik" onclick="edittopik('<?=$d["kd_topik"]?>','<?=$d["nm_topik"]?>')"><i class="fa fa-edit"></i></a>
                              <a href="<?php echo base_url('index.php')?>/Kegiatan/HapusTopik/<?=$d['kd_topik']?>" class="btn btn-danger tombol-hapus" title="Hapus"><i class="fa fa-trash-o"></i></a>
                            </td>
                          </tr>
                        <?php }?>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Kode Kegitan</th>
                        <th>Nama Kegiatan Pembangunan</th>
                        <th>Aksi</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
              </div>
              <!-- /.tab-pane -->

              <div class="<?php if($this->session->userdata('submenu') == 'Dusun'){echo 'active';}?> tab-pane" id="settings">
                 <!-- The timeline -->
                <div class="box-header">
                    <div class="row">
                      <div class="col-md-2">
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahdusun" onclick="tambahdusun();">
                          Tambah Data
                        </button>
                       </div>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body table-responsive mailbox-messages">              
                    <table id="example4" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Kode Dusun</th>                  
                        <th>RW</th>
                        <th>Jumlah RT</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($datadusun as $d) {?>
                          <tr>
                            <td><?=$d['kd_dusun']?></td>
                            <td><?=$d['rw']?></td>
                            <td><?=$d['jml_rt']?></td>
                            <td>
                              <a href="#" class="btn btn-success" title="Edit" data-toggle="modal" data-target="#modal-editdusun" onclick="editdusun('<?=$d["kd_dusun"]?>','<?=$d["rw"]?>','<?=$d["jml_rt"]?>')"><i class="fa fa-edit"></i></a>
                              <a href="<?php echo base_url('index.php')?>/Kegiatan/HapusDusun/<?=$d['kd_dusun']?>" class="btn btn-danger tombol-hapus" title="Hapus"><i class="fa fa-trash-o"></i></a>
                            </td>
                          </tr>
                        <?php }?>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Kode Dusun</th>                     
                        <th>RW</th>
                        <th>Jumlah RT</th>
                        <th>Aksi</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <!-- /.modal tambah data kegiatan -->
    <div class="modal fade" id="modal-tambahkegiatan">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Kegiatan</h4>
              </div>
              <?php echo form_open_multipart('Kegiatan/TambahKegiatan');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Kode Kegiatan</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?php echo $kd_kegiatan;?>" placeholder="Kode Kegiatan" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_kegiatan" name="kd_kegiatan" value="<?php echo $kd_kegiatan;?>" placeholder="Kode Kegiatan" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Kegiatan</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_kegiatan" name="nm_kegiatan" placeholder="Nama Kegiatan" required>
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
     <!-- /.modal tambah data Topik-->
    <div class="modal fade" id="modal-tambahtopik">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Topik Aduan</h4>
              </div>
              <?php echo form_open_multipart('Kegiatan/TambahTopik');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Kode Topik Aduan</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?php echo $kd_topik;?>" placeholder="Kode Topik Aduan" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_topik" name="kd_topik" value="<?php echo $kd_topik;?>" placeholder="Kode Topik Aduan" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Topik Aduan</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_topik" name="nm_topik" placeholder="Nama Topik Aduan" required>
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
    <!-- /.modal tambah data Topik-->
    <div class="modal fade" id="modal-tambahdusun">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Dusun</h4>
              </div>
              <?php echo form_open_multipart('Kegiatan/TambahDusun');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Kode Dusun</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?php echo $kd_dusun;?>" placeholder="Kode Dusun" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_dusun" name="kd_dusun" value="<?php echo $kd_dusun;?>" placeholder="Kode Topik Aduan" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">RW</label>

                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="rw" name="rw" placeholder="RW" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Jumlah RT</label>

                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="jml_rt" name="jml_rt" placeholder="Jumlah RT" required>
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
    <!-- /.modal edit data kegiatan -->
    <div class="modal fade" id="modal-editkegiatan">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data Kegiatan</h4>
              </div>
              <?php echo form_open_multipart('Kegiatan/EditKegiatan');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Kode Kegiatan</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="kd_kegiatan_edit1" placeholder="Kode Kegiatan" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_kegiatan_edit" name="kd_kegiatan_edit" placeholder="Kode Kegiatan" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Kegiatan</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_kegiatan_edit" name="nm_kegiatan_edit" placeholder="Nama Kegiatan" required>
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
    <!-- /.modal edit data topik -->
    <div class="modal fade" id="modal-edittopik">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data Topik</h4>
              </div>
              <?php echo form_open_multipart('Kegiatan/EditTopik');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Kode Topik Aduan</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="kd_topik_edit1" placeholder="Kode Topik Aduan" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_topik_edit" name="kd_topik_edit" placeholder="Kode Topik Aduan" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Topik Aduan</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_topik_edit" name="nm_topik_edit" placeholder="Nama Topik Aduan" required>
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
    <!-- /.modal edit data Dusun -->
    <div class="modal fade" id="modal-editdusun">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data Dusun</h4>
              </div>
              <?php echo form_open_multipart('Kegiatan/EditDusun');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Kode Dusun</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="kd_dusun_edit1" placeholder="Kode Dusun" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_dusun_edit" name="kd_dusun_edit" placeholder="Kode Dusun" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">RW</label>

                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="rw_edit" name="rw_edit" placeholder="RW" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Jumlah RT</label>

                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="jml_rt_edit" name="jml_rt_edit" placeholder="Jumlah RT" required>
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
    $('#example3').DataTable()
    $('#example4').DataTable()
  })
  function tambah() {
    // body...
    document.getElementById('nm_kegiatan').value="";
  }
  function tambahtopik() {
    // body...
    document.getElementById('nm_topik').value="";
  }
  function tambahdusun() {
    // body...
    document.getElementById('nm_dusun').value="";
    document.getElementById('rw').value="";
    document.getElementById('jml_rt').value="";
  }
  function edit(kd_kegiatan_edit,nm_kegiatan_edit) {
    // body...
    document.getElementById('kd_kegiatan_edit').value=kd_kegiatan_edit;
     document.getElementById('kd_kegiatan_edit1').value=kd_kegiatan_edit;
    document.getElementById('nm_kegiatan_edit').value=nm_kegiatan_edit;
  }
  function edittopik(kd_topik_edit,nm_topik_edit) {
    // body...
    document.getElementById('kd_topik_edit').value=kd_topik_edit;
     document.getElementById('kd_topik_edit1').value=kd_topik_edit;
    document.getElementById('nm_topik_edit').value=nm_topik_edit;
  }
 function editdusun(kd_dusun_edit,rw_edit,jml_rt_edit) {
    // body...
    document.getElementById('kd_dusun_edit').value=kd_dusun_edit;
    document.getElementById('kd_dusun_edit1').value=kd_dusun_edit;
    document.getElementById('rw_edit').value=rw_edit;
    document.getElementById('jml_rt_edit').value=jml_rt_edit;
  }
</script>
</body>
</html>
