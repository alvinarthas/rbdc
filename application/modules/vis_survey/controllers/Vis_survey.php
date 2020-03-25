<?php
class Vis_survey extends CI_Controller{

    public function __construct() {
			parent::__construct();
			$this->load->model('m_visurvey');
    }
    
    public function index() {
		$data['breadcrumbs'] = array(
			array (
				'link' => '/vis_survey',
				'name' => 'Home'
			)
		);
		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$data['sub_judul_form']="Data Survey";
		$data['kabupaten'] = $this->m_visurvey->get_kab_all();
		$this->template->load('template_frontend','v_index',$data);		
	}

    public function ajx_choice(){
		$jenis = $this->input->post('jenis');
		if($jenis == "c1"){
			$data['kabupaten'] = $this->m_visurvey->get_kab_all();
			$this->load->view('v_daerahkerja',$data);
		}elseif($jenis == "c2"){
			$data['kabupaten'] = $this->m_visurvey->get_kab_all();
			$this->load->view('v_daerahkerja2',$data);
		}elseif($jenis == "c4"){
			$data['kabupaten'] = $this->m_visurvey->get_kab_all();
			$this->load->view('v_sainganpaslon',$data);
		}elseif($jenis == "c5"){
			$data['kabupaten'] = $this->m_visurvey->get_kab_all();
			$this->load->view('v_tokohpengaruh',$data);
		}
	}

	public function get_jenis(){
		$kategori = $this->input->post('kategori');
		$query = $this->m_visurvey->get_tbl($kategori);
		$output = '<option value=""disabled selected> Pilih Data </option>';
		foreach ($query as $key) {
			$output .= '<option value="'.$key->id.'">'.$key->$kategori.'</option>';
		}
		echo json_encode($output);	
	}

	public function all_kat(){
		$total_calon = 0;
		$target = 0;
		$calon1 = 0;
		$calon2 = 0;
		$calon3 = 0;
		$calon4 = 0;
		$xcalon = 0;
		$arr_kab = array();
		$pie_kab = array();
		$pie_kab2 = array();
		$pie_data = array();$pie_data2 = array();
		$kabupaten = $this->m_visurvey->get_kab_all();
		foreach ($kabupaten as $kab) {
			$kecamatan = $this->m_visurvey->get_kec($kab->id);
			foreach ($kecamatan as $kec) {
				$kelurahan = $this->m_visurvey->get_kel($kec->id);
				foreach ($kelurahan as $kel) {
					$target += $kel->target;
					$survey = $this->m_visurvey->get_survey($kel->id);
					foreach ($survey as $sur) {
						if($sur->paslon_pil == 1){
							$calon1 +=1;
							$total_calon +=1;
						}elseif ($sur->paslon_pil == 2) {
							$calon2 +=1;
							$total_calon +=1;
						}elseif ($sur->paslon_pil == 3) {
							$calon3 +=1;
							$total_calon +=1;
						}elseif ($sur->paslon_pil == 4) {
							$calon4 +=1;
							$total_calon +=1;
						}elseif ($sur->paslon_pil == 5) {
							$xcalon +=1;
							$total_calon +=1;
						}
						
					}
				}
			}
		}
		// CALON 1
		$datak['name'] = "Syamsuar - Edy Nasution";
		$datak['points'] = $calon1;
		$datak['color'] = "#bfbfbf";
		if($calon1 == 0 || $total_calon == 0){
			$datak['persen'] = 0;
		}else{
			$datak['persen'] = 100*($calon1/$total_calon);
		}
		$datak['bullet'] = base_url().'assets_users/paslon/4.png';
		array_push($arr_kab,$datak);

		// CALON 2
		$datak['name'] = "Lukman Edy - Hardianto";
		$datak['points'] = $calon2;
		$datak['color'] = "#00cc00";
		if($calon2 == 0 || $total_calon == 0){
			$datak['persen'] = 0;
		}else{
			$datak['persen'] = 100*($calon2/$total_calon);
		}
		$datak['bullet'] = base_url().'assets_users/paslon/2.png';
		array_push($arr_kab,$datak);

		// CALON 3
		$datak['name'] = "Firdaus - Rusli Effendi";
		$datak['points'] = $calon3;
		$datak['color'] = "#0099ff";
		if($calon3 == 0 || $total_calon == 0){
			$datak['persen'] = 0;
		}else{
			$datak['persen'] = 100*($calon3/$total_calon);
		}
		$datak['bullet'] = base_url().'assets_users/paslon/3.png';;
		array_push($arr_kab,$datak);

		// CALON 4
		$datak['name'] = "Andi Rachman - Suyatno";
		$datak['points'] = $calon4;
		$datak['color'] = "#ffff1a";
		if($calon4 == 0 || $total_calon == 0){
			$datak['persen'] = 0;
		}else{
			$datak['persen'] = 100*($calon4/$total_calon);
		}
		$datak['bullet'] = base_url().'assets_users/paslon/1.png';;
		array_push($arr_kab,$datak);

		// X CALON
		$datak['name'] = "Belum Mengetahui - Pilihan";
		$datak['points'] = $xcalon;
		$datak['color'] = "#000000";
		if($xcalon == 0 || $total_calon == 0){
			$datak['persen'] = 0;
		}else{
			$datak['persen'] = 100*($xcalon/$total_calon);
		}
		$datak['bullet'] = base_url().'assets_users/paslon/5.png';;
		array_push($arr_kab,$datak);

		// SET PIE 1
		$datap['country'] = "Total yang sudah Melakukan Survey";
		$datap['value'] = $total_calon;
		array_push($pie_kab,$datap);
		$total =$this->m_visurvey->count_allmasy();
		$sisa = $total-$total_calon;
		$datap['country'] = "Total Yang Belum Melakukan Survey";
		$datap['value'] = $sisa;
		array_push($pie_kab,$datap);

		// SET PIE 2	
		$datap2['country'] = "Pemilih Lukman-Hardi";
		$datap2['value'] = $calon2;
		array_push($pie_kab2,$datap2);
		$datap2['country'] = "Sisa Target DPT yang belum di Survey";
		$datap2['value'] = $target-$calon4;
		array_push($pie_kab2,$datap2);

		// SET PIE DATA 1
		$datapie['title'] = "Target Suara DPT";
		$datapie['value'] = $target;
		array_push($pie_data,$datapie);

		// SET PIE DATA 1
		$datapie2['title'] = "Total Pemilih Telah di Survey";
		$datapie2['value'] = $total;
		array_push($pie_data2,$datapie2);

		$data['chart'] = json_encode($arr_kab);
		$data['piechart'] = json_encode($pie_kab);
		$data['piechart2'] = json_encode($pie_kab2);
		$data['piedata'] = json_encode($pie_data);
		$data['piedata2'] = json_encode($pie_data2);

		$data['kategori'] = "Semua Pekerjaan";
		$data['daerah'] = "Provinsi Riau";
		$this->load->view('v_paslon_kab',$data);
	}

