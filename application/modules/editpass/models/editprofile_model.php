<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Editprofile_model extends CI_Model{
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	  function insert_pemohon($dataIn)
	{
		$insert = $this->db->insert('pemohon',$dataIn);
		
		return $insert;//$this->db->insert_id();
		echo $insert;
	}



	
}