<?php
foreach($popup as $row){
	$sewa_mobil_bulanan = $row['sewa_bulanan'];
	$sewa_driver_bulanan = 1000000;
	$periode_sewa_bulan = $row['periode_sewa'];
	
	if($row['nama_driver']=="") $harga_sewa = $sewa_mobil_bulanan * $periode_sewa_bulan;
	else $harga_sewa = ($sewa_mobil_bulanan + $sewa_driver_bulanan) * $periode_sewa_bulan;
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
			<td>Rp. <?php echo number_format($harga_sewa, 0, ",", "."); ?></td>
		</tr>
	</table>
	<?php
}
?>
</div>