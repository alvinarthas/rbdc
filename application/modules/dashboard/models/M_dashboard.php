<?php
class M_dashboard extends CI_Model{
	
	function __construct(){
        parent::__construct();
    }

    public function get_unit(){
        $query = $this->db->query("SELECT * from ref_unit order by id_unit"); 
        return $query;
    }

    public function get_retribusi($id){
        $query = $this->db->query("SELECT * from jenis_retribusi where Nm_Unit='$id' order by id"); 
        return $query;
    }

    public function all_retribusi(){
        $query = $this->db->query("SELECT * from jenis_retribusi order by id"); 
        return $query;
    }
}