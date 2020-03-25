<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_survey extends CI_Model{
	
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

	public function get_calon(){
		$query = $this->db->get('ref_calon');
		return $query->result();
	}

	public function get_survey(){
		$query = $this->db->query("SELECT id_masy,q1,q2,q3,q4,q5,nama_lengkap,ktp,alamat FROM ref_survey
		INNER JOIN ref_masy ON ref_survey.id_masy=ref_masy.id");
		return $query->result();
	}

	public function get_masy($id){
		$query = $this->db->query("SELECT kelurahan FROM ref_masy WHERE id=$id");
		return $query->row();
	}

	public function check_survey($id){
		$query = $this->db->query("SELECT * FROM ref_survey WHERE id_masy=$id");
		return $query->num_rows();
	}

	public function get_tokoh(){
		$query = $this->db->get('ref_tokohpgrh');
		return $query->result();
	}

}