<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Role_model extends CI_Model{
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

	public function get_menu_all($where = NULL){
    	if(isset($where) or $where!=NULL){
      	$this->db->where($where);
    	}
      $this->db->order_by('urutan','ASC');      

   		$query = $this->db->get('ref_menu');
    	if($query->num_rows()>0){
    		if(isset($where) or $where!=NULL){
      			return $query->row();
    		}else{
      			return $query->result();    		
    		}
    	}
    	return FALSE;
  	}

  public function get_menu_user($where){
      $this->db->where($where);
      $query = $this->db->get('ref_group_menu');
      return $query->result();        
    }    
	
	



	
}