	public function all_job(){
		$kategori = $this->input->post('kategori');
		$jenis2 = $this->input->post('jenis2');
		$total_calon = 0;
		$target = 0;
		$calon1 = 0;
		$calon2 = 0;
		$calon3 = 0;
		$calon4 = 0;
		$xcalon = 0;
		$arr_kab = array();
		$pie_kab = array();
		$pie_kab2 = array();
		$pie_data = array();$pie_data2 = array();
		$kabupaten = $this->m_visurvey->get_kab_all();
		foreach ($kabupaten as $kab) {
			$kecamatan = $this->m_visurvey->get_kec($kab->id);
			foreach ($kecamatan as $kec) {
				$kelurahan = $this->m_visurvey->get_kel($kec->id);
				foreach ($kelurahan as $kel) {
					$target += $kel->target;
					$masy = $this->m_visurvey->get_masy($kategori,$jenis2,$kel->id);
					foreach ($masy as $mas) {
						$survey = $this->m_visurvey->get_row_survey($mas->id);
						if($survey['paslon_pil'] == 1){
							$calon1 +=1;
							$total_calon +=1;
						}elseif ($survey['paslon_pil'] == 2) {
							$calon2 +=1;
							$total_calon +=1;
						}elseif ($survey['paslon_pil'] == 3) {
							$calon3 +=1;
							$total_calon +=1;
						}elseif ($survey['paslon_pil'] == 4) {
							$calon4 +=1;
							$total_calon +=1;
						}elseif ($survey['paslon_pil'] == 5) {
							$xcalon +=1;
							$total_calon +=1;
						}
					}
				}
			}
		}
		// CALON 1
		$datak['name'] = "Syamsuar - Edy Nasution";
		$datak['points'] = $calon1;
		$datak['color'] = "#bfbfbf";
		if($calon1 == 0 || $total_calon == 0){
			$datak['persen'] = 0;
		}else{
			$datak['persen'] = 100*($calon1/$total_calon);
		}
		$datak['bullet'] = base_url().'assets_users/paslon/4.png';
		array_push($arr_kab,$datak);

		// CALON 2
		$datak['name'] = "Lukman Edy - Hardianto";
		$datak['points'] = $calon2;
		$datak['color'] = "#00cc00";
		if($calon2 == 0 || $total_calon == 0){
			$datak['persen'] = 0;
		}else{
			$datak['persen'] = 100*($calon2/$total_calon);
		}
		$datak['bullet'] = base_url().'assets_users/paslon/2.png';
		array_push($arr_kab,$datak);

		// CALON 3
		$datak['name'] = "Firdaus - Rusli Effendi";
		$datak['points'] = $calon3;
		$datak['color'] = "#0099ff";
		if($calon3 == 0 || $total_calon == 0){
			$datak['persen'] = 0;
		}else{
			$datak['persen'] = 100*($calon3/$total_calon);
		}
		$datak['bullet'] = base_url().'assets_users/paslon/3.png';;
		array_push($arr_kab,$datak);

		// CALON 4
		$datak['name'] = "Andi Rachman - Suyatno";
		$datak['points'] = $calon4;
		$datak['color'] = "#ffff1a";
		if($calon4 == 0 || $total_calon == 0){
			$datak['persen'] = 0;
		}else{
			$datak['persen'] = 100*($calon4/$total_calon);
		}
		$datak['bullet'] = base_url().'assets_users/paslon/1.png';;
		array_push($arr_kab,$datak);

		// X CALON
		$datak['name'] = "Belum Mengetahui Pilihan";
		$datak['points'] = $xcalon;
		$datak['color'] = "#000000";
		if($xcalon == 0 || $total_calon == 0){
			$datak['persen'] = 0;
		}else{
			$datak['persen'] = 100*($xcalon/$total_calon);
		}
		$datak['bullet'] = base_url().'assets_users/paslon/5.png';;
		array_push($arr_kab,$datak);

		// SET PIE 1
		$datap['country'] = "Total yang sudah Melakukan Survey";
		$datap['value'] = $total_calon;
		array_push($pie_kab,$datap);
		$total =$this->m_visurvey->count_allmasy();
		$sisa = $total-$total_calon;
		$datap['country'] = "Total Yang Belum Melakukan Survey";
		$datap['value'] = $sisa;
		array_push($pie_kab,$datap);

		// SET PIE 2	
		$datap2['country'] = "Pemilih Lukman-Hardi";
		$datap2['value'] = $calon2;
		array_push($pie_kab2,$datap2);
		$datap2['country'] = "Sisa Target DPT yang belum di Survey";
		$datap2['value'] = $target-$calon2;
		array_push($pie_kab2,$datap2);

		// SET PIE DATA 1
		$datapie['title'] = "Target Suara DPT";
		$datapie['value'] = $target;
		array_push($pie_data,$datapie);

		// SET PIE DATA 1
		$datapie2['title'] = "Total Pemilih Telah di Survey";
		$datapie2['value'] = $total;
		array_push($pie_data2,$datapie2);

		$data['chart'] = json_encode($arr_kab);
		$data['piechart'] = json_encode($pie_kab);
		$data['piechart2'] = json_encode($pie_kab2);
		$data['piedata'] = json_encode($pie_data);
		$data['piedata2'] = json_encode($pie_data2);
		$query = $this->m_visurvey->row_tbl($kategori,$jenis2);
		$data['kategori'] = $kategori." per ".$query->$kategori;
		$data['daerah'] = "Provinsi Riau";
		$this->load->view('v_paslon_kab',$data);
	}

