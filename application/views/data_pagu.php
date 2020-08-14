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
        PAGU ANGGARAN
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">PAGU ANGGARAN</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <?php echo form_open_multipart('PaguAnggaran');?>
              <div class="col-md-10">
                <div class="form-group">
                  <label>Filter Tahun</label>
                  <select class="form-control select2" style="width: 100%;" id="tahun" name="tahun">
                   <?php
                   $thn_filter = $tahun;
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
          <!-- /.box -->
          <div class="box">
            <div class="box-header">                 
              <h3 class="box-title">DATA PAGU ANGGARAN <?=$tahun?></h3>       
            </div>
             <?php if($this->session->userdata('lvl_admin')=="2"){?>
            <div class="box-header">
              <div class="row">
                <div class="col-md-2">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahdata" onclick="tambah();" <?php if(empty($list)){echo 'disabled="true"';}?>>
                    Tambah Data
                  </button>
                 </div>
              </div>
            </div>
            <?php }?>
            <!-- /.box-header -->
            <div class="box-body table-responsive mailbox-messages">              
             <table class="table table-hover table-striped">
                <thead>
                <tr>
                  <th>Kode Pagu</th>
                  <th>Nama Bidang</th>
                  <th>Jenis Akun</th>
                  <th style="text-align: right;">Pagu Anggaran</th>
				<?php if($this->session->userdata('lvl_admin')=="2"){?>  	
                  <th>Aksi</th>
				<?php }?>	
                </tr>
                </thead>
                <tbody>
                  <?php 
                  if (empty($data)) {?>
                    <td colspan="5"><center>Data Kosong</center></td>
                  <?php }else{
                  foreach ($data as $d) {?>
                    <tr>
                      <td><?php if($d['tipe_akun']==1){?><b><?php }?><?=$d['kd_pagu']?><?php if($d['tipe_akun']==1){?></b><?php }?></td>
                      <td><?php if($d['tipe_akun']==1){?><b><?php }?><?=$d['nm_bidang']?><?php if($d['tipe_akun']==1){?></b><?php }?></td>
                      <td><?php if($d['jns_akun']==1){echo 'Debet';}else{echo 'Kredit';}?></td>
                      <td style="text-align: right;"><?php if($d['tipe_akun']==1){?><b><?php }?>Rp <?=number_format($d['pagu'],0,',','.')?><?php if($d['tipe_akun']==1){?></b><?php }?></td>
                      <td>
						<?php if($this->session->userdata('lvl_admin')=="2"){?>  
                        <?php if($d['tipe_akun']==2){?>
                        <a href="#" class="btn btn-success" title="Edit" data-toggle="modal" data-target="#modal-editdata" onclick="edit('<?=$d["kd_pagu"]?>','<?=$d["nm_bidang"]?>','<?=number_format($d['pagu'],0,',','.')?>','<?=$d["tahun"]?>')"><i class="fa fa-edit"></i></a>
                        <a href="<?=base_url()?>PaguAnggaran/Hapus/<?=$d['kd_pagu']?>/<?=$d['tahun']?>" class="tombol-hapus btn btn-danger" title="Hapus"><i class="fa fa-trash-o"></i></a>
                        <?php }}?>
                      </td>
                    </tr>
                  <?php }
                    foreach ($pendapatan as $pend) {
                      # code...
                      $pendapatan=$pend['pagupendapatan'];
                    }
                    foreach ($pengeluaran as $peng) {
                      # code...
                      $pengeluaran=$peng['pagupengeluaran'];
                    }
                  ?>
                  <td></td>
                  <td colspan="2"><b>SURPLUS DEFISIT</b></td>
                  <td style="text-align: right;"><b>Rp <?=number_format($pendapatan-$pengeluaran,0,',','.')?></b></td>
                  <td></td>
                  <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode Pagu</th>
                  <th>Nama Bidang</th>
                  <th>Jenis Akun</th>
                  <th style="text-align: right;">Pagu Anggaran</th>
                  <?php if($this->session->userdata('lvl_admin')=="2"){?>  	
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
    </section>
    <!-- /.content -->
    <!-- /.modal tambah data -->
    <div class="modal fade" id="modal-tambahdata">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Pagu Anggaran</h4>
              </div>
              <?php echo form_open_multipart('PaguAnggaran/Tambah');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Nama Akun</label>

                      <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" id="kd_bidang" name="kd_bidang">
                         <?php
                         foreach ($list as $l) {
                          if ($l['jns_akun']==1) {
                            # code...
                            $jns_akun="Debet";
                          }else{
                            $jns_akun="Kredit";
                          }
                          ?> 
                         <option value="<?=$l['kd_bidang']?>"><?=$l['nm_bidang']?> [ <?=$jns_akun?> ]</option>
                         <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Pagu Anggaran</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control uang" id="pagu" name="pagu" required min="0" placeholder="Pagu Anggaran">
                        <input type="hidden" class="form-control" id="tahun" name="tahun" value="<?=$tahun?>">
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
              <?php echo form_open_multipart('PaguAnggaran/Ubah');?>          
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Nama Bidang</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nm_bidang_edit" name="nm_bidang_edit" placeholder="Nama Bidang" required disabled="true">
                        <input type="hidden" class="form-control" id="kd_pagu_edit" name="kd_pagu_edit">
                        <input type="hidden" class="form-control" id="tahun_edit" name="tahun_edit">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Pagu Anggaran</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control uang" id="pagu_edit" name="pagu_edit" placeholder="Pagu Anggaran" required>
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
     $( '.uang' ).mask('000.000.000.000', {reverse: true});
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
  function edit(kd_pagu_edit,nm_bidang_edit,pagu_edit,tahun_edit) {
    // body...
    document.getElementById('kd_pagu_edit').value=kd_pagu_edit;
     document.getElementById('nm_bidang_edit').value=nm_bidang_edit;
    document.getElementById('pagu_edit').value=pagu_edit;
    document.getElementById('tahun_edit').value=tahun_edit;
  }

</script>
</body>
</html>
