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
					<th>Email</th>
					<th>No. Kendaraan</th>
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
					<td><?php echo $value['email']; ?></td>
					<td><?php echo $value['no_kendaraan']; ?></td>
					<td><?php echo $value['status']; ?></td>
					<td align="right">
						<a href="<?= base_url("main/execute/cetak/member"); ?>/<?= $value['id'] ?>" target="_blank"><button type="button" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-eye-open"></span></button></a>
						<a href="#"><button type="button" data-toggle="modal" data-target="#editModal" id="<?php echo $value['id']; ?>" class="edit btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></button></a>
						<a href="<?php echo site_url('main/execute/delete/'.$value['id'].''); ?>" onclick="return confirm('Hapus <?php echo $value['fullname'] ?>?')"><button type="button" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a>
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
						<h3 class="modal-title"><span class="glyphicon glyphicon-plus"></span> Tambah Barang</h3>
					</div>
					<div class="modal-body">
						<form id="tambahform" action="#" method="post" enctype="multipart/form-data">	
							<div class="form-group">
								<label>Kode Produk</label>&nbsp;<span class="error" id="err_kode_produk"></span>
								<input type="text" name="kode_produk" id="kode_produk" class="form-control" maxlength="10" required>
							</div>
							<div class="form-group">
								<label>Nama</label>&nbsp;<span class="error" id="report1"></span>
								<input type="text" id="nama" name="nama" class="form-control" maxlength="100" required>
							</div>
							<div class="form-group">
								<label>Harga</label>
								<input type="number" name="harga" class="form-control" maxlength="30" required>
							</div>
							<button type="submit" class="btn btn-primary" style="width:100%;">Tambah</button>
						</form>
						<div id="a"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>