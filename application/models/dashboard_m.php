<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_m extends CI_Model{
	function __construct(){
		parent::__construct();
		
	}
	function select_kontrak_all($bulan,$tahun){
		$sql = "SELECT kt.*, pg.*
			FROM kontrak kt
			LEFT JOIN m_pelanggan pg
			ON kt.id_pelanggan = pg.id_pelanggan
			WHERE MONTH(kt.tgl_berakhir)=".$bulan."
			AND YEAR(kt.tgl_berakhir)=".$tahun."
			LIMIT 5
		";
        $query = $this->db->query($sql);
		$result_array = $query->result_array();
		return $result_array;
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
	function select_invoice_all($bulan,$tahun){
		$sql = "SELECT inv.*, kt.*, pg.*
			FROM invoice inv
			LEFT JOIN kontrak kt
			ON inv.id_kontrak = kt.id_kontrak
			LEFT JOIN m_pelanggan pg
			ON kt.id_pelanggan = pg.id_pelanggan
			WHERE MONTH(inv.tgl_jatuh_tempo)=".$bulan."
			AND YEAR(inv.tgl_jatuh_tempo)=".$tahun."
			LIMIT 5
		";
        $query = $this->db->query($sql);
		$result_array = $query->result_array();
		return $result_array;
	}
	function select_invoice_popup($id){
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
}