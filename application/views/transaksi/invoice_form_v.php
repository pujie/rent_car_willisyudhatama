<!DOCTYPE html>
<html lang="en">
<head>
<title>Invoice | Rent Car</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/dhtmlxCombo_v45_std/codebase/dhtmlxcombo.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>css/style.css">
<script src="<?php echo assets_url(); ?>js/jquery1.11.3.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/dhtmlxCombo_v45_std/codebase/dhtmlxcombo.js"></script>
<script src="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/jquery.sidr.min.js"></script>
<script src="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	var z3 = dhtmlXComboFromSelect("kontrak")
	z3.enableFilteringMode("between"); 
	z3.attachEvent("onChange", function(){
		var kt = z3.getSelectedValue();
		$("#kontrak").attr("value", kt);
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
<h2><span class="glyphicon glyphicon-list-alt"></span> Invoice</h2>
<h4>Tambah Data Invoice</h4>
<?php
echo form_open(base_url().'transaksi/invoice/tambah_data'); //pernyataan form action
?>
<div class="form-dkm">
	<div
	<?php
	if (form_error('no_invoice') != "") echo "class = 'alert alert-danger'"
	?>
	>
		<label for="no_invoice">No Invoice <span style="color:red">*</span></label>
        <input type="text" class="form-control" id="no_invoice" name="no_invoice" value="<?php echo set_value('no_invoice'); ?>">
		<?php echo form_error('no_invoice');?>
	</div>
	<div
	<?php
	if (form_error('tgl_invoice') != "") echo "class = 'alert alert-danger'"
	?>
	>
		<label for="tgl_invoice">Tanggal Terbit Invoice <span style="color:red">*</span></label>
        <input type="date" class="form-control" id="tgl_invoice" name="tgl_invoice" value="<?php echo set_value('tgl_invoice'); ?>">
		<?php echo form_error('tgl_invoice');?>
	</div>
    
    <div class="form-dkm">
    	<div
        <?php
		if (form_error('kontrak') != "") echo "class = 'alert alert-danger'"
		?>
        >
        <label for="kontrak">No Kontrak <span style="color:red">*</span></label>
        <?php
		$options = array(''  => '' );
		foreach($kontrak as $row){
			$options[$row['id_kontrak']]= $row['no_kontrak'];
		}
		$prop_kontrak = "id='kontrak' class='form-control'"; //class dari bootstrap
		echo form_dropdown('kontrak', $options, $select_kontrak, $prop_kontrak);

		?>
        <?php echo form_error('kontrak');?>
        </div>
    </div>
</div>
<br />
<button type="submit" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-saved"></span> Proses</button>
<a href="<?php echo base_url(); ?>transaksi/invoice"><button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-remove"></span> Batal</button></a>
</form>
</div>
</body>
</html>