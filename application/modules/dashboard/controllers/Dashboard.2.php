<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok"); // set waktu yang sekarang di region indonesia
		date_default_timezone_get();
        $this->load->model('m_dashboard'); //set model dashboard
	}
	
	public function pull_data(){
        $json = file_get_contents('http://localhost/kemendagri-formasiipdn/dummy/get_all'); //get data from webiste lain

        $data = json_decode($json, TRUE); // data diconvert ke dalam JSON
        $isi =array();
        $masuk =array();
        foreach($data as $key){
            
            $query = $this->m_dashboard->cek($key['id_jenis'],$key['tgl']); // cek apakah data yang diambil sudah ada di database sistem ini atau tidak
            $test =$query->num_rows();
            if($test>0){ // jika ada data yang sama, akan melakukan update
                $isi =[
                    'target' => $key['target'],
                    'realisasi' => $key['realisasi'],
                ];
                $this->m_dashboard->update_trx($key['id_jenis'],$isi);
            }else{ // jika data tidak ada didalam sistem, maka akan melakukan proses insert ke dalam database
                $masuk =[
                    'id_jenis_ret'=> $key['id_jenis'],
                    'tgl'   => $key['tgl'],
                    'target' => $key['target'],
                    'realisasi' => $key['realisasi'],
                ];
                $this->m_dashboard->simpan_trx($masuk);
            }
                
        }
    }
	
	public function index() {
		// $this->pull_data(); // ambil data dari sistem lain
		$query = $this->m_dashboard->get_all(); // ambil data semua dinas
		$masuk =array();
		$masik =array();
		foreach($query as $key){
			$data['nilai'] = $this->m_dashboard->get_realisasi($key['id_dinas']); // sum nilai realisasai
			$data['target'] = $this->m_dashboard->get_target($key['id_dinas']); // sum nilai target
			$data['nama'] = $key['nama'];
			$data['id_dinas'] = $key['id_dinas'];
			$dati['color'] = $key['color']; // select warna untuk di chart
			$dati['country'] =$key['nama'];
			$dati['visits'] =$this->m_dashboard->get_realisasi($key['id_dinas']);
			array_push($masuk,$data); // data untuk untuk table
			array_push($masik,$dati); // dati untuk chart
		}
		$isi = [
			'isi'=>$masuk,
			'iso'=>json_encode($masik),
		];	
		$this->template->load('template_dashboard','v_index',$isi);	// send to view
   	}

	public function detail_page($id){
		$masuk =array();
		$coba=array();
		$year=date("Y"); // get tahun sekarang
		$query = $this->m_dashboard->getret($id); // mendapatkan id retribusi berdasarkan id_dinas
		foreach($query as $key){
			$query2 = $this->m_dashboard->get_trx($id,$key['id_jenis'],$year); // get data-data transaksi
				foreach($query2 as $value){
					$masuk = [
						'id_jenis_ret' => $value['id_jenis_ret'],
						'target' => $value['target'],
						'realisasi'=>$value['realisasi'],
						'nama'=>$value['nama_jenis'],
						'tgl' =>$value['tgl']
					];
					array_push($coba,$value);
				}
			$data=[
				'detail'=>$coba
			];	
		}
		$this->template->load('template_dashboard','v_detail',$data);	
	}
	
	// public function ajx_dash($id){ // proses ajax
	// 	$masuk =array();
	// 	$coba=array();
	// 	$query = $this->m_dashboard->getret($id);
	// 	foreach($query as $key){
	// 		$query2 = $this->m_dashboard->get_trx($id,$key['id_jenis']);
	// 			foreach($query2 as $value){
	// 				$masuk = [
	// 					'id_jenis_ret' => $value['id_jenis_ret'],
	// 					'target' => $value['target'],
	// 					'realisasi'=>$value['realisasi'],
	// 					'nama'=>$value['nama_jenis'],
	// 				];
	// 				array_push($coba,$masuk);
	// 			}
	// 	}
	// 	echo json_encode($coba);
		
	// }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */