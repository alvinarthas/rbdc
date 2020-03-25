<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_masy extends CI_Model{
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

	public function get_tps($tps){
		$query = $this->db->query("SELECT * FROM ref_tps WHERE tps like '$tps%' LIMIT 5");
		return $query->result();
	}

	public function profil(){
		$query = $this->db->get('ref_profil');
		return $query->result();
	}

	public function get_kab(){
		$query = $this->db->get('ref_kabupaten');
		return $query->result_array();
	}

	public function get_pekerjaan(){
		$query = $this->db->get('ref_pekerjaan');
		return $query->result_array();
	}
	public function get_penghasilan(){
		$query = $this->db->get('ref_penghasilan');
		return $query->result_array();
	}
	public function get_umur(){
		$query = $this->db->get('ref_umur');
		return $query->result_array();
	}
	public function get_pendidikan(){
		$query = $this->db->get('ref_pendidikan');
		return $query->result_array();
	}
	public function get_profil(){
		$query = $this->db->get('profil_masy');
		return $query->result_array();
	}

	public function get_all($where = NULL){
    	if(isset($where) or $where!=NULL){
      	$this->db->where($where);
    	}
   		$query = $this->db->get('ref_masy');
    	if($query->num_rows()>0){
    		if(isset($where) or $where!=NULL){
      			return $query->row();
    		}else{
      			return $query->result();    		
    		}
    	}
    	return FALSE;
	}

	public function cek_ktp($ktp){
		$query = $this->db->get_where('ref_masy', array('ktp' => $ktp));
		return $query->num_rows();
	}
	  
	public function super_masy($id){
		$query = $this->db->query("SELECT nama_lengkap,nama_panggilan,jns_kel,alamat,ktp,hp,ref_kabupaten.kabupaten,ref_kecamatan.kecamatan,ref_kelurahan.kelurahan,ref_pekerjaan.pekerjaan,ref_penghasilan.penghasilan,ref_umur.umur,ref_pendidikan.pendidikan,anggota_kel FROM ref_masy
		INNER JOIN ref_kabupaten ON ref_masy.kabupaten=ref_kabupaten.id
		INNER JOIN ref_kecamatan ON ref_masy.kecamatan=ref_kecamatan.id
		INNER JOIN ref_kelurahan ON ref_masy.kelurahan=ref_kelurahan.id
		INNER JOIN ref_pekerjaan ON ref_masy.pekerjaan=ref_pekerjaan.id
		INNER JOIN ref_penghasilan ON ref_masy.penghasilan=ref_penghasilan.id
		INNER JOIN ref_pendidikan ON ref_masy.pendidikan=ref_pendidikan.id
		INNER JOIN ref_umur ON ref_masy.umur=ref_umur.id
		WHERE ref_masy.id=$id");
		return $query->row();
	}

}