<?php
class Ref_masy extends CI_Controller{

    public function __construct() {
		parent::__construct();
		$this->atos_tiasa_leubeut();
		$this->load->model('m_masy');
		
	}
	
    public function atos_tiasa_leubeut(){
		
		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
	}
	
    public function index() {
		$id_user_group = $this->session->userdata('sesi_user_group');
		$id_user = $this->session->userdata('sesi_id');
		if (isset($_POST['cari_global'])) {
			$data1 = array('s_cari_global' => $_POST['cari_global']);
			$this->session->set_userdata($data1);			
		}
			
		$per_page = 20;  
		$qry = "SELECT ref_masy.id,nama_lengkap,jns_kel,ktp,ref_kabupaten.kabupaten,ref_kecamatan.kecamatan,ref_kelurahan.kelurahan from ref_masy
		INNER JOIN ref_kabupaten ON ref_masy.kabupaten = ref_kabupaten.id
		INNER JOIN ref_kecamatan ON ref_masy.kecamatan = ref_kecamatan.id
		INNER JOIN ref_kelurahan ON ref_masy.kelurahan = ref_kelurahan.id";
		
		if ($id_user_group == 1 || $id_user_group == 2) {
			if ($this->session->userdata('s_cari_global')!="") {
				$qry.=" WHERE ref_masy.nama_lengkap like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
			} 
			elseif ($this->session->userdata('s_cari_global')=="") {
				$this->session->unset_userdata('s_cari_global');
			} 		
		}else {
			$qry.=" WHERE id_user=$id_user";
			if ($this->session->userdata('s_cari_global')!="") {
				$qry.="  AND ref_masy.nama_lengkap like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
			} 
			elseif ($this->session->userdata('s_cari_global')=="") {
				$this->session->unset_userdata('s_cari_global');
			} 		
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
		$config['base_url']= base_url().'/ref_masy/index'; 
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
				'link' => '/ref_masy',
				'name' => 'Home'
			)
		);
	
