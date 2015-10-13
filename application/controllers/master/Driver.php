<?php
defined ('BASEPATH') OR exit('No direct script access allowed');
class Driver extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('master/driver_m', 'dt_driver');
		/*if($this->logged_in()){
		}
		else redirect('login','refresh');*/
	}
	public function index(){
		$data['list_driver'] = $this->dt_driver->select_all();
		$this->load->view('master/driver_v', $data);
	}
	public function tambah_data(){
		$this->load->library('form_validation');
		//$this->form_validation->set_message('required', '%s Harus diisi !');//%s mewakili human name
		$this->form_validation->set_message('required', ' ');
		$this->form_validation->set_rules('nama', 'Nama', 'required');//human name urutan kedua
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');//urutan pertama adalah name input dari form
		$this->form_validation->set_rules('no_telp', 'No Telp', 'required');
		
		if ($this->form_validation->run()==FALSE){
			$data['status_form']='add';
			$this->load->view('master/driver_form_v', $data);
		}
		else {
			$data_formdrv['nama'] = $this->input->post('nama');
			$data_formdrv['alamat'] = $this->input->post('alamat');
			$data_formdrv['no_telp'] = $this->input->post('no_telp');
			
			$this->dt_driver->insert_drv($data_formdrv);
			$this->session->set_flashdata('pesan', 'Anda telah berhasil menambahkan driver bernama <b>'.$data_formdrv['nama'].'</b>');
			redirect(base_url().'master/driver');
		}
		
	}
	public function edit_data($id){
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', ' ');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'required');
		
		if ($this->form_validation->run()==FALSE){
			$data['list_driver'] = $this->dt_driver->select_detil_drv($id);
			$data['status_form']='edit';
			$this->load->view('master/driver_form_v', $data);
		}
		else {
			$data_formdrv['nama_driver'] = $this->input->post('nama');
			$data_formdrv['alamat'] = $this->input->post('alamat');
			$data_formdrv['no_telp_driver'] = $this->input->post('no_telp');
			
			$this->dt_driver->update_drv($id, $data_formdrv);
			$this->session->set_flashdata('pesan', 'Anda telah berhasil mengubah detil data driver yang bernama <b>'.$data_formdrv['nama'].'</b>');
			redirect(base_url().'master/driver');
		}
	}
	public function hapus_data($id){	
		$this->dt_driver->delete_drv($id);
		$this->session->set_flashdata('pesan', 'Anda telah berhasil menghapus data.');
		redirect(base_url().'master/driver');
	}
}