<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_regis extends CI_Model{
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

	public function profil(){
		$query = $this->db->get('ref_profil');
		return $query->result();
	}
}