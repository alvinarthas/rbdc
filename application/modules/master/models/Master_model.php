<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Master_model extends CI_Model{
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	
	
		public function get_dinas($where = NULL){
      if(isset($where) or $where!=NULL){
        $this->db->where($where);
      }
      $query = $this->db->get('ref_dinas');
      if($query->num_rows()>0){
        if(isset($where) or $where!=NULL){
            return $query->row();
        }else{
            return $query->result();        
        }
      }
      return FALSE;
    }

	public function get_prov($where = NULL){
      if(isset($where) or $where!=NULL){
        $this->db->where($where);
      }
      $query = $this->db->get('provinsi');
      if($query->num_rows()>0){
        if(isset($where) or $where!=NULL){
            return $query->row();
        }else{
            return $query->result();        
        }
      }
      return FALSE;
    }

    public function get_kokab($where = NULL,$param){
      if(isset($where) or $where!=NULL){
        $this->db->where($where);
      }
      $query = $this->db->get('kabupaten');
      if($query->num_rows()>0){
        if(isset($where) or $where!=NULL){
            return $query->row();
        }else{
            return $query->result();        
        }
      }
      return FALSE;
    }

    public function get_kecamatan($where = NULL,$param){
      if(isset($where) or $where!=NULL){
        $this->db->where($where);
      }
      $query = $this->db->get('kecamatan');
      if($query->num_rows()>0){
        if(isset($where) or $where!=NULL){
            return $query->row();
        }else{
            return $query->result();        
        }
      }
      return FALSE;
    }

    public function get_kelurahan($where = NULL,$param){
      if(isset($where) or $where!=NULL){
        $this->db->where($where);
      }
      $query = $this->db->get('desa');
      if($query->num_rows()>0){
        if(isset($where) or $where!=NULL){
            return $query->row();
        }else{
            return $query->result();        
        }
      }
      return FALSE;
    }

    public function get_agama($where = NULL){
      if(isset($where) or $where!=NULL){
        $this->db->where($where);
      }
      $query = $this->db->get('ref_praja_agama');
      if($query->num_rows()>0){
        if(isset($where) or $where!=NULL){
            return $query->row();
        }else{
            return $query->result();        
        }
      }
      return FALSE;
    }  	
	

  public function get_fakultas($where = NULL){
      if(isset($where) or $where!=NULL){
        $this->db->where($where);
      }
      $query = $this->db->get('ref_fakultas');
      if($query->num_rows()>0){
        if(isset($where) or $where!=NULL){
            return $query->row();
        }else{
            return $query->result();        
        }
      }
      return FALSE;
    }

   public function get_prodi($where = NULL){
      if(isset($where) or $where!=NULL){
        $this->db->where($where);
      }
      $query = $this->db->get('ref_fakultas_prodi');
      if($query->num_rows()>0){
        if(isset($where) or $where!=NULL){
            return $query->row();
        }else{
            return $query->result();        
        }
      }
      return FALSE;
    } 

    public function get_pendidikan($where = NULL){
      if(isset($where) or $where!=NULL){
        $this->db->where($where);
      }
      $query = $this->db->get('ref_pendidikan');
      if($query->num_rows()>0){
        if(isset($where) or $where!=NULL){
            return $query->row();
        }else{
            return $query->result();        
        }
      }
      return FALSE;
    }    


}