	public function kat_all(){
		$kategori = $this->input->post('kategori');
		$id_kab = $this->input->post('id_kab');
		$id_kec = $this->input->post('id_kec');
		$id_kel = $this->input->post('id_kel');
		$daerah = $this->input->post('daerah');
		$jenis = $this->input->post('jenis');
		$total_calon = 0;
		$target = 0;
		$calon1 = 0;
		$calon2 = 0;
		$calon3 = 0;
		$calon4 = 0;
		$xcalon = 0;
		$arr_kab = array();
		$pie_kab = array();
		$pie_kab2 = array();
		$pie_data = array();$pie_data2 = array();
		$kabupaten = $this->m_visurvey->get_kab($id_kab);
		foreach ($kabupaten as $kab) {
			if($daerah == "kabupaten"){
				$kecamatan = $this->m_visurvey->get_kec($kab->id);
			}else{
				$kecamatan = $this->m_visurvey->get_kec_id($id_kec);
			}

			foreach ($kecamatan as $kec) {
				if($daerah == "kelurahan"){
					$kelurahan = $this->m_visurvey->get_kel_id($id_kel);
				}else{
					$kelurahan = $this->m_visurvey->get_kel($kec->id);
				}
	
				foreach ($kelurahan as $kel) {
					$target += $kel->target;
					$survey = $this->m_visurvey->get_survey($kel->id);
					foreach ($survey as $sur) {
						if($sur->paslon_pil == 1){
							$calon1 +=1;
							$total_calon +=1;
						}elseif ($sur->paslon_pil == 2) {
							$calon2 +=1;
							$total_calon +=1;
						}elseif ($sur->paslon_pil == 3) {
							$calon3 +=1;
							$total_calon +=1;
						}elseif ($sur->paslon_pil == 4) {
							$calon4 +=1;
							$total_calon +=1;
						}elseif ($sur->paslon_pil == 5) {
							$xcalon +=1;
							$total_calon +=1;
						}
						
					}
				}
			}
			$datak['name'] = "Syamsuar - Edy Nasution";
			$datak['points'] = $calon1;
			$datak['color'] = "#bfbfbf";
			if($calon1 == 0 || $total_calon == 0){
				$datak['persen'] = 0;
			}else{
				$datak['persen'] = 100*($calon1/$total_calon);
			}
			$datak['bullet'] = base_url().'assets_users/paslon/4.png';
			array_push($arr_kab,$datak);

			$datak['name'] = "Lukman Edy - Hardianto";
			$datak['points'] = $calon2;
			$datak['color'] = "#00cc00";
			if($calon2 == 0 || $total_calon == 0){
				$datak['persen'] = 0;
			}else{
				$datak['persen'] = 100*($calon2/$total_calon);
			}
			$datak['bullet'] = base_url().'assets_users/paslon/2.png';
			array_push($arr_kab,$datak);

			$datak['name'] = "Firdaus - Rusli Effendi";
			$datak['points'] = $calon3;
			$datak['color'] = "#0099ff";
			if($calon3 == 0 || $total_calon == 0){
				$datak['persen'] = 0;
			}else{
				$datak['persen'] = 100*($calon3/$total_calon);
			}
			$datak['bullet'] = base_url().'assets_users/paslon/3.png';;
			array_push($arr_kab,$datak);

			$datak['name'] = "Andi Rachman - Suyatno";
			$datak['points'] = $calon4;
			$datak['color'] = "#ffff1a";
			if($calon4 == 0 || $total_calon == 0){
				$datak['persen'] = 0;
			}else{
				$datak['persen'] = 100*($calon4/$total_calon);
			}
			$datak['bullet'] = base_url().'assets_users/paslon/1.png';;
			array_push($arr_kab,$datak);

			$datak['name'] = "Belum Mengetahui Pilihan";
			$datak['points'] = $xcalon;
			$datak['color'] = "#000000";
			if($xcalon == 0 || $total_calon == 0){
				$datak['persen'] = 0;
			}else{
				$datak['persen'] = 100*($xcalon/$total_calon);
			}
			$datak['bullet'] = base_url().'assets_users/paslon/5.png';;
			array_push($arr_kab,$datak);

			$datap['country'] = "Total yang sudah Melakukan Survey";
			$datap['value'] = $total_calon;
			array_push($pie_kab,$datap);
			if($daerah == "kabupaten"){
				$total =$this->m_visurvey->count_daerahmasy($daerah,$id_kab);
			}elseif ($daerah =="kecamatan") {
				$total =$this->m_visurvey->count_daerahmasy($daerah,$id_kec);
			}elseif ($daerah =="kelurahan") {
				$total =$this->m_visurvey->count_daerahmasy($daerah,$id_kel);
			}
			$sisa = $total-$total_calon;
			$datap['country'] = "Total Yang Belum Melakukan Survey";
			$datap['value'] = $sisa;
			array_push($pie_kab,$datap);
			$datap2['country'] = "Pemilih Lukman-Hardi";
			$datap2['value'] = $calon2;
			array_push($pie_kab2,$datap2);
			$datap2['country'] = "Sisa Target DPT yang belum di Survey";
			$datap2['value'] = $target-$calon2;
			array_push($pie_kab2,$datap2);
			$datapie['title'] = "Target Suara DPT";
			$datapie['value'] = $target;
			array_push($pie_data,$datapie);
			$datapie2['title'] = "Total Pemilih Telah di Survey";
			$datapie2['value'] = $total;
			array_push($pie_data2,$datapie2);
		}
		$data['chart'] = json_encode($arr_kab);
		$data['piechart'] = json_encode($pie_kab);
		$data['piechart2'] = json_encode($pie_kab2);
		$data['piedata'] = json_encode($pie_data);
		$data['piedata2'] = json_encode($pie_data2);
		$data['jenis'] = $jenis;
		$data['kategori'] = "Semua Pekerjaan";
		$data['daerah'] = $daerah;
		$this->load->view('v_paslon_kab',$data);
	}

