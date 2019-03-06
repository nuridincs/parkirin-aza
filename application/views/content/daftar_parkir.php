<div align="left">
	<h3>Data Parkir Harian</h3>
</div>
<div class="row">
	<div class="col-sm-12">
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:5%;">No.</th>
					<th>No. Induk</th>
					<th>Status</th>
					<th>Zona Parkir</th>
					<th>No. Kendaraan</th>
					<th>Tanggal</th>
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
					<td><?php echo $value['no_induk']; ?></td>
					<td><?php echo ($value['status_inout'] == 1 ? 'Parkir' : 'Keluar'); ?></td>
					<td><?php echo $value['nama_zona']; ?></td>
					<td><?php echo $value['no_kendaraan']; ?></td>
					<td><?php echo $value['created_date']; ?></td>
				</tr>
			 <?php } ?>
			</tbody>
		</table>
	</div>
</div>