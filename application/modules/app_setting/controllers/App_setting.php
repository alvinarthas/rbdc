<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_setting extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
		$this->atos_tiasa_leubeut();
		Modules::run('ref_role/permissions');
		$this->load->model('users_model');
    }   
    
    
	public function atos_tiasa_leubeut(){
		
		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
    }

	
	
	
	public function index( $offset = 0 ) {
	
			
					
			$per_page = 20;  
			$qry = "SELECT * FROM ref_setting_app where meta_type='img_slideshow'";
			$data['ListData'] = $this->db->query($qry)->result_array();   
	
			$data['breadcrumbs'] = array(
				array (
					'link' => '#',
					'name' => 'Settings'
				),
				array (
					'link' => '#',
					'name' => 'App'
				)
			);
	
		$data['sub_judul_form']="Setting Slide ";
		$this->template->load('template_frontend','v_index',$data);	

	
   }
	
	

public function add() {

	if(isset($_FILES['file'])){

		$config['file_name']        = 'img_'.time();
        $config['upload_path']      = './assets_users/img/slideshow';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = 2048;

            $this->load->library('upload', $config);

             if ( ! $this->upload->do_upload('file')){
	                $error = $this->upload->display_errors();
					$this->session->set_flashdata('message_gagal', $error);
					redirect('app_setting');        	
                }else{
                $namafile   = $this->upload->data();
                $data       = array('meta_type' => 'img_slideshow', 'source'  => $namafile['file_name']);
				$this->db->insert('ref_setting_app', $data);
				$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
				redirect('app_setting');        	
                }

            
        }else{
		$this->session->set_flashdata('message_gagal', 'Undefined File!');
		redirect('app_setting');        	
        }
}    



	public function hupus() {
		$id=$this->uri->segment(3);
		$q=$this->db->query("SELECT * FROM ref_setting_app WHERE id =".$id);
		$data=$q->row();
		$file ='./assets_users/img/slideshow/'.$data->source;
		if (is_readable($file) && unlink($file)) {
			try {
				$this->db->where('id',$id);
				$this->db->delete('ref_setting_app');
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
