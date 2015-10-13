<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_m extends CI_Model{
	function __construct(){
		parent::__construct();
		
	}
	function select_invoice_all(){
		$sql = "SELECT inv.*, kt.*, pg.*
			FROM invoice inv
			LEFT JOIN kontrak kt
			ON inv.id_kontrak = kt.id_kontrak
			LEFT JOIN m_pelanggan pg
			ON kt.id_pelanggan = pg.id_pelanggan
		";
        $query = $this->db->query($sql);
		$result_array = $query->result_array();
		return $result_array;
	}
	function select_kt(){
		$query = $this->db->get('kontrak');
		$result_array = $query->result_array();
		return $result_array;
	}
	
	function insert_invoice($data){
		$this->db->insert('invoice', $data); 
	}
	function select_det_invoice($id){
		$sql = "SELECT det.*, inv.*, kt.*, pg.*, mb.*, drv.*
			FROM detil_kontrak det
			LEFT JOIN kontrak kt
			ON det.id_kontrak = kt.id_kontrak
			LEFT JOIN m_pelanggan pg
			ON kt.id_pelanggan = pg.id_pelanggan
			LEFT JOIN m_mobil mb
			ON det.id_mobil = mb.id_mobil
			LEFT JOIN m_driver drv
			ON det.id_driver = drv.id_driver
			LEFT JOIN invoice inv
			ON inv.id_kontrak = kt.id_kontrak
			WHERE inv.id_invoice = ".$id."
		";
        $query = $this->db->query($sql);
		$result_array = $query->result_array();
		return $result_array;
	}
	function pembayaran_submit_up($id, $data) {
        $this->db->where('id_invoice', $id);
        return $this->db->update('invoice', $data);
    }
}