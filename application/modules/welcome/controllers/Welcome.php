<?php

class Welcome extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
		$this->atos_tiasa_leubeut();
    }   
    
    
	public function atos_tiasa_leubeut(){	
		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
    }
		
	public function index() {
		$data["nama"]=$this->session->userdata('sesi_nama_lengkap');
		$this->template->load('template_frontend','v_index',$data);
    }

}
 