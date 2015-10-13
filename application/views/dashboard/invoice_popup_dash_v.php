<?php

foreach($popup as $row){
	?>
	<div class="table-responsive">
	<table class="table">
    	<tr>
			<td>No Invoice</td>
			<td>:</td>
			<td><?php echo $row['no_invoice']; ?></td>
		</tr>
        <tr>
			<td>No Kontrak</td>
			<td>:</td>
			<td><?php echo $row['no_kontrak']; ?></td>
		</tr>
		<tr>
			<td>Tanggal Sewa</td>
			<td>:</td>
			<td><?php echo $tgl_mulai_new." - ".$tgl_berakhir_new; ?></td>
		</tr>
		<tr>
			<td>Total Pembayaran </td>
			<td>:</td>
			<td><?php echo $total_harga_sewa_new; ?></td>
		</tr>
	</table>
	<?php
}
?>
</div>