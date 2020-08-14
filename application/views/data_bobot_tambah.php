<?php 
  foreach ($bidang as $bid) {
    # code...
    $nm_bidang=$bid['nm_bidang'];
    $kd_bidang=$bid['kd_bidang'];
    $thn_filter = $this->session->userdata('tahun');
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
      <h4>
        TAMBAH BOBOT KRITERIA <?php echo $nm_bidang." TAHUN ".$thn_filter?>
      </h4>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">TAMBAH BOBOT KRITERIA</li>
      </ol>
    </section>

    <!-- Main content -->      
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <?php echo form_open_multipart('Bobot/TambahBobot');?>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Nama Kriteria</label>
                  <select class="form-control select2" style="width: 100%;" id="kd_kriteria" name="kd_kriteria">
                   <?php
                   if (!empty($list)) {
                  
                   foreach ($list as $l) {
                   ?> 
                   <option value="<?=$l['kd_kriteria']?>"><?=$l['nm_kriteria']?></option>
                   <?php }}else{?>
                   <option>Tidak ada data</option>
                   <?php }?>
                  </select>
                </div>
              </div> 
              <div class="col-md-3">
                <div class="form-group">
                  <label>Nilai Bobot ( % )</label>
                  <input type="number" class="form-control" id="bobot" name="bobot" placeholder="Bobot" required min="1" max="100">
                  <input type="hidden" class="form-control" id="kd_bidang" name="kd_bidang" value="<?php echo $kd_bidang?>">
                  <input type="hidden" class="form-control" id="tahun" name="tahun" value="<?php echo $thn_filter?>">
                </div>
              </div>   
              <div class="col-md-2">
                <div class="form-group">
                  <label>Nilai Parameter (P)</label>
                  <input type="number" class="form-control" id="parameter" name="parameter" placeholder="Parameter" required min="1">
                </div>
              </div>       
              <div class="col-md-2">
                <div class="form-group">
                  <label>Simpan Data</label>
                  <button type="submit" class="btn btn-primary form-control" <?php if (empty($list)) {echo "disabled";}?>>Simpan Data</button>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Kembali Ke Bobot Kriteria</label>
                  <a type="button" href="<?php echo base_url('index.php')?>/Bobot/Tahun/<?php echo $thn_filter;?>" class="btn btn-default form-control">Kembali</a>
                </div>
              </div>
            </form>
            <div class="col-md-12 table-responsive mailbox-messages">
            <table class="table table-condensed">  
                <tr>
                  <th>Kode Bobot</th>
                  <th>Nama Kriteria</th>
                  <th>Bobot %</th>
                  <th>Nilai Parameter (P)</th>
                  <th>Aksi</th>
                </tr> 
                <?php if( ! empty($data)){
                  foreach($data as $kr){ // Lakukan looping pada variabel siswa dari controller
                ?> 
                <tr>
                  <td><?=$kr['kd_bobot']?></td>
                  <td><?=$kr['nm_kriteria']?></td>
                  <td><?=$kr['bobot']?> %</td>
                  <td><?=$kr['parameter']?></td>
                  <td>
                     <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-editdata" onclick="edit('<?=$kr["kd_bobot"]?>','<?php echo $nm_bidang?>','<?=$kr["nm_kriteria"]?>','<?=$kr["bobot"]?>','<?php echo $thn_filter?>','<?=$kr['parameter']?>')"><i class="fa fa-edit"></i> Edit</a>
                     <a type="button" class="btn btn-danger tombol-hapus" href="<?php echo base_url('index.php')?>/Bobot/hapusedit/<?=$kr['kd_bobot']?>/<?php echo $thn_filter?>/<?=$kr['kd_bidang']?>"><i class="fa fa-trash-o"></i> Hapus</a>
                  </td>
                </tr>
                <?php }}else{?>
                 <tr><td>Tidak ada data</td></tr> 
                <?php }?>          
              </table>
            </div>
          </div>  
        </div>
        <!-- /.col -->
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
              <?php echo form_open_multipart('Bobot/BobotEdit');?>          
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
                        <input type="number" class="form-control" id="bobotedit" name="bobotedit" placeholder="Bobot" required min="1" max="100">
                         <input type="hidden" class="form-control" id="bobotlama" name="bobotlama">
                        <input type="hidden" class="form-control" id="kd_bidangedit" name="kd_bidangedit" value="<?php echo $kd_bidang?>">
                        <input type="hidden" class="form-control" id="tahunedit" name="tahunedit" value="<?php echo $thn_filter?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nilai Parameter (P)</label>

                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="parameteredit" name="parameteredit" placeholder="Parameter" required min="1">
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
    document.getElementById('nm_kegiatan').value="";
  }
  function edit(kd_bobot,nm_kegiatan_edit,nm_kriteria,bobot,thn_filter,parameter) {
    // body...
    document.getElementById('kd_bobot').value=kd_bobot;
    document.getElementById('kd_bobot1').value=kd_bobot;
    document.getElementById('nm_kegiatan_edit').value=nm_kegiatan_edit;
    document.getElementById('nm_kriteria').value=nm_kriteria;
    document.getElementById('bobotedit').value=bobot;
    document.getElementById('bobotlama').value=bobot;
    document.getElementById('thn_filter').value=thn_filter;
    document.getElementById('parameteredit').value=parameter;
  }

</script>
</body>
</html>
