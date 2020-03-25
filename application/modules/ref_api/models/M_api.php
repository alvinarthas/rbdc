<?php
class M_api extends CI_Model{
	
	function __construct(){
        parent::__construct();
    }

    public function get_calon(){
        $query = $this->db->get('tbl_calon');
        return $query->result_array();
    }

    public function get_partai($id){
		$query = $this->db->query("SELECT nm_partai,tbl_partai.gambar from tbl_calon
        INNER JOIN tbl_map_partai ON tbl_calon.id=tbl_map_partai.id_calon
        INNER JOIN tbl_partai ON tbl_map_partai.id_partai=tbl_partai.id
        WHERE tbl_calon.id = $id");
		return $query->result_array();
    }
    
    public function get_polling($id){
		$query = $this->db->query("SELECT nm_cagub,nm_cawagub,count(id_calon) as total FROM tbl_polling
        INNER JOIN tbl_calon ON tbl_polling.id_calon=tbl_calon.id
        WHERE id_calon=$id");
		return $query->result_array();
    }

    public function cek_address($ip){
		$query = $this->db->query("SELECT * FROM tbl_polling WHERE ip_address = '$ip'");
		return $query->num_rows();
    }

    public function map_partai($id){
		$query = $this->db->query("SELECT nm_cagub,nm_cawagub,nm_partai,id_calon,id_partai from tbl_calon
        INNER JOIN tbl_map_partai ON tbl_calon.id=tbl_map_partai.id_calon
        INNER JOIN tbl_partai ON tbl_map_partai.id_partai=tbl_partai.id
        WHERE tbl_calon.id = $id");
		return $query->result_array();
    }
}