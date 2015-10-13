<!DOCTYPE html>
<html lang="en">
<head>
<title>Master Driver | Rent Car</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>css/style.css">
<script src="<?php echo assets_url(); ?>js/jquery1.11.3.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/jquery.sidr.min.js"></script>
<script src="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
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
<h2><span class="glyphicon glyphicon-book"></span> Data Master Driver</h2>
<?php
if(isset($status_form)) {
	if ($status_form=="add") {
		echo "<h4>Tambah Data Master Driver</h4>";
		echo form_open(base_url().'master/driver/tambah_data'); //pernyataan form action
	}
	else if ($status_form=="edit") {
		echo "<h4>Edit Data Master Driver</h4>";
		echo form_open(base_url().'master/driver/edit_data/'.$list_driver[0]['id_driver']); //pernyataan form action
	}
	
	
	//if ($status_form=="edit");
	?>
    <div class="form-dkm">
        <div
        <?php
        if (form_error('nama') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="nama">Nama <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php if (form_error('nama') != "") echo set_value('nama'); else echo $list_driver[0]['nama_driver'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama'); ?>">
            <?php
            } 
			echo form_error('nama');?>
        </div>
        <div
        <?php
        if (form_error('alamat') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="alamat">Alamat <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php if (form_error('alamat') != "") echo set_value('alamat'); else echo $list_driver[0]['alamat'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="alamat" name="alamat" value="<?php set_value('alamat'); ?>">
            <?php
            } 
			echo form_error('alamat');?>
        </div>
        <div
        <?php
        if (form_error('no_telp') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="no_telp">No Telp <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php if (form_error('no_telp') != "") echo set_value('no_telp'); else echo $list_driver[0]['no_telp_driver'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo set_value('no_telp'); ?>">
            <?php
            } 
			echo form_error('no_telp');?>
        </div>
    </div>
    <br />
    <button type="submit" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-saved"></span> Simpan</button>
    <a href="<?php echo base_url(); ?>master/driver"><button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-remove"></span> Batal</button></a>
    </form>
<?php } ?>
</div>
</body>
</html>