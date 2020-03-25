<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_info extends CI_Model{
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
	}
	
	public function get_kab($id){
		$query = $this->db->get_where('ref_kabupaten', array('id' => $id));
		return $query->result();
	}
	public function get_kab_all(){
		$query = $this->db->get('ref_kabupaten');
		return $query->result();
	}
	public function get_kec_all(){
		$query = $this->db->get('ref_kecamatan');
		return $query->result();
	}
	public function get_kec($id){
		$query = $this->db->get_where('ref_kecamatan', array('id_kab' => $id));
		return $query->result();
	}
	public function get_kec_id($id){
		$query = $this->db->get_where('ref_kecamatan', array('id' => $id));
		return $query->result();
	}
	public function get_kel_all(){
		$query = $this->db->get('ref_kelurahan');
		return $query->result();
	}

	public function get_kel($id){
		$query = $this->db->get_where('ref_kelurahan', array('id_kec' => $id));
		return $query->result();
	}

	public function get_kel_id($id){
		$query = $this->db->get_where('ref_kelurahan', array('id' => $id));
		return $query->result();
	}

	public function get_tps($id){
		$query = $this->db->get_where('ref_tps', array('id_kel' => $id));
		return $query->result();
	}

	public function get_suara($id){
		$query = $this->db->get_where('suara_masuk', array('id_tps' => $id));
		return $query->row();
	}

	public function count_suara(){
		$query = $this->db->query("SELECT COUNT(id) as total from suara_masuk");
		return $query->row();
	}

	public function sum_tps(){
		$query = $this->db->query("SELECT SUM(tps) as tps from ref_kelurahan");
		return $query->row();
	}
}