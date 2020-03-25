<?php
class Ref_saksi extends CI_Controller{

    public function __construct() {
		parent::__construct();
		$this->atos_tiasa_leubeut();
		$this->load->model('m_saksi');
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
		$qry = "SELECT ref_saksi.id,id_masy,sedia,terlibat,tingkat,rekomendasi,valid_rekomendasi,nama_lengkap,ktp,alamat FROM ref_saksi
INNER JOIN ref_masy ON ref_saksi.id_masy=ref_masy.id";
		if ($id_user_group == 1 || $id_user_group == 2) {
			if ($this->session->userdata('s_cari_global')!="") {
				$qry.="  WHERE nama_lengkap like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
			} 
			elseif ($this->session->userdata('s_cari_global')=="") {
				$this->session->unset_userdata('s_cari_global');
			} 	
		}else{
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
				'link' => '/ref_saksi',
				'name' => 'Home'
			)
		);
		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$user_group=$this->session->userdata('sesi_user_group');
		$data['sub_judul_form']="Data Saksi";
		if($user_group == 3 || $user_group == 5){
			$this->template->load('template_frontend','v_index',$data);
		}else{
			$this->template->load('template_frontend','v_validasi',$data);
		}
				
	}

	public function ajx_user(){
		$id_user_group = $this->session->userdata('sesi_user_group');
		$id = $this->session->userdata('sesi_id');
		$nama = strip_tags(trim($_GET['nama_user']));
		if($id_user_group == 1 || $id_user_group == 2){
			$query = $this->m_saksi->get_nama($nama);
		}else{
			$query = $this->m_saksi->get_namabyid($nama,$id);
		}
		$data = array();
		foreach ($query as $key) {
			$arrayName = array('id' =>$key->id,'text' =>$key->nama_lengkap);
			array_push($data,$arrayName);
		}
		$myJSON = json_encode($data);

        echo $myJSON;
	}

	public function show_index(){
		$sedia = $this->input->post('sedia');
		$data['sedia'] = $sedia;
		$this->load->view('v_saksi',$data);
	}
	
	public function tambih() {
		$data['breadcrumbs'] = array(
			array (
				'link' => '/ref_saksi',
				'name' => 'Home'
			)
		);
		$data['judul_form']="Data";
		$data['sub_judul_form']="Saksi";
		$this->template->load('template_frontend','v_add',$data);
	}
	
	public function validasi(){
		$validasi = $this->input->post('validasi');
		foreach($validasi as $key){
			$data = array(
				'valid_rekomendasi' => "Sudah",
			);
			$xss_data = $this->security->xss_clean($data);
			$this->db->where('id',$key);
			$this->db->update('ref_saksi',$xss_data);		
			
			$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
		}
		redirect('ref_saksi');
	}

	public function un_validate(){
		$id=$this->uri->segment(3);
		$data = array(
			'valid_rekomendasi' => "Belum",
		);
		$xss_data = $this->security->xss_clean($data);
		$this->db->where('id',$id);
		$this->db->update('ref_saksi',$xss_data);		
		
		$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
		redirect('ref_saksi');
	}

	public function cetak(){
		$id=$this->uri->segment(3);
		$query = $this->m_saksi->get_masy($id);
		$data = [
			'nama' => $query['nama_lengkap'],
			'no_ktp' => $query['ktp'],
			'alamat' => $query['alamat'],
			'profil' => $query['rekomendasi'],
			'no_tps' => $query['no_tps'],
			'barcode'=> site_url().'ref_saksi/cetak/'.$id
		];
		// $this->load->view('v_cetak1',$data);
		ini_set('memory_limit', '512M');
		set_time_limit (60);
		$html = $this->load->view('v_cetak1',$data,true);
		$filename="Kartu Saksi Masyarakat.pdf";
		$this->load->library('pdf');
		$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8'); 
		$this->pdf->pdf->WriteHTML($html);
		$this->pdf->pdf->Output($filename, "D");
	}

	public function tambih_robih() {
		try {				
			$data = array(
				'id_masy' => $this->input->post('nama_lengkap'),
				'sedia' => $this->input->post('sedia'),
				'terlibat' => $this->input->post('terlibat'),
				'tingkat' => $this->input->post('tingkat'),
				'rekomendasi' => $this->input->post('rekomendasi'),
				'valid_rekomendasi' => "Belum",
			);
			$xss_data = $this->security->xss_clean($data);
			$this->db->insert('ref_saksi', $xss_data);
			$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
			$this->tambih();		
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
				$this->db->delete('ref_saksi');
				redirect('ref_saksi');
			}
			catch(Exception $err)
			{
				log_message("error",$err->getMessage());
				return show_error($err->getMessage());
			}
   }
}
