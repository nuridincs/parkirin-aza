
<div align="left">
	<h3>Report Keuangan Parkir</h3>
</div>
<br><br>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
   
   </div>
  </div>
 </div>
</div>
<?php // echo $this->load->view('layouts/datepicker'); ?>
<!-- <div>
  <form action="<?php //echo base_url('main/daftarparkir'); ?>" class="form-horizontal" method="post">
    <div class="form-group">
      <div class="col-xs-2">
        <input class="form-control" name="search" id="search" placeholder="Search..." type="text">
      </div>
      <button class="btn btn-primary " name="submit" type="submit">
        Cari
       </button>
    </div>
  </form>
</div> -->
<div align="right">
  <form action="<?php echo base_url('main/daftarparkir'); ?>" class="form-horizontal" method="post">
   <!-- <input type="text" name="search" id="search" placeholder="Search..." required>
    <button>Cari</button> -->
  </form>
</div>

<div class="row">
  <div class="col-sm-6" style="">
    <form action="<?php echo base_url('main/report'); ?>" class="form-horizontal" method="post">
     <div class="form-group ">
      <label class="control-label col-sm-2 requiredField" for="date">
       Pilih
       <span class="asteriskField">
        *
       </span>
      </label>
      <div class="col-sm-10">
       <!-- <div class="input-group">
        <div class="input-group-addon">
         <i class="fa fa-calendar">
         </i>
        </div> -->
        <input class="form-control" id="date" name="date" required placeholder="Dari Tanggal" type="text"/><br>
        <input class="form-control" id="date_2" name="date_2" required placeholder="Sampai Tanggal" type="text"/><br>
        <select class="form-control" id="zona" name="zona" required="required" type="text"/>
            <option value="0"> Semua Zona </option>
            <option value="1"> Mahasiswa </option>
            <option value="3"> Pegawai </option>
            <option value="2"> Dosen </option>
        </select>
            
       <!-- </div> -->
      </div>
     </div>
     <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
       <input name="submit" style="display:none" type="text"/>
       <button class="btn btn-primary " name="submit" type="submit">
        Cari
       </button>
       <a href="<?= base_url('main/report') ?>" class="btn btn-success">
        Refresh
       </a>
      </div>
     </div>
    </form>
    <?php
      if(!empty($result)){ 
        
        $cekdata = count($result['data']);
    ?>
      <table class="table table-hover">
        <thead>
          <tr>
            <th style="width:5%;">No.</th>
            <th>No. Induk</th>
            <!-- <th>Status</th> -->
            <th>Zona Parkir</th>
            <th>No. Kendaraan</th>
            <!--<th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th> -->
          </tr>
        </thead>
        <tbody>
        <?php 
          $no = 0;
          foreach($result['data'] as $value){ 
            $no++;
        ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $value['no_induk']; ?></td>
            <!-- <td><?php //echo ($value['status_inout'] == 1 ? 'Parkir' : 'Keluar'); ?></td> -->
            <td><?php echo $value['nama_zona']; ?></td>
            <td><?php echo $value['no_kendaraan']; ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      </div>
      <div class="col-sm-6">
        <div style="border: 2px solid #ccc;border-radius: 5px;" align="center">
          <div style="background-color: #e0dfdf" align="center">
            <div style="font-size: 20px;">Total Kendaraan</div>
          </div>
          <div class="row">
            <div class="col-sm-4" style="font-size: 20px;">
            Mahasiswa
            </div>
            <div class="col-sm-4" style="font-size: 20px;">
            Dosen
            </div>
            <div class="col-sm-4" style="font-size: 20px;">
            Pegawai
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
            <div style="font-size: 40px;color: #f30cb3;"><?php echo ($cekdata != 0) ? $result['total'][0]['total_parkir'] : 0 ?></div>
            </div>
            <div class="col-sm-4">
            <div style="font-size: 40px;color: red;"><?php echo ($cekdata != 0) ? $result['total'][1]['total_parkir'] : 0 ?></div>
            </div>
            <div class="col-sm-4">
            <div style="font-size: 40px;color: #1efb1e;"><?php echo ($cekdata != 0) ? $result['total'][2]['total_parkir'] : 0 ?></div>
            </div>
          </div>
          <div class="row" align="center">
            <div>
            <span style="font-size: 15px">Total Tarif Rp. </span><span style="border: 2px solid #cecece;border-radius: 5px;font-size: 40px">
                <?php 
                  $tarifmhs = 0;
                  $tarifdosen = 0;
                  $tarifpgw = 0;

                  if($result['total'][0]['total_tarif'] != 0){
                    $tarifmhs = $result['total'][0]['total_tarif'];
                  }
                  
                  if($result['total'][1]['total_tarif'] != 0){
                    $tarifdosen = $result['total'][1]['total_tarif'];
                  }
                
                  if($result['total'][2]['total_tarif'] != 0){
                    $tarifpgw = $result['total'][2]['total_tarif'];
                  }

                  if($cekdata == 0){
                    $totaltarif = 0;
                  }else{
                    $totaltarif = $tarifmhs + $tarifdosen + $tarifpgw;
                  }
                  echo number_format($totaltarif,0) 
                  //echo number_format($result['tarif'][0]['total_tarif'],0) 
                ?>
              </span>
            </div>

          </div>
        </div>

      </div>
    <?php } ?>
  </div>