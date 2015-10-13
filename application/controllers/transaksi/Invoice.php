<?php
defined ('BASEPATH') OR exit('No direct script access allowed');
class Invoice extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->model('transaksi/invoice_m', 'dt_invoice');
		/*if($this->logged_in()){
		}
		else redirect('login','refresh');*/
	}
	public function index(){
		$data["list_invoice"]=$this->dt_invoice->select_invoice_all();
		$i=0;
		foreach($data["list_invoice"] as $row){
			$data["list_invoice"][$i]['tgl_mulai_new']=$this->nama_bulan($row['tgl_mulai']);
			$data["list_invoice"][$i]['tgl_berakhir_new']=$this->nama_bulan($row['tgl_berakhir']);
			$data["list_invoice"][$i]['tgl_invoice_new']=$this->nama_bulan($row['tgl_invoice']);
			$data["list_invoice"][$i]['tgl_jatuh_tempo_new']=$this->nama_bulan($row['tgl_jatuh_tempo']);
			$data["list_invoice"][$i]['total_harga_sewa_new']=$this->angka_rupiah($row['total_harga_sewa']);
			$i++;
		}
		$this->load->view('transaksi/invoice_v', $data);
	}
	public function tambah_data(){
		$data["kontrak"]=$this->dt_invoice->select_kt();
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', ' ');
		$this->form_validation->set_rules('no_invoice', 'Invoice', 'required');
		$this->form_validation->set_rules('tgl_invoice', 'Tanggal Invoice', 'required');
		$this->form_validation->set_rules('kontrak', 'Kontrak', 'required');
		if ($this->form_validation->run()==FALSE){
			$data['select_kontrak'] = $this->input->post('kontrak');
			$this->load->view('transaksi/invoice_form_v', $data);
		}
		else {
			$data_inv['no_invoice'] = $this->input->post('no_invoice');
			$data_inv['tgl_invoice'] = $this->input->post('tgl_invoice');
			$data_inv['id_kontrak'] = $this->input->post('kontrak');
			$data_inv['tgl_jatuh_tempo'] = $this->tgl_jatuh_tempo($data_inv['tgl_invoice']);
			
			$this->dt_invoice->insert_invoice($data_inv);
			
			$this->session->set_flashdata('pesan', 'Anda telah berhasil menambahkan invoice dengan nomor : <b>'.$data_inv['no_invoice'].'</b>');
			redirect(base_url().'transaksi/invoice');
		}
	}
	public function tgl_jatuh_tempo($tgl_invoice){
		$jarak_hari = 15; 
		$date=date_create($tgl_invoice);
		date_modify($date,"+ ".$jarak_hari." days");
		$tgl_jatuh_tempo = date_format($date,"Y-m-d");
		return $tgl_jatuh_tempo;
	}
	public function cetak_invoice($id){
		$gaji_driver_bulanan = 1000000;
		$data["list_invoice_det"]=$this->dt_invoice->select_det_invoice($id);
		/* start menghitung harga per item per periode */
		$i=0;
		foreach ($data["list_invoice_det"] as $row){
			$data["list_invoice_det"][$i]["harga_paket_mobil"] = $row['sewa_bulanan'] * $row['periode_sewa'];
			$data["list_invoice_det"][$i]["harga_paket_driver" ]= $gaji_driver_bulanan * $row['periode_sewa'];
			$data["list_invoice_det"][$i]["harga_paket_mobil_new"]= $this->angka_rupiah($data["list_invoice_det"][$i]["harga_paket_mobil"]);
			$data["list_invoice_det"][$i]["harga_paket_driver_new"]= $this->angka_rupiah($data["list_invoice_det"][$i]["harga_paket_driver"]);
			$i++;
		}
		/* end menghitung harga per item per periode */
		foreach($data["list_invoice_det"] as $row){
			$data["total_harga_sewa"] = $row['total_harga_sewa'];
			$data["total_ppn"] = ( $row['total_harga_sewa'] / 100 ) * 10;
			$data["total_final"] = $data["total_harga_sewa"] + $data["total_ppn"];
			
			$data["total_harga_sewa_new"] = $this->angka_rupiah($data["total_harga_sewa"]);
			$data["total_ppn_new"] = $this->angka_rupiah($data["total_ppn"]);
			$data["total_final_new"] = $this->angka_rupiah($data["total_final"]);
			
			$data["tgl_invoice_new"]=$this->nama_bulan($row['tgl_invoice']);
			$data["tgl_jatuh_tempo_new"]=$this->nama_bulan($row['tgl_jatuh_tempo']);
			$data["terbilang"]=$this->terbilang($data["total_final"]);
		}
		$this->load->view('transaksi/cetak_invoice_v', $data);
	}
	public function pembayaran($id){
		$data['list_invoice_det']=$this->dt_invoice->select_det_invoice($id);
		foreach ($data['list_invoice_det'] as $row){
			if ($row['tgl_terbayar'] != "0000-00-00") $data['tgl_terbayar_new'] = $this->nama_bulan($row['tgl_terbayar']);
			else $data['tgl_terbayar_new'] = "-";
		}
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', ' ');
		$this->form_validation->set_rules('pembayaran', 'Pembayaran', 'required');
		$this->form_validation->set_rules('tgl_bayar', 'Tanggal Bayar', 'required');
		if ($this->form_validation->run()==FALSE){
			$this->load->view('transaksi/invoice_bayar_v', $data);
		}
		else {
			$terbayar_sebelumya = $this->session->userdata['terbayar'];
			$pembayaran_skrg = $this->input->post('pembayaran');
			$tot_bayar = $terbayar_sebelumya + $pembayaran_skrg;
			$data_bayar["terbayar"] = $tot_bayar;
			$data_bayar["tgl_terbayar"] = $this->input->post('tgl_bayar');
			$this->dt_invoice->pembayaran_submit_up($id, $data_bayar);
			
			$this->session->set_flashdata('pesan', 'Anda telah berhasil memasukkan pembayaran pada invoice.');
			redirect(base_url().'transaksi/invoice');
		}
	}
	public function nama_bulan($tgl){
		$tgl_artikel = date_create($tgl);
		$date = date_format($tgl_artikel,'d M Y');
		$format = array(
			'Jan' => 'Januari',
			'Feb' => 'Februari',
			'Mar' => 'Maret',
			'Apr' => 'April',
			'May' => 'Mei',
			'Jun' => 'Juni',
			'Jul' => 'Juli',
			'Aug' => 'Agustus',
			'Sep' => 'September',
			'Oct' => 'Oktober',
			'Nov' => 'November',
			'Dec' => 'Desember'
		);
		$new_tgl = strtr(($date),$format);
		return $new_tgl;
	}
	public function terbilang($nominal)
	{
		$kata = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		if ($nominal < 12)
			return " " . $kata[$nominal];
		elseif ($nominal < 20)
			return $this->terbilang($nominal - 10) . " belas ";
		elseif ($nominal < 100)
			return $this->terbilang($nominal / 10) . " puluh" . $this->terbilang($nominal % 10);
		elseif ($nominal < 200)
			return " seratus" . $this->terbilang($nominal - 100);
		elseif ($nominal < 1000)
			return $this->terbilang($nominal / 100) . " ratus" . $this->terbilang($nominal % 100);
		elseif ($nominal < 2000)
			return " seribu" . $this->terbilang($nominal - 1000);
		elseif ($nominal < 1000000)
			return $this->terbilang($nominal / 1000) . " ribu" . $this->terbilang($nominal % 1000);
		elseif ($nominal < 1000000000)
			return $this->terbilang($nominal/ 1000000) . " juta" . $this->terbilang($nominal % 1000000);
	}	
	public function angka_rupiah($number){
		$new_rupiah = "Rp. ".number_format($number, 0, ",", ".");
		return $new_rupiah;
	}
}