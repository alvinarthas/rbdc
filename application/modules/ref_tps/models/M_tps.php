<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_tps extends CI_Model{
	
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
      $query = $this->db->query("SELECT ref_tps.id,ref_tps.tps as tps,ref_tps.dpt as dpt,kabupaten,kecamatan,kelurahan,ref_kelurahan.id as id_kel FROM ref_tps
      INNER JOIN ref_kelurahan ON ref_tps.id_kel = ref_kelurahan.id
      INNER JOIN ref_kecamatan ON ref_kelurahan.id_kec = ref_kecamatan.id
      INNER JOIN ref_kabupaten ON ref_kecamatan.id_kab= ref_kabupaten.id
      WHERE ref_tps.id = $id");
      return $query->row();
    }

}