<!DOCTYPE html>
<html lang="en">
<head>
<title>Tambah Kontrak | Rent Car</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/dhtmlxCombo_v45_std/codebase/dhtmlxcombo.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>css/style.css">
<script src="<?php echo assets_url(); ?>js/jquery1.11.3.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/jquery.sidr.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/jquery.sidr.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/dhtmlxCombo_v45_std/codebase/dhtmlxcombo.js"></script>
<script src="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
	$("#periode_sewa").keypress(function (e) {
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
		}
	});
	var z3 = dhtmlXComboFromSelect("pelanggan")
	z3.enableFilteringMode("between"); 
	z3.attachEvent("onChange", function(){
		var pg = z3.getSelectedValue();
		$("#pelanggan").attr("value", pg);
		//alert(pg);
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
<h2><span class="glyphicon glyphicon-list-alt"></span> Kontrak</h2>
<h4>Tambah Data Kontrak Sewa Mobil</h4>
<?php

echo form_open(base_url().'transaksi/kontrak/tambah_data'); //pernyataan form action
?>
<div class="form-dkm">
	<div
	<?php
	if (form_error('no_kontrak') != "") echo "class = 'alert alert-danger'"
	?>
	>
		<label for="no_kontrak">No Kontrak <span style="color:red">*</span></label>
        <input type="text" class="form-control" id="no_kontrak" name="no_kontrak" value="<?php echo set_value('no_kontrak'); ?>">
		<?php echo form_error('no_kontrak');?>
	</div>
	<div
	<?php
	if (form_error('tgl_mulai') != "") echo "class = 'alert alert-danger'"
	?>
	>
		<label for="tgl_mulai">Tanggal Mulai <span style="color:red">*</span></label>
        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="<?php echo set_value('tgl_mulai'); ?>">
		<?php echo form_error('tgl_mulai');?>
	</div>
    <div
	<?php
	if (form_error('periode_sewa') != "") echo "class = 'alert alert-danger'"
	?>
	>
		<label for="periode_sewa">Periode Sewa (bulan) <span style="color:red">*</span></label>
        <input type="text" class="form-control" id="periode_sewa" name="periode_sewa" value="<?php echo set_value('periode_sewa'); ?>">
		<?php echo form_error('periode_sewa');?>
	</div>
    <div class="form-dkm">
    	<div
        <?php
		if (form_error('pelanggan') != "") echo "class = 'alert alert-danger'"
		?>
        >
        <label for="pelanggan">Pelanggan <span style="color:red">*</span></label>
        <?php
		$options = array(''  => '' );
		foreach($pelanggan as $row){
			$options[$row['id_pelanggan']]= $row['perusahaan'];
		}
		$prop_pelanggan = "id='pelanggan' class='form-control' ";
		echo form_dropdown('pelanggan', $options, $select_pelanggan, $prop_pelanggan);
		
		?>
        <?php echo form_error('pelanggan');?>
        </div>
    </div>
</div>
<br />
<button type="submit" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-saved"></span> Proses</button>
<a href="<?php echo base_url(); ?>transaksi/kontrak"><button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-remove"></span> Batal</button></a>
</form>
</div>
</body>
</html>