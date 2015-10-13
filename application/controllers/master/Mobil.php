<?php
defined ('BASEPATH') OR exit('No direct script access allowed');
class Mobil extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('master/mobil_m', 'dt_mobil');
		/*if($this->logged_in()){
		}
		else redirect('login','refresh');*/
	}
	public function index(){
		$data['list_mobil'] = $this->dt_mobil->select_all();
		$i=0;
		foreach ($data["list_mobil"] as $row){
			$data["list_mobil"][$i]["sewa_bulanan_new"] = $this->angka_rupiah($data["list_mobil"][$i]["sewa_bulanan"]);
			$i++;
		}
		$this->load->view('master/mobil_v', $data);
	}
	public function tambah_data(){
		$this->load->library('form_validation');
		//$this->form_validation->set_message('required', '%s Harus diisi !');//%s mewakili human name
		$this->form_validation->set_message('required', ' ');
		$this->form_validation->set_rules('merk', 'Merk', 'required');//human name urutan kedua
		$this->form_validation->set_rules('jenis', 'Jenis', 'required');//urutan pertama adalah name input dari form
		$this->form_validation->set_rules('tipe', 'Tipe', 'required');
		$this->form_validation->set_rules('no_pol', 'No Polisi', 'required');
		$this->form_validation->set_rules('tahun_keluaran', 'Tahun Keluaran', 'required');
		$this->form_validation->set_rules('warna', 'warna', 'required');
		$this->form_validation->set_rules('sewa_bulanan', 'Sewa Bulanan', 'required');
		
		if ($this->form_validation->run()==FALSE){
			$data['status_form']='add';
			$this->load->view('master/mobil_form_v', $data);
		}
		else {
			$data_formmb['merk'] = $this->input->post('merk');
			$data_formmb['jenis'] = $this->input->post('jenis');
			$data_formmb['tipe'] = $this->input->post('tipe');
			$data_formmb['no_pol'] = $this->input->post('no_pol');
			$data_formmb['tahun_keluaran'] = $this->input->post('tahun_keluaran');
			$data_formmb['warna'] = $this->input->post('warna');
			$data_formmb['sewa_bulanan'] = $this->input->post('sewa_bulanan');
			
			$this->dt_mobil->insert_mb($data_formmb);
			$this->session->set_flashdata('pesan', 'Anda telah berhasil menambahkan mobil merk <b>'.$data_formmb['nama'].'</b>');
			redirect(base_url().'master/mobil');
		}
		
	}
	public function edit_data($id){
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', ' ');
		$this->form_validation->set_rules('merk', 'Merk', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'required');
		$this->form_validation->set_rules('no_pol', 'No Polisi', 'required');
		$this->form_validation->set_rules('tahun_keluaran', 'Tahun Keluaran', 'required');
		$this->form_validation->set_rules('warna', 'warna', 'required');
		$this->form_validation->set_rules('sewa_bulanan', 'Sewa Bulanan', 'required');
		
		if ($this->form_validation->run()==FALSE){
			$data['list_mobil'] = $this->dt_mobil->select_detil_mb($id);
			$data['status_form']='edit';
			$this->load->view('master/mobil_form_v', $data);
		}
		else {
			$data_formmb['merk'] = $this->input->post('merk');
			$data_formmb['jenis'] = $this->input->post('jenis');
			$data_formmb['tipe'] = $this->input->post('tipe');
			$data_formmb['no_pol'] = $this->input->post('no_pol');
			$data_formmb['tahun_keluaran'] = $this->input->post('tahun_keluaran');
			$data_formmb['warna'] = $this->input->post('warna');
			$data_formmb['sewa_bulanan'] = $this->input->post('sewa_bulanan');
			
			$this->dt_mobil->update_mb($id, $data_formmb);
			$this->session->set_flashdata('pesan', 'Anda telah berhasil mengubah detil data mobil merk <b>'.$data_formmb['nama'].'</b>');
			redirect(base_url().'master/mobil');
		}
	}
	public function hapus_data($id){	
		$this->dt_mobil->delete_mb($id);
		$this->session->set_flashdata('pesan', 'Anda telah berhasil menghapus data.');
		redirect(base_url().'master/mobil');
	}
	public function angka_rupiah($number){
		$new_rupiah = "Rp. ".number_format($number, 0, ",", ".");
		return $new_rupiah;
	}
}