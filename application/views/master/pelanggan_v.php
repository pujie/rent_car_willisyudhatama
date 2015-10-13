<!DOCTYPE html>
<html lang="en">
<head>
<title>Master Pelanggan | Rent Car</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/css/bootstrap.min.css">
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
		$("#proses_hapus").attr("href", "<?php echo base_url(); ?>master/pelanggan/hapus_data/"+id);
    });
	$('#simple-menu').sidr({
		name: 'sidr-left',
		side: 'left',
		source: '#menu-sidr'
    }); 
	$("#table_pelanggan").DataTable();
});
</script>
</head>
<body>
<a id="simple-menu" href="#sidr"><img src="<?php echo assets_url(); ?>images/menu_toggle.png"></a>
<div class="container">
<?php $this->view('menu'); ?>
<h2><span class="glyphicon glyphicon-book"></span> Data Master Pelanggan</h2>
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
<div align="center"><a href="<?php echo base_url(); ?>master/pelanggan/tambah_data"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-duplicate"></span> Tambah Data</button></a></div>
<div class="table-responsive">
    <table class="table" id="table_pelanggan">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama<br>Perusahaan</td>
                <td>Penanggung Jawab</td>
                <td>Kota</td>
                <td>No Telp</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $no=1;
        foreach($list_pelanggan as $row) { ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row['perusahaan']; ?> </td>
            <td><?php echo $row['penanggung_jwb']; ?></td>
            <td><?php echo $row['kota']; ?></td>
            <td><?php echo $row['no_telp']; ?> </td>
            <td><a href="<?php echo base_url(); ?>master/pelanggan/edit_data/<?php echo $row['id_pelanggan']; ?>">Edit</a> |  
            <a name="<?php echo $row['id_pelanggan']; ?>" class="hapus" href="#">Delete</a>
            </td>
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
            <p>Apakah Anda yakin akan menghapus data pelanggan tersebut ?</p>
            </div>
            <div class="modal-footer">
            <a href="#" id="proses_hapus"><button type="submit" class="btn btn-default" id="proses"><span class="glyphicon glyphicon-trash"></span> Lanjutkan</button></a>
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