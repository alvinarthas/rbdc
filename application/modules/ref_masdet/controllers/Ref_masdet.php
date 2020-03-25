<?php
class Ref_masdet extends CI_Controller{

    public function __construct() {
		parent::__construct();
		$this->atos_tiasa_leubeut();
		$this->load->model('m_masdet');
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
		$config['base_url']= base_url().'/ref_masdet/index'; 
		$config['suffix'] = '?'.http_build_query($_GET, '', "&"); 
		$this->pagination->initialize($config);
		$data['paginglinks'] = $this->pagination->create_links();    
		$data['per_page'] = $this->uri->segment(3);      
		$data['offset'] = $offset ;

		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}
		$data['kabupaten'] = $this->m_masdet->get_kab_all();   

		$data['breadcrumbs'] = array(
			array (
				'link' => '/ref_masdet',
				'name' => 'Home'
			)
		);
		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$this->template->load('template_frontend','v_index',$data);		
	}

	public function kab_index(){
		$id_kab = $this->input->post('kabupaten');
		$daerah = $this->input->post('daerah');
		$arr_kab = array();
		$query = $this->m_masdet->super_masy_kab($id_kab);
		foreach ($query as $key) {
			$datap = [
				'ktp' => $key->ktp,
				'nama_lengkap' =>$key->nama_lengkap,
				'alamat' => $key->alamat,
				'kecamatan' => $key->kecamatan,
				'kelurahan' =>$key->kelurahan,
				'no_tps' => $key->no_tps,
				'profil' => $key->profil,
				'hp' => $key->hp,
			];
			array_push($arr_kab,$datap);
		}
		$data['saksi'] = $arr_kab;
		$data['kab'] = $id_kab;
		$this->load->view('index_kabupaten',$data);
	}

	public function kec_index(){
		$id_kec = $this->input->post('kecamatan');
		$daerah = $this->input->post('daerah');
		$arr_kab = array();
		$query = $this->m_masdet->super_masy_kec($id_kec);
		foreach ($query as $key) {
			$datap = [
				'ktp' => $key->ktp,
				'nama_lengkap' =>$key->nama_lengkap,
				'alamat' => $key->alamat,
				'kelurahan' =>$key->kelurahan,
				'no_tps' => $key->no_tps,
				'profil' => $key->profil,
				'hp' => $key->hp,
			];
			array_push($arr_kab,$datap);
		}
		$data['saksi'] = $arr_kab;
		$data['kec'] = $id_kec;
		$this->load->view('index_kecamatan',$data);
	}

	public function kel_index(){
		$id_kel = $this->input->post('kelurahan');
		$daerah = $this->input->post('daerah');
		$arr_kab = array();
		$query = $this->m_masdet->super_masy_kel($id_kel);
		foreach ($query as $key) {
			$datap = [
				'ktp' => $key->ktp,
				'nama_lengkap' =>$key->nama_lengkap,
				'alamat' => $key->alamat,
				'no_tps' => $key->no_tps,
				'profil' => $key->profil,
				'hp' => $key->hp,
			];
			array_push($arr_kab,$datap);
		}
		$data['saksi'] = $arr_kab;
		$data['kel'] = $id_kel;
		$this->load->view('index_kelurahan',$data);
	}

	public function kab_excel(){
		$id_kab = $this->uri->segment(3);
		$daerah = $this->input->post('daerah');
		$arr_kab = array();
		$query = $this->m_masdet->super_masy_kab($id_kab);
		foreach ($query as $key) {
			$datap = [
				'ktp' => $key->ktp,
				'nama_lengkap' =>$key->nama_lengkap,
				'alamat' => $key->alamat,
				'kecamatan' => $key->kecamatan,
				'kelurahan' =>$key->kelurahan,
				'no_tps' => $key->no_tps,
				'profil' => $key->profil,
				'hp' => $key->hp,
			];
			array_push($arr_kab,$datap);
		}
		$data['saksi'] = $arr_kab;
		$data['filename'] = "Rekap Masyarakat per Kabupaten";
		$this->load->view('excel_kabupaten',$data);
	}

	public function kec_excel(){
		$id_kec = $this->uri->segment(3);
		$daerah = $this->input->post('daerah');
		$arr_kab = array();
		$query = $this->m_masdet->super_masy_kec($id_kec);
		foreach ($query as $key) {
			$datap = [
				'ktp' => $key->ktp,
				'nama_lengkap' =>$key->nama_lengkap,
				'alamat' => $key->alamat,
				'kelurahan' =>$key->kelurahan,
				'no_tps' => $key->no_tps,
				'profil' => $key->profil,
				'hp' => $key->hp,
			];
			array_push($arr_kab,$datap);
		}
		$data['saksi'] = $arr_kab;
		$data['filename'] = "Rekap Masyarakat per Kecamatan";
		$this->load->view('excel_kecamatan',$data);
	}

	public function kel_excel(){
		$id_kel = $this->uri->segment(3);
		$arr_kab = array();
		$query = $this->m_masdet->super_masy_kel($id_kel);
		foreach ($query as $key) {
			$datap = [
				'ktp' => $key->ktp,
				'nama_lengkap' =>$key->nama_lengkap,
				'alamat' => $key->alamat,
				'no_tps' => $key->no_tps,
				'profil' => $key->profil,
				'hp' => $key->hp,
			];
			array_push($arr_kab,$datap);
		}
		$data['saksi'] = $arr_kab;
		$data['filename'] = "Rekap Masyarakat per Kelurahan";
		$this->load->view('excel_kelurahan',$data);
	}
}