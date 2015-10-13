<!DOCTYPE html>
<html lang="en">
<head>
<title>Dashboard | Rent Car</title>
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
	$(".detil_kontrak").click(function(){
		var id = $(this).attr('name');
		$.ajax({
			url: "<?php echo base_url() ?>home/popup_detil_kontrak/"+id,
			success: function(data){
				$("#detil_kontrak_full").html(data);
			}
		});
		$("#detil_kontrak").modal({backdrop: "static"});
    });
	$(".detil_invoice").click(function(){
		var id = $(this).attr('name');
		$.ajax({
			url: "<?php echo base_url() ?>home/popup_detil_invoice/"+id,
			success: function(data){
				$("#detil_invoice_full").html(data);
			}
		});
		$("#detil_invoice").modal({backdrop: "static"});
    });
    $('#simple-menu').sidr({
      name: 'sidr-left',
      side: 'left',
      source: '#menu-sidr'
    }); 
});
</script>
<style>
.table{
	font-size:13px;
}
h4{
	font-size:16px;
	font-weight:bold;
}
#selengkapnya a{
	font-size:12px;
	color:#990;
}
</style>
</head>
<body>
<a id="simple-menu" href="#sidr"><img src="<?php echo assets_url(); ?>images/menu_toggle.png"></a>
<div class="container">
    
<?php 
$this->view('slider');
$this->view('menu');
?>
<h2><span class="glyphicon glyphicon-home"></span> DashBoard</h2>
    <div class="row">
        <div class="col-md-6">
        	<h4>Kontrak Berakhir Bulan Ini</h4>
        	<div class="table-responsive">
            	<table class="table">
                	<thead>
                	<tr>
                    	<td>No Kontrak</td>
                        <td>Pelanggan</td>
                        <td>Tgl Berakhir</td>
                    </tr>
                    </thead>
                    <?php
					foreach ($dash_kontrak as $row){
						?>
                    	<tr>
                        <td><a href="#" class="detil_kontrak" name="<?php echo $row['id_kontrak']; ?>"><?php echo $row['no_kontrak']; ?></a></td>
                        <td><?php echo $row['perusahaan']; ?></td>
                        <td><?php echo $row['tgl_berakhir_new']; ?></td>
                        </tr>
                        <?php
					}
					?>
                </table>
            </div>
            <div align="center" id="selengkapnya">
            <a href="<?php echo base_url(); ?>transaksi/invoice"><i>List Data Kontrak Selengkapnya &rarr;</i></a>
            </div><hr />
        </div>
        <div class="col-md-6"> 
        	<h4>Invoice Jatuh Tempo Bulan Ini</h4>
        	<div class="table-responsive">
	            <table class="table">
                	<thead>
                	<tr>
                    	<td>No Invoice</td>
                        <td>Pelanggan</td>
                        <td>Tgl Jatuh Tempo</td>
                    </tr>
                    </thead>
                    <?php
					foreach ($dash_invoice as $row){
						?>
                    <tr>
                        <td><a href="#" class="detil_invoice" name="<?php echo $row['id_invoice']; ?>"><?php echo $row['no_invoice']; ?></a></td>
                        <td><?php echo $row['perusahaan']; ?></td>
                        <td><?php echo $row['tgl_jatuh_tempo_new']; ?></td>
                    </tr>
                        <?php
					}
					?>
                </table>
            </div>
            <div align="center" id="selengkapnya">
            <a href="<?php echo base_url(); ?>transaksi/invoice"><i>List Data Invoice Selengkapnya &rarr;</i></a>
            </div><hr />
        </div>
        </div>
	</div>
    <br /><br /><br />
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
    
    <div class="modal fade" id="detil_invoice" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><span class="glyphicon glyphicon-align-left"></span> Detil Invoice</h4>
            </div>
            <div class="modal-body">
            <div id="detil_invoice_full"></div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-check"></span> Tutup</button>
            </div>
            </div>        
        </div>
    </div>
</div>
</body>
</html>
