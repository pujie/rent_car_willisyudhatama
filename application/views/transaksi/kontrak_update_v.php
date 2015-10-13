<!DOCTYPE html>
<html lang="en">
<head>
<title>Kontrak Update | Rent Car</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>css/style.css">
<script src="<?php echo assets_url(); ?>js/jquery1.11.3.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/jquery.sidr.min.js"></script>
<script src="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
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
<h2><span class="glyphicon glyphicon-list-alt"></span> Kontrak Update</h2>
<?php
echo form_open(base_url().'transaksi/kontrak/status_submit_update/'.$list_kontrak[0]['id_kontrak'].''); //pernyataan form action
?>
<div class="form-dkm">
	<div>
    	<label for="no_kontrak">No Kontrak : </label>
        <?php echo $list_kontrak[0]['no_kontrak']; ?>
    </div>
    <div>
    	<label for="pelanggan">Pelanggan : </label>
        <?php echo $list_kontrak[0]['perusahaan']; ?>
    </div>
	<div>
        <label for="canceled">Status Cancel </label>
        <select name="cancel" class="form-control">
        	<option value="0">-</option>
            <option value="1"
            	<?php if ($list_kontrak[0]['cancel']==1) echo "selected"; ?>
            >Canceled</option>
        </select>
    </div>
    <div>
		<label for="alasan_cancel">Alasan Cancel </label>
        <textarea class="form-control" name="keterangan_cancel"><?php echo $list_kontrak[0]['keterangan_cancel']; ?></textarea>
	</div>
</div>
<br />
<button type="submit" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-saved"></span> Simpan</button>
<a href="<?php echo base_url(); ?>transaksi/kontrak"><button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-remove"></span> Batal</button></a>
</form>
</div>
</body>
</html>