	public function kat_job(){
		$kategori = $this->input->post('kategori');
		$jenis2 = $this->input->post('jenis2');
		$id = $this->input->post('id');
		$id_kab = $this->input->post('id_kab');
		$id_kec = $this->input->post('id_kec');
		$id_kel = $this->input->post('id_kel');
		$daerah = $this->input->post('daerah');
		$jenis = $this->input->post('jenis');
		$total_calon = 0;
		$target = 0;
		$calon1 = 0;
		$calon2 = 0;
		$calon3 = 0;
		$calon4 = 0;
		$xcalon = 0;
		$arr_kab = array();
		$pie_kab = array();
		$pie_kab2 = array();
		$pie_data = array();$pie_data2 = array();
		$kabupaten = $this->m_visurvey->get_kab($id_kab);
		foreach ($kabupaten as $kab) {
			if($daerah == "kabupaten"){
				$kecamatan = $this->m_visurvey->get_kec($kab->id);
			}else{
				$kecamatan = $this->m_visurvey->get_kec_id($id_kec);
			}

			foreach ($kecamatan as $kec) {
				if($daerah == "kelurahan"){
					$kelurahan = $this->m_visurvey->get_kel_id($id_kel);
				}else{
					$kelurahan = $this->m_visurvey->get_kel($kec->id);
				}
	
				foreach ($kelurahan as $kel) {
					$target += $kel->target;
					$masy = $this->m_visurvey->get_masy($kategori,$jenis2,$kel->id);
					foreach ($masy as $mas) {
						$survey = $this->m_visurvey->get_row_survey($mas->id);
						if($survey['paslon_pil'] == 1){
							$calon1 +=1;
							$total_calon +=1;
						}elseif ($survey['paslon_pil'] == 2) {
							$calon2 +=1;
							$total_calon +=1;
						}elseif ($survey['paslon_pil'] == 3) {
							$calon3 +=1;
							$total_calon +=1;
						}elseif ($survey['paslon_pil'] == 4) {
							$calon4 +=1;
							$total_calon +=1;
						}elseif ($survey['paslon_pil'] == 5) {
							$xcalon +=1;
							$total_calon +=1;
						}
					}
				}
			}
			$datak['name'] = "Syamsuar - Edy Nasution";
			$datak['points'] = $calon1;
			$datak['color'] = "#bfbfbf";
			$datak['bullet'] = base_url().'assets_users/paslon/4.png';
			array_push($arr_kab,$datak);
			$datak['name'] = "Lukman Edy - Hardianto";
			$datak['points'] = $calon2;
			$datak['color'] = "#00cc00";
			$datak['bullet'] = base_url().'assets_users/paslon/2.png';
			array_push($arr_kab,$datak);
			$datak['name'] = "Firdaus - Rusli Effendi";
			$datak['points'] = $calon3;
			$datak['color'] = "#0099ff";
			$datak['bullet'] = base_url().'assets_users/paslon/3.png';;
			array_push($arr_kab,$datak);
			$datak['name'] = "Andi Rachman - Suyatno";
			$datak['points'] = $calon4;
			$datak['color'] = "#ffff1a";
			$datak['bullet'] = base_url().'assets_users/paslon/1.png';;
			array_push($arr_kab,$datak);
			$datak['name'] = "Belum Menentukan Pilihan";
			$datak['points'] = $xcalon;
			$datak['color'] = "#000000";
			$datak['bullet'] = base_url().'assets_users/paslon/5.png';;
			array_push($arr_kab,$datak);
			$datap['country'] = "Total Pemilih";
			$datap['value'] = $total_calon;
			array_push($pie_kab,$datap);
			if($daerah == "kabupaten"){
				$total =$this->m_visurvey->count_katmasy($kategori,$jenis2,$daerah,$id_kab);
			}elseif ($daerah =="kecamatan") {
				$total =$this->m_visurvey->count_katmasy($kategori,$jenis2,$daerah,$id_kec);
			}elseif ($daerah =="kelurahan") {
				$total =$this->m_visurvey->count_katmasy($kategori,$jenis2,$daerah,$id_kel);
			}
			$sisa = $total->total-$total_calon;
			$datap['country'] = "Total Yang Belum Memilih";
			$datap['value'] = $sisa;
			array_push($pie_kab,$datap);
			$datap2['country'] = "Total Yang Telah Memilih Lukman Edy";
			$datap2['value'] = $calon4;
			array_push($pie_kab2,$datap2);
			$datap2['country'] = "Sisa Target Yang Memilih Lukman Edy";
			$datap2['value'] = $target-$calon2;
			array_push($pie_kab2,$datap2);
			$datapie['title'] = "Total Target";
			$datapie['value'] = $target;
			array_push($pie_data,$datapie);
			$datapie2['title'] = "Total Pemilih";
			$datapie2['value'] = $total->total;
			array_push($pie_data2,$datapie2);
		}
		$data['chart'] = json_encode($arr_kab);
		$data['piechart'] = json_encode($pie_kab);
		$data['piechart2'] = json_encode($pie_kab2);
		$data['piedata'] = json_encode($pie_data);
		$data['piedata2'] = json_encode($pie_data2);
		$data['jenis'] = $jenis;
		$query = $this->m_visurvey->row_tbl($kategori,$jenis2);
		$data['kategori'] = $kategori." per ".$query->$kategori;
		$data['daerah'] = $daerah;
		$this->load->view('v_paslon_kab',$data);
	}

