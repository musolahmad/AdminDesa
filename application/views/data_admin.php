
<?php 
  $kd_admin='';
  $lvl_admin='1';
  if (empty($nomor)) {
    # code...
    $kd_admin="ADM001";
  }else{
    foreach ($nomor as $n) {
    $nilai = substr($n['kd_admin'], 3)+1;
    }
    if ($nilai<10) {
      # code...
      $kd_admin="ADM00".$nilai;
    }elseif ($nilai<100) {
    
      $kd_admin="ADM0".$nilai;
    }else{
      $kd_admin="ADM".$nilai;
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
      <h1>
        ADMIN
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
      <?php if($this->session->flashdata('flash')):?>
      <?php endif;?>
      <div class="flash-confirm" data-flashconfirm="<?=$this->session->flashdata('error');?>"></div>
      <?php if($this->session->flashdata('error')):?>
      <?php endif;?>
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li <?php if($this->session->userdata('tampil') == 'admin'){echo 'class="active"';}?>><a href="#admin" data-toggle="tab">Data Admin</a></li>
                <li <?php if($this->session->userdata('tampil') == 'penyusun'){echo 'class="active"';}?>><a href="#penyusun" data-toggle="tab">Penyusun Perencanaan</a></li>
              </ul>
              <div class="tab-content">
                <div class="<?php if($this->session->userdata('tampil') == 'admin'){echo 'active';}?> tab-pane" id="admin">
                    <div class="box-header">
                      <div class="row">
                        <div class="col-md-2">
                           <a type="button" class="btn btn-primary" href="<?=base_url()?>Admin/Tambah">
                            Tambah Data
                          </a>
                         </div>
                      </div>
                    </div>  
                    <!-- /.box-header -->
                      <div class="box-body table-responsive mailbox-messages">              
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>Kode Admin</th>
                            <th>Nama Admin</th>
                            <th>Jabatan</th>
                            <th>Foto</th>
                            <th>Email</th>
                            <th>Level Admin</th>
                            <th>Status Admin</th>
                            <th>Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($data as $d) {?>  
                              <tr>
                                <td><?=$d['kd_admin']?></td>
                                <td><?=$d['nm_pegawai']?></td>
                                <td><?=$d['nm_jabatan']?></td>
                                <td>
                                    <div class="attachment-block clearfix">
                                      <img class="attachment-img" src="<?=base_url()?>asset/foto_profil/<?=$d['foto_profil']?>" alt="Attachment Image" id="image-preview">
                                    </div>
                                </td>
                                <td><?=$d['email']?></td>
                                <td><?php if($d['lvl_admin']=="1"){echo "Admin";}elseif($d['lvl_admin']=="2"){echo "Super Admin";}else{echo "Verifikator";}?></td>
                                <td><?php if($d['status_admin']=="1"){echo "Aktif";}else{echo "Non Aktif";}?></td>
                                <td>
                                  <a type="button" class="btn btn-success" title="Edit" href="<?= base_url()?>Admin/Edit/<?=$d['kd_admin']?>"><i class="fa fa-edit"></i></a>
                                  <?php if($this->session->userdata('kode_admin') != $d['kd_admin']){?> 
                                  <a type="button" class="btn btn-danger tombol-hapus" title="Hapus" href="<?= base_url()?>Admin/Hapus/<?=$d['kd_admin']?>/<?=$d['foto_profil']?>"><i class="fa fa-trash-o"></i></a> 
                                  <a type="button" class="btn btn-warning" title="<?php if($d['status_admin']=="1"){echo "Non Aktifkan";}else{echo "Aktifkan";}?>" href="<?= base_url()?>Admin/Status/<?=$d['kd_admin']?>/<?=$d['status_admin']?>"><i class="fa <?php if($d['status_admin']=="1"){echo "fa-close";}else{echo "fa-check";}?>"></i></a>  
                                  <?php }?>
                                </td>
                              </tr>
                            <?php }?>
                          </tbody>
                          <tfoot>                                
                            <tr>
                            <th>Kode Admin</th>
                            <th>Nama Admin</th>
                            <th>Jabatan</th>
                            <th>Foto</th>
                            <th>Email</th>
                            <th>Level Admin</th>
                            <th>Status Admin</th>
                            <th>Aksi</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.box-body -->     
                </div>
                <div class="<?php if($this->session->userdata('tampil') == 'penyusun'){echo 'active';}?> tab-pane" id="penyusun">
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
                        <table id="example2" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>Tahun Penyusunan</th>
                            <th>Nama Ketua Tim</th>
                            <th>Nama Penanggung Jawab</th>
                            <th>Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($penyusun as $d) {?>  
                              <tr>
                                <td><?=$d['th_penyusunan']?></td>
                                <td><?=$d['nm_pegawai1']?> (<?=$d['jabatan1']?>)</td>
                                <td><?=$d['nm_pegawai2']?> (<?=$d['jabatan2']?>)</td>
                                <td>
                                  <a type="button" class="btn btn-success" title="Edit" data-toggle="modal" data-target="#modal-editdata" onclick="edit('<?=$d["th_penyusunan"]?>','<?=$d["kd_ketua"]?>','<?=$d["kd_penanggungjawab"]?>')"><i class="fa fa-edit"></i></a>
                                  <a type="button" class="btn btn-danger tombol-hapus" title="Hapus" href="<?= base_url()?>Admin/Hapus/<?=$d['th_penyusunan']?>"><i class="fa fa-trash-o"></i></a> 
                                </td>
                              </tr>
                            <?php }?>
                          </tbody>
                          <tfoot>                                
                            <tr>
                              <th>Tahun Penyusunan</th>
                              <th>Nama Ketua Tim</th>
                              <th>Nama Penanggung Jawab</th>
                              <th>Aksi</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.box-body -->     
                </div>
              </div>
          </div>  
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.modal -->
    <!-- /.modal tambah data -->
    <div class="modal fade" id="modal-tambahdata">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Admin</h4>
              </div>
              <?php echo form_open_multipart('Admin/TambahPenyusun');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Tahun Penyusunan</label>
                      <div class="col-sm-8">
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
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Nama Ketua Tim</label>
                      <div class="col-sm-8">
                         <select class="form-control select2" style="width: 100%;" id="kd_ketua" name="kd_ketua">
                         <?php foreach ($data as $d) {?>
                         <option value="<?=$d['kd_admin']?>"><?=$d['nm_pegawai']?> [<?=$d['nm_jabatan']?>]</option>
                         <?php } ?>
                        </select>
                      </div>
                    </div>                    
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Nama Penanggung Jawab</label>
                      <div class="col-sm-8">
                         <select class="form-control select2" style="width: 100%;" id="kd_penangungjawab" name="kd_penangungjawab">
                         <?php foreach ($data as $d) {?>
                         <option value="<?=$d['kd_admin']?>"><?=$d['nm_pegawai']?> [<?=$d['nm_jabatan']?>]</option>
                         <?php } ?>
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
    <div class="modal fade" id="modal-editdata">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Admin</h4>
              </div>
              <?php echo form_open_multipart('Admin/EditPenyusun');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Tahun Penyusunan</label>
                      <div class="col-sm-8">
                         <input type="text" class="form-control" id="th_edit" name="th_edit" placeholder="Tahun Penyusunan" disabled >
                         <input type="hidden" class="form-control" id="th_edit1" name="th_edit1" placeholder="Tahun Penyusunan">
                      </div>  
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Nama Ketua Tim</label>
                      <div class="col-sm-8">
                         <select class="form-control" style="width: 100%;" id="kd_ketua_edit" name="kd_ketua_edit">
                         <?php foreach ($data as $d) {?>
                         <option value="<?=$d['kd_admin']?>"><?=$d['nm_pegawai']?> [<?=$d['nm_jabatan']?>]</option>
                         <?php } ?>
                        </select>
                      </div>
                    </div>                    
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Nama Penanggung Jawab</label>
                      <div class="col-sm-8">
                         <select class="form-control" style="width: 100%;" id="kd_penanggungjawab_edit" name="kd_penanggungjawab_edit">
                         <?php foreach ($data as $d) {?>
                         <option value="<?=$d['kd_admin']?>"><?=$d['nm_pegawai']?> [<?=$d['nm_jabatan']?>]</option>
                         <?php } ?>
                        </select>
                      </div>
                    </div>
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
    $('#example2').DataTable()
  })
  function edit(th_edit,kd_ketua_edit,kd_penanggungjawab_edit) {
    // body...
    document.getElementById('th_edit').value=th_edit;
    document.getElementById('th_edit1').value=th_edit;
    document.getElementById('kd_ketua_edit').value=kd_ketua_edit;
    document.getElementById('kd_penanggungjawab_edit').value=kd_penanggungjawab_edit;
  }
</script>
</body>
</html>