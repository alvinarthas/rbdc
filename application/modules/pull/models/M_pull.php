<?php
class M_pull extends CI_Model{
	
	function __construct(){
        parent::__construct();
    }

    public function cek_ret($id,$id_dinas){
        $query = $this->db->query("SELECT id_jenis from ref_jenis_retribusi WHERE id_jenis=$id AND id_dinas=$id_dinas");
        return $query;
    }

    public function cek($id,$tgl){
        $query = $this->db->query("SELECT id_trx from trx_1 WHERE id_jenis_ret=$id AND tgl='$tgl'"); 
        return $query;
    }

    public function update_trx($id,$data){
        $this->db->where('id_jenis_ret',$id);
        return $this->db->update('trx_1',$data);
    }

    public function simpan_trx($data){
        if($this->db->insert('trx_1',$data)){
        }
    }
    public function insert_ret($data){
        if($this->db->insert('ref_jenis_retribusi',$data)){
        }
    }
    public function get_all()
    {
        $query = $this->db->get('ref_dinas');
        return $query->result_array();
    }
}