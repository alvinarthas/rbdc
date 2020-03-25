<?php
class Ref_surdet extends CI_Controller{

    public function __construct() {
		parent::__construct();
		$this->atos_tiasa_leubeut();
		$this->load->model('m_surdet');
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
		$config['base_url']= base_url().'/ref_surdet/index'; 
		$config['suffix'] = '?'.http_build_query($_GET, '', "&"); 
		$this->pagination->initialize($config);
		$data['paginglinks'] = $this->pagination->create_links();    
		$data['per_page'] = $this->uri->segment(3);      
		$data['offset'] = $offset ;

		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}
		$data['kabupaten'] = $this->m_surdet->get_kab_all();   

		$data['breadcrumbs'] = array(
			array (
				'link' => '/ref_surdet',
				'name' => 'Home'
			)
		);
		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$this->template->load('template_frontend','v_index',$data);		
	}

	public function kec_index(){
		$id_kab = $this->input->post('kabupaten');
		$daerah = $this->input->post('daerah');
		$total_dpt = 0;
		$total_tps = 0;
		$target_dpt = 0;
		$total_calon = 0;
		$calon1 = 0;
		$calon2 = 0;
		$calon3 = 0;
		$calon4 = 0;
		$xcalon = 0;
		$arr_kab = array();
		$kecamatan = $this->m_surdet->get_kec($id_kab);
		foreach ($kecamatan as $kec) {
			$kelurahan = $this->m_surdet->get_kel($kec->id);
			foreach ($kelurahan as $kel) {
				$dpttps = $this->m_surdet->get_dpttps($kel->id);
				if($dpttps->num_rows() > 0){
					$result_dpt = $dpttps->row();
					if($result_dpt->jml_dpt == NULL || $result_dpt->jml_dpt == ''){
						$total_dpt += 0;
					}else{
						$total_dpt += $result_dpt->jml_dpt;
					}
					$total_tps += $result_dpt->jml_tps;
				}else{
					$total_dpt += 0;
					$total_tps += 0;
				}
				$target_dpt += $kel->target;
				$survey = $this->m_surdet->get_survey($kel->id);
				foreach ($survey as $sur) {
					if($sur->paslon_pil == 1){
						$calon1 +=1;
					}elseif ($sur->paslon_pil == 2) {
						$calon2 +=1;
					}elseif ($sur->paslon_pil == 3) {
						$calon3 +=1;
					}elseif ($sur->paslon_pil == 4) {
						$calon4 +=1;
					}elseif ($sur->paslon_pil == 5) {
						$xcalon +=1;
					}
					$total_calon +=1;
				}
			}
			$datak['total_dpt'] = $total_dpt;
			$datak['total_tps'] = $total_tps;
			$datak['target_dpt'] = $target_dpt;
			$datak['calon1'] = $calon1;
			$datak['calon2'] = $calon2;
			$datak['calon3'] = $calon3;
			$datak['calon4'] = $calon4;
			$datak['xcalon'] = $xcalon;
			$datak['kecamatan'] = $kec->kecamatan;
			$datak['sisa_ttl'] = $total_dpt-$total_calon;
			array_push($arr_kab,$datak);
			$total_dpt = 0;
			$total_tps = 0;
			$target_dpt = 0;
			$total_calon = 0;
			$calon1 = 0;
			$calon2 = 0;
			$calon3 = 0;
			$calon4 = 0;
			$xcalon = 0;
		}
		$data['kecall'] = $arr_kab;
		$data['id_kab'] = $id_kab;
		$data['daerah'] = $daerah;
		$this->load->view('index_kecamatan',$data);
	}
	public function kel_index(){
		$id_kab = $this->input->post('kabupaten');
		$id_kec = $this->input->post('kecamatan');
		$daerah = $this->input->post('daerah');
		$total_dpt = 0;
		$total_tps = 0;
		$target_dpt = 0;
		$total_calon = 0;
		$calon1 = 0;
		$calon2 = 0;
		$calon3 = 0;
		$calon4 = 0;
		$xcalon = 0;
		$arr_kab = array();
			$kelurahan = $this->m_surdet->get_kel($id_kec);
			foreach ($kelurahan as $kel) {
				$dpttps = $this->m_surdet->get_dpttps($kel->id);
				if($dpttps->num_rows() > 0){
					$result_dpt = $dpttps->row();
					if($result_dpt->jml_dpt == NULL || $result_dpt->jml_dpt == ''){
						$total_dpt += 0;
					}else{
						$total_dpt += $result_dpt->jml_dpt;
					}
					$total_tps += $result_dpt->jml_tps;
				}else{
					$total_dpt += 0;
					$total_tps += 0;
				}
				$target_dpt += $kel->target;
				$survey = $this->m_surdet->get_survey($kel->id);
				foreach ($survey as $sur) {
					if($sur->paslon_pil == 1){
						$calon1 +=1;
					}elseif ($sur->paslon_pil == 2) {
						$calon2 +=1;
					}elseif ($sur->paslon_pil == 3) {
						$calon3 +=1;
					}elseif ($sur->paslon_pil == 4) {
						$calon4 +=1;
					}elseif ($sur->paslon_pil == 5) {
						$xcalon +=1;
					}
					$total_calon +=1;
				}
				$datak['total_dpt'] = $total_dpt;
				$datak['total_tps'] = $total_tps;
				$datak['target_dpt'] = $target_dpt;
				$datak['calon1'] = $calon1;
				$datak['calon2'] = $calon2;
				$datak['calon3'] = $calon3;
				$datak['calon4'] = $calon4;
				$datak['xcalon'] = $xcalon;
				$datak['kelurahan'] = $kel->kelurahan;
				$datak['sisa_ttl'] = $total_dpt-$total_calon;
				array_push($arr_kab,$datak);
				$total_dpt = 0;
				$total_tps = 0;
				$total_calon = 0;
				$calon1 = 0;
				$calon2 = 0;
				$target_dpt = 0;
				$calon3 = 0;
				$calon4 = 0;
				$xcalon = 0;
			}
		$data['kelall'] = $arr_kab;
		$data['id_kab'] = $id_kab;
		$data['daerah'] = $daerah;
		$data['id_kec'] = $id_kec;
		$this->load->view('index_kelurahan',$data);
	}

	public function cetak_excel_kec(){
		$id_kab = $this->uri->segment(4);
		$daerah = $this->uri->segment(3);
		$total_dpt = 0;
		$total_tps = 0;
		$total_calon = 0;
		$target_dpt = 0;
		$calon1 = 0;
		$calon2 = 0;
		$calon3 = 0;
		$calon4 = 0;
		$xcalon = 0;
		$arr_kab = array();
		$kecamatan = $this->m_surdet->get_kec($id_kab);
		foreach ($kecamatan as $kec) {
			$kelurahan = $this->m_surdet->get_kel($kec->id);
			foreach ($kelurahan as $kel) {
				$dpttps = $this->m_surdet->get_dpttps($kel->id);
				if($dpttps->num_rows() > 0){
					$result_dpt = $dpttps->row();
					if($result_dpt->jml_dpt == NULL || $result_dpt->jml_dpt == ''){
						$total_dpt += 0;
					}else{
						$total_dpt += $result_dpt->jml_dpt;
					}
					$total_tps += $result_dpt->jml_tps;
				}else{
					$total_dpt += 0;
					$total_tps += 0;
				}
				$target_dpt += $kel->target;
				$survey = $this->m_surdet->get_survey($kel->id);
				foreach ($survey as $sur) {
					if($sur->paslon_pil == 1){
						$calon1 +=1;
					}elseif ($sur->paslon_pil == 2) {
						$calon2 +=1;
					}elseif ($sur->paslon_pil == 3) {
						$calon3 +=1;
					}elseif ($sur->paslon_pil == 4) {
						$calon4 +=1;
					}elseif ($sur->paslon_pil == 5) {
						$xcalon +=1;
					}
					$total_calon +=1;
				}
			}
			$datak['total_dpt'] = $total_dpt;
			$datak['total_tps'] = $total_tps;
			$datak['target_dpt'] = $target_dpt;
			$datak['calon1'] = $calon1;
			$datak['calon2'] = $calon2;
			$datak['calon3'] = $calon3;
			$datak['calon4'] = $calon4;
			$datak['xcalon'] = $xcalon;
			$datak['daerah'] = $kec->kecamatan;
			$datak['sisa_ttl'] = $total_dpt-$total_calon;
			array_push($arr_kab,$datak);
			$total_dpt = 0;
			$total_tps = 0;
			$total_calon = 0;
			$target_dpt = 0;
			$calon1 = 0;
			$calon2 = 0;
			$calon3 = 0;
			$calon4 = 0;
			$xcalon = 0;
		}
		$data = array(
			'filename' => "Rekap Survey per Kecamatan Excel",
			'survey' => $arr_kab,
			'daerah' => $daerah,
			'daerah2' => "Kecamatan"
		);
		$this->load->view('excel_survey',$data);
	}

	public function cetak_excel_kel(){
		$id_kec = $id=$this->uri->segment(4);
		$daerah = $id=$this->uri->segment(3);
		$total_dpt = 0;
		$total_tps = 0;
		$total_calon = 0;
		$target_dpt = 0;
		$calon1 = 0;
		$calon2 = 0;
		$calon3 = 0;
		$calon4 = 0;
		$xcalon = 0;
		$arr_kab = array();
			$kelurahan = $this->m_surdet->get_kel($id_kec);
			foreach ($kelurahan as $kel) {
				$dpttps = $this->m_surdet->get_dpttps($kel->id);
				if($dpttps->num_rows() > 0){
					$result_dpt = $dpttps->row();
					if($result_dpt->jml_dpt == NULL || $result_dpt->jml_dpt == ''){
						$total_dpt += 0;
					}else{
						$total_dpt += $result_dpt->jml_dpt;
					}
					$total_tps += $result_dpt->jml_tps;
				}else{
					$total_dpt += 0;
					$total_tps += 0;
				}
				$target_dpt += $kel->target;
				$survey = $this->m_surdet->get_survey($kel->id);
				foreach ($survey as $sur) {
					if($sur->paslon_pil == 1){
						$calon1 +=1;
					}elseif ($sur->paslon_pil == 2) {
						$calon2 +=1;
					}elseif ($sur->paslon_pil == 3) {
						$calon3 +=1;
					}elseif ($sur->paslon_pil == 4) {
						$calon4 +=1;
					}elseif ($sur->paslon_pil == 5) {
						$xcalon +=1;
					}
					$total_calon +=1;
				}
				$datak['total_dpt'] = $total_dpt;
				$datak['total_tps'] = $total_tps;
				$datak['target_dpt'] = $target_dpt;
				$datak['calon1'] = $calon1;
				$datak['calon2'] = $calon2;
				$datak['calon3'] = $calon3;
				$datak['calon4'] = $calon4;
				$datak['xcalon'] = $xcalon;
				$datak['daerah'] = $kel->kelurahan;
				$datak['sisa_ttl'] = $total_dpt-$total_calon;
				array_push($arr_kab,$datak);
				$target_dpt = 0;
				$total_dpt = 0;
				$total_tps = 0;
				$total_calon = 0;
				$calon1 = 0;
				$calon2 = 0;
				$calon3 = 0;
				$calon4 = 0;
				$xcalon = 0;
			}
		$data = array(
			'filename' => "Rekap Survey per Kelurahan Excel",
			'survey' => $arr_kab,
			'daerah' => $daerah,
			'daerah2' => "Kelurahan"
		);
		$this->load->view('excel_survey',$data);
	}
}