	public function kenal_kat_all(){
		$kategori = $this->input->post('kategori');
		$id_kab = $this->input->post('id_kab');
		$id_kec = $this->input->post('id_kec');
		$id_kel = $this->input->post('id_kel');
		$daerah = $this->input->post('daerah');
		$jenis = $this->input->post('jenis');
		$kenal_ya = 0;
		$kenal_tidak = 0;
		$pie_kab = array();

		$kabupaten = $this->m_visurvey->get_kab($id_kab);
		foreach ($kabupaten as $kab) {
			if($daerah == "kabupaten"){
				$kecamatan = $this->m_visurvey->get_kec($kab->id);
			}else{
				$kecamatan = $this->m_visurvey->get_kec_id($id_kec);
			}

			foreach ($kecamatan as $kec) {
				if($daerah == "kelurahan"){
					$kelurahan = $this->m_visurvey->get_kel_id($id_kel);
				}else{
					$kelurahan = $this->m_visurvey->get_kel($kec->id);
				}
	
				foreach ($kelurahan as $kel) {
					$surveyya = $this->m_visurvey->get_ya_survey_all($kel->id);
					$kenal_ya += $surveyya->ya;
					$surveytidak = $this->m_visurvey->get_tidak_survey_all($kel->id);
					$kenal_tidak += $surveytidak->tidak;
				}
			}
			$datap['country'] = "Pemilih yang Kenal";
			$datap['value'] = $kenal_ya;
			array_push($pie_kab,$datap);
			$datap['country'] = "Pemilih yang Tidak Kenal";
			$datap['value'] = $kenal_tidak;
			array_push($pie_kab,$datap);
		}
		$data['piechart'] = json_encode($pie_kab);
		$data['jenis'] = $jenis;
		$data['kategori'] = "Semua Pekerjaan";
		$data['daerah'] = $daerah;
		$this->load->view('v_pie_only',$data);
	}

