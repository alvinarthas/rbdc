<?php
class Info_suara extends CI_Controller{

    public function __construct() {
		parent::__construct();
		$this->atos_tiasa_leubeut();
		$this->load->model('m_info');
		error_reporting(0);
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
		$data['sum'] = $this->m_info->sum_tps()->tps;   
		$data['count'] = $this->m_info->count_suara()->total;   
		$data['persentase'] = ($this->m_info->count_suara()->total / $this->m_info->sum_tps()->tps)*100;
		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}
		$data['kabupaten'] = $this->m_info->get_kab_all();   

		$data['breadcrumbs'] = array(
			array (
				'link' => '/info_suara',
				'name' => 'Home'
			)
		);
		$data['role']=get_role($this->session->userdata('sesi_user_group'));
		$this->template->load('template_frontend','v_index',$data);		
	}

	public function provgraf(){
		$calon1=0;
		$calon2=0;
		$calon3=0;
		$calon4=0;
		$sah=0;
		$tdk=0;
		$total=0;
		$dpt=0;
		$j_tps=0;
		$j_msk=0;
		$pie = array();
		$kabupaten = $this->m_info->get_kab_all();
		foreach ($kabupaten as $kab) {
			$kecamatan = $this->m_info->get_kec($kab->id);
			foreach ($kecamatan as $kec) {
				$kelurahan = $this->m_info->get_kel($kec->id);
				foreach ($kelurahan as $kel) {
					$j_tps+=$kel->tps;
					$tps = $this->m_info->get_tps($kel->id);
					foreach($tps as $tpss){
						$suara_masuk = $this->m_info->get_suara($tpss->id);
						if($suara_masuk){
							$j_msk+=1;
						}
						$calon1+=$suara_masuk->calon1;
						$calon2+=$suara_masuk->calon2;
						$calon3+=$suara_masuk->calon3;
						$calon4+=$suara_masuk->calon4;
						$sah+=$suara_masuk->suara_sah;
						$tdk+=$suara_masuk->suara_tdk;
						$total+=$suara_masuk->suara_ttl;
						$dpt+=$tpss->dpt;
					}
				}
			}
		}

		if($calon1 == NULL || $calon1 == 0){
			$persen1 = 0;
		}else{
			$persen1 = ($calon1/$sah)*100;
		}

		if($calon2 == NULL || $calon2 == 0){
			$persen2 = 0;
		}else{
			$persen2 = ($calon2/$sah)*100;
		}

		if($calon3 == NULL || $calon3 == 0){
			$persen3 = 0;
		}else{
			$persen3 = ($calon3/$sah)*100;
		}

		if($calon4 == NULL || $calon4 == 0){
			$persen4 = 0;
		}else{
			$persen4 = ($calon4/$sah)*100;
		}

		if($total == NULL || $total == 0){
			$partisipasi = 0;
		}else{
			$partisipasi = ($total/$dpt)*100;
		}
		$j_klr = $j_tps- $j_msk;
		$data_tabel = array(
			'dpt' => $dpt,
			'calon1' => $calon1,
			'persen1' => $persen1,
			'calon2' => $calon2,
			'persen2' => $persen2,
			'calon3' => $calon3,
			'persen3' => $persen3,
			'calon4' => $calon4,
			'persen4' => $persen4,
			'sah' => $sah,
			'tdk' => $tdk,
			'total' => $total,
			'partisipasi' => $partisipasi,
			'jumlah' => $j_tps,
			'masuk' => $j_msk,
			'keluar' => $j_klr,
		);

		$data_pie['country'] = "Calon 1";
		$data_pie['value'] = $calon1;
		$data_pie['persen'] = number_format($persen1, 2, '.', '');
		array_push($pie,$data_pie);
		$data_pie['country'] = "Calon 2";
		$data_pie['value'] = $calon2;
		$data_pie['persen'] = number_format($persen2, 2, '.', '');
		array_push($pie,$data_pie);
		$data_pie['country'] = "Calon 3";
		$data_pie['value'] = $calon3;
		$data_pie['persen'] = number_format($persen3, 2, '.', '');
		array_push($pie,$data_pie);
		$data_pie['country'] = "Calon 4";
		$data_pie['value'] = $calon4;
		$data_pie['persen'] = number_format($persen4, 2, '.', '');
		array_push($pie,$data_pie);

		$data = array(
			'tabel' => $data_tabel,
			'chart' => json_encode($pie)
		);

		$this->load->view('provgraf',$data);
	}

	public function provtab(){
		$calon1=0;
		$calon2=0;
		$calon3=0;
		$calon4=0;
		$sah=0;
		$tdk=0;
		$total=0;
		$dpt=0;
		$j_tps=0;
		$j_msk=0;
		$tabel = array();
		$chart = array();
		$kabupaten = $this->m_info->get_kab_all();
		foreach ($kabupaten as $kab) {
			$kecamatan = $this->m_info->get_kec($kab->id);
			foreach ($kecamatan as $kec) {
				$kelurahan = $this->m_info->get_kel($kec->id);
				foreach ($kelurahan as $kel) {
					$j_tps+=$kel->tps;
					$tps = $this->m_info->get_tps($kel->id);
					foreach($tps as $tpss){
						$suara_masuk = $this->m_info->get_suara($tpss->id);
						if($suara_masuk){
							$j_msk+=1;
						}
						$calon1+=$suara_masuk->calon1;
						$calon2+=$suara_masuk->calon2;
						$calon3+=$suara_masuk->calon3;
						$calon4+=$suara_masuk->calon4;
						$sah+=$suara_masuk->suara_sah;
						$tdk+=$suara_masuk->suara_tdk;
						$total+=$suara_masuk->suara_ttl;
						$dpt+=$tpss->dpt;
					}
				}
			}
			if($calon1 == NULL || $calon1 == 0){
				$persen1 = 0;
			}else{
				$persen1 = ($calon1/$sah)*100;
			}

			if($calon2 == NULL || $calon2 == 0){
				$persen2 = 0;
			}else{
				$persen2 = ($calon2/$sah)*100;
			}

			if($calon3 == NULL || $calon3 == 0){
				$persen3 = 0;
			}else{
				$persen3 = ($calon3/$sah)*100;
			}

			if($calon4 == NULL || $calon4 == 0){
				$persen4 = 0;
			}else{
				$persen4 = ($calon4/$sah)*100;
			}

			if($total == NULL || $total == 0){
				$partisipasi = 0;
			}else{
				$partisipasi = ($total/$dpt)*100;
			}

			$j_klr = $j_tps- $j_msk;

			$datak['name'] = "Syamsuar - Edy Nasution";
			$datak['points'] = $calon1;
			$datak['color'] = "#bfbfbf";
			$datak['persen'] = $persen1;
			$datak['bullet'] = base_url().'assets_users/paslon/4.png';
			array_push($chart,$datak);

			$datak['name'] = "Lukman Edy - Hardianto";
			$datak['points'] = $calon2;
			$datak['color'] = "#00cc00";
			$datak['persen'] = $persen2;
			$datak['bullet'] = base_url().'assets_users/paslon/2.png';
			array_push($chart,$datak);

			$datak['name'] = "Firdaus - Rusli Effendi";
			$datak['points'] = $calon3;
			$datak['color'] = "#0099ff";
			$datak['persen'] = $persen3;
			$datak['bullet'] = base_url().'assets_users/paslon/3.png';;
			array_push($chart,$datak);

			$datak['name'] = "Andi Rachman - Suyatno";
			$datak['points'] = $calon4;
			$datak['color'] = "#ffff1a";
			$datak['persen'] = $persen4;
			$datak['bullet'] = base_url().'assets_users/paslon/1.png';;
			array_push($chart,$datak);
			
			$data_tabel = array(
				'kabupaten' => $kab->kabupaten,
				'dpt' => $dpt,
				'calon1' => $calon1,
				'persen1' => $persen1,
				'calon2' => $calon2,
				'persen2' => $persen2,
				'calon3' => $calon3,
				'persen3' => $persen3,
				'calon4' => $calon4,
				'persen4' => $persen4,
				'sah' => $sah,
				'tdk' => $tdk,
				'total' => $total,
				'partisipasi' => $partisipasi,
				'jumlah' => $j_tps,
				'masuk' => $j_msk,
				'keluar' => $j_klr,
			);
			array_push($tabel,$data_tabel);
			$calon1=0;
			$calon2=0;
			$calon3=0;
			$calon4=0;
			$sah=0;
			$tdk=0;
			$total=0;
			$dpt=0;
			$j_tps=0;
			$j_msk=0;
		}
		$data = array(
			'tabel' => $tabel
		);

		$this->load->view('provtab',$data);
	}

	public function index_tps(){
		$calon1=0;
		$calon2=0;
		$calon3=0;
		$calon4=0;
		$xsah=0;
		$xcalon1=0;
		$xcalon2=0;
		$xcalon3=0;
		$xcalon4=0;
		$sah=0;
		$tdk=0;
		$total=0;
		$dpt=0;
		$xdpt=0;
		$j_tps=0;
		$j_msk=0;
		$id_kab = $this->input->post('kabupaten');
		$id_kec = $this->input->post('kecamatan');
		$id_kel = $this->input->post('kelurahan');
		$daerah = $this->input->post('daerah');
		$tabel = array();
		$chart = array();
		$kabupaten = $this->m_info->get_kab($id_kab);

		foreach ($kabupaten as $kab) {
			if($daerah == "kabupaten"){
				$kecamatan = $this->m_info->get_kec($kab->id);
			}else{
				$kecamatan = $this->m_info->get_kec_id($id_kec);
			}

			foreach ($kecamatan as $kec) {
				if($daerah == "kelurahan"){
					$kelurahan = $this->m_info->get_kel_id($id_kel);
				}else{
					$kelurahan = $this->m_info->get_kel($kec->id);
				}
	
				foreach ($kelurahan as $kel) {
					if($daerah == "kelurahan"){
						$tps = $this->m_info->get_tps($id_kel);
					}else{
						$tps = $this->m_info->get_tps($kel->id);
					}
					$j_tps+=$kel->tps;
					foreach($tps as $tpss){
						$suara_masuk = $this->m_info->get_suara($tpss->id);
						if($suara_masuk){
							$j_msk+=1;
						}
						$calon1+=$suara_masuk->calon1;
						$calon2+=$suara_masuk->calon2;
						$calon3+=$suara_masuk->calon3;
						$calon4+=$suara_masuk->calon4;

						$xcalon1+=$suara_masuk->calon1;
						$xcalon2+=$suara_masuk->calon2;
						$xcalon3+=$suara_masuk->calon3;
						$xcalon4+=$suara_masuk->calon4;
						$xsah+=$suara_masuk->suara_sah;

						$sah+=$suara_masuk->suara_sah;
						$tdk+=$suara_masuk->suara_tdk;
						$total+=$suara_masuk->suara_ttl;
						$dpt+=$tpss->dpt;
						$xdpt+=$tpss->dpt;
						if($daerah == "kelurahan"){
							if($calon1 == NULL || $calon1 == 0 || $sah == NULL || $sah == 0){
								$persen1 = 0;
							}else{
								$persen1 = ($calon1/$sah)*100;
							}
				
							if($calon2 == NULL || $calon2 == 0 || $sah == NULL || $sah == 0){
								$persen2 = 0;
							}else{
								$persen2 = ($calon2/$sah)*100;
							}
				
							if($calon3 == NULL || $calon3 == 0 || $sah == NULL || $sah == 0){
								$persen3 = 0;
							}else{
								$persen3 = ($calon3/$sah)*100;
							}
				
							if($calon4 == NULL || $calon4 == 0 || $sah == NULL || $sah == 0){
								$persen4 = 0;
							}else{
								$persen4 = ($calon4/$sah)*100;
							}
				
							if($total == NULL || $total == 0 || $sah == NULL || $sah == 0){
								$partisipasi = 0;
							}else{
								$partisipasi = ($total/$dpt)*100;
							}
							$data_tabel = array(
								'nama_tps' => $tpss->tps,
								'dpt' => $dpt,
								'calon1' => $calon1,
								'persen1' => $persen1,
								'calon2' => $calon2,
								'persen2' => $persen2,
								'calon3' => $calon3,
								'persen3' => $persen3,
								'calon4' => $calon4,
								'persen4' => $persen4,
								'sah' => $sah,
								'tdk' => $tdk,
								'total' => $total,
								'partisipasi' => $partisipasi,
							);
							array_push($tabel,$data_tabel);
							$calon1=0;
							$calon2=0;
							$calon3=0;
							$calon4=0;
							$sah=0;
							$tdk=0;
							$total=0;
							$dpt=0;
							$j_tps=0;
							$j_msk=0;
						}


					}

					if($daerah == "kecamatan"){
						if($calon1 == NULL || $calon1 == 0 || $sah == NULL || $sah == 0){
							$persen1 = 0;
						}else{
							$persen1 = ($calon1/$sah)*100;
						}
			
						if($calon2 == NULL || $calon2 == 0 || $sah == NULL || $sah == 0){
							$persen2 = 0;
						}else{
							$persen2 = ($calon2/$sah)*100;
						}
			
						if($calon3 == NULL || $calon3 == 0 || $sah == NULL || $sah == 0){
							$persen3 = 0;
						}else{
							$persen3 = ($calon3/$sah)*100;
						}
			
						if($calon4 == NULL || $calon4 == 0 || $sah == NULL || $sah == 0){
							$persen4 = 0;
						}else{
							$persen4 = ($calon4/$sah)*100;
						}
			
						if($total == NULL || $total == 0){
							$partisipasi = 0;
						}else{
							$partisipasi = ($total/$dpt)*100;
						}
			
						$j_klr = $j_tps- $j_msk;
						
						$data_tabel = array(
							'nama_tps' => $kel->kelurahan,
							'dpt' => $dpt,
							'calon1' => $calon1,
							'persen1' => $persen1,
							'calon2' => $calon2,
							'persen2' => $persen2,
							'calon3' => $calon3,
							'persen3' => $persen3,
							'calon4' => $calon4,
							'persen4' => $persen4,
							'sah' => $sah,
							'tdk' => $tdk,
							'total' => $total,
							'partisipasi' => $partisipasi,
							'jumlah' => $j_tps,
							'masuk' => $j_msk,
							'keluar' => $j_klr,
						);
						array_push($tabel,$data_tabel);
						$calon1=0;
						$calon2=0;
						$calon3=0;
						$calon4=0;
						$sah=0;
						$tdk=0;
						$total=0;
						$dpt=0;
						$j_tps=0;
						$j_msk=0;
					}
				}

				if($daerah == "kabupaten"){
					if($calon1 == NULL || $calon1 == 0 || $sah == NULL || $sah == 0){
						$persen1 = 0;
					}else{
						$persen1 = ($calon1/$sah)*100;
					}
		
					if($calon2 == NULL || $calon2 == 0 || $sah == NULL || $sah == 0){
						$persen2 = 0;
					}else{
						$persen2 = ($calon2/$sah)*100;
					}
		
					if($calon3 == NULL || $calon3 == 0 || $sah == NULL || $sah == 0){
						$persen3 = 0;
					}else{
						$persen3 = ($calon3/$sah)*100;
					}
		
					if($calon4 == NULL || $calon4 == 0 || $sah == NULL || $sah == 0){
						$persen4 = 0;
					}else{
						$persen4 = ($calon4/$sah)*100;
					}
		
					if($total == NULL || $total == 0){
						$partisipasi = 0;
					}else{
						$partisipasi = ($total/$sah)*100;
					}
		
					$j_klr = $j_tps- $j_msk;
					
					$data_tabel = array(
						'nama_tps' => $kec->kecamatan,
						'dpt' => $dpt,
						'calon1' => $calon1,
						'persen1' => $persen1,
						'calon2' => $calon2,
						'persen2' => $persen2,
						'calon3' => $calon3,
						'persen3' => $persen3,
						'calon4' => $calon4,
						'persen4' => $persen4,
						'sah' => $sah,
						'tdk' => $tdk,
						'total' => $total,
						'partisipasi' => $partisipasi,
						'jumlah' => $j_tps,
						'masuk' => $j_msk,
						'keluar' => $j_klr,
					);
					array_push($tabel,$data_tabel);
					$calon1=0;
					$calon2=0;
					$calon3=0;
					$calon4=0;
					$sah=0;
					$tdk=0;
					$total=0;
					$dpt=0;
					$j_tps=0;
					$j_msk=0;
				}
			}
		}

		if($xcalon1 == NULL || $xcalon1 == 0 || $xsah == NULL || $xsah == 0){
			$xpersen1 = 0;
		}else{
			$xpersen1 = ($xcalon1/$xsah)*100;
		}

		if($xcalon2 == NULL || $xcalon2 == 0 || $xsah == NULL || $xsah == 0){
			$xpersen2 = 0;
		}else{
			$xpersen2 = ($xcalon2/$xsah)*100;
		}

		if($xcalon3 == NULL || $xcalon3 == 0 || $xsah == NULL || $xsah == 0){
			$xpersen3 = 0;
		}else{
			$xpersen3 = ($xcalon3/$xsah)*100;
		}

		if($xcalon4 == NULL || $xcalon4 == 0 || $xsah == NULL || $xsah == 0){
			$xpersen4 = 0;
		}else{
			$xpersen4 = ($xcalon4/$xsah)*100;
		}

		$datak['name'] = "Syamsuar - Edy Nasution";
		$datak['points'] = $xcalon1;
		$datak['color'] = "#bfbfbf";
		$datak['persen'] = number_format($xpersen1, 2, '.', '');
		$datak['bullet'] = base_url().'assets_users/paslon/4.png';
		array_push($chart,$datak);

		$datak['name'] = "Lukman Edy - Hardianto";
		$datak['points'] = $xcalon2;
		$datak['color'] = "#00cc00";
		$datak['persen'] = number_format($xpersen2, 2, '.', '');
		$datak['bullet'] = base_url().'assets_users/paslon/2.png';
		array_push($chart,$datak);

		$datak['name'] = "Firdaus - Rusli Effendi";
		$datak['points'] = $xcalon3;
		$datak['color'] = "#0099ff";
		$datak['persen'] = number_format($xpersen3, 2, '.', '');
		$datak['bullet'] = base_url().'assets_users/paslon/3.png';;
		array_push($chart,$datak);

		$datak['name'] = "Andi Rachman - Suyatno";
		$datak['points'] = $xcalon4;
		$datak['color'] = "#ffff1a";
		$datak['persen'] = number_format($xpersen4, 2, '.', '');
		$datak['bullet'] = base_url().'assets_users/paslon/1.png';;
		array_push($chart,$datak);

		$data = array(
			'tabel' => $tabel,
			'daerah' => $daerah,
			'chart' => json_encode($chart)
		);

		$this->load->view('index_tps',$data);
	}
}