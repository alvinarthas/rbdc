<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_partai extends CI_Model{
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

	public function map_partai($id){
		$query = $this->db->query("SELECT nm_cagub,nm_cawagub,nm_partai,id_calon,id_partai from tbl_calon
        INNER JOIN tbl_map_partai ON tbl_calon.id=tbl_map_partai.id_calon
        INNER JOIN tbl_partai ON tbl_map_partai.id_partai=tbl_partai.id
        WHERE tbl_calon.id = $id");
		return $query->result_array();
	}

	public function map_partai_all(){
		$query = $this->db->query("SELECT nm_cagub,nm_cawagub,nm_partai,id_calon,id_partai from tbl_calon
        INNER JOIN tbl_map_partai ON tbl_calon.id=tbl_map_partai.id_calon
		INNER JOIN tbl_partai ON tbl_map_partai.id_partai=tbl_partai.id
		ORDER BY id_calon");
		return $query->result_array();
	}

	public function get_paslon(){
        $query = $this->db->get('tbl_calon');
        return $query->result_array();
	}
	
	public function get_partai(){
        $query = $this->db->get('tbl_partai');
        return $query->result_array();
	}
}