	public function all_kenal(){
		$kategori = $this->input->post('kategori');
		$id_kab = $this->input->post('id_kab');
		$id_kec = $this->input->post('id_kec');
		$id_kel = $this->input->post('id_kel');
		$daerah = $this->input->post('daerah');
		$jenis = $this->input->post('jenis');
		$kenal_ya = 0;
		$kenal_tidak = 0;
		$pie_kab = array();

		$kabupaten = $this->m_visurvey->get_kab_all();
		foreach ($kabupaten as $kab) {
			$kecamatan = $this->m_visurvey->get_kec($kab->id);

			foreach ($kecamatan as $kec) {
				$kelurahan = $this->m_visurvey->get_kel($kec->id);
	
				foreach ($kelurahan as $kel) {
					$surveyya = $this->m_visurvey->get_ya_survey_all($kel->id);
					$kenal_ya += $surveyya->ya;
					$surveytidak = $this->m_visurvey->get_tidak_survey_all($kel->id);
					$kenal_tidak += $surveytidak->tidak;
				}
			}
		}

		$datap['country'] = "Pemilih yang Kenal";
		$datap['value'] = $kenal_ya;
		array_push($pie_kab,$datap);
		$datap['country'] = "Pemilih yang Tidak Kenal";
		$datap['value'] = $kenal_tidak;
		array_push($pie_kab,$datap);

		$data['piechart'] = json_encode($pie_kab);
		$data['jenis'] = $jenis;
		$data['kategori'] = "Semua Pekerjaan";
		$data['daerah'] = "Provinsi Riau";
		$this->load->view('v_pie_only',$data);
	}

	public function all_kenal_job(){
		$kategori = $this->input->post('kategori');
		$jenis2 = $this->input->post('jenis2');
		$id = $this->input->post('id');
		$id_kab = $this->input->post('id_kab');
		$id_kec = $this->input->post('id_kec');
		$id_kel = $this->input->post('id_kel');
		$daerah = $this->input->post('daerah');
		$jenis = $this->input->post('jenis');
		$kenal_ya = 0;
		$kenal_tidak = 0;
		$pie_kab = array();

		$kabupaten = $this->m_visurvey->get_kab_all();
		foreach ($kabupaten as $kab) {
			$kecamatan = $this->m_visurvey->get_kec($kab->id);

			foreach ($kecamatan as $kec) {
				$kelurahan = $this->m_visurvey->get_kel($kec->id);
	
				foreach ($kelurahan as $kel) {
					$masy = $this->m_visurvey->get_masy($kategori,$jenis2,$kel->id);
					foreach ($masy as $mas) {
						$surveyya = $this->m_visurvey->get_ya_survey_all($mas->id);
						$kenal_ya += $surveyya->ya;
						$surveytidak = $this->m_visurvey->get_tidak_survey_all($mas->id);
						$kenal_tidak += $surveytidak->tidak;
					}
				}
			}
		}
		$datap['country'] = "Pemilih yang Kenal";
		$datap['value'] = $kenal_ya;
		array_push($pie_kab,$datap);
		$datap['country'] = "Pemilih yang Tidak Kenal";
		$datap['value'] = $kenal_tidak;
		array_push($pie_kab,$datap);

		$data['piechart'] = json_encode($pie_kab);
		$data['jenis'] = $jenis;
		$query = $this->m_visurvey->row_tbl($kategori,$jenis2);
		$data['kategori'] = $kategori." per ".$query->$kategori;
		$data['daerah'] = "Provinsi Riau";
		$this->load->view('v_pie_only',$data);
	}

