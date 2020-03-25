<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Suara_masuk extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
		$this->atos_tiasa_leubeut();
		Modules::run('ref_role/permissions');
		$this->load->model('m_masuk');
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
		$config['base_url']= base_url().'/suara_masuk/index'; 
		$config['suffix'] = '?'.http_build_query($_GET, '', "&"); 
		$this->pagination->initialize($config);
		$data['paginglinks'] = $this->pagination->create_links();    
		$data['per_page'] = $this->uri->segment(3);      
		$data['offset'] = $offset ;

		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}
		$data['kabupaten'] = $this->m_masuk->get_kab_all();   
		$data['sum'] = $this->m_masuk->sum_tps()->tps;   
		$data['count'] = $this->m_masuk->count_suara()->total;   
		$data['persentase'] = ($this->m_masuk->count_suara()->total / $this->m_masuk->sum_tps()->tps)*100;
		$data['breadcrumbs'] = array(
			array (
				'link' => '/suara_masuk',
				'name' => 'Home'
			)
		);
		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$this->template->load('template_frontend','v_index',$data);		
	}

	public function index_suara(){
		$id_kel = $this->input->post('kelurahan');
		$arr_kab = array();
		$query = $this->m_masuk->get_tps($id_kel);
		foreach ($query as $key) {
			$datap = [
				'id' => $key->id,
				'tps' => $key->tps,
			];
			array_push($arr_kab,$datap);
		}
		$data['tps'] = $arr_kab;
		$this->load->view('index_tps',$data);
	}
	
	
	public function atur(){
		$id_tps=$this->uri->segment(3);
		$cek = $this->m_masuk->cek_suara($id_tps);
		if($cek > 0){
			$data['field'] = $this->m_masuk->get_suara($id_tps);
		}else {
			$data['field'] = $this->m_masuk->get_tpss($id_tps);   
		}  
		$data['breadcrumbs'] = array(
			array (
				'link' => '/suara_masuk',
				'name' => 'Home'
			)
		);
		$this->template->load('template_frontend','v_add',$data);
   }
   
    public function atur_data() {
	   try {
			$id_tps = $this->input->post('id_tps');
			$cek = $this->m_masuk->cek_suara($id_tps);
			if($cek > 0){
				// UPDATE
				$data = array(
					'calon1' => $this->input->post('suara1'),
					'calon2' => $this->input->post('suara2'),
					'calon3' => $this->input->post('suara3'),
					'calon4' => $this->input->post('suara4'),
					'suara_sah' => $this->input->post('sah'),
					'suara_tdk' => $this->input->post('tdk_sah'),
					'suara_ttl' => $this->input->post('ttl_suara'),
				);
				$xss_data = $this->security->xss_clean($data);
				$this->db->where('id_tps',$id_tps);
				$this->db->update('suara_masuk',$xss_data);
			}else{
				// INSERT
				$data = array(
					'id_tps' => $id_tps,
					'calon1' => $this->input->post('suara1'),
					'calon2' => $this->input->post('suara2'),
					'calon3' => $this->input->post('suara3'),
					'calon4' => $this->input->post('suara4'),
					'suara_sah' => $this->input->post('sah'),
					'suara_tdk' => $this->input->post('tdk_sah'),
					'suara_ttl' => $this->input->post('ttl_suara'),
				);
				$xss_data = $this->security->xss_clean($data);
				$this->db->insert('suara_masuk', $xss_data);
			}
			$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
			redirect('suara_masuk');
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
