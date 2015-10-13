<!DOCTYPE html>
<html lang="en">
<head>
<title>Kontrak Sewa Mobil | Rent Car</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/BeatPicker-master/css/BeatPicker.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>plugin/dhtmlxCombo_v45_std/codebase/dhtmlxcombo.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>css/style.css">
<script src="<?php echo assets_url(); ?>js/jquery1.11.3.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/sidr-package-1.2.1/jquery.sidr.min.js"></script>
<script src="<?php echo assets_url(); ?>plugin/dhtmlxCombo_v45_std/codebase/dhtmlxcombo.js"></script>
<script src="<?php echo assets_url(); ?>plugin/BeatPicker-master/js/BeatPicker.js"></script>
<script src="<?php echo assets_url(); ?>templates/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	var z3 = dhtmlXComboFromSelect("mobil")
	z3.enableFilteringMode("between"); 
	z3.attachEvent("onChange", function(){
		var mb = z3.getSelectedValue();
		$("#mobil").attr("value", mb);
	});
	var z = dhtmlXComboFromSelect("driver")
	z.enableFilteringMode("between"); 
	z.attachEvent("onChange", function(){
		var drv = z.getSelectedValue();
		$("#driver").attr("value", mb);
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
	<?php $this->view('menu'); 
    $no_kontrak = $this->session->userdata('no_kontrak');
    $periode_sewa = $this->session->userdata('periode_sewa');
    $tgl_mulai = $this->session->userdata('tgl_mulai');
    $pelanggan = $det_pelanggan[0]['perusahaan'];
    $gaji_driver_bulanan = $this->session->userdata('gaji_driver_bulanan');
    ?>
    <h2><span class="glyphicon glyphicon-list-alt"></span> Kontrak</h2>
    
    <div class="row">
        <div class="col-md-6">
        <h4>Detil Kontrak Sewa Mobil</h4>
        <br/>
        <p>No Kontrak : <?php echo $no_kontrak; ?></p>
        <p>Pelanggan : <?php echo $pelanggan; ?></p>
        <p>Periode Sewa : <?php echo $periode_sewa; ?> Bulan</p>
        <p>Tanggal Mulai : <?php echo $tgl_mulai_new; ?></p>
        <p>Tanggal Berakhir : <?php echo $tgl_berakhir_new; ?></p>
        <div id="cancel_item">
        <br />
        <a href="<?php echo base_url(); ?>transaksi/kontrak/batal_kontrak"><button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-remove"></span> Batalkan Kontrak</button></a>
        </div>
        <div id="garis_pemisah_kontrak"><hr></div>
        </div>
        <div class="col-md-6">
       	<h4>Tambah Detil Item</h4>
        <?php
        echo form_open(base_url().'transaksi/kontrak/tambah_data_full'); //pernyataan form action
        ?>
        <div class="form-dkm">
            <div class="form-dkm">
                <div
                <?php
                if (form_error('mobil') != "") echo "class = 'alert alert-danger'"
                ?>
                >
                <label for="mobil">Mobil <span style="color:red">*</span></label>
                <?php
                $options = array(''  => '' );
                foreach($mobil as $row){
                    $options[$row['id_mobil']]= $row['jenis']." ".$row['merk']." / ".$row['warna']." - (".$row['no_pol'].") -  ".$row['tipe'];
                }
                $prop_mobil = "id='mobil' class='form-control'"; //class dari bootstrap
                echo form_dropdown('mobil', $options, $select_mobil, $prop_mobil);
        
                ?>
                <?php echo form_error('mobil');?>
                </div>
            </div>
            <div class="form-dkm">
                <div>
                <label for="driver">Driver</label>
                <?php
                $options = array(''  => '' );
                foreach($driver as $row){
                    $options[$row['id_driver']]= $row['nama_driver'];
                }
                $prop_driver = "id='driver' class='form-control'"; //class dari bootstrap
                echo form_dropdown('driver', $options, $select_driver, $prop_driver);
        
                ?>
                </div>
            </div>
        </div>
        <br />
        <button type="submit" class="btn btn-info btn-md"><span class="glyphicon glyphicon-floppy-saved"></span> Tambahkan Paket</button>
        </form><br /><br />        
        </div>
    </div>
    <?php
	if ($jum_temp>=1){
		?>
        <style>
			#cancel_item{
				display:none
			}
		</style>
        <hr>
        <?php
		$this->load->view('transaksi/kontrak_temp_v');
	}
	?>
</div>

</body>
</html>