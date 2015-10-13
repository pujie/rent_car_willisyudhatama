<!DOCTYPE html>
<html lang="en">
<head>
<title>Master Pelanggan | Rent Car</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>css/style.css">
<script src="<?php echo assets_url(); ?>js/jquery1.11.3.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/jquery.sidr.min.js"></script>
<script src="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {
	$('#simple-menu').sidr({
      name: 'sidr-left',
      side: 'left',
      source: '#menu-sidr'
    });
});
</script>
</head>
<body>
<a id="simple-menu" href="#sidr"><img src="<?php echo assets_url(); ?>images/menu_toggle.png"></a>
<div class="container">
<?php $this->view('menu'); ?>
<h2><span class="glyphicon glyphicon-book"></span> Data Master Pelanggan</h2>
<?php
if(isset($status_form)) {
	if ($status_form=="add") {
		echo "<h4>Tambah Data Master Pelanggan</h4>";
		echo form_open(base_url().'master/pelanggan/tambah_data'); //pernyataan form action
	}
	else if ($status_form=="edit") {
		echo "<h4>Edit Data Master Pelanggan</h4>";
		echo form_open(base_url().'master/pelanggan/edit_data/'.$list_pelanggan[0]['id_pelanggan']); //pernyataan form action
	}
	
	
	//if ($status_form=="edit");
	?>
    <div class="form-dkm">
        <div
        <?php
        if (form_error('perusahaan') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="perusahaan">Perusahaan <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="perusahaan" name="perusahaan" value="<?php if (form_error('perusahaan') != "") echo set_value('perusahaan'); else echo $list_pelanggan[0]['perusahaan'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="perusahaan" name="perusahaan" value="<?php echo set_value('perusahaan'); ?>">
            <?php
            } 
			echo form_error('perusahaan');?>
        </div>
        <div
        <?php
        if (form_error('penanggung_jwb') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="penanggung_jwb">Penanggung Jawab <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="penanggung_jwb" name="penanggung_jwb" value="<?php if (form_error('penanggung_jwb') != "") echo set_value('penanggung_jwb'); else echo $list_pelanggan[0]['penanggung_jwb'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="penanggung_jwb" name="penanggung_jwb" value="<?php echo set_value('penanggung_jwb'); ?>">
            <?php
            } 
			echo form_error('penanggung_jwb');?>
        </div>
        <div
        <?php
        if (form_error('no_telp') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="no_telp">No Telp <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php if (form_error('no_telp') != "") echo set_value('no_telp'); else echo $list_pelanggan[0]['no_telp'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php set_value('no_telp'); ?>">
            <?php
            } 
			echo form_error('no_telp');?>
        </div>
        <div
        <?php
        if (form_error('kota') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="no_telp">Kota <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="kota" name="kota" value="<?php if (form_error('kota') != "") echo set_value('kota'); else echo $list_pelanggan[0]['kota'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="kota" name="kota" value="<?php echo set_value('kota'); ?>">
            <?php
            } 
			echo form_error('kota');?>
        </div>
    </div>
    <br />
    <button type="submit" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-saved"></span> Simpan</button>
    <a href="<?php echo base_url(); ?>master/pelanggan"><button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-remove"></span> Batal</button></a>
    </form>
<?php } ?>
</div>
</body>
</html>