	public function kenal_kat_job(){
		$kategori = $this->input->post('kategori');
		$jenis2 = $this->input->post('jenis2');
		$id = $this->input->post('id');
		$id_kab = $this->input->post('id_kab');
		$id_kec = $this->input->post('id_kec');
		$id_kel = $this->input->post('id_kel');
		$daerah = $this->input->post('daerah');
		$jenis = $this->input->post('jenis');
		$kenal_ya = 0;
		$kenal_tidak = 0;
		$pie_kab = array();

		$kabupaten = $this->m_visurvey->get_kab($id_kab);
		foreach ($kabupaten as $kab) {
			if($daerah == "kabupaten"){
				$kecamatan = $this->m_visurvey->get_kec($kab->id);
			}else{
				$kecamatan = $this->m_visurvey->get_kec_id($id_kec);
			}

			foreach ($kecamatan as $kec) {
				if($daerah == "kelurahan"){
					$kelurahan = $this->m_visurvey->get_kel_id($id_kel);
				}else{
					$kelurahan = $this->m_visurvey->get_kel($kec->id);
				}
	
				foreach ($kelurahan as $kel) {
					$masy = $this->m_visurvey->get_masy($kategori,$jenis2,$kel->id);
					foreach ($masy as $mas) {
						$surveyya = $this->m_visurvey->get_ya_survey_all($mas->id);
						$kenal_ya += $surveyya->ya;
						$surveytidak = $this->m_visurvey->get_tidak_survey_all($mas->id);
						$kenal_tidak += $surveytidak->tidak;
					}
				}
			}
			$datap['country'] = "Pemilih yang Kenal";
			$datap['value'] = $kenal_ya;
			array_push($pie_kab,$datap);
			$datap['country'] = "Pemilih yang Tidak Kenal";
			$datap['value'] = $kenal_tidak;
			array_push($pie_kab,$datap);
		}
		$data['piechart'] = json_encode($pie_kab);
		$data['jenis'] = $jenis;
		$query = $this->m_visurvey->row_tbl($kategori,$jenis2);
		$data['kategori'] = $kategori." per ".$query->$kategori;
		$data['daerah'] = $daerah;
		$this->load->view('v_pie_only',$data);
	}

	public function saingan(){
		$id_kab = $this->input->post('id_kab');
		$id_kec = $this->input->post('id_kec');
		$id_kel = $this->input->post('id_kel');
		$daerah = $this->input->post('daerah');
		$jenis = $this->input->post('jenis');
		$total_saingan = 0;
		$calon1 = 0;
		$calon3 = 0;
		$calon4 = 0;
		$pie_kab = array();

		$kabupaten = $this->m_visurvey->get_kab($id_kab);
		foreach ($kabupaten as $kab) {
			if($daerah == "kabupaten"){
				$kecamatan = $this->m_visurvey->get_kec($kab->id);
			}else{
				$kecamatan = $this->m_visurvey->get_kec_id($id_kec);
			}

			foreach ($kecamatan as $kec) {
				if($daerah == "kelurahan"){
					$kelurahan = $this->m_visurvey->get_kel_id($id_kel);
				}else{
					$kelurahan = $this->m_visurvey->get_kel($kec->id);
				}
	
				foreach ($kelurahan as $kel) {
					$survey = $this->m_visurvey->get_survey($kel->id);
					foreach ($survey as $sur) {
						if($sur->saingan == 1){
							$calon1 +=1;
						}elseif ($sur->saingan == 3) {
							$calon3 +=1;
						}elseif ($sur->saingan == 4) {
							$calon4 +=1;
						}
					}
				}
			}
			$datap['country'] = "Syamsuar - Edy Nasution";
			$datap['value'] = $calon1;
			array_push($pie_kab,$datap);
			$datap['country'] = "Firdaus - Rusli Effendi";
			$datap['value'] = $calon3;
			array_push($pie_kab,$datap);
			$datap['country'] = "Andi Rachman - Suyatno";
			$datap['value'] = $calon4;
			array_push($pie_kab,$datap);
		}
		$data['piechart'] = json_encode($pie_kab);
		$data['jenis'] = $jenis;
		$data['daerah'] = $daerah;
		$this->load->view('v_pie_only',$data);
	}

