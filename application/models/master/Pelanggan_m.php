<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_m extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
	}
	function select_all(){
		$query = $this->db->get('m_pelanggan');//namatabel
		$result_array = $query->result_array();
		
		return $result_array;
	}
	function insert_pg($data){
		$this->db->insert('m_pelanggan', $data);
	}
	function select_detil_pg($id){
		$query = $this->db->get_where('m_pelanggan', array('id_pelanggan' => $id));
		$result_array = $query->result_array();
		
		return $result_array;
	}
	function update_pg($id, $data) {
        $this->db->where('id_pelanggan', $id);
        return $this->db->update('m_pelanggan', $data);
    }
	function delete_pg($id) {
        $this->db->where('id_pelanggan', $id);
        return $this->db->delete('m_pelanggan');
    }
	
}