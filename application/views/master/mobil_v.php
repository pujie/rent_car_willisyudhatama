<!DOCTYPE html>
<html lang="en">
<head>
<title>Master Mobil | Rent Car</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/DataTables-1.10.9/media/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>css/style.css">
<script src="<?php echo assets_url(); ?>js/jquery1.11.3.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/jquery.sidr.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/DataTables-1.10.9/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".hapus").click(function(){
        $("#hapus_confirm").modal({backdrop: "static"});
		var id = $(this).attr('name');
		$("#proses_hapus").attr("href", "<?php echo base_url(); ?>master/mobil/hapus_data/"+id);
    });
	$('#simple-menu').sidr({
		name: 'sidr-left',
		side: 'left',
		source: '#menu-sidr'
    }); 
	$("#table_mobil").DataTable();
	
});
</script>
</head>
<body>
<a id="simple-menu" href="#sidr"><img src="<?php echo assets_url(); ?>images/menu_toggle.png"></a>
<div class="container">
<?php $this->view('menu'); ?>
<h2><span class="glyphicon glyphicon-book"></span> Data Master Mobil</h2>
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
<div align="center"><a href="<?php echo base_url(); ?>master/mobil/tambah_data"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-duplicate"></span> Tambah Data</button></a></div>
<div class="table-responsive">
    <table class="table" id="table_mobil">
        <thead>
            <tr>
                <td>No</td>
                <td>Merk</td>
                <td>Jenis</td>
                <td>Nopol</td>
                <td>Tahun<br />Keluaran</td>
                <td>Warna</td>
                <td>Harga Sewa<br />Bulanan</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $no=1;
        foreach($list_mobil as $row) { ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row['merk']; ?> </td>
            <td><?php echo $row['jenis']; ?></td>
            <td><?php echo $row['no_pol']; ?></td>
            <td><?php echo $row['tahun_keluaran']; ?> </td>
            <td><?php echo $row['warna']; ?> </td>
            <td><?php echo $row['sewa_bulanan_new']; ?> </td>
            <td><a href="<?php echo base_url(); ?>master/mobil/edit_data/<?php echo $row['id_mobil']; ?>">Edit</a> |  
            <a name="<?php echo $row['id_mobil']; ?>" class="hapus" href="#">Delete</a>
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
            <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Konfirmasi</h4>
            </div>
            <div class="modal-body">
            <p>Apakah Anda yakin akan menghapus data mobil tersebut ?</p>
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