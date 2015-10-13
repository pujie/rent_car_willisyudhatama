<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver_m extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
	}
	function select_all(){
		$query = $this->db->get('m_driver');//namatabel
		$result_array = $query->result_array();
		
		return $result_array;
	}
	function insert_drv($data){
		$this->db->insert('m_driver', $data);
	}
	function select_detil_drv($id){
		$query = $this->db->get_where('m_driver', array('id_driver' => $id));
		$result_array = $query->result_array();
		
		return $result_array;
	}
	function update_drv($id, $data) {
        $this->db->where('id_driver', $id);
        return $this->db->update('m_driver', $data);
    }
	function delete_drv($id) {
        $this->db->where('id_driver', $id);
        return $this->db->delete('m_driver');
    }
	
}