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
       LAPORAN
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-12"> 
        <div class="box">
              <div class="box-header">
                <?php echo form_open_multipart('Laporan');?>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label>Filter Tahun</label>
                      <select class="form-control select2" style="width: 100%;" id="tahun" name="tahun">
                       <?php
                       $thn_filter =$this->session->userdata('tahun');
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
       <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Laporan</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li <?php if ($no=='1'){echo 'class="active"';}?>><a href="<?=base_url()?>Laporan/Tahun/<?=$thn_filter?>/1"><i class="fa fa-building-o"></i> Rencana Pembangunan</a></li>
                <li <?php if ($no=='2'){echo 'class="active"';}?>><a href="<?=base_url()?>Laporan/Tahun/<?=$thn_filter?>/2"><i class="fa fa-filter"></i> Prioritas Pembangunan</a></li>
                <li <?php if ($no=='3'){echo 'class="active"';}?>><a href="<?=base_url()?>Laporan/Tahun/<?=$thn_filter?>/3"><i class="fa fa-star"></i> Pelaksanaan Pembangunan</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
       <div class="col-md-9">
           <?php if(empty($laporan)){?>
            <div class="callout callout-warning" style="margin-bottom: 0!important;">
              <h4><i class="fa fa-warning"></i> Perhatian:</h4>
               <?php if ($no=='1') {echo "Tidak Ada Data Laporan Rencana Kegiatan Pembangunan Desa Tahun ".$thn_filter;}?>
               <?php if ($no=='2') {echo "Tidak Ada Data Laporan Prioritas Rencana Kegiatan Pembangunan Desa Tahun ".$thn_filter;}?>
               <?php if ($no=='3') {echo "Tidak Ada Data Laporan Pelaksanaan Kegiatan Pembangunan Desa Tahun ".$thn_filter;}?>
            </div>
          <?php }else{?>
           <section class="invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <center>
                  <h2 class="page-header">
                    Daftar <?php if ($no=='1'){echo 'Rencana Kegiatan Pembangunan Desa';}if ($no=='2'){echo 'Prioritas Rencana Kegiatan Pembangunan Desa';}if ($no=='3'){echo 'Pelaksanaan Kegiatan Pembangunan Desa';}?>
                    <p>Tahun <?=$thn_filter?></p>
                  </h2>                  
                  </center>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                  <table>
                    <tr>
                      <td style="width: 100px">Desa</td>
                      <td style="width: 10px"> :</td>
                      <td> Jeruksari</td>
                    </tr>
                    <tr>
                      <td>Kecamatan</td>
                      <td> :</td>
                      <td> Tirto</td>
                    </tr>
                    <tr>
                      <td>Kabupaten</td>
                      <td> :</td>
                      <td> Pekalongan</td>
                    </tr>
                    <tr>
                      <td>Privinsi</td>
                      <td> :</td>
                      <td> Jawa Tengah</td>
                    </tr>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <br>
              <!-- Table row -->
              <div class="row">
                <div class="col-xs-12 table-responsive">
                <?php $total=0; foreach ($laporan as $l) {?>
                 <table class="table table-bordered">
                    <thead>
                    <tr>
                      <?php $j=$this->BobotKriteria_model->cari($l['kd_bidang'],$thn_filter); 
                      if ($no==1) {
                        # code...
                        $jum=count($j)+4;
                      }if ($no==2) {
                        # code...
                        $jum=7;
                      }if ($no==3) {
                        # code...
                        $jum=count($j)+5;
                      }
                      ?>                      
                      <th colspan="<?=$jum?>"><?=$l['nm_bidang']?></th>
                    </tr>
                    <tr>
                      <th><center>
                       <?php if ($no=='2') {
							echo "Ranking";
						}else{
					   		echo "No";
						}?>
                        </center>
                      </th>
                      <th>Jenis Kegiatan</th>
                      <th>Lokasi</th>
                      <?php if($no!=2){?>
						<?php $j=$this->BobotKriteria_model->cari($l['kd_bidang'],$thn_filter);
                            foreach ($j as $j) {?>
                      <th style="width: 40px"><center><?=$j['nm_kriteria']?></center></th>
                            <?php }}?> 
                      <?php if($no==2){?>
                      <th><center>Leaving Flow</center></th>
                      <th><center>Entering Flow</center></th>
                      <th><center>Net Flow</center></th>
                      <?php }?> 
                      <?php if($no==3){?>
                      <th><center>Prakiraan Waktu Pelaksanaan</center></th>
                      <?php }?>      
                      <th style="text-align: right;">Prakiraan Biaya</th>
					   	
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if ($no=='1') {
                    $data=$this->Laporan_model->rencana1($thn_filter,$l['kd_bidang']);
                    }if ($no=='2') {
                    $data=$this->Laporan_model->prioritas1($thn_filter,$l['kd_bidang']);
                    }if ($no=='3') {
                    $data=$this->Laporan_model->pelaksanaan1($thn_filter,$l['kd_bidang']);
                    }
                    $nomor=1;$biaya=0;
                    foreach ($data as $d) {
                    ?>
                    <tr>
                      <td><center><?=$nomor?></center></td>
                      <td><?=$d['nm_kegiatan']?></td>
                      <td>RT <?=$d['rt']?>/ RW <?=$d['rw']?></td>
                      <?php if ($no!='2') {?>
						<?php $j=$this->BobotKriteria_model->cari($l['kd_bidang'],$thn_filter);
                            foreach ($j as $j) {$kriteria = $this->KriteriaKegiatan_model->lihat1($d['kd_rencana'],$j['kd_kriteria']);
                                foreach ($kriteria as $k) {
                          ?>
                          <td>
							  <center>
                            <?=$k['nm_dtl_kriteria']?>
							  </center>	  
                          </td>   
                          <?php }}}?>
                      <?php if($no==2){?>
                      <td><center><?=$d['nilai_leaving_flow']?></center></td>
                      <td><center><?=$d['nilai_entering_flow']?></center></td>
                      <td><center><?=$d['nilai_net_flow']?></center></td>
                      <?php }?>		
                      <?php if($no==3){?>
                      <td><center><?=date('d-m-Y',strtotime($d['tgl_mulai']))?> <br>Sampai<br> <?=date('d-m-Y',strtotime($d['tgl_akhir']))?></center></td>
                      <?php }?> 
                      <td style="text-align: right;">Rp <?=number_format($d['biaya'],0,',','.')?></td> 
                    </tr>
                    <?php $nomor++;$biaya=$biaya+$d['biaya'];}?>
                    <tr>
                      <th colspan="<?=$jum-1?>" style="text-align: right;">Jumlah Per Bidang</th>
                      <th style="text-align: right;">Rp <?=number_format($biaya,0,',','.')?></th>
                    </tr>
                    </tbody>
                  </table>
                <?php $total=$total+$biaya;}?>  
                  <table class="table table-bordered">
                    <thead>
                    <tr>  
                      <th style="text-align: right;">JUMLAH TOTAL : RP <?=number_format($total,0,',','.')?></th>
                    </tr>
                    </thead>
                  </table>  

                <a href="<?=base_url()?>Laporan/Cetak/<?=$thn_filter?>/<?=$no?>" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Cetak</a>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </section>
          <?php }?>
        </div>  
      </div> 
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
