<!DOCTYPE html>
<html lang="en">
<head>
<title>Data Invoice | Rent Car</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>css/style.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/DataTables-1.10.9/media/css/jquery.dataTables.min.css">
<script src="<?php echo assets_url(); ?>js/jquery1.11.3.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/jquery.sidr.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/DataTables-1.10.9/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".hapus").click(function(){
        $("#hapus_confirm").modal({backdrop: "static"});
		var id = $(this).attr('name');
		$("#proses_hapus").attr("href", "<?php echo base_url(); ?>master/driver/hapus_data/"+id);
    });
	$('#simple-menu').sidr({
		name: 'sidr-left',
		side: 'left',
		source: '#menu-sidr'
    }); 
	$("#table_invoice").DataTable();	
});
</script>
</head>
<body>
<a id="simple-menu" href="#sidr"><img src="<?php echo assets_url(); ?>images/menu_toggle.png"></a>
<div class="container">
<?php $this->view('menu'); ?>
<h2><span class="glyphicon glyphicon-list-alt"></span> Data Invoice</h2>
<?php 
if ($this->session->flashdata('pesan')!=NULL){
	?>
    <div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>Success!</strong> <?php echo $this->session->flashdata('pesan'); ?>
	</div>
    <?php
}
?>
<div align="center"><a href="<?php echo base_url(); ?>transaksi/invoice/tambah_data"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-duplicate"></span> Tambah Data</button></a></div>
<div class="table-responsive">
    <table class="table" id="table_invoice">
        <thead>
            <tr>
                <td>No</td>
                <td>No Invoice</td>
                <td>Tanggal Sewa</td>
                <td>Pelanggan</td>
                <td>Tgl Terbit Invoice</td>
                <td>Jatuh Tempo</td>
                <td>Total Pembayaran</td>
                <td>Status</td>
                <td>Cetak</td>
            </tr>
        </thead>
        <?php
        $no=1;
        foreach($list_invoice as $row) { ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row['no_invoice']; ?> </td>
            <td><?php echo $row['tgl_mulai_new']." - ".$row['tgl_berakhir_new']; ?></td>
            <td><?php echo $row['perusahaan']; ?></td>
            <td><?php echo $row['tgl_invoice_new']; ?></td>
            <td><?php echo $row['tgl_jatuh_tempo_new']; ?></td>
            <td><?php echo $row['total_harga_sewa_new']; ?></td>
            <td><?php 
				if($row['terbayar'] == 0) {
					?>
                    <a href="<?php echo base_url(); ?>transaksi/invoice/pembayaran/<?php echo $row['id_invoice']; ?>">Unpaid</a>
                    <?php
				}
				else if($row['terbayar'] < $row['total_harga_sewa'] && $row['terbayar'] != 0){
					?>
                    <a href="<?php echo base_url(); ?>transaksi/invoice/pembayaran/<?php echo $row['id_invoice']; ?>">Incomplete</a>
                    <?php
				}
				else if($row['terbayar'] == $row['total_harga_sewa']) echo "Paid";
			 ?></td>
            <td><a target="new" href="<?php echo base_url(); ?>transaksi/invoice/cetak_invoice/<?php echo $row['id_invoice']; ?>">Cetak</a></td>
        </tr>
        <?php 
        $no++;
        } ?>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="hapus_confirm" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
            <p>Apakah Anda yakin akan menghapus data driver tersebut ?</p>
            </div>
            <div class="modal-footer">
            <a href="#" id="proses_hapus"><button type="submit" class="btn btn-default" id="proses">Lanjutkan</button></a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
            </div>        
        </div>
    </div>
</div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
	$(".dataTable").removeAttr('style');
});
</script>	