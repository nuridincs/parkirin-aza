<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Parkirin Aza</title>
		<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/parkir.png'); ?>" />

  		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	</head>
	<body>
	<nav class="navbar navbar-default nav-t navbar-fixed-top">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('nama') ?></a>
			<?php if($this->session->userdata('levelaks') == 3){ ?>
			
			<?php }else{ ?>
				<a class="navbar-brand" href="<?php echo base_url('main/home'); ?>">Home</a>
				<a class="navbar-brand" href="<?php echo base_url('main/daftarmember'); ?>">Daftar Member</a>
				<a class="navbar-brand" href="<?php echo base_url('main/daftarparkir'); ?>">Daftar Parkir Harian</a>
				<a class="navbar-brand" href="<?php echo base_url('main/report'); ?>">Report Keuangan</a>
				
			<?php } ?>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<li class="menu-t"><a href="<?php echo base_url(); ?>login/logoutProcess">KELUAR</a></li>
			</ul>
		</div>
	</nav>
	<div style="margin-bottom: 60px;"></div>
	<div class="container">
		<?php $this->load->view($content); ?>
	</div>
		<!-- <div class="wrapper-t">
			<div class="right-content-t pad-t">
				<?php //$this->load->view($content); ?>
			</div>
		</div> -->

		<!-- external javascript -->
		<script src="<?php echo base_url('assets/js/jquery.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/main.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>

  		<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

	</body>
</html>

 <script>
 	$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var date_input_2 =$('input[name="date_2"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy-mm-dd',//yyyy-mm-dd
			container: container,
			todayHighlight: true,
			autoclose: true,
		})

		date_input_2.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	})
</script>