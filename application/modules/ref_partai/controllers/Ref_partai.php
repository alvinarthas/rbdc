<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ref_partai extends MX_Controller{
    // Add Construct
    public function __construct() {
        parent::__construct();
		Modules::run('ref_role/permissions');
        $this->atos_tiasa_leubeut();
        // $this->load->model('m_calon');
    }   
    
    // Check if already logged in
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
        $qry = "SELECT * FROM tbl_partai";

        if ($this->session->userdata('s_cari_global')!="") {
            $qry.="  WHERE nm_partai like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
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
        $config['base_url']= base_url().'/ref_partai/index'; 
        $config['suffix'] = '?'.http_build_query($_GET, '', "&"); 
        $this->pagination->initialize($config);
        $data['paginglinks'] = $this->pagination->create_links();    
        $data['per_page'] = $this->uri->segment(3);      
        $data['offset'] = $offset ;

        if($data['paginglinks']!= '') {
            $data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
        }   
        $data['breadcrumbs'] = array(
			array (
				'link' => '#',
				'name' => 'Home'
			)
		);
        $qry .= " limit {$per_page} offset {$offset} ";
        $data['ListData'] = $this->db->query($qry)->result_array();   
        $data['sub_judul_form']="Data Partai";
        $data['role']=get_role($this->session->userdata('sesi_user_group'));
        $this->template->load('template_frontend','v_index',$data);	
    }
	
	public function tambih() {
        $data['breadcrumbs'] = array(
			array (
				'link' => '#',
				'name' => 'Home'
			)
		);
		get_role($this->session->userdata('sesi_user_group'),'insert');
   		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$data['judul_form']="Tambah Data";
		$data['sub_judul_form']="Partai";
		$this->template->load('template_frontend','v_add',$data);
   }
   
    public function tambih_robih() {
	   try {				
            $id = $this->input->post('id_partai');
            $nm = $this->input->post('nm_partai');

            if($id==''|| $id==null){
                get_role($this->session->userdata('sesi_user_group'),'insert');
                if(isset($_FILES['file'])){
                    $config['file_name']        = 'partai_'.$nm;
                    $config['upload_path']      = './assets_users/partai';
                    $config['allowed_types']    = 'gif|jpg|png|jpeg';
                    $config['max_size']         = 4048;
            
                        $this->load->library('upload', $config);
            
                            if ( ! $this->upload->do_upload('file')){
                                $error = $this->upload->display_errors();
                                $this->session->set_flashdata('message_gagal', $error);
                                redirect('ref_partai');        	
                            }else{
                            $namafile   = $this->upload->data();
                            $data = array(
                                'nm_partai' => $this->input->post('nm_partai'),
                                'gambar' => $namafile['file_name'],
                            );
                            $xss_data = $this->security->xss_clean($data);
                            $this->db->insert('tbl_partai', $xss_data);
                            $this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
                            redirect('ref_partai');        	
                            }
                    }else{
                    $this->session->set_flashdata('message_gagal', 'Undefined File!');
                    redirect('ref_partai');        	
                    }	
            }else{
                get_role($this->session->userdata('sesi_user_group'),'update');
                if(isset($_FILES['file'])){
                    $q=$this->db->query("SELECT * FROM tbl_partai WHERE id =".$id);
                    $data=$q->row();
                    $file ='./assets_users/partai/'.$data->gambar;
                    if (is_readable($file) && unlink($file)) {
                        try {
                            $config['file_name']        = 'partai_'.$nm;
                            $config['upload_path']      = './assets_users/partai';
                            $config['allowed_types']    = 'gif|jpg|png|jpeg';
                            $config['max_size']         = 4048;
                    
                            $this->load->library('upload', $config);
                                if ( ! $this->upload->do_upload('file')){
                                    $error = $this->upload->display_errors();
                                    $this->session->set_flashdata('message_gagal', $error);
                                    redirect('ref_partai');        	
                                }else{
                                    $namafile   = $this->upload->data();
                                    $data = array(
                                        'nm_partai' => $this->input->post('nm_partai'),
                                        'gambar' => $namafile['file_name'],
                                    );
                                    $xss_data = $this->security->xss_clean($data);
                                    $this->db->where('id',$id);
                                    $this->db->update('tbl_partai',$xss_data);
                                    $this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
                                    redirect('ref_partai');
                                }
                        }catch(Exception $err){
                            log_message("error",$err->getMessage());
                            echo show_error($err->getMessage());
                        }
                    } else {
                        echo "Sistem tidak menemukan file tersebut untuk dihapus";
                    }
                }else{
                $this->session->set_flashdata('message_gagal', 'Undefined File!');
                redirect('ref_partai');        	
                }	
            }
        }
        catch(Exception $err)
        {
            log_message("error",$err->getMessage());
            return show_error($err->getMessage());
        }
    }
	
   public function robih() {
        $data['breadcrumbs'] = array(
            array (
                'link' => '#',
                'name' => 'Home'
            )
        );
   	   get_role($this->session->userdata('sesi_user_group'),'update');
	   $id=$this->uri->segment(3);
	   $sql = "SELECT * FROM tbl_partai  WHERE id='".$id."' ";
	   $query = $this->db->query($sql);
	   $data['field'] = $query->row_array();
	   $data['judul_form']="Ubah Data";
	   $data['sub_judul_form']="Partai";
	   $this->template->load('template_frontend','v_add',$data);
   }
   
   public function hupus() {
        get_role($this->session->userdata('sesi_user_group'),'delete');
        $id=$this->uri->segment(3);
        $q=$this->db->query("SELECT * FROM tbl_partai WHERE id =".$id);
		$data=$q->row();
		$file ='./assets_users/partai/'.$data->gambar;
		if (is_readable($file) && unlink($file)) {
			try {
				$this->db->where('id',$id);
				$this->db->delete('tbl_partai');
				echo "Sukses ! File Sudah terhapus";
			}catch(Exception $err){
				log_message("error",$err->getMessage());
				echo show_error($err->getMessage());
			}

		} else {
			echo "Sistem tidak menemukan file tersebut untuk dihapus";
		}
   }
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
