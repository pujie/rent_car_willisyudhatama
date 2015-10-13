<style>
#total_biaya_sewa{
	font-size:24px;
}
</style>
<?php
$no_kontrak = $this->session->userdata('no_kontrak');
$periode_sewa = $this->session->userdata('periode_sewa');
$tgl_mulai = $this->session->userdata('tgl_mulai');
$pelanggan = $det_pelanggan[0]['perusahaan'];
$gaji_driver_bulanan = $this->session->userdata('gaji_driver_bulanan');
?>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <td>No</td>
                <td>Mobil</td>
                <td>Driver</td>
                <td>Biaya Sewa<br />Paket <?php echo $periode_sewa; ?> Bulan</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $no=1;
        foreach($temp as $row) { ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row['jenis']." ".$row['merk']." / ".$row['warna']." - (".$row['no_pol'].") -  ".$row['tipe'] ?> </td>
            <td><?php echo $row['nama_driver']; ?></td>
            <td><?php echo $row['harga_paket_new'];?></td>
            <td><a href="<?php echo base_url(); ?>transaksi/kontrak/delete_temp_trans/<?php echo $row['id_temp_det_kontrak']; ?>">Hapus</td>
        </tr>
        <?php
        $no++;
        } ?>
    </table>
   
</div>
<div id="total_biaya_sewa">Total Biaya Sewa <b><?php echo $this->session->userdata('total_sum_sewa_new'); 
?></b></div><br />

    <a href="<?php echo base_url(); ?>transaksi/kontrak/proses_kontrak"><button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-ok"></span> Proses Kontrak</button>
<a href="<?php echo base_url(); ?>transaksi/kontrak/batal_kontrak"><button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-remove"></span> Batalkan Kontrak</button></a>
<hr><hr>
<br /><br />