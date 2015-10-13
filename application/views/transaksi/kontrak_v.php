<!DOCTYPE html>
<html lang="en">
<head>
<title>Data Kontrak | Rent Car</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/DataTables-1.10.9/media/css/jquery.dataTables.min.css">

<script src="<?php echo assets_url(); ?>js/jquery1.11.3.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/jquery.sidr.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/DataTables-1.10.9/media/js/jquery.dataTables.min.js"></script>

<script src="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo assets_url(); ?>css/style.css">

<script>
$(document).ready(function(){
    $(".detil").click(function(){
		var id = $(this).attr('name');
		$.ajax({
			url: "<?php echo base_url() ?>transaksi/kontrak/popup_detil_kontrak/"+id,
			success: function(data){
				$("#detil_kontrak_full").html(data);
			}
		});
		$("#detil_kontrak").modal({backdrop: "static"});
    });
	$(".alasan_cancel").click(function(){
		var id = $(this).attr('name');
		$.ajax({
			url: "<?php echo base_url() ?>transaksi/kontrak/popup_detil_cancel/"+id,
			success: function(data){
				$("#detil_cancel_full").html(data);
			}
		});
		$("#detil_cancel").modal({backdrop: "static"});
    });
	$('#simple-menu').sidr({
		name: 'sidr-left',
		side: 'left',
		source: '#menu-sidr'
    }); 
	$("#table_kontrak").DataTable();
});
</script>
</head>
<body>
<a id="simple-menu" href="#sidr"><img src="<?php echo assets_url(); ?>images/menu_toggle.png"></a>
<div class="container">
<?php $this->view('menu'); ?>
<h2><span class="glyphicon glyphicon-list-alt"></span> Data Kontrak</h2>
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
<div align="center"><a href="<?php echo base_url(); ?>transaksi/kontrak/tambah_data"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-duplicate"></span> Tambah Data</button></a></div>
<div class="table-responsive">
    <table class="table" id="table_kontrak">
        <thead>
            <tr>
                <td>No</td>
                <td>No Kontrak</td>
                <td>Pelanggan</td>
                <td>Periode Sewa<br />(Bulan)</td>
                <td>Awal Sewa</td>
                <td>Akhir Sewa</td>
                <td>Total Harga Sewa</td>
                <td>Status</td>
            </tr>
        </thead>
        <?php
        $no=1;
        foreach($list_kontrak as $row) { ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><a href="#" class="detil" name="<?php echo $row['id_kontrak']; ?>"><?php echo $row['no_kontrak']; ?></a></td>
            <td><?php echo $row['perusahaan']; ?></td>
            <td><?php echo $row['periode_sewa']; ?></td>
            <td><?php echo $row['tgl_mulai_new']; ?></td>
            <td><?php echo $row['tgl_berakhir_new']; ?></td>
            <td><?php echo $row['total_harga_sewa_new']; ?></td>
            <td>
			<?php
			if ($row['tgl_berakhir'] > $hari_ini && $row['cancel'] == 0) {
				?>
                <a href="<?php echo base_url(); ?>transaksi/kontrak/status_update/<?php echo $row['id_kontrak']; ?>">Open</a>
                <?php
			}
			else if ($row['tgl_berakhir'] < $hari_ini && $row['cancel'] == 0) {
				?>
                <b>Closed</b>
                <?php
			}
			else if ($row['cancel'] == 1) {
				?>
                <a href="#" class="alasan_cancel" name="<?php echo $row['id_kontrak']; ?>">Canceled</a>
                <?php
			}
			?>
            </td>
        </tr>
        <?php 
        $no++;
        } ?>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="detil_kontrak" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><span class="glyphicon glyphicon-align-left"></span> Detil Kontrak</h4>
            </div>
            <div class="modal-body">
            <div id="detil_kontrak_full"></div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-check"></span> Tutup</button>
            </div>
            </div>        
        </div>
    </div>
    <div class="modal fade" id="detil_cancel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><span class="glyphicon glyphicon-align-left"></span> Detil Pembatalan</h4>
            </div>
            <div class="modal-body">
            <div id="detil_cancel_full"></div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-check"></span> Tutup</button>
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