		$data['sub_judul_form']="Data Masyarakat";
		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$this->template->load('template_frontend','v_index',$data);	
	}
	
	public function tambih() {
		$data['breadcrumbs'] = array(
			array (
				'link' =>'/ref_masy',
				'name' => 'Home'
			)
		);
		$data['judul_form']="Isi Data Masyarakat";
		$data['sub_judul_form']="atau Pengguna";
		$data['kabupaten']=$this->m_masy->get_kab();
		$data['pekerjaan']=$this->m_masy->get_pekerjaan();
		$data['penghasilan']=$this->m_masy->get_penghasilan();
		$data['umur']=$this->m_masy->get_umur();
		$data['pendidikan']=$this->m_masy->get_pendidikan();
		$data['profil']=$this->m_masy->get_profil();
		$this->template->load('template_frontend','v_add',$data);
    }

	public function get_kecamatan(){
		$id = $this->input->post('kabupaten');
		$sql = "SELECT * FROM ref_kecamatan WHERE id_kab = $id";
		$output = '<option value=""disabled selected> Pilih Data </option>';

		$query = $this->db->query($sql);
		foreach($query->result() as $row){
			$output .= '<option value="'.$row->id.'">'.$row->kecamatan.'</option>';
		}

		echo json_encode($output);
	}

	public function ajx_tps(){
		$tps = strip_tags(trim($_GET['no_tps']));
		$query = $this->m_masy->get_tps($tps);
		$data = array();
		foreach ($query as $key) {
			$arrayName = array('id' =>$key->id,'text' =>$key->tps);
			array_push($data,$arrayName);
		}
		$myJSON = json_encode($data);

        echo $myJSON;
	}

	public function get_kelurahan(){
		$id = $this->input->post('kecamatan');
		$sql = "SELECT * FROM ref_kelurahan WHERE id_kec = $id";
		$output = '<option value=""disabled selected> Pilih Data </option>';

		$query = $this->db->query($sql);
		foreach($query->result() as $row){
			$output .= '<option value="'.$row->id.'">'.$row->kelurahan.'</option>';
		}

		echo json_encode($output);
	}

	public function cetak_isi(){
		$id=$this->uri->segment(3);
		$data['field']=$this->m_masy->super_masy($id);
		ini_set('memory_limit', '512M');
		set_time_limit (60);
		$html = $this->load->view('v_kosong',$data,true);
		$filename="Form Data Masyarakat.pdf";
		$this->load->library('pdf');
		$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8'); 
		$this->pdf->pdf->WriteHTML($html);
		$this->pdf->pdf->Output($filename, "D");
	}
	
	public function cetak_kosong(){
		$data['s']="s";
		ini_set('memory_limit', '512M');
		set_time_limit (60);
		$html = $this->load->view('v_kosong',$data,true);
		$filename="Form Data Masyarakat.pdf";
		$this->load->library('pdf');
		$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8'); 
		$this->pdf->pdf->WriteHTML($html);
		$this->pdf->pdf->Output($filename, "D");
	}

	public function tambih_robih() {
   
		try {				
			$id = $this->input->post('id_masy');
			$ktp = $this->m_masy->cek_ktp($this->input->post('ktp'));
				if($id=='' || $id==null){			
				if($ktp <= 0){
					$data = array(
						'nama_lengkap' => $this->input->post('nama'),
						'id_user' => $this->input->post('id_user'),
						'nama_panggilan' => $this->input->post('nama_pgl'),
						'jns_kel' => $this->input->post('jns_kel'),
						'alamat' => $this->input->post('alamat'),
						'ktp' => $this->input->post('ktp'),
						'hp' => $this->input->post('hp'),
						'kabupaten' => $this->input->post('kabupaten'),
						'kecamatan' => $this->input->post('kecamatan'),
						'kelurahan' => $this->input->post('kelurahan'),
						'pekerjaan' => $this->input->post('pekerjaan'),
						'penghasilan' => $this->input->post('penghasilan'),
						'umur' => $this->input->post('umur'),
						'pendidikan' => $this->input->post('pendidikan'),
						'anggota_kel' => $this->input->post('keluarga'),
						'no_tps' => $this->input->post('no_tps'),
						'profil' => $this->input->post('profil'),
					);
					echo '<pre>';
					print_r($data);
					echo '</pre>';die();
					$xss_data = $this->security->xss_clean($data);
					$this->db->insert('ref_masy', $xss_data);
					$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
					$this->tambih();	
				}else{
					$this->session->set_flashdata('message_gagal', 'Data dengan No KTP ini telah terdaftar');
					$this->tambih();	
				}
							
				}else{
				$data = array(
					'nama_lengkap' => $this->input->post('nama'),
					'id_user' => $this->input->post('id_user'),
					'nama_panggilan' => $this->input->post('nama_pgl'),
					'jns_kel' => $this->input->post('jns_kel'),
					'alamat' => $this->input->post('alamat'),
					'ktp' => $this->input->post('ktp'),
					'hp' => $this->input->post('hp'),
					'kabupaten' => $this->input->post('kabupaten'),
					'kecamatan' => $this->input->post('kecamatan'),
					'kelurahan' => $this->input->post('kelurahan'),
					'pekerjaan' => $this->input->post('pekerjaan'),
					'penghasilan' => $this->input->post('penghasilan'),
					'umur' => $this->input->post('umur'),
					'pendidikan' => $this->input->post('pendidikan'),
					'anggota_kel' => $this->input->post('keluarga'),
					'no_tps' => $this->input->post('no_tps'),
					'profil' => $this->input->post('profil'),
				);
				
				$xss_data = $this->security->xss_clean($data);
				$this->db->where('id',$id);
				$this->db->update('ref_masy',$xss_data);		
				
				$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
				$this->robih();
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
		$data['field']=$this->m_masy->get_all(array('id'=>$id));
		$data['breadcrumbs'] = array(
				array (
					'link' => '/ref_masy',
					'name' => 'Home'
				)
			);
		$data['judul_form']="Ubah ";
		$data['sub_judul_form']="Data Masyarakat";
		$data['kabupaten']=$this->m_masy->get_kab();
		$data['pekerjaan']=$this->m_masy->get_pekerjaan();
		$data['penghasilan']=$this->m_masy->get_penghasilan();
		$data['umur']=$this->m_masy->get_umur();
		$data['pendidikan']=$this->m_masy->get_pendidikan();
		$data['profil']=$this->m_masy->get_profil();
		$this->template->load('template_frontend','v_add',$data);
   }
   
	public function hupus() {
  
		$id=$this->uri->segment(3);
		try {
			$this->db->where('id',$id);
			$this->db->delete('ref_masy');
			redirect('ref_masy');
		}
		catch(Exception $err)
		{
			log_message("error",$err->getMessage());
			return show_error($err->getMessage());
		}
   }
}
