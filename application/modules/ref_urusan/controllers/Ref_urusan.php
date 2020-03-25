<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ref_urusan extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
		$this->atos_tiasa_leubeut();
		Modules::run('ref_role/permissions');
		$this->load->model('m_urusan');
    }   
    
    
	public function atos_tiasa_leubeut(){
		if(!$this->session->userdata('atos_tiasa_leubeut')){
				redirect('loginapp');
		}
	}
	public function index( $offset = 0 ) {	
		if (isset($_POST['cari_global'])) {
			$data1 = array('s_cari_global' => $_POST['cari_global']);
			$this->session->set_userdata($data1);			
		}
			
		$per_page = 20;  
		$qry = "SELECT * FROM ref_urusan";
		
		if ($this->session->userdata('s_cari_global')!="") {
			$qry.="  AND nama_lengkap like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
		} 
		elseif ($this->session->userdata('s_cari_global')=="") {
			$this->session->unset_userdata('s_cari_global');
		} 		
		
		$offset = ($this->uri->segment(3) != '' ? $this->uri->segment(3):0);
		$config['total_rows'] = $this->db->query($qry)->num_rows();
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
		$config['base_url']= base_url().'/ref_urusan/index'; 
		$config['suffix'] = '?'.http_build_query($_GET, '', "&"); 
		$this->pagination->initialize($config);
		$data['paginglinks'] = $this->pagination->create_links();    
		$data['per_page'] = $this->uri->segment(3);      
		$data['offset'] = $offset ;

		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}

		// $qry .= " limit {$per_page} offset {$offset} ";
		$data['ListData'] = $this->db->query($qry)->result_array();   
	
		$data['breadcrumbs'] = array(
			array (
				'link' => '#',
				'name' => 'Data Master'
			),
			array (
				'link' => '#',
				'name' => 'Urusan'
			)
		);
	
		$data['sub_judul_form']="Data Urusan  ";
		$this->template->load('template_frontend','v_index',$data);	
	}
	
	
	public function tambih() {
   
		$data['breadcrumbs'] = array(
			array (
				'link' => '#',
				'name' => 'Home'
			),
			array (
				'link' => 'ref_urusan',
				'name' => 'Urusan'
			),
			array (
				'link' => '#',
				'name' => 'Tambah Data'
			)
		);
		
		$data['judul_form']="Tambah Data";
		$data['sub_judul_form']="Urusan ";
		$this->template->load('template_frontend','v_add',$data);
   }
   
    public function tambih_robih() {
   
	   try {				
				$id = $this->input->post('id_urusan');
				$urusan = $this->input->post('urusan');

				if($id=='' || $id==null){			
					
					$data['urusan']=$urusan;
					$xss_data = $this->security->xss_clean($data);
					$this->db->insert('ref_urusan', $xss_data);
					$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
					$this->tambih();	
							
				}else{
			
					$data['id']=$id;
					$data['urusan']=$urusan;
				
					$xss_data = $this->security->xss_clean($data);
					$this->db->where('id',$id);
					$this->db->update('ref_urusan',$xss_data);		
					
					$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
					
					$data['judul_form']="Ubah Data";
					$data['sub_judul_form']="Urusan ";
					$data['field']=$this->m_urusan->get_all(array('id'=>$id));
					$data['breadcrumbs'] = array(
						array (
							'link' => '#',
							'name' => 'Settings'
						),
						array (
							'link' => 'ref_users',
							'name' => 'Users'
						),
						array (
							'link' => '#',
							'name' => 'Ubah Data'
						)
					);

				$this->template->load('template_frontend','v_add',$data);
				
				}
			}
			catch(Exception $err)
			{
			log_message("error",$err->getMessage());
			return show_error($err->getMessage());
			}
	}
	
	public function robih() {
		$id=$this->uri->segment(3);
		$data['field']=$this->m_urusan->get_all(array('id'=>$id));

		$data['breadcrumbs'] = array(
				array (
					'link' => '#',
					'name' => 'Home'
				),
				array (
					'link' => 'ref_urusan',
					'name' => 'Urusan'
				),
				array (
					'link' => '#',
					'name' => 'Ubah Data'
				)
			);

		$data['judul_form']="Ubah Data";
		$data['sub_judul_form']="Users ";
		$this->template->load('template_frontend','v_add',$data);
   }
   
	public function hupus() {
  
		$id=$this->uri->segment(3);
			try {
				$this->db->where('id',$id);
				$this->db->delete('ref_urusan');
				redirect('ref_urusan');
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
