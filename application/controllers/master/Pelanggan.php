<?php
defined ('BASEPATH') OR exit('No direct script access allowed');
class Pelanggan extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('master/pelanggan_m', 'dt_pelanggan');
		/*if($this->logged_in()){
		}
		else redirect('login','refresh');*/
	}
	public function index(){
		$data['list_pelanggan'] = $this->dt_pelanggan->select_all();
		$this->load->view('master/pelanggan_v', $data);
	}
	public function tambah_data(){
		$this->load->library('form_validation');
		//$this->form_validation->set_message('required', '%s Harus diisi !');//%s mewakili human name
		$this->form_validation->set_message('required', ' ');
		$this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');//human name urutan kedua
		$this->form_validation->set_rules('penanggung_jwb', 'Penanggung Jawab', 'required');//urutan pertama adalah name input dari form
		$this->form_validation->set_rules('no_telp', 'No Telp', 'required');
		$this->form_validation->set_rules('kota', 'Kota', 'required');
		
		if ($this->form_validation->run()==FALSE){
			$data['status_form']='add';
			$this->load->view('master/pelanggan_form_v', $data);
		}
		else {
			$data_formpg['perusahaan'] = $this->input->post('perusahaan');
			$data_formpg['penanggung_jwb'] = $this->input->post('penanggung_jwb');
			$data_formpg['no_telp'] = $this->input->post('no_telp');
			$data_formpg['kota'] = $this->input->post('kota');
			
			$this->dt_pelanggan->insert_pg($data_formpg);
			$this->session->set_flashdata('pesan', 'Anda telah berhasil menambahkan pelanggan <b>'.$data_formpg['perusahaan'].'</b>');
			redirect(base_url().'master/pelanggan');
		}
		
	}
	public function edit_data($id){
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', ' ');
		$this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');
		$this->form_validation->set_rules('penanggung_jwb', 'Penanggung Jawab', 'required');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'required');
		$this->form_validation->set_rules('kota', 'Kota', 'required');
		
		if ($this->form_validation->run()==FALSE){
			$data['list_pelanggan'] = $this->dt_pelanggan->select_detil_pg($id);
			$data['status_form']='edit';
			$this->load->view('master/pelanggan_form_v', $data);
		}
		else {
			$data_formpg['perusahaan'] = $this->input->post('perusahaan');
			$data_formpg['penanggung_jwb'] = $this->input->post('penanggung_jwb');
			$data_formpg['no_telp'] = $this->input->post('no_telp');
			$data_formpg['kota'] = $this->input->post('kota');
			
			$this->dt_pelanggan->update_pg($id, $data_formpg);
			$this->session->set_flashdata('pesan', 'Anda telah berhasil mengubah detil data pelanggan <b>'.$data_formpg['perusahaan'].'</b>');
			redirect(base_url().'master/pelanggan');
		}
	}
	public function hapus_data($id){	
		$this->dt_pelanggan->delete_pg($id);
		$this->session->set_flashdata('pesan', 'Anda telah berhasil menghapus data.');
		redirect(base_url().'master/pelanggan');
	}
}