<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_visuara extends CI_Model{
	
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

	public function get_survey($id){
		$query = $this->db->get_where('ref_survey', array('id_kel' => $id));
		return $query->result();
	}
	public function get_row_survey($id){
		$query = $this->db->get_where('ref_survey', array('id_masy' => $id));
		return $query->row_array();
	}

	public function get_ya_survey_all($kel){
		$query = $this->db->query("SELECT COUNT(paslon_kenal) as ya FROM ref_survey WHERE id_kel=$kel AND paslon_kenal='Iya'");
		return $query->row();
	}

	public function get_tidak_survey_all($kel){
		$query = $this->db->query("SELECT COUNT(paslon_kenal) as tidak FROM ref_survey WHERE id_kel=$kel AND paslon_kenal='Tidak'");
		return $query->row();
	}
	
	public function get_tbl($id){
		$query = $this->db->query("SELECT * FROM ref_$id");
		return $query->result();
	}

	public function row_tbl($kat,$id){
		$query = $this->db->query("SELECT * FROM ref_$kat WHERE id=$id");
		return $query->row();
	}

	public function get_masy($kategori,$jenis2,$kel){
		$query = $this->db->query("SELECT id FROM ref_masy WHERE $kategori =$jenis2 AND kelurahan=$kel");
		return $query->result();
	}

	public function count_allmasy(){
		$query = $this->db->get('ref_masy');
		return $query->num_rows();
	}

	public function count_daerahmasy($daerah,$id){
		$query = $this->db->get_where('ref_masy', array($daerah => $id));
		return $query->num_rows();
	}

	public function count_katmasy($kategori,$jenis2,$daerah,$id){
		$query = $this->db->query("SELECT COUNT(id) as total FROM ref_masy WHERE $kategori=$jenis2 AND $daerah=$id");
		return $query->row();
	}
}