	public function tokoh_pengaruh(){
		$id_kab = $this->input->post('id_kab');
		$id_kec = $this->input->post('id_kec');
		$id_kel = $this->input->post('id_kel');
		$daerah = $this->input->post('daerah');
		$jenis = $this->input->post('jenis');
		$total_saingan = 0;
		$tokoh1 = 0;$tokoh2 = 0;$tokoh3 = 0;
		$tokoh4 = 0;$tokoh5 = 0;$tokoh6 = 0;
		$tokoh7 = 0;$tokoh8 = 0;$tokoh9 = 0;
		$tokoh10 = 0;$tokoh11 = 0;$tokoh12 = 0;
		$pie_kab = array();

		$kabupaten = $this->m_visurvey->get_kab($id_kab);
		foreach ($kabupaten as $kab) {
			if($daerah == "kabupaten"){
				$kecamatan = $this->m_visurvey->get_kec($kab->id);
			}else{
				$kecamatan = $this->m_visurvey->get_kec_id($id_kec);
			}

			foreach ($kecamatan as $kec) {
				if($daerah == "kelurahan"){
					$kelurahan = $this->m_visurvey->get_kel_id($id_kel);
				}else{
					$kelurahan = $this->m_visurvey->get_kel($kec->id);
				}
	
				foreach ($kelurahan as $kel) {
					$survey = $this->m_visurvey->get_survey($kel->id);
					foreach ($survey as $sur) {
						if($sur->pengaruh == 1){
							$tokoh1 +=1;
						}elseif ($sur->pengaruh == 2) {
							$tokoh2 +=1;
						}elseif ($sur->pengaruh == 3) {
							$tokoh3 +=1;
						}elseif ($sur->pengaruh == 4) {
							$tokoh4 +=1;
						}elseif ($sur->pengaruh == 5) {
							$tokoh5 +=1;
						}elseif ($sur->pengaruh == 6) {
							$tokoh6 +=1;
						}elseif ($sur->pengaruh == 7) {
							$tokoh7 +=1;
						}elseif ($sur->pengaruh == 8) {
							$tokoh8 +=1;
						}elseif ($sur->pengaruh == 9) {
							$tokoh9 +=1;
						}elseif ($sur->pengaruh == 10) {
							$tokoh10 +=1;
						}elseif ($sur->pengaruh == 11) {
							$tokoh11 +=1;
						}elseif ($sur->pengaruh == 12) {
							$tokoh12 +=1;
						}
					}
				}
			}
			$datap['country'] = "Tokoh Agama";
			$datap['value'] = $tokoh1;
			array_push($pie_kab,$datap);
			$datap['country'] = "Tokoh Masyarakat";
			$datap['value'] = $tokoh2;
			array_push($pie_kab,$datap);
			$datap['country'] = "Tokoh Pemuda";
			$datap['value'] = $tokoh3;
			array_push($pie_kab,$datap);
			$datap['country'] = "Tokoh Perempuan";
			$datap['value'] = $tokoh4;
			array_push($pie_kab,$datap);
			$datap['country'] = "Guru/Dosen";
			$datap['value'] = $tokoh5;
			array_push($pie_kab,$datap);
			$datap['country'] = "Ketua Paguyuban/Suku Adat";
			$datap['value'] = $tokoh6;
			array_push($pie_kab,$datap);
			$datap['country'] = "Kelompok Pengajian";
			$datap['value'] = $tokoh7;
			array_push($pie_kab,$datap);
			$datap['country'] = "Kelompok Tani/Nelayan";
			$datap['value'] = $tokoh8;
			array_push($pie_kab,$datap);
			$datap['country'] = "RT/RW";
			$datap['value'] = $tokoh9;
			array_push($pie_kab,$datap);
			$datap['country'] = "Kepala Desa";
			$datap['value'] = $tokoh10;
			array_push($pie_kab,$datap);
			$datap['country'] = "Pengusaha";
			$datap['value'] = $tokoh11;
			array_push($pie_kab,$datap);
			$datap['country'] = "Asosiasi Pedagang";
			$datap['value'] = $tokoh12;
			array_push($pie_kab,$datap);
		}
		$data['piechart'] = json_encode($pie_kab);
		$data['jenis'] = $jenis;
		$data['daerah'] = $daerah;
		$this->load->view('v_pie_only',$data);
	}
}
