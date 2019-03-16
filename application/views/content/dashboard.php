<?php 
	if($this->session->userdata('levelaks') == 3){ 
		$this->load->view('content/scan_barcode');
		// $this->load->view('content/form_inout');
?>	
<?php } else { //print_r($dosen); ?>
<h3>Welcome to aplikasi parkir</h3>
<div class="container">
  <div class="row">
    <div class="col-xs-18 col-sm-6 col-md-3">
      <div class="thumbnail" style="border: 2px solid #f30cb3;">
      	<div align="center">
	      	<div>Parkir Zona</div>
	      	<div><b><?= $dosen[0]['nama_zona'] ?></b></div>
	      	<div style="font-size: 40px;color: #f30cb3;"><?= $dosen[0]['sisa_kuota'] ?></div>
	      	<div>Slot Tersedia</div>
      	</div>
      </div>
    </div>
    
    <div class="col-xs-18 col-sm-6 col-md-3">
      <div class="thumbnail" style="border: 2px solid red;">
      	<div align="center">
	      	<div>Parkir Zona</div>
	      	<div><b><?= $mahasiswa[0]['nama_zona'] ?></b></div>
	      	<div style="font-size: 40px;color: red"><?= $mahasiswa[0]['sisa_kuota'] ?></div>
	      	<div>Slot Tersedia</div>
      	</div>
      </div>
    </div>
    
    <div class="col-xs-18 col-sm-6 col-md-3">
      <div class="thumbnail" style="border: 2px solid #1efb1e;">
      	<div align="center">
	      	<div>Parkir Zona</div>
	      	<div><b><?= $pegawai[0]['nama_zona'] ?></b></div>
	      	<div style="font-size: 40px;color: #1efb1e"><?= $pegawai[0]['sisa_kuota'] ?></div>
	      	<div>Slot Tersedia</div>
      	</div>
      </div>
    </div>
  </div><!--/row-->
</div><!--/container -->
<?php } ?>