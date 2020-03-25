<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ref_tps extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
		$this->atos_tiasa_leubeut();
		Modules::run('ref_role/permissions');
		$this->load->model('m_tps');
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
		$config['base_url']= base_url().'/ref_tps/index'; 
		$config['suffix'] = '?'.http_build_query($_GET, '', "&"); 
		$this->pagination->initialize($config);
		$data['paginglinks'] = $this->pagination->create_links();    
		$data['per_page'] = $this->uri->segment(3);      
		$data['offset'] = $offset ;

		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}
		$data['kabupaten'] = $this->m_tps->get_kab_all();   

		$data['breadcrumbs'] = array(
			array (
				'link' => '/ref_tps',
				'name' => 'Home'
			)
		);
		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$this->template->load('template_frontend','v_index',$data);		
	}

	public function data_tps(){
		$id_kel = $this->input->post('kelurahan');
		$arr_kab = array();
		$query = $this->m_tps->get_tps($id_kel);
		foreach ($query as $key) {
			$datap = [
				'id' => $key->id,
				'tps' => $key->tps,
				'dpt' => $key->dpt,
			];
			array_push($arr_kab,$datap);
		}
		$data['tps'] = $arr_kab;
		$this->load->view('index_tps',$data);
	}
	
	
	public function add_tps(){
		$data['kabupaten'] = $this->m_tps->get_kab_all();   

		$data['breadcrumbs'] = array(
			array (
				'link' => '/ref_tps',
				'name' => 'Home'
			)
		);
		$this->template->load('template_frontend','v_add',$data);
	}

	public function edit_tps(){
		$id = $this->uri->segment(3);
		$data['kabupaten'] = $this->m_tps->get_kab_all();   
		$data['field'] = $this->m_tps->get_tpss($id);
		$data['breadcrumbs'] = array(
			array (
				'link' => '/ref_tps',
				'name' => 'Home'
			)
		);
		$this->template->load('template_frontend','v_add',$data);
	}

    public function action() {
	   try {
		$id = $this->input->post('id_tps');
			if($id == NULL){
				$data['id_kel']=$this->input->post('kelurahan');
				$data['tps']=$this->input->post('tps');
				$data['dpt']=$this->input->post('dpt');
				$xss_data = $this->security->xss_clean($data);
				$this->db->insert('ref_tps', $xss_data);
				$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
				$this->add_tps();	
			}else{
				$data['id_kel']=$this->input->post('kelurahan');
				$data['tps']=$this->input->post('tps');
				$data['dpt']=$this->input->post('dpt');
				$xss_data = $this->security->xss_clean($data);
				$this->db->where('id',$id);
				$this->db->update('ref_tps', $xss_data);
				$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
				redirect('ref_tps');	
			}
		}
		catch(Exception $err)
		{
		log_message("error",$err->getMessage());
		return show_error($err->getMessage());
		}
	}
	
	public function hupus() {
		$id=$this->uri->segment(3);
			try {
				$this->db->where('id',$id);
				$this->db->delete('ref_tps');
				redirect('ref_tps');
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
