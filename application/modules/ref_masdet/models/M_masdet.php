<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_masdet extends CI_Model{
	
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

	public function get_saksi($id){
		$query = $this->db->query("SELECT * from ref_saksi where id_masy=$id");
		return $query->row();
	}

	public function super_masy_kab($id){
		$query = $this->db->query("SELECT ref_masy.id,no_tps,nama_lengkap,nama_panggilan,jns_kel,alamat,ktp,hp,ref_kabupaten.kabupaten,ref_kecamatan.kecamatan,ref_kelurahan.kelurahan,ref_pekerjaan.pekerjaan,ref_penghasilan.penghasilan,ref_umur.umur,ref_pendidikan.pendidikan,anggota_kel,profil FROM ref_masy
		INNER JOIN ref_kabupaten ON ref_masy.kabupaten=ref_kabupaten.id
		INNER JOIN ref_kecamatan ON ref_masy.kecamatan=ref_kecamatan.id
		INNER JOIN ref_kelurahan ON ref_masy.kelurahan=ref_kelurahan.id
		INNER JOIN ref_pekerjaan ON ref_masy.pekerjaan=ref_pekerjaan.id
		INNER JOIN ref_penghasilan ON ref_masy.penghasilan=ref_penghasilan.id
		INNER JOIN ref_pendidikan ON ref_masy.pendidikan=ref_pendidikan.id
		INNER JOIN ref_umur ON ref_masy.umur=ref_umur.id
		WHERE ref_masy.kabupaten=$id");
		return $query->result();
	}

	public function super_masy_kec($id){
		$query = $this->db->query("SELECT ref_masy.id,no_tps,nama_lengkap,nama_panggilan,jns_kel,alamat,ktp,hp,ref_kabupaten.kabupaten,ref_kecamatan.kecamatan,ref_kelurahan.kelurahan,ref_pekerjaan.pekerjaan,ref_penghasilan.penghasilan,ref_umur.umur,ref_pendidikan.pendidikan,anggota_kel,profil FROM ref_masy
		INNER JOIN ref_kabupaten ON ref_masy.kabupaten=ref_kabupaten.id
		INNER JOIN ref_kecamatan ON ref_masy.kecamatan=ref_kecamatan.id
		INNER JOIN ref_kelurahan ON ref_masy.kelurahan=ref_kelurahan.id
		INNER JOIN ref_pekerjaan ON ref_masy.pekerjaan=ref_pekerjaan.id
		INNER JOIN ref_penghasilan ON ref_masy.penghasilan=ref_penghasilan.id
		INNER JOIN ref_pendidikan ON ref_masy.pendidikan=ref_pendidikan.id
		INNER JOIN ref_umur ON ref_masy.umur=ref_umur.id
		WHERE ref_masy.kecamatan=$id ");
		return $query->result();
	}

	public function super_masy_kel($id){
		$query = $this->db->query("SELECT ref_masy.id,no_tps,nama_lengkap,nama_panggilan,jns_kel,alamat,ktp,hp,ref_kabupaten.kabupaten,ref_kecamatan.kecamatan,ref_kelurahan.kelurahan,ref_pekerjaan.pekerjaan,ref_penghasilan.penghasilan,ref_umur.umur,ref_pendidikan.pendidikan,anggota_kel,profil FROM ref_masy
		INNER JOIN ref_kabupaten ON ref_masy.kabupaten=ref_kabupaten.id
		INNER JOIN ref_kecamatan ON ref_masy.kecamatan=ref_kecamatan.id
		INNER JOIN ref_kelurahan ON ref_masy.kelurahan=ref_kelurahan.id
		INNER JOIN ref_pekerjaan ON ref_masy.pekerjaan=ref_pekerjaan.id
		INNER JOIN ref_penghasilan ON ref_masy.penghasilan=ref_penghasilan.id
		INNER JOIN ref_pendidikan ON ref_masy.pendidikan=ref_pendidikan.id
		INNER JOIN ref_umur ON ref_masy.umur=ref_umur.id
		WHERE ref_masy.kelurahan=$id");
		return $query->result();
	}
}