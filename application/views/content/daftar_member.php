<div align="left">
	<h3>Data Member</h3>
</div>
<div class="row">
	<div class="col-sm-12">
		<div align="right">
			<button class="btn btn-primary" data-toggle="modal" data-target="#addmemberModal" >Add Member</button>
		</div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:5%;">No.</th>
					<th>Nama</th>
					<th>No. Induk</th>
					<th>Fakultas</th>
					<th>Jurusan</th>
					<th>No. Kendaraan</th>
					<th>Zona</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$no = 0;
				foreach($result as $value){ 
					$no++;
			?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $value['fullname']; ?></td>
					<td><?php echo $value['no_induk']; ?></td>
					<td><?php echo $value['nama_fakultas']; ?></td>
					<td><?php echo $value['nama_jurusan']; ?></td>
					<td><?php echo $value['no_kendaraan']; ?></td>
					<td><?php echo $value['zona']; ?></td>
					<td><?php echo $value['status']; ?></td>
					<td align="right">
						<a href="<?= base_url("main/execute/cetak/member"); ?>/<?= $value['id'] ?>" target="_blank"><button type="button" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-eye-open"></span></button></a>
						<a href="<?= base_url("main/export/cetak_kartu/"); ?><?= $value['id'] ?>" target="_blank"><button type="button" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span></button></a>
						<a href="<?php echo base_url("main/execute/getdata/memberbyid/"); ?><?= $value['id']; ?>"><button type="button" id="<?php echo $value['id']; ?>" class="edit btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></button></a>
						<!-- <a href="#"><button type="button" data-toggle="modal" data-target="#updatememberModal" id="<?php echo $value['id']; ?>" class="edit btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></button></a> -->
						<a href="<?php echo base_url('main/execute/delete/member/'.$value['id']); ?>" onclick="return confirm('Hapus <?php echo $value['fullname'] ?>?')"><button type="button" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a>
					</td>
				</tr>
			 <?php } ?>
			</tbody>
		</table>
		<div id="addmemberModal" class="modal fade" role="modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title"><span class="glyphicon glyphicon-plus"></span> Tambah Member</h3>
					</div>
					<div class="modal-body">
						<form id="tambahform" action="#" method="post" enctype="multipart/form-data">	
							<div class="form-group">
								<label>Nim/Nip</label>&nbsp;<span class="error" id="err_no_induk"></span>
								<input type="text" name="no_induk" id="no_induk" class="form-control" maxlength="10" required>
							</div>
							<div class="form-group">
								<label>Nama</label>&nbsp;<span class="error" id="report1"></span>
								<input type="text" id="fullname" name="fullname" class="form-control" maxlength="100" required>
							</div>
							<div class="form-group">
								<label>Fakultas</label>&nbsp;<span class="error" id="fakultas"></span>
								<select name="id_fakultas" id="id_fakultas" class="form-control">
									<option value="">-Pilih Fakultas-</option>
									<?php
										foreach ($fakultas as $value) {
											echo "<option value='".$value['id']."'>".$value['nama_fakultas']."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Jurusan</label>&nbsp;<span class="error" id="jurusan"></span>
								<select name="id_jurusan" id="id_jurusan" class="form-control">
									<option value="">-Pilih Jurusan-</option>
									<?php
										foreach ($jurusan as $value) {
											echo "<option value='".$value['id']."'>".$value['nama_jurusan']."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>No. Kendaraan</label>&nbsp;<span class="error" id="no_kendaraan"></span>
								<input type="text" id="no_kendaraan" name="no_kendaraan" class="form-control" maxlength="100" required>
							</div>
							<div class="form-group">
								<label>Zona</label>&nbsp;<span class="error" id="zona"></span>
								<select name="id_zona" id="id_zona" class="form-control">
									<option value="">-Pilih Zona-</option>
									<?php
										foreach ($zona as $value) {
											echo "<option value='".$value['id']."'>".$value['nama_zona']."</option>";
										}
									?>
								</select>
							</div>
							<button type="submit" class="btn btn-primary" style="width:100%;" id="savemember">Simpan</button>
						</form>
						<!-- <div id="a"></div> -->
					</div>
				</div>
			</div>
		</div>
		<div id="updatememberModal" class="modal fade" role="modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title"><span class="glyphicon glyphicon-plus"></span> Update Member</h3>
					</div>
					<div class="modal-body">
						<form id="tambahform" action="#" method="post" enctype="multipart/form-data">	
							<div class="form-group">
								<label>Nim/Nip</label>&nbsp;<span class="error" id="err_no_induk"></span>
								<input type="text" name="update_no_induk" id="update_no_induk" class="form-control" maxlength="10" required>
							</div>
							<div class="form-group">
								<label>Nama</label>&nbsp;<span class="error" id="report1"></span>
								<input type="text" id="update_fullname" name="update_fullname" class="form-control" maxlength="100" required>
							</div>
							<div class="form-group">
								<label>Fakultas</label>&nbsp;<span class="error" id="fakultas"></span>
								<select name="update_id_fakultas" id="update_id_fakultas" class="form-control">
									<option value="">-Pilih Fakultas-</option>
									<?php
										foreach ($fakultas as $value) {
											echo "<option value='".$value['id']."'>".$value['nama_fakultas']."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Jurusan</label>&nbsp;<span class="error" id="jurusan"></span>
								<select name="update_id_jurusan" id="update_id_jurusan" class="form-control">
									<option value="">-Pilih Jurusan-</option>
									<?php
										foreach ($jurusan as $value) {
											echo "<option value='".$value['id']."'>".$value['nama_jurusan']."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>No. Kendaraan</label>&nbsp;<span class="error" id="no_kendaraan"></span>
								<input type="text" id="update_no_kendaraan" name="update_no_kendaraan" class="form-control" maxlength="100" required>
							</div>
							<div class="form-group">
								<label>Zona</label>&nbsp;<span class="error" id="zona"></span>
								<select name="update_id_zona" id="update_id_zona" class="form-control">
									<option value="">-Pilih Zona-</option>
									<?php
										foreach ($zona as $value) {
											echo "<option value='".$value['id']."'>".$value['nama_zona']."</option>";
										}
									?>
								</select>
							</div>
							<button type="submit" class="btn btn-primary" style="width:100%;" id="updatemember">Simpan</button>
						</form>
						<!-- <div id="a"></div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>