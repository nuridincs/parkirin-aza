<?php 
	if($this->session->userdata('levelaks') == 3){ 
		$this->load->view('content/scan_barcode');
		// $this->load->view('content/form_inout');
?>	
<?php } else { ?>
	<h3>Welcome to aplikasi parkir</h3>
<?php } ?>