<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrak_m extends CI_Model{
	function __construct(){
		parent::__construct();
		
	}
	function select_kontrak_all(){
		$sql = "SELECT kt.*, pg.*
			FROM kontrak kt
			LEFT JOIN m_pelanggan pg
			ON kt.id_pelanggan = pg.id_pelanggan
		";
        $query = $this->db->query($sql);
		$result_array = $query->result_array();
		return $result_array;
	}
	function select_pg(){
		$query = $this->db->get('m_pelanggan');//namatabel
		$result_array = $query->result_array();
		return $result_array;
	}
	function select_mb(){
		$query = $this->db->get('m_mobil');
		$result_array = $query->result_array();
		return $result_array;
	}
	function select_drv(){
		$query = $this->db->get('m_driver');
		$result_array = $query->result_array();
		return $result_array;
	}
	function cek_jum_kontrak(){
		$query = $this->db->get('kontrak');
		$jum = $query->num_rows();
		return $jum;
	}
	function cek_jum_temp($data){
		$query = $this->db->get_where('temp_det_kontrak', array('id_kontrak' => $data));
		$jum = $query->num_rows();
		return $jum;
	}
	function select_temp($data){
		$sql = "SELECT tdk.*, mb.*, drv.*
			FROM temp_det_kontrak tdk
			LEFT JOIN m_mobil mb
			ON tdk.id_mobil = mb.id_mobil
			LEFT JOIN m_driver drv
			ON tdk.id_driver = drv.id_driver
			WHERE tdk.id_kontrak = ".$data."
		";
        $query = $this->db->query($sql);
		$result_array = $query->result_array();
		return $result_array;
	}
	function insert_temp($data){
		$this->db->insert('temp_det_kontrak', $data); 
	}
	function insert_det_kontrak($data){
		$this->db->insert('detil_kontrak', $data); 
	}
	function insert_kontrak($data){
		$this->db->insert('kontrak', $data); 
	}

	function select_detil_pg($id){
		$query = $this->db->get_where('m_pelanggan', array('id_pelanggan' => $id));
		$result_array = $query->result_array();
		
		return $result_array;
	}
	function delete_temp($id){
		$this->db->where('id_kontrak', $id);
        return $this->db->delete('temp_det_kontrak');
    }
	function select_detil_temp($id) {
		$query = $this->db->get_where('temp_det_kontrak', array('id_temp_det_kontrak' => $id));
       	$result_array = $query->result_array();
		
		return $result_array;
    }
	function delete_temp_trans($id) {
		$this->db->where('id_temp_det_kontrak', $id);
        return $this->db->delete('temp_det_kontrak');
    }
	function select_kontrak_popup($id) {
		$sql = "SELECT dk.*, mb.*, drv.*,k.*
			FROM detil_kontrak dk
			LEFT JOIN m_mobil mb
			ON dk.id_mobil = mb.id_mobil
			LEFT JOIN m_driver drv
			ON dk.id_driver = drv.id_driver
			LEFT JOIN kontrak k
			ON dk.id_kontrak = k.id_kontrak
			WHERE dk.id_kontrak = ".$id."
		";
        $query = $this->db->query($sql);
       	$result_array = $query->result_array();
		return $result_array;
    }
	function status_submit_up($id, $data) {
        $this->db->where('id_kontrak', $id);
        return $this->db->update('kontrak', $data);
    }
	function select_kontrak_status($id){
		$sql = "SELECT kt.*, pg.*
			FROM kontrak kt
			LEFT JOIN m_pelanggan pg
			ON kt.id_pelanggan = pg.id_pelanggan
			WHERE kt.id_kontrak = ".$id."
		";
        $query = $this->db->query($sql);
		$result_array = $query->result_array();
		return $result_array;
	}
	
}