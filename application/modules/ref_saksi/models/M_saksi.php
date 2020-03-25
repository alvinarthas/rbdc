<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_saksi extends CI_Model{
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

	public function get_nama($nama){
		$query = $this->db->query("SELECT * FROM ref_masy WHERE nama_lengkap like '$nama%' LIMIT 5");
		return $query->result();
	}

	public function get_namabyid($nama,$id){
		$query = $this->db->query("SELECT * FROM ref_masy WHERE nama_lengkap like '$nama%' AND id_user=$id LIMIT 5");
		return $query->result();
	}
	
	public function get_masy($id){
		$query = $this->db->query("SELECT * FROM ref_saksi INNER JOIN ref_masy on ref_masy.id=ref_saksi.id_masy WHERE ref_saksi.id=$id");
		return $query->row_array();
	}

	public function get_calon(){
		$query = $this->db->get('ref_calon');
		return $query->result();
	}

	public function get_survey(){
		$query = $this->db->query("SELECT id_masy,q1,q2,q3,q4,q5,nama_lengkap,ktp,alamat FROM ref_survey
		INNER JOIN ref_masy ON ref_survey.id_masy=ref_masy.id");
		return $query->result();
	}

}