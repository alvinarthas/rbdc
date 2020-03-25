<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Menu_model extends CI_Model{
	
	function __construct(){
        parent::__construct();
    }

	public function get_all($where = NULL){
    	if(isset($where) or $where!=NULL){
      	$this->db->where($where);
    	}
      $this->db->order_by('urutan','asc');
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
	
	



	
}