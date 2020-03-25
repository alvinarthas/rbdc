<?php
class Ref_daerah extends CI_Controller{

    public function __construct() {
		parent::__construct();
		$this->atos_tiasa_leubeut();
		$this->load->model('m_daerah');
	}
	
	public function atos_tiasa_leubeut(){
		
		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
	}
    
    public function index() {		
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
		$config['base_url']= base_url().'/ref_surdet/index'; 
		$config['suffix'] = '?'.http_build_query($_GET, '', "&"); 
		$this->pagination->initialize($config);
		$data['paginglinks'] = $this->pagination->create_links();    
		$data['per_page'] = $this->uri->segment(3);      
		$data['offset'] = $offset ;

		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}
		$data['kabupaten'] = $this->m_daerah->get_kab_all();   

		$data['breadcrumbs'] = array(
			array (
				'link' => '/ref_daerah',
				'name' => 'Home'
			)
		);
		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$this->template->load('template_frontend','v_index',$data);		
	}

	public function index_kab(){
		$query = $this->m_daerah->get_kab_all();
		$data['daerah'] = $query;
		$this->load->view('index_kab',$data);
	}

	public function index_kec(){
		$id_kab = $this->input->post('kabupaten');
		$query = $this->m_daerah->get_kec($id_kab);
		$data['daerah'] = $query;
		$this->load->view('index_kec',$data);
	}

	public function index_kel(){
		$id_kec = $this->input->post('kecamatan');
		$query = $this->m_daerah->get_kel($id_kec);
		$data['daerah'] = $query;
		$this->load->view('index_kel',$data);
	}

	public function tambah(){
		$data['breadcrumbs'] = array(
			array (
				'link' =>'/ref_daerah',
				'name' => 'Home'
			)
		);
		$data['judul_form']="Tambah";
		$data['sub_judul_form']="Daerah";
		$this->template->load('template_frontend','v_add',$data);
	}

	public function ajx_daerah(){
		$daerah = $this->input->post('daerah');
		if($daerah == "kabupaten"){
			$this->load->view('add_kabupaten');
		}elseif ($daerah == "kecamatan") {
			$data['kabupaten'] = $this->m_daerah->get_kab_all();
			$this->load->view('add_kecamatan',$data);
		}elseif ($daerah == "kelurahan"){
			$data['kabupaten'] = $this->m_daerah->get_kab_all();
			$this->load->view('add_kelurahan',$data);
		}
	}

	public function tambah_action(){
		$daerah = $this->input->post('daerah');
		if($daerah == "kabupaten"){
			$data = array(
				'kabupaten' => $this->input->post('kabupaten'),
			);
			$xss_data = $this->security->xss_clean($data);
			$this->db->insert('ref_kabupaten', $xss_data);
			$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
			$this->tambah();
		}elseif ($daerah == "kecamatan") {
			$data = array(
				'id_kab' => $this->input->post('kabupaten'),
				'kecamatan' => $this->input->post('kecamatan'),
			);
			$xss_data = $this->security->xss_clean($data);
			$this->db->insert('ref_kecamatan', $xss_data);
			$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
			$this->tambah();
		}elseif ($daerah == "kelurahan"){
			$data = array(
				'id_kec' => $this->input->post('kecamatan'),
				'kelurahan' => $this->input->post('kelurahan'),
				// 'dpt' => $this->input->post('dpt'),
				// 'tps' => $this->input->post('tps'),
			);
			$xss_data = $this->security->xss_clean($data);
			$this->db->insert('ref_kelurahan', $xss_data);
			$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
			$this->tambah();
		}
	}

	public function edit(){
		$daerah=$this->uri->segment(3);
		$id=$this->uri->segment(4);
		$data['breadcrumbs'] = array(
			array (
				'link' =>'/ref_daerah',
				'name' => 'Home'
			)
		);
		$data['judul_form']="Edit";
		$data['sub_judul_form']=$daerah;

		if($daerah == "kabupaten"){
			$data['kabupaten'] = $this->m_daerah->get_kab($id);
			$this->template->load('template_frontend','edit_kab',$data);
		}elseif ($daerah == "kecamatan") {
			$id_kab=$this->uri->segment(5);
			$data['kab'] = $this->m_daerah->get_kab($id_kab);
			$data['kabupaten'] = $this->m_daerah->get_kab_all();
			$data['kecamatan'] = $this->m_daerah->get_kec_id($id);
			$this->template->load('template_frontend','edit_kec',$data);
		}elseif ($daerah == "kelurahan"){
			$id_kec=$this->uri->segment(5);
			$data['kabupaten'] = $this->m_daerah->get_kab_all();
			$data['kecamatan'] = $this->m_daerah->get_kec_id($id_kec);
			$data['kelurahan'] = $this->m_daerah->get_kel_id($id);
			$this->template->load('template_frontend','edit_kel',$data);
		}
	}

	public function edit_action(){
		$daerah = $this->input->post('daerah');
		$id = $this->input->post('id');
		if($daerah == "kabupaten"){
			$data = array(
				'kabupaten' => $this->input->post('kabupaten'),
			);
			$xss_data = $this->security->xss_clean($data);
			$this->db->where('id',$id);
			$this->db->update('ref_kabupaten',$xss_data);
			$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
			redirect('ref_daerah');
		}elseif ($daerah == "kecamatan") {
			$data = array(
				'id_kab' => $this->input->post('kabupaten'),
				'kecamatan' => $this->input->post('kecamatan'),
			);
			$xss_data = $this->security->xss_clean($data);
			$this->db->where('id',$id);
			$this->db->update('ref_kecamatan',$xss_data);
			$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
			redirect('ref_daerah');
		}elseif ($daerah == "kelurahan"){
			$data = array(
				'id_kec' => $this->input->post('kecamatan'),
				'kelurahan' => $this->input->post('kelurahan'),
				'dpt' => $this->input->post('dpt'),
				'tps' => $this->input->post('tps'),
			);
			$xss_data = $this->security->xss_clean($data);
			$this->db->where('id',$id);
			$this->db->update('ref_kelurahan',$xss_data);
			$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
			redirect('ref_daerah');
		}
	}

	public function delete() {
		$daerah=$this->uri->segment(3);
		$id=$this->uri->segment(4);

		if($daerah == "kabupaten"){
			try {
				$this->db->where('id',$id);
				$this->db->delete('ref_kabupaten');
				redirect('ref_daerah');
			}
			catch(Exception $err)
			{
				log_message("error",$err->getMessage());
				return show_error($err->getMessage());
			}
		}elseif ($daerah == "kecamatan") {
			try {
				$this->db->where('id',$id);
				$this->db->delete('ref_kecamatan');
				redirect('ref_daerah');
			}
			catch(Exception $err)
			{
				log_message("error",$err->getMessage());
				return show_error($err->getMessage());
			}
		}elseif ($daerah == "kelurahan"){
			try {
				$this->db->where('id',$id);
				$this->db->delete('ref_kelurahan');
				redirect('ref_daerah');
			}
			catch(Exception $err)
			{
				log_message("error",$err->getMessage());
				return show_error($err->getMessage());
			}
		}
   }
}