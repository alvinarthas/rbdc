<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_surdet extends CI_Model{
	
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

	public function get_survey($id){
		$query = $this->db->get_where('ref_survey', array('id_kel' => $id));
		return $query->result();
	}

	public function get_dpttps($id){
		$query = $this->db->query("SELECT sum(dpt) as jml_dpt, count(tps) as jml_tps FROM ref_tps where id_kel=$id");
		return $query;
	}
}