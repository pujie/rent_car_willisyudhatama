<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil_m extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
	}
	function select_all(){
		$query = $this->db->get('m_mobil');//namatabel
		$result_array = $query->result_array();
		
		return $result_array;
	}
	function insert_mb($data){
		$this->db->insert('m_mobil', $data);
	}
	function select_detil_mb($id){
		$query = $this->db->get_where('m_mobil', array('id_mobil' => $id));
		$result_array = $query->result_array();
		
		return $result_array;
	}
	function update_mb($id, $data) {
        $this->db->where('id_mobil', $id);
        return $this->db->update('m_mobil', $data);
    }
	function delete_mb($id) {
        $this->db->where('id_mobil', $id);
        return $this->db->delete('m_mobil');
    }
	
}