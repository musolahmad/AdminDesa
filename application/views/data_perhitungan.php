<?php 
  $warna=array("aqua","green","yellow","red","purple","aqua","green","yellow","red","purple");
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
        PERHITUNGAN PRIORITAS PEMBANGUNAN dengan METODE PROMETHEE
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php');?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> PERHITUNGAN PRIORITAS</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
     <div class="row">  
         <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="box">
            <div class="box-header">
              <?php echo form_open_multipart('Prioritas');?>
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
                  <button type="submit" class="btn btn-primary form-control"><i class="fa fa-eye"></i> Lihat Data</button>
                </div>
              </div>
            </form>
          </div>  
          </div>  
          </div> 
        <?php 
        $nomor=0;
        if (empty($data)) {?>
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="callout callout-warning" style="margin-bottom: 0!important;">
              <h4><i class="fa fa-warning"></i> Perhatian:</h4>
                Silahkan isi <b>Rencana Pembangunan</b> tahun <b><?=$thn_filter?></b> terlebih dahulu sebelum melihiat daftar <b>Prioritas Pembangunan</b> tahun <b><?=$thn_filter?></b>
            </div>
        </div>  
        <?php }else{
        foreach ($data as $d) {?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-<?=$warna[$nomor]?>">
              <?=$this->RencanaPembangunan_model->totaladuan($thn_filter,$d['kd_bidang'],'2')?>              
            </span>
            <div class="info-box-content">
            <?php foreach ($no as $n){if ($n['kd_bidang']== $d['kd_bidang']){?>
             <p><b><font color="red"><?=$d['nm_bidang']?></font></b></p>
            <?php }else{?>
            <p><b><?=$d['nm_bidang']?></b></p>
             <?php }if ($n['kd_bidang']!= $d['kd_bidang']) {?>
                <a href="<?php echo base_url('index.php')?>/Prioritas/Tahun/<?=$thn_filter?>/<?=$d['kd_bidang']?>" type="button" class="btn btn-default form-control">Lihat Daftar Prioritas</a>
              <?php }}?>               
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <?php $nomor=$nomor+1;}?>
      </div>
      <!-- /.row -->
      <?php if(empty($datarencana)){?>
        <div class="callout callout-warning" style="margin-bottom: 0!important;">
          <h4><i class="fa fa-warning"></i> Perhatian:</h4>
           RENCANA PEMBANGUNAN <?php foreach ($no as $n) {echo $n['nm_bidang']." TAHUN ".$thn_filter;$kd_bidang=$n['kd_bidang'];}?> BELUM ADA YANG DITERIMA
        </div>
      <?php }else{?>
        <div class="row">          
          <div class="col-xs-12">
            <!-- /.box -->
            <div class="box-header">                 
              <h3 class="box-title">PRIORITAS PEMBANGUNAN <?php foreach ($no as $n) {echo $n['nm_bidang']." TAHUN ".$thn_filter;$kd_bidang=$n['kd_bidang'];}?></h3>       
            </div>
              <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#alternatif" data-toggle="tab">Data Penilaian Kegiatan [ Alternatif ]</a></li>
                <li><a href="#preferensi" data-toggle="tab">Index Preferensi Alternatif</a></li>
                <li><a href="#entering" data-toggle="tab">Entering & Leaving Flow</a></li>
                <li><a href="#prioritas" data-toggle="tab">Hasil Perankingan</a></li>
              </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="alternatif">
                    <div class="box-body table-responsive mailbox-messages">
                      <table class="table table-bordered">
                        <tr>
                          <th  rowspan="2" style="width: 10px">No</th>
                          <th  rowspan="2" style="width: 50px">Kegiatan</th>
                           <th rowspan="2" style="width: 50px">Pagu Anggaran</th>
                          <?php $j=$this->BobotKriteria_model->cari($kd_bidang,$thn_filter); $jum=count($j);?>
                          <th colspan="<?=$jum?>"><center>Nilai</center></th>
                        </tr>
                        <tr>
                          <?php $j=$this->BobotKriteria_model->cari($kd_bidang,$thn_filter);
                            foreach ($j as $j) {?>
                              <th style="width: 40px"><center><?=$j['nm_kriteria']?></center></th>
                            <?php }?>  
                        </tr>
                        <?php $n=1; foreach ($datarencana as $d) {?>
                        <tr>
                          <td><?=$n?>.</td>
                          <td><?=$d['nm_kegiatan']." Lokasi RT ".$d['rt']."/ RW ".$d['rw']?></td>                          
                          <td style="text-align: right;">Rp <?=number_format($d['biaya'],0,',','.')?></td>
                          <?php 
                            $kriteria = $this->KriteriaKegiatan_model->lihat($d['kd_rencana']);
                            foreach ($kriteria as $k) {?>
                              <td><b><center><?=$k['nilai_dtl_kriteria']?></center></b></td>
                          <?php }?>
                        </tr>
                        <?php $n++;}?>
                      </table>
                    </div>          
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="preferensi">
                  <!-- The timeline -->
                  <div class="box-body table-responsive mailbox-messages">
                      <table class="table table-bordered">
                        <tr>
                          <th rowspan="2" style="width: 10px">Kriteria</th>
                          <th rowspan="2" style="width: 10px">Bobot</th>
                          <?php $jum=count($datarencana);?>
                          <th colspan="<?=$jum?>"><center>Alternatif</center></th>
                          <th rowspan="2" style="width: 10px"><center>Tipe Preferensi</center></th>
                          <th rowspan="2" style="width: 10px"><center>Nilai Parameter</center></th>
                        </tr>
                        <tr>
                          <?php 
                            $n=1; foreach ($datarencana as $d) {?>
                          <th style="width: 10px"><center>X<?=$n?></center></th>
                          <?php $n++;}?>                          
                        </tr> 
                        <?php $j=$this->BobotKriteria_model->cari($kd_bidang,$thn_filter);
                          foreach ($j as $j) {?>
                        <tr>
                          <td><?=$j['nm_kriteria']?></td>
                          <td><?=$j['bobot']?>%</td>
                          <?php foreach ($datarencana as $ds) {$kriteria = $this->KriteriaKegiatan_model->lihat1($ds['kd_rencana'],$j['kd_kriteria']);
                                foreach ($kriteria as $k) {
                          ?>
                          <td><center><?=number_format(($k['nilai_dtl_kriteria']*$j['bobot'])/100,2,',','.')?></center></td>   
                          <?php }}?>                       
                          <td><center>3</center></td>                                                    
                          <td><center><?=$j['parameter']?></center></td>
                        </tr>
                        <?php }?>
                      </table>
                    </div> 
                   <div class="box-body table-responsive mailbox-messages">
                      <table class="table table-bordered">
                        <tr>
                          <th>Keterangan Alternatif Diatas</th>
                        </tr>                        
                          <?php 
                            $n=1; foreach ($datarencana as $d) {?>
                            <tr>
                              <td style="width: 10px">X<?=$n?> = <?=$d['nm_kegiatan']." Lokasi RT ".$d['rt']."/ RW ".$d['rw']?></td>
                            </tr>
                          <?php $n++;}?>
                      </table>
                    </div> 
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="prioritas">
                  <div class="box-body table-responsive mailbox-messages">
                      <table class="table table-bordered">
                        <tr>
                          <th style="width: 50px">Kegiatan</th>
						   <th style="width: 50px">Pagu Anggaran</th>                                               
                           <th style="width: 10px"><center>Leaving Flow</center></th>
                           <th style="width: 10px"><center>Entering Flow</center></th>
                           <th style="width: 10px"><center>Net Flow</center></th>
							<th style="width: 10px"><center>Ranking</center></th>
                        </tr>
                        <?php $n=1; $prioritas=$this->Promethee_model->prioritas($thn_filter,$kd_bidang); 
                        foreach ($prioritas as $d) {?>
                        <tr>
                          <td><?=$d['nm_kegiatan']." Lokasi RT ".$d['rt']."/ RW ".$d['rw']?></td>
                          <td style="text-align: right;">Rp <?=number_format($d['biaya'],0,',','.')?></td>
                          <td><center><?=number_format($d['nilai_leaving_flow'],3,',','.')?></center></td>
                          <td><center><?=number_format($d['nilai_entering_flow'],3,',','.')?></center></td>
                          <td><center><?=number_format($d['nilai_net_flow'],3,',','.')?></center></td>
					      <th><center><?=$n?></center></th>
                       </tr>
                        <?php $n++;}?>
                      </table>
                    </div>          
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="entering">
                  <!-- The timeline -->
                  <div class="box-body table-responsive mailbox-messages">
                      <table class="table table-bordered">
                        <tr>
                          <th style="width: 10px"></th>
                          <?php 
                            $n=1; foreach ($datarencana as $d) {?>
                          <th style="width: 10px"><center>X<?=$n?></center></th>
                          <?php $n++;}?>
                          <th style="width: 10px"><center>Leaving Flow</center></th>
                        </tr>
                        <?php 
                            $y=1; foreach ($datarencana as $d1) {?>  
                            <tr>
                              <th style="width: 10px"><center>X<?=$y?></center></th>
                              <?php 
                                $n=1; $x=0; $yz=[]; foreach ($datarencana as $d2) {?>
                                <td style="width: 10px">
                                  <center>
                                    <?php $q=0;$s=0; $z=[]; $selisih=$this->Selisih_model->get_all($d1['kd_rencana'],$d2['kd_rencana']); 
                                      foreach ($selisih as $sl) {
                                        $z[$s]= (((($sl['nilai1']*$sl['bobot'])/100)-(($sl['nilai2']*$sl['bobot'])/100))/$sl['parameter'])/$this->RencanaPembangunan_model->totaladuan($thn_filter,$d['kd_bidang'],'2');
                                        $s++;
                                      }
                                      if (array_sum($z)==0) {
                                        # code...
                                        echo "0";
                                      }else{
                                        echo number_format(array_sum($z),3,',','.');
                                      }
                                    ?>                                                                        
                                  </center>
                                </td>
                              <?php $yz[$x]=array_sum($z);$x++;$n++;}?>
                              <th style="width: 10px"><center><?=number_format(array_sum($yz),3,',','.')?></center></th>
                            </tr>
                        <?php $y++;}?>
                        <tr>
                          <th style="width: 10px"><center>Entering Flow</center></th>
                            <?php 
                              $y=1; foreach ($datarencana as $d1) {?>  
                                <?php 
                                  $n=1; $x=0; $yz=[]; foreach ($datarencana as $d2) {?>
                                      <?php $q=0;$s=0; $z=[]; $selisih=$this->Selisih_model->get_all($d1['kd_rencana'],$d2['kd_rencana']); 
                                        foreach ($selisih as $sl) {
                                          $z[$s]= (((($sl['nilai1']*$sl['bobot'])/100)-(($sl['nilai2']*$sl['bobot'])/100))/$sl['parameter'])/$this->RencanaPembangunan_model->totaladuan($thn_filter,$d['kd_bidang'],'2');
                                          $s++;
                                        }
                                      ?>          
                                <?php $yz[$x]=array_sum($z);$x++;$n++;}?>
                                <th style="width: 10px"><center><?=number_format(-array_sum($yz),3,',','.')?></center></th>
                            <?php $y++;}?>
                          <th style="width: 10px"><center></center></th>
                        </tr>
                      </table>
                  </div> 
                   <div class="box-body table-responsive mailbox-messages">
                      <table class="table table-bordered">
                        <tr>
                          <th>Keterangan Alternatif Diatas</th>
                        </tr>                        
                          <?php 
                            $n=1; foreach ($datarencana as $d) {?>
                            <tr>
                              <td style="width: 10px">X<?=$n?> = <?=$d['nm_kegiatan']." Lokasi RT ".$d['rt']."/ RW ".$d['rw']?></td>
                            </tr>
                          <?php $n++;}?>
                      </table>
                    </div> 
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      <?php }}?>
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
</script>
</body>
</html>