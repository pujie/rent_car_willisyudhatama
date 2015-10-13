<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo assets_url(); ?>css/cetak_style.css">
<title>Cetak Invoice | Rent Car</title>

</head>

<body>
<table id="table_profile">
	<tr>
    	<td>No. Invoice</td><td align="center">:</td><td><?php echo $list_invoice_det[0]['no_invoice']; ?></td>
        <td>No. Kontrak</td><td align="center">:</td><td><?php echo $list_invoice_det[0]['no_kontrak']; ?></td>
    </tr>
    <tr>
    	<td>Periode Sewa</td><td align="center">:</td><td><?php echo $list_invoice_det[0]['periode_sewa']; ?> Bulan</td>
        <td>Pelanggan</td><td align="center">:</td><td><?php echo $list_invoice_det[0]['perusahaan']; ?></td>
    </tr>
    <tr>
    	<td>Tgl Invoice</td><td align="center">:</td><td><?php echo $tgl_invoice_new; ?></td>
        <td>No Telp</td><td align="center">:</td><td><?php echo $list_invoice_det[0]['no_telp']; ?></td>
    </tr>
    <tr>
    	<td>Tgl Jatuh Tempo</td><td align="center">:</td><td><?php echo $tgl_jatuh_tempo_new; ?></td>
        <td>Kota</td><td align="center">:</td><td><?php echo $list_invoice_det[0]['kota']; ?></td>
    </tr>
</table>
<br />
<table id="table_harga">
	<tr>
    	<td align="center">No</td>
        <td align="center">Keterangan</td>
        <td align="center">Harga</td>
    </tr>
<?php
$no=1;
foreach ($list_invoice_det as $row){
	?>
    <tr>
    	<td align="center"><?php echo $no; ?></td>
        <td><?php echo $row['jenis']." ".$row['merk']." / ".$row['warna']." - (".$row['no_pol'].") - ".$row['tipe'] ?></td>
        <td align="right"><?php echo $row['harga_paket_mobil_new']; ?></td>
    </tr>
    <?php if($row['id_driver']!=""){ ?>
    <tr>
    	<td align="center"><?php echo $no+1; ?></td>
        <td>Driver : <?php echo $row['nama_driver'] ?></td>
        <td align="right"><?php echo $row['harga_paket_driver_new']; ?></td>
    </tr>
    <?php
	}
	$no++;
}

?>
	<tr>
    	<td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
        <td></td>
        <td></td>
    </tr>
	<tr>
    	<td></td>
        <td align="right">Jumlah</td>
        <td align="right"><?php echo $total_harga_sewa_new; ?></td>
    </tr>
    <tr>
    	<td></td>
        <td align="right">PPN 10%</td>
        <td align="right"><?php echo $total_ppn_new; ?></td>
    </tr>
    <tr style="background-color:#333; color:#FFF">
    	<td></td>
        <td align="right">Jumlah Total Yang Harus Dibayar</td>
        <td align="right"><?php echo $total_final_new; ?></td>
    </tr>
    <tr>
    	<td></td>
        <td>Terbilang :</td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
        <td><div id="terbilang_huruf"><?php echo $terbilang; ?> rupiah</div></td>
        <td></td>
    </tr>
</body>
</html>