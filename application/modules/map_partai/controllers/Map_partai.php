<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Map_partai extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
		$this->atos_tiasa_leubeut();
		Modules::run('ref_role/permissions');
		$this->load->model('m_partai');
    }   
    
    
	public function atos_tiasa_leubeut(){
		
		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
    }

	public function index( $offset = 0 ) {
		$per_page = 20;  

		$offset = ($this->uri->segment(3) != '' ? $this->uri->segment(3):0);
		$config['per_page']= $per_page;
		$config['full_tag_open'] = '<div class="table-pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<a href="#" class="active"><b>';
		$config['cur_tag_close'] = '</b></a>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['last_tag_open'] = "<span>";
		$config['first_tag_close'] = "</span>";
		$config['uri_segment'] = 3;
		$config['base_url']= base_url().'/map_partai/index'; 
		$config['suffix'] = '?'.http_build_query($_GET, '', "&"); 
		$this->pagination->initialize($config);
		$data['paginglinks'] = $this->pagination->create_links();    
		$data['per_page'] = $this->uri->segment(3);      
		$data['offset'] = $offset ;

		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}

		$data['ListData'] = $this->m_partai->map_partai_all();   

		$data['breadcrumbs'] = array(
			array (
				'link' => '#',
				'name' => 'Home'
			)
		);
			
		$data['sub_judul_form']="Mapping Partai";
		$this->template->load('template_frontend','v_index',$data);	
   	}
	
	
	public function tambih() {
   
		$data['breadcrumbs'] = array(
			array (
				'link' => '#',
				'name' => 'Home'
			)
		);
		
		$data['judul_form']="Tambah Data";
		$data['sub_judul_form']="Mapping Partai";
		$data['paslon']=$this->m_partai->get_paslon();
		$data['partai']=$this->m_partai->get_partai();
		$this->template->load('template_frontend','v_add',$data);
	}
   
    public function tambih_robih() {
   
	   try {				
			$data = array(
				'id_calon' => $this->input->post('paslon'),
				'id_partai' => $this->input->post('partai'),	
			);
			$xss_data = $this->security->xss_clean($data);
			$this->db->insert('tbl_map_partai',$xss_data);
			$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
			redirect('map_partai');
		}
		catch(Exception $err)
		{
		log_message("error",$err->getMessage());
		return show_error($err->getMessage());
		}
	}

   
	public function hupus() {
		$id_calon=$this->uri->segment(3);
		$id_partai=$this->uri->segment(4);
		try {
			$this->db->where('id_calon',$id_calon);
			$this->db->where('id_partai',$id_partai);
			$this->db->delete('tbl_map_partai');
			redirect('map_partai');
		}
			catch(Exception $err)
		{
			log_message("error",$err->getMessage());
			return show_error($err->getMessage());
		}
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
