<?php
defined ('BASEPATH') OR exit('No direct script access allowed');
class Kontrak extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->model('transaksi/kontrak_m', 'dt_kontrak');
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index(){
		$data["hari_ini"] = $this->hari_ini();
		$data["list_kontrak"]=$this->dt_kontrak->select_kontrak_all();
		$i=0;
		foreach($data["list_kontrak"] as $row){
			$data["list_kontrak"][$i]['tgl_mulai_new']=$this->nama_bulan($row['tgl_mulai']);
			$data["list_kontrak"][$i]['tgl_berakhir_new']=$this->nama_bulan($row['tgl_berakhir']);
			$data["list_kontrak"][$i]['total_harga_sewa_new']=$this->angka_rupiah($row['total_harga_sewa']);
			$i++;
		}
		$this->load->view('transaksi/kontrak_v', $data);
	}
	public function tambah_data(){
		$data["pelanggan"]=$this->dt_kontrak->select_pg();
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', ' ');
		$this->form_validation->set_rules('no_kontrak', 'No Kontrak', 'required');//human name urutan kedua
		$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');//urutan pertama adalah name input dari form
		$this->form_validation->set_rules('periode_sewa', 'Periode Sewa', 'required');
		$this->form_validation->set_rules('pelanggan', 'Pelanggan', 'required');
		if ($this->form_validation->run()==FALSE){
			$data['select_pelanggan'] = $this->input->post('pelanggan');
			$this->load->view('transaksi/no_kontrak_v', $data);
		}
		else {
			$data["jum_row"]=$this->dt_kontrak->cek_jum_kontrak();
			if ($data['jum_row']==0) $id_kontrak = 1;
			else $id_kontrak = $data['jum_row'] + 1;
			$dtkon = array(
			   'no_kontrak' => $this->input->post('no_kontrak'),
			   'tgl_mulai' => $this->input->post('tgl_mulai'),
			   'periode_sewa' => $this->input->post('periode_sewa'),
			   'id_kontrak' => $id_kontrak,
			   'pelanggan' => $this->input->post('pelanggan'),
			   'gaji_driver_bulanan' => 1000000
		 	);
			$this->session->set_userdata($dtkon);
			$this->dt_kontrak->delete_temp($this->session->userdata('id_kontrak'));
			redirect(base_url().'transaksi/kontrak/tambah_data_full');
		}
	}
	public function hari_ini(){
		$datestring = '%Y-%m-%d';
		$time = time();
		$tanggal = mdate($datestring, $time);
		return $tanggal;
	}
	public function tambah_data_full(){
		if ($this->session->userdata("id_kontrak")==NULL){
			redirect(base_url().'transaksi/kontrak/tambah_data');
		}
		else {
			$this->load->library('form_validation');
			$this->form_validation->set_message('required', ' ');
			$this->form_validation->set_rules('mobil', 'Mobil', 'required');
			if ($this->form_validation->run()==FALSE){
				
				/* START DATA SESSION KONTRAK */
				$id_pelanggan = $this->session->userdata("pelanggan");
				$data["det_pelanggan"]=$this->dt_kontrak->select_detil_pg($id_pelanggan);
				
				$tgl_mulai = $this->session->userdata("pelanggan");
				$periode = $this->session->userdata("periode_sewa");
				$data["tgl_berakhir"] = $this->tgl_berakhir($tgl_mulai, $periode);
				
				$this->session->set_userdata('tgl_berakhir', $data['tgl_berakhir']);
				$data["tgl_berakhir_new"]= $this->nama_bulan($this->session->userdata('tgl_berakhir'));
				$data["tgl_mulai_new"]= $this->nama_bulan($this->session->userdata('tgl_mulai'));
				/* END DATA SESSION KONTRAK */
				
				$data["mobil"] = $this->dt_kontrak->select_mb();
				$data["driver"] = $this->dt_kontrak->select_drv();
				
				$id_kontrak = $this->session->userdata("id_kontrak");
				$data["jum_temp"] = $this->dt_kontrak->cek_jum_temp($id_kontrak);
				$data["temp"] = $this->dt_kontrak->select_temp($id_kontrak);
				
				/* start menghitung total paket per rew item*/
				
				$i=0;
				foreach ($data["temp"] as $row){
					if ($row['nama_driver']!="") $data["temp"][$i]["harga_paket"] = ($row['sewa_bulanan'] + $this->session->userdata('gaji_driver_bulanan')) * $this->session->userdata('periode_sewa'); 			
					else $data["temp"][$i]["harga_paket"] = $row['sewa_bulanan'] * $this->session->userdata('periode_sewa');
					$data['total_harga_paket'][]=$data["temp"][$i]["harga_paket"];
					
					$data["temp"][$i]["harga_paket_new"] = $this->angka_rupiah($data["temp"][$i]["harga_paket"]);
					$i++;
				}
				if (isset($data['total_harga_paket'])) {
					$data['total_sum_sewa'] = array_sum($data['total_harga_paket']);
					$this->session->set_userdata('total_sum_sewa_new',$this->angka_rupiah($data['total_sum_sewa']));
					$this->session->set_userdata('total_sum_sewa', $data['total_sum_sewa']);
				}
				/* end menghitung total paket per rew item */
				
				$data['select_mobil'] = $this->input->post('mobil');
				$data['select_driver'] = $this->input->post('driver');
				$this->load->view('transaksi/kontrak_formfull_v.php', $data);
			}
			else {
				$data_form_temp['id_kontrak'] = $this->session->userdata("id_kontrak");
				$data_form_temp['id_mobil'] = $this->input->post('mobil');
				$data_form_temp['id_driver'] = $this->input->post('driver');
				
				$this->dt_kontrak->insert_temp($data_form_temp);
				$id_mb = $this->input->post('mobil');
				$id_drv = $this->input->post('driver');
				
				redirect(base_url().'transaksi/kontrak/tambah_data_full');
			}
		}
	}
	public function tgl_berakhir($tgl_mulai, $periode){
		$jum = $periode * 30; 
		$date=date_create($this->session->userdata('tgl_mulai'));
		date_modify($date,"+ ".$jum." days");
		$tgl_berakhir = date_format($date,"Y-m-d");
		return $tgl_berakhir;
	}
	public function proses_kontrak(){
		$id_kontrak = $this->session->userdata("id_kontrak");		
		$temp = $this->dt_kontrak->select_temp($id_kontrak);
		foreach ($temp as $row){
			$data_move = "";
			$data_move["id_kontrak"] = $row["id_kontrak"];
			$data_move["id_mobil"] = $row["id_mobil"];
			if ($row["id_driver"]==NULL) $id_driver = 0;
			else $id_driver = $row["id_driver"];
			$data_move["id_driver"] = $id_driver;
			$this->dt_kontrak->insert_det_kontrak($data_move);
			
		}
		$data_in_kontrak["no_kontrak"] = $this->session->userdata('no_kontrak');
		$this->input_kontrak();
		$this->dt_kontrak->delete_temp($id_kontrak);
		$this->unset_ses_kontrak();
		
		$this->session->set_flashdata('pesan', 'Anda telah berhasil menambahkan kontrak dengan nomor <b>'.$data_in_kontrak["no_kontrak"].'</b>');
		redirect(base_url().'transaksi/kontrak/');
	}
	public function input_kontrak(){
		$data_in_kontrak["id_kontrak"] = $this->session->userdata('id_kontrak');
		$data_in_kontrak["no_kontrak"] = $this->session->userdata('no_kontrak');
		$data_in_kontrak["tgl_mulai"] = $this->session->userdata('tgl_mulai');
		$data_in_kontrak["tgl_mulai"] = $this->session->userdata('tgl_mulai');
		$data_in_kontrak["periode_sewa"] = $this->session->userdata('periode_sewa');
		$data_in_kontrak["id_pelanggan"] = $this->session->userdata('pelanggan');
		$data_in_kontrak["tgl_berakhir"] = $this->session->userdata('tgl_berakhir');
		$data_in_kontrak["total_harga_sewa"] = $this->session->userdata('total_sum_sewa');
		$this->dt_kontrak->insert_kontrak($data_in_kontrak);
	}
	public function batal_kontrak(){
		
		$id_kontrak = $this->session->userdata("id_kontrak");
		$this->dt_kontrak->delete_temp($id_kontrak);
		$this->unset_ses_kontrak();
		
		redirect(base_url().'transaksi/kontrak/');
	}
	public function unset_ses_kontrak(){
		$this->session->unset_userdata('no_kontrak');
		$this->session->unset_userdata('tgl_mulai');
		$this->session->unset_userdata('periode_sewa');
		$this->session->unset_userdata('id_kontrak');
		$this->session->unset_userdata('pelanggan');
		$this->session->unset_userdata('total_harga');
		$this->session->unset_userdata('tgl_berakhir');
	}
	public function delete_temp_trans($id){	
		$this->dt_kontrak->delete_temp_trans($id);
		redirect(base_url().'transaksi/kontrak/tambah_data_full');
	}
	public function popup_detil_kontrak($id){
		$data["popup"] = $this->dt_kontrak->select_kontrak_popup($id);
		$this->load->view('transaksi/kontrak_popup_v', $data);
	}
	public function popup_detil_cancel($id){
		$data["popup"] = $this->dt_kontrak->select_kontrak_popup($id);
		$this->load->view('transaksi/kontrak_popup_cancel_v', $data);
	}
	public function status_update($id){
		$data["list_kontrak"]=$this->dt_kontrak->select_kontrak_status($id);
		$this->load->view('transaksi/kontrak_update_v', $data);
	}
	public function status_submit_update($id){
		$data_status["cancel"] = $this->input->post('cancel');
		$data_status["keterangan_cancel"] = $this->input->post('keterangan_cancel');
		$this->dt_kontrak->status_submit_up($id, $data_status);
		
		$this->session->set_flashdata('pesan', 'Anda telah berhasil membatalkan kontrak');
		redirect(base_url().'transaksi/kontrak/');
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
	public function angka_rupiah($number){
		$new_rupiah = "Rp. ".number_format($number, 0, ",", ".");
		return $new_rupiah;
	}
	
}