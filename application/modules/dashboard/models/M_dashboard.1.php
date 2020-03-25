<?php
class M_dashboard extends CI_Model{
	
	function __construct(){
        parent::__construct();
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

    public function get_all()
    {
        $query = $this->db->get('ref_dinas');
        return $query->result_array();
    }

    public function getret($id){
        $query = $this->db->query("SELECT * FROM ref_jenis_retribusi WHERE id_dinas=$id");
        return $query->result_array();
    }

    
    public function get_trx($id,$idret,$year){
        $query = $this->db->query("select * from trx_$id 
JOIN ref_jenis_retribusi ON trx_$id.id_jenis_ret=ref_jenis_retribusi.id_jenis 
WHERE id_jenis_ret=$idret and YEAR(tgl)=$year ORDER BY tgl ASC"); 
        return $query->result_array();
    }
    
    public function get_realisasi($id){
        $masuk =array();
		$coba=array();
        $tempret=0;
        $tempdin=0;
		$year=date("Y");
		$query = $this->getret($id);
		foreach($query as $key){
			$query2 = $this->m_dashboard->get_trx($id,$key['id_jenis'],$year);
				foreach($query2 as $value){
                    $tempret=$value['realisasi'];
				}
            $tempdin+=$tempret;
		}

        return $tempdin;
    }

    public function get_target($id){
        $masuk =array();
		$coba=array();
        $temptar=0;
        $temptin=0;
		$year=date("Y");
		$query = $this->getret($id);
		foreach($query as $key){
			$query2 = $this->m_dashboard->get_trx($id,$key['id_jenis'],$year);
				foreach($query2 as $value){
                    $temptar=$value['target'];
				}
            $temptin+=$temptar;
		}

        return $temptin;
    }
}