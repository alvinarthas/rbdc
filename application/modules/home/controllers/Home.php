<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function Home(){
		parent::__construct();
        
	}
	
	
	public function index() {
		$sql = "SELECT * FROM ref_setting_app  WHERE meta_type='img_slideshow' ";
		$query = $this->db->query($sql);
		$data['data_img'] = $query->result();		
		$this->template->load('template_frontend','v_index',$data);	
	
   }
   
   
   public function read()
	{	
		
		$id=$this->uri->segment(3);
		$sql = "SELECT * FROM ref_konten  WHERE id='".$id."' ";
		$query = $this->db->query($sql);
		$data['field'] = $query->row_array();
		$this->template->load('template_frontend','v_index_read',$data);	
		
	}
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */