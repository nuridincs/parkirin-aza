<div class="row">
  <div class="col-sm-6">
		<div class="form-group">
			<label>Nim/Nip</label>&nbsp;<span class="error" id="err_no_induk"></span>
			<input type="text" name="p_no_induk" id="p_no_induk" placeholder="Masukan No. Induk" class="form-control" maxlength="10" required>
		</div>
		<div class="form-group">
			<a href="<?php echo base_url('main/loadbarcode'); ?>" class="btn btn-success btn-block" id="s_barcode">Scan Barcode</a>
		</div>
		<div class="form-group">
			<button class="btn btn-primary btn-block p_inout" id="in">Parkir</button>
		</div>
		<div class="form-group">
			<button class="btn btn-danger btn-block p_inout" id="out">Keluar</button>
		</div>
  </div>
  <div class="col-sm-4">
  	<div class="p_result"></div>
  </div>
</div>