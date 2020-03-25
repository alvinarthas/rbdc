<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ref_menu extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
		$this->atos_tiasa_leubeut();
		Modules::run('ref_role/permissions');
		$this->load->model('menu_model');
    }   
    
    
	public function atos_tiasa_leubeut(){
		
		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
    }

	
	
	
	public function index( $offset = 0 ) {
	
			
					

	$categoryList = $this->categoryParentChildTree(); 
    $data["categoryList"]=$categoryList;

	$data['breadcrumbs'] = array(
		array (
			'link' => '#',
			'name' => 'Settings'
		),
		array (
			'link' => '#',
			'name' => 'Menu'
		)
	);

    $data['role'] = get_role($this->session->userdata('sesi_user_group'));
	$data['sub_judul_form']="Data Menu ";
	$this->template->load('template_frontend','v_index',$data);	
// decrypt_menu_json_format(menu_json_format());

   }
	
	
	public function tambih() {	
     get_role($this->session->userdata('sesi_user_group'),'insert');		
		$data['judul_form']="Tambah Data";
		$data['sub_judul_form']="Menu ";
		
		$data['breadcrumbs'] = 
		array(
			array (
				'link' => '#',
				'name' => 'Settings'
			),
			array (
				'link' => 'ref_menu',
				'name' => 'Menu'
			),
			array (
				'link' => '#',
				'name' => 'Tambah Data'
			)
		);

   	$categoryList = $this->categoryParentChildTree(); 
    $data["categoryList"]=$categoryList;
   $data['menu_list']=$categoryList;

		$this->template->load('template_frontend','v_add',$data);
   }
   
   
   

   
   
    public function tambih_robih() {
   
	   try {				
				$id = $this->input->post('id_menu');
				$nama = $this->input->post('nama_menu');
				$parrent = $this->input->post('parrent');
				$link = $this->input->post('link');
				$urutan = $this->input->post('urutan');				
				
				if($id=='' || $id==null){
					get_role($this->session->userdata('sesi_user_group'),'insert');
					$data['nama_menu']=$nama;
					$data['parrent']=$parrent;
					$data['link']=$link;
					$data['urutan']=$urutan;
				$xss_data = $this->security->xss_clean($data);
				$this->db->insert('ref_menu', $xss_data);
				$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
				$this->tambih();	
							
				}else{
					get_role($this->session->userdata('sesi_user_group'),'update');
					$data['nama_menu']=$nama;
					$data['parrent']=$parrent;
					$data['link']=$link;
					$data['urutan']=$urutan;
				
				$xss_data = $this->security->xss_clean($data);
				$this->db->where('id_menu',$id);
				$this->db->update('ref_menu',$xss_data);		
				
				$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
				

$data['breadcrumbs'] = 
		array(
			array (
				'link' => '#',
				'name' => 'Settings'
			),
			array (
				'link' => 'ref_menu',
				'name' => 'Menu'
			),
			array (
				'link' => '#',
				'name' => 'Tambah Data'
			)
		);
				$data['judul_form']="Ubah Data";
				$data['sub_judul_form']="Menu ";
				$data['menu_list']=$this->menu_model->get_all();
				$data['field']=$this->menu_model->get_all(array('id_menu'=>$id));
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
get_role($this->session->userdata('sesi_user_group'),'update');   	
   $id=$this->uri->segment(3);

   	$categoryList = $this->categoryParentChildTree(); 
    $data["categoryList"]=$categoryList;
   $data['menu_list']=$categoryList;

   $data['field']=$this->menu_model->get_all(array('id_menu'=>$id));
   $data['judul_form']="Ubah Data";
   $data['sub_judul_form']="Menu ";

	$data['breadcrumbs'] = array(
			array (
				'link' => '#',
				'name' => 'Settings'
			),
			array (
				'link' => 'ref_menu',
				'name' => 'Menu'
			),
			array (
				'link' => '#',
				'name' => 'Ubah Data'
			)
	);


   $this->template->load('template_frontend','v_add',$data);
   
   }
   
   public function lengkep(){
		

    }

   
   public function hupus() {
get_role($this->session->userdata('sesi_user_group'),'delete');  
	$id=$this->uri->segment(3);
			try {
			
			$this->db->where('id_menu',$id);
			$q=$this->db->delete('ref_menu');
			
			if($q){
				$this->db->where('parrent',$id);
				$qe=$this->db->delete('ref_menu');
					if ($qe) {
						$this->db->where('id_menu',$id);
						$this->db->delete('ref_group_menu');
						redirect('ref_menu');					
					}
			}

			
			}
			catch(Exception $err)
			{
			log_message("error",$err->getMessage());
			return show_error($err->getMessage());
			}
   
   }

   
    
    public function categoryParentChildTree($parent = 0, $spacing = '', $category_tree_array = '') {
  
    if (!is_array($category_tree_array))
        $category_tree_array = array();
 
   
    $query = $this->db->query("SELECT * FROM ref_menu WHERE parrent = $parent ORDER BY urutan ASC");
    
            if ($query->num_rows() > 0)
        {
           foreach ($query->result() as $row)
           {
            
                 $category_tree_array[] = array("id_menu" => $row->id_menu,"parrent" => $row->parrent, "nama_menu" => $spacing . $row->nama_menu);
                    $category_tree_array = $this->categoryParentChildTree($row->id_menu, '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array);
              
           }
        } 

    
 
        return $category_tree_array;
    }
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
