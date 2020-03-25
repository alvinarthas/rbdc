<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ref_dinas extends MX_Controller{
    // Add Construct
    public function __construct() {
        parent::__construct();
		Modules::run('ref_role/permissions');
		$this->atos_tiasa_leubeut();
    }   
    
    // Check if already logged in
	public function atos_tiasa_leubeut(){
		
		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
    }
	public function ajx_dinas(){
        $cari_dinas = $this->input->get('cari_dinas');
        $data1 = array('s_cari_global' => $cari_dinas);
        $this->session->set_userdata($data1);

        $per_page = 20;  
        $qry = "SELECT * FROM ref_dinas";

        if ($this->session->userdata('s_cari_global')!="") {
            $qry.="  WHERE nama like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
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
        $config['base_url']= base_url().'/ref_dinas/index'; 
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
        $data['sub_judul_form']="Data Dinas ";
        $data['role']=get_role($this->session->userdata('sesi_user_group'));

        echo json_encode($data);
        // $this->template->load('template_frontend','v_index',$data);
    }
	public function index( $offset = 0 ) {
			// if (isset($_POST['cari_global'])) {
            //     $data1 = array('s_cari_global' => $_POST['cari_global']);
            //     $this->session->set_userdata($data1);			
		    // }

			$per_page = 20;  
			$qry = "SELECT * FROM ref_dinas";

			if ($this->session->userdata('s_cari_global')!="") {
                $qry.="  WHERE nama like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
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
			$config['base_url']= base_url().'/ref_dinas/index'; 
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
            $data['sub_judul_form']="Data Dinas ";
            $data['role']=get_role($this->session->userdata('sesi_user_group'));
            $this->template->load('template_frontend','v_index',$data);	
   }
	
	
	public function tambih() {
		get_role($this->session->userdata('sesi_user_group'),'insert');
   		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$data['judul_form']="Tambah Data";
		$data['sub_judul_form']="Dinas ";
		$this->template->load('template_frontend','v_add',$data);
   }
   
    public function tambih_robih() {
	   try {				
                $id = $this->input->post('id_dinas');

                if($id==''|| $id==null){
                    get_role($this->session->userdata('sesi_user_group'),'insert');
                    $data = array(
                        'nama' => $this->input->post('dinas'),				
                    );
                    $xss_data = $this->security->xss_clean($data);
                    $this->db->insert('ref_dinas', $xss_data);
                    $this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
                    redirect('ref_dinas');	
                }else{
                    get_role($this->session->userdata('sesi_user_group'),'update');		
                    $data = array(
                        'nama' => $this->input->post('dinas')
                    );
                    $xss_data = $this->security->xss_clean($data);
                    $this->db->where('id_dinas',$id);
                    $this->db->update('ref_dinas',$xss_data);
                    $this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
                    
                    $data['judul_form']="Ubah Data";
                    $data['sub_judul_form']="Dinas ";
                    
                    $sql = "SELECT * FROM ref_dinas  WHERE id_dinas='".$id."' ";
                    $query = $this->db->query($sql);
                    $data['field'] = $query->row_array();
                    redirect('ref_dinas');
                }
			}
			catch(Exception $err)
			{
                log_message("error",$err->getMessage());
                return show_error($err->getMessage());
			}
	}
	
   public function robih() {
   	   get_role($this->session->userdata('sesi_user_group'),'update');
	   $id=$this->uri->segment(3);
	   $sql = "SELECT * FROM ref_dinas  WHERE id_dinas='".$id."' ";
	   $query = $this->db->query($sql);
	   $data['field'] = $query->row_array();
	   $data['judul_form']="Ubah Data";
	   $data['sub_judul_form']="Dinas ";
	   $this->template->load('template_frontend','v_add',$data);
   }
   
   public function hupus() {
        get_role($this->session->userdata('sesi_user_group'),'delete');
        $id=$this->uri->segment(3);
        try {
            $this->db->where('id_dinas',$id);
            $this->db->delete('ref_dinas');
            redirect('ref_dinas');		
        }catch(Exception $err){
            log_message("error",$err->getMessage());
            return show_error($err->getMessage());
        }
   }
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
