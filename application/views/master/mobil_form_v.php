<!DOCTYPE html>
<html lang="en">
<head>
<title>Master Mobil | Rent Car</title>
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
	$("#sewa_bulanan").keypress(function (e) {
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
		}
	});
	$("#tahun_keluaran").keypress(function (e) {
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
		}
	});
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
<h2><span class="glyphicon glyphicon-book"></span> Data Master Mobil</h2>
<?php
if(isset($status_form)) {
	if ($status_form=="add") {
		echo "<h4>Tambah Data Master Mobil</h4>";
		echo form_open(base_url().'master/mobil/tambah_data'); //pernyataan form action
	}
	else if ($status_form=="edit") {
		echo "<h4>Edit Data Master Mobil</h4>";
		echo form_open(base_url().'master/mobil/edit_data/'.$list_mobil[0]['id_mobil']); //pernyataan form action
	}
	
	
	//if ($status_form=="edit");
	?>
    <div class="form-dkm">
        <div
        <?php
        if (form_error('merk') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="merk">Merk <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="merk" name="merk" value="<?php if (form_error('merk') != "") echo set_value('merk'); else echo $list_mobil[0]['merk'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="merk" name="merk" value="<?php echo set_value('merk'); ?>">
            <?php
            } 
			echo form_error('merk');?>
        </div>
        <div
        <?php
        if (form_error('jenis') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="jenis">Jenis <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="jenis" name="jenis" value="<?php if (form_error('jenis') != "") echo set_value('jenis'); else echo $list_mobil[0]['jenis'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="jenis" name="jenis" value="<?php set_value('jenis'); ?>">
            <?php
            } 
			echo form_error('jenis');?>
        </div>
        <div
        <?php
        if (form_error('tipe') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="tipe">Tipe <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="tipe" name="tipe" value="<?php if (form_error('tipe') != "") echo set_value('tipe'); else echo $list_mobil[0]['tipe'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="tipe" name="tipe" value="<?php echo set_value('tipe'); ?>">
            <?php
            } 
			echo form_error('tipe');?>
        </div>
        <div
        <?php
        if (form_error('no_pol') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="no_pol">No Pol <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="no_pol" name="no_pol" value="<?php if (form_error('no_pol') != "") echo set_value('no_pol'); else echo $list_mobil[0]['no_pol'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="no_pol" name="no_pol" value="<?php echo set_value('no_pol'); ?>">
            <?php
            } 
			echo form_error('no_pol');?>
        </div>
        <div
        <?php
        if (form_error('tahun_keluaran') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="tahun_keluaran">Tahun Keluaran <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="tahun_keluaran" name="tahun_keluaran" value="<?php if (form_error('tahun_keluaran') != "") echo set_value('tahun_keluaran'); else echo $list_mobil[0]['tahun_keluaran'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="tahun_keluaran" name="tahun_keluaran" value="<?php echo set_value('tahun_keluaran'); ?>">
            <?php
            } 
			echo form_error('tahun_keluaran');?>
        </div>
        <div
        <?php
        if (form_error('warna') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="warna">Warna <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="warna" name="warna" value="<?php if (form_error('warna') != "") echo set_value('warna'); else echo $list_mobil[0]['warna'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="warna" name="warna" value="<?php echo set_value('warna'); ?>">
            <?php
            } 
			echo form_error('warna');?>
        </div>
        <div
        <?php
        if (form_error('sewa_bulanan') != "") echo "class = 'alert alert-danger'"
        ?>
        >
            <label for="sewa_bulanan">Sewa Bulanan <span style="color:red">*</span></label>
            <?php
            if ($status_form=="edit") { ?>
                <input type="text" class="form-control" id="sewa_bulanan" name="sewa_bulanan" value="<?php if (form_error('sewa_bulanan') != "") echo set_value('sewa_bulanan'); else echo $list_mobil[0]['sewa_bulanan'];?>">
                <?php
            } else {
			?>
            	<input type="text" class="form-control" id="sewa_bulanan" name="sewa_bulanan" value="<?php echo set_value('sewa_bulanan'); ?>">
            <?php
            } 
			echo form_error('sewa_bulanan');?>
        </div>
    </div>
    <br />
    <button type="submit" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-saved"></span> Simpan</button>
    <a href="<?php echo base_url(); ?>master/mobil"><button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-remove"></span> Batal</button></a>
    </form>
<?php } ?>
</div>
</body>
</html>