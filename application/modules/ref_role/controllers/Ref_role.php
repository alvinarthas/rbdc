<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ref_role extends MX_Controller{
    //put your code here
	public function __construct() {
		parent::__construct();
		$this->atos_tiasa_leubeut();
		$this->permissions();
		$this->load->model("Role_model");
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
		$qry = "select * from ref_user_group";


		
		if ($this->session->userdata('s_cari_global')!="") {
			$qry.="  where nama_user_group like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
		} 
		elseif ($this->session->userdata('s_cari_global')=="") {
			$this->session->unset_userdata('s_cari_global');
		} 	

		
		
		$qry.= " ORDER BY nama_user_group asc"; 
			//echo $qry;
		

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
		$config['base_url']= base_url().'/ref_users/index'; 
		$config['suffix'] = '?'.http_build_query($_GET, '', "&"); 
		$this->pagination->initialize($config);
		$data['paginglinks'] = $this->pagination->create_links();    
		$data['per_page'] = $this->uri->segment(3);      
		$data['offset'] = $offset ;
		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}   
		$qry .= " limit {$per_page} offset {$offset} ";
		
		$data['ListData'] = $this->db->query($qry)->result_array();   
		$data['breadcrumbs'] = array(
			array (
				'link' => '#',
				'name' => 'Settings'
				),
			array (
				'link' => '#',
				'name' => 'Users Role'
				)
			);
    $data['role'] = get_role($this->session->userdata('sesi_user_group'));
		$data['sub_judul_form']="Data Users Role ";
		$this->template->load('template_frontend','v_index',$data);	

		
	}
	
	
	public function tambih() {

		$data['breadcrumbs'] = array(
			array (
				'link' => '#',
				'name' => 'Settings'
				),
			array (
				'link' => 'ref_role',
				'name' => 'Users Role'
				),
			array (
				'link' => '#',
				'name' => 'Tambah Data'
				)
			);
		
		$data['judul_form']="Tambah Data";
		$data['sub_judul_form']="Role User Group";
		$data['menu_list']=$this->Role_model->get_menu_all();
		$this->template->load('template_frontend','v_add',$data);
	}
	
	
	

	
	
	public function tambih_robih() {
		
		try {				
			$id = $this->input->post('id_user_group');
			$nama = $this->input->post('nama_user_group');
//				$cb = $this->input->post('cb_pv');
			
			if($id=='' || $id==null){			
				
				$data['nama_user_group']=$nama;

				$xss_data = $this->security->xss_clean($data);
				$this->db->insert('ref_user_group', $xss_data);
				$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
				$this->tambih();	
				
			}else{
				

				$data['nama_user_group']=$nama;
				
				$xss_data = $this->security->xss_clean($data);
				$this->db->where('id_user_group',$id);
				$this->db->update('ref_user_group',$xss_data);		
				
				$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
				
				$data['judul_form']="Ubah Data";
				$data['sub_judul_form']="Role ";
				$sql = "SELECT * FROM ref_user_group  WHERE id_user_group='".$id."' ";
				$query = $this->db->query($sql);
				$data['field'] = $query->row();

				$data['breadcrumbs'] = array(
					array (
						'link' => '#',
						'name' => 'Settings'
						),
					array (
						'link' => 'ref_role',
						'name' => 'Users Role'
						),
					array (
						'link' => '#',
						'name' => 'Detail'
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
		$data['menu_list']=$this->Role_model->get_menu_all();
		$data['menu_user']=$this->Role_model->get_menu_user(array('id_user_group'=>$id));

		$sql = "SELECT * FROM ref_user_group  WHERE id_user_group='".$id."' ";
		$query = $this->db->query($sql);
		$data['field'] = $query->row();
		if ($data['field']!=TRUE) {
			show_404();
		} else {

			$data['breadcrumbs'] = array(
				array (
					'link' => '#',
					'name' => 'Settings'
					),
				array (
					'link' => 'ref_role',
					'name' => 'Users Role'
					),
				array (
					'link' => '#',
					'name' => 'Ubah Data'
					)
				);     
			$data['judul_form']="Ubah Data";
			$data['sub_judul_form']="Role ";
			$this->template->load('template_frontend','v_add',$data);
//   echo json_encode($data['field']);
		}
	}
	
	public function lengkep(){
		
		$id=$this->uri->segment(3);
		$data['categoryList']=Modules::run('Ref_menu/categoryParentChildTree');	
		$data['menu_list']=$this->Role_model->get_menu_all();
		$data['menu_user']=$this->Role_model->get_menu_user(array('id_user_group'=>$id));
		$sql = "SELECT * FROM ref_user_group  WHERE id_user_group='".$id."' ";
		$query = $this->db->query($sql);
		$data['field'] = $query->row();
		if ($data['field']!=TRUE) {
			show_404();
		} else {  
			$data['judul_form']="Ubah Data";
			$data['sub_judul_form']="Role ";
			
			$data['breadcrumbs'] = array(
				array (
					'link' => '#',
					'name' => 'Settings'
					),
				array (
					'link' => 'ref_role',
					'name' => 'Users Role'
					),
				array (
					'link' => '#',
					'name' => 'Detail'
					)
				);
			$this->template->load('template_frontend','v_detail',$data);
		}
	}

	public function robih_pv(){
		try {				
			$id = $this->input->post('id_user_group');
			$role = $this->input->post('role');
			$this->db->where('id_user_group', $id);
			$q=$this->db->delete('ref_group_menu'); 
			if($q){
				$datax = array();
				foreach($this->input->post('cb_pv') as $symb) {
					$act_role="";
					if(isset($role[$symb]) && $role[$symb]!='' && $role[$symb]!=null){						
						foreach ($role[$symb] as $key => $value) {
							$act_role .= $value;								
						}
					}
					
					$datax[] = array('id_menu' => $symb,'id_user_group' => $id,'role' => $act_role);
				}
				$xss_data = $this->security->xss_clean($datax);
				$this->db->insert_batch('ref_group_menu', $datax);
				$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
			}				
			

			$data['menu_list']=$this->Role_model->get_menu_all();
			$data['menu_user']=$this->Role_model->get_menu_user(array('id_user_group'=>$id));

			$sql = "SELECT * FROM ref_user_group  WHERE id_user_group='".$id."' ";
			$query = $this->db->query($sql);
			$data['field'] = $query->row();
			if ($data['field']!=TRUE) {
				show_404();
			} else {
				$data['breadcrumbs'] = array(
					array (
						'link' => '#',
						'name' => 'Settings'
						),
					array (
						'link' => 'ref_role',
						'name' => 'Users Role'
						),
					array (
						'link' => '#',
						'name' => 'Detail'
						)
					);

				$data['categoryList']=Modules::run('Ref_menu/categoryParentChildTree');		
				$data['judul_form']="Ubah Data";
				$data['sub_judul_form']="Role ";
				$this->template->load('template_frontend','v_detail',$data);
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
			
			$this->db->where('id_user_group',$id);
			$this->db->delete('ref_user_group');
			redirect('ref_role');
			
		}
		catch(Exception $err)
		{
			log_message("error",$err->getMessage());
			return show_error($err->getMessage());
		}
		
	}

	public function permissions(){
		$this->db->select('ref_group_menu.*,ref_menu.nama_menu,ref_menu.link');
		$this->db->from('ref_group_menu');
		$this->db->where('id_user_group',$this->session->userdata('sesi_user_group'));
		$this->db->where('link',$this->uri->segment(1));		
		$this->db->join('ref_menu', 'ref_menu.id_menu = ref_group_menu.id_menu', 'left');
		$qe=$this->db->get();
		if($qe->result()==TRUE AND count($qe->result()) > 0 ){
			return TRUE;
		}else{
			echo "Oops, You dont have permissions to visit this page. please <a href=".base_url().">back now!</a>";
			exit();
		}
	}

   
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
