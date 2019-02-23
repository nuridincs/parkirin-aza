<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Parkirin Aza</title>
		<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/parkir.png'); ?>" />
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
			<a class="navbar-brand" href="<?php echo base_url('main/home'); ?>">Home</a>
			<a class="navbar-brand" href="<?php echo base_url('main/daftarmember'); ?>">Daftar Member</a>
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
		<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
	</body>
</html>