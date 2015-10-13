<!DOCTYPE html>
<html lang="en">
<head>
<title>Invoice Pay | Rent Car</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>css/style.css">
<script src="<?php echo assets_url(); ?>js/jquery1.11.3.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/jquery.sidr.min.js"></script>
<script src="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {
	$("#pembayaran").keypress(function (e) {
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
<h2><span class="glyphicon glyphicon-barcode"></span> Pembayaran Invoice</h2>
<?php 
if ($this->session->flashdata('pesan')!=NULL){
	?>
    <div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>Success!</strong> <?php echo $this->session->flashdata('pesan'); ?>
	</div>
    <?php
}
echo form_open(base_url().'transaksi/invoice/pembayaran/'.$list_invoice_det[0]['id_invoice'].''); //pernyataan form action
$kekurangan_pemb = $list_invoice_det[0]['total_harga_sewa'] - $list_invoice_det[0]['terbayar'];
$terbayar = $list_invoice_det[0]['terbayar'];
$this->session->set_userdata('terbayar', $terbayar);
?>
<div class="form-dkm">
	<div>
    	<label for="no_invoice">No Invoice : </label>
        <?php echo $list_invoice_det[0]['no_invoice']; ?>
    </div>
    <div>
    	<label for="no_kontrak">No Kontrak : </label>
        <?php echo $list_invoice_det[0]['no_kontrak']; ?>
    </div>
    <div>
    	<label for="pelanggan">Pelanggan : </label>
        <?php echo $list_invoice_det[0]['perusahaan']; ?>
    </div>
    <div>
    	<label for="total_harga_sewa">Total Tagihan : </label>
        Rp. <?php echo number_format($list_invoice_det[0]['total_harga_sewa'], 0, ",", "."); ?>
    </div>
    <div>
    	<label for="terbayar">Jumlah Telah Dibayar : </label>
        Rp. <?php echo number_format($terbayar, 0, ",", ".");?>
    </div>
    <div>
    	<label for="terbayar">Telah Dibayar Pada : </label>
        <?php echo $tgl_terbayar_new; ?>
    </div>
    <div>
    	<label for="kekurangan">Kekurangan Pembayaran : </label>
        Rp. <?php echo number_format($kekurangan_pemb, 0, ",", "."); ?>
    </div>
    
    <div
	<?php
	if (form_error('pembayaran') != "") echo "class = 'alert alert-danger'"
	?>
	>
		<label for="pembayaran">Tambahkan Pembayaran Sebesar  <span style="color:red">*</span></label>
        <input type="text" class="form-control" name="pembayaran" id="pembayaran" value="<?php echo set_value('pembayaran'); ?>">
        <?php echo form_error('pembayaran');?>
	</div>
    <div
	<?php
	if (form_error('tgl_bayar') != "") echo "class = 'alert alert-danger'"
	?>
	>
		<label for="tgl_bayar">Tanggal Pembayaran <span style="color:red">*</span></label>
        <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?php echo set_value('tgl_bayar'); ?>">
		<?php echo form_error('tgl_bayar');?>
	</div>
</div>
<br />
<button type="submit" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-saved"></span> Simpan</button>
<a href="<?php echo base_url(); ?>transaksi/invoice"><button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-remove"></span> Batal</button></a>
</form>
</div>
</body>
</html>