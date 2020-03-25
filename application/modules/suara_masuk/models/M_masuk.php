<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_masuk extends CI_Model{
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    public function get_kab_all(){
      $query = $this->db->get('ref_kabupaten');
      return $query->result();
    }
    
    public function get_tps($id){
      $query = $this->db->get_where('ref_tps',array('id_kel' => $id));
      return $query->result();
    }

    public function get_tpss($id){
      $query = $this->db->get_where('ref_tps',array('id' => $id));
      return $query->row();
    }

    public function cek_tpss($id){
      $query = $this->db->get_where('ref_tps',array('id' => $id));
      return $query->num_rows();
    }

    public function cek_suara($id){
      $query = $this->db->query("SELECT ref_tps.id,dpt,calon1,calon2,calon3,calon4,suara_sah,suara_tdk,suara_ttl FROM suara_masuk
      INNER JOIN ref_tps ON ref_tps.id = suara_masuk.id_tps
      WHERE id_tps =$id");
      return $query->num_rows();
    }

    public function get_suara($id){
      $query = $this->db->query("SELECT ref_tps.id,dpt,calon1,calon2,calon3,calon4,suara_sah,suara_tdk,suara_ttl FROM suara_masuk
      INNER JOIN ref_tps ON ref_tps.id = suara_masuk.id_tps
      WHERE id_tps =$id");
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