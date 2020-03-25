<?php
class Ref_survey extends CI_Controller{

    public function __construct() {
		parent::__construct();
		$this->load->model('m_survey');
    }
    
    public function index() {
		$id_user_group = $this->session->userdata('sesi_user_group');
		$id_user = $this->session->userdata('sesi_id');
		if (isset($_POST['cari_global'])) {
			$data1 = array('s_cari_global' => $_POST['cari_global']);
			$this->session->set_userdata($data1);			
		}
			
		$per_page = 20;  
		$qry = "SELECT ref_survey.id,id_masy,paslon_pil,paslon_kenal,target,saingan,pengaruh,nama_lengkap,ktp,alamat,nm_cagub,nm_cawagub FROM ref_survey
		INNER JOIN ref_masy ON ref_survey.id_masy=ref_masy.id
		INNER JOIN ref_calon ON ref_survey.paslon_pil=ref_calon.id";

		if ($id_user_group == 1 || $id_user_group == 2) {
			if ($this->session->userdata('s_cari_global')!="") {
				$qry.="  WHERE nama_lengkap like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
				} 
				elseif ($this->session->userdata('s_cari_global')=="") {
				$this->session->unset_userdata('s_cari_global');
				} 	
		}else {
			$qry .=" WHERE ref_masy.id_user=$id_user";
			if ($this->session->userdata('s_cari_global')!="") {
				$qry.="  AND nama_lengkap like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
				} 
				elseif ($this->session->userdata('s_cari_global')=="") {
				$this->session->unset_userdata('s_cari_global');
				} 	
		}
		

		$qry.= " ORDER BY nama_lengkap asc"; 

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
		$config['base_url']= base_url().'/ref_survey/index'; 
		$config['suffix'] = '?'.http_build_query($_GET, '', "&"); 
		$this->pagination->initialize($config);
		$data['paginglinks'] = $this->pagination->create_links();    
		$data['per_page'] = $this->uri->segment(3);      
		$data['offset'] = $offset ;

		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}

		$qry .= " limit {$per_page} offset {$offset} ";
		$data['ListData'] = $this->db->query($qry)->result();
		$data['breadcrumbs'] = array(
			array (
				'link' => '/ref_survey',
				'name' => 'Home'
			)
		);
		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$data['sub_judul_form']="Data Survey";
		$this->template->load('template_frontend','v_index',$data);		
	}

	public function ajx_user(){
		$id_user_group = $this->session->userdata('sesi_user_group');
		$id = $this->session->userdata('sesi_id');
		$nama = strip_tags(trim($_GET['nama_user']));
		if($id_user_group == 1 || $id_user_group == 2){
			$query = $this->m_survey->get_nama($nama);
		}else{
			$query = $this->m_survey->get_namabyid($nama,$id);
		}
		$data = array();
		foreach ($query as $key) {
			$arrayName = array('id' =>$key->id,'text' =>$key->nama_lengkap);
			array_push($data,$arrayName);
		}
		$myJSON = json_encode($data);

        echo $myJSON;
	}
	
	public function cetak_kosong(){
		$data['s']="s";
		ini_set('memory_limit', '512M');
		set_time_limit (60);
		$html = $this->load->view('v_kosong',$data,true);
		$filename="Form Survey.pdf";
		$this->load->library('pdf');
		$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8'); 
		$this->pdf->pdf->WriteHTML($html);
		$this->pdf->pdf->Output($filename, "D");
	}

	public function tambih() {
		$data['breadcrumbs'] = array(
			array (
				'link' => '/ref_survey',
				'name' => 'Home'
			)
		);
		$data['judul_form']="Survey";
		$data['sub_judul_form']="Pemilih";
		$data['paslon'] = $this->m_survey->get_calon();
		$data['tokoh'] = $this->m_survey->get_tokoh();
		$this->template->load('template_frontend','v_add',$data);
    }

	public function tambih_robih() {
		try {
			$id_masy = $this->input->post('nama_lengkap');
			$quecheck = $this->m_survey->check_survey($id_masy);
			if($quecheck > 0){
				$this->session->set_flashdata('message_gagal', 'Maaf, Akun ini telah melakukan Survey sebelumnya');
				$this->tambih();
			}else{
				$kelurahan = $this->m_survey->get_masy($id_masy);
				$data = array(
					'id_masy' => $this->input->post('nama_lengkap'),
					'id_kel' => $kelurahan->kelurahan,
					'paslon_pil' => $this->input->post('paslon_pil'),
					'paslon_kenal' => $this->input->post('paslon_kenal'),
					'target' => $this->input->post('target'),
					'saingan' => $this->input->post('saingan'),
					'pengaruh' => $this->input->post('pengaruh'),
				);
				$xss_data = $this->security->xss_clean($data);
				$this->db->insert('ref_survey', $xss_data);
				$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
				$this->tambih();
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
			$this->db->delete('ref_survey');
			redirect('ref_survey');
		}
		catch(Exception $err)
		{
			log_message("error",$err->getMessage());
			return show_error($err->getMessage());
		}
   }
}
