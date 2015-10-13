<?php
foreach($popup as $row){
	?>
    
	<div class="table-responsive">
	<table class="table">
		<tr>
			<td>Mobil</td>
			<td>:</td>
			<td><?php echo $row['jenis']." ".$row['merk']." / ".$row['warna']." - (".$row['no_pol'].") - ".$row['tipe'] ?></td>
		</tr>
		<tr>
			<td>Driver </td>
			<td>:</td>
			<td><?php echo $row['nama_driver']; ?></td>
		</tr>
		<tr>
			<td>Harga Sewa </td>
			<td>:</td>
			<td><?php echo $row['harga_paket_new']; ?></td>
		</tr>
	</table>
	<?php
}
?>
</div>