<?php
$thn_filter =$this->session->userdata('tahun');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SPK Prioritas Pembangunan Desa</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

  <link rel="icon" href="<?php echo base_url()?>asset/dist/img/jeruksari.png">
  <link rel="stylesheet" href="<?=base_url()?>/asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>/asset/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href=".<?=base_url()?>/asset/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>/asset/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>

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
                <div class="col-sm-12 invoice-col lead">
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
                <div class="col-xs-12">
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
                        <?php 
                        if ($no=='2') {
                          echo 'Ranking';
                        }else{
                        echo 'No';
                        }
                        ?>
                        </center>
                      </th>
                      <th>Jenis Kegiatan</th>
                      <th style="text-align: center;width: 90px">Lokasi</th>
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
                      <th style="text-align: center;">Prakiraan Biaya</th>
					   	
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
                      <td><center>RT <?=$d['rt']?>/ RW <?=$d['rw']?></center></td>
					<?php if ($no!='2') {?>	
                      <?php $j=$this->BobotKriteria_model->cari($l['kd_bidang'],$thn_filter);
                            foreach ($j as $j) {$kriteria = $this->KriteriaKegiatan_model->lihat1($d['kd_rencana'],$j['kd_kriteria']);
                                foreach ($kriteria as $k) {
                          ?>
                          <td>
                            <center><?=$k['nm_dtl_kriteria']?></center>
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
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <?php foreach ($tim as $t) {?>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                  <p>.</p>
                  <center><p>Mengetahui</p></center>
                  <center><p><?=$t['jabatan2']?></p></center>
                  <br><br><br>
                  <center><p><?=$t['nm_pegawai2']?></p></center>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                  <?php 
                    $bulan = array (
                              1 =>   'Januari',
                              'Februari',
                              'Maret',
                              'April',
                              'Mei',
                              'Juni',
                              'Juli',
                              'Agustus',
                              'September',
                              'Oktober',
                              'November',
                              'Desember'
                            );
                  ?>
                  <p style="text-align: right;">Jeruksari, <?php echo date('d').' '.$bulan[(int)date('m')].' '.date('Y');?></p>
                  <center><p>Ketua Tim Penyusun RKP Desa</p></center>
                  <center><p>.</p></center>
                  <br><br><br>
                  <center><p><?=$t['nm_pegawai1']?></p></center>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <?php }?>

  <script>
    window.print();
  </script>
  
</body>
</html>