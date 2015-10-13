<?php
defined ('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('date');
		$this->load->model('dashboard_m', 'userdashboard');
		date_default_timezone_set("Asia/Jakarta");
		/*if($this->logged_in()){
		}
		else redirect('login','refresh');*/
	}
	public function index(){
		$datestring = '%m';
		$time = time();
		$bulan_ini = mdate($datestring, $time);
		
		$datestring = '%Y';
		$time = time();
		$tahun_ini = mdate($datestring, $time);
		
		
		$data["dash_kontrak"]=$this->userdashboard->select_kontrak_all($bulan_ini, $tahun_ini);
		$i=0;
		foreach($data["dash_kontrak"] as $row){
			$data["dash_kontrak"][$i]['tgl_berakhir_new']=$this->nama_bulan($row['tgl_berakhir']);
			$i++;
		}
		
		$data["dash_invoice"]=$this->userdashboard->select_invoice_all($bulan_ini, $tahun_ini);
		$i=0;
		foreach($data["dash_invoice"] as $row){
			$data["dash_invoice"][$i]['tgl_jatuh_tempo_new']=$this->nama_bulan($row['tgl_jatuh_tempo']);
			$i++;
		}
		$this->load->view('home_v', $data);
	}
	public function popup_detil_kontrak($id){
		$sewa_driver_bulanan = 1000000;
		
		$data["popup"] = $this->userdashboard->select_kontrak_popup($id);
		$i=0;
		foreach ($data["popup"] as $row){
			if ($row['nama_driver']!="") $data["popup"][$i]["harga_paket"] = ($row['sewa_bulanan'] + $sewa_driver_bulanan) * $row['periode_sewa']; 			
			else $data["popup"][$i]["harga_paket"] = $row['sewa_bulanan'] * $row['periode_sewa'];
			
			$data["popup"][$i]["harga_paket_new"] = $this->angka_rupiah($data["popup"][$i]["harga_paket"]);
			$i++;
		}
		$this->load->view('dashboard/kontrak_popup_dash_v', $data);
	}
	public function popup_detil_invoice($id){
		
		$data["popup"] = $this->userdashboard->select_invoice_popup($id);
		foreach($data["popup"] as $row){
			$data["tgl_mulai_new"] = $this->nama_bulan($row['tgl_mulai']);
			$data["tgl_berakhir_new"] = $this->nama_bulan($row['tgl_berakhir']);
			$data["total_harga_sewa_new"]=$this->angka_rupiah($row['total_harga_sewa']);
		}
		$this->load->view('dashboard/invoice_popup_dash_v', $data);
	}
	public function angka_rupiah($number){
		$new_rupiah = "Rp. ".number_format($number, 0, ",", ".");
		return $new_rupiah;
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
	
}