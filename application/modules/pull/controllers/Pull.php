<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pull extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok"); // set waktu yang sekarang di region indonesia
		date_default_timezone_get();
        $this->load->model('m_pull'); //set model dashboard
    }
	
	public function index() {
		$json = file_get_contents('http://aplikasipeta.com/dishub_service/wsparkir.php'); //get data from webiste lain
        $data = json_decode($json, TRUE); // data diconvert ke dalam JSON
        $isi =array();
        $masuk =array();
        foreach($data as $key){
            $que = $this->m_pull->cek_ret($key['id_retribusi '],$key['id_dinas ']);
            $rou = $que->num_rows();
            if($rou==0){
                $isi2 =[
                    'id_jenis' => $key['id_retribusi '],
                    'id_dinas' => $key['id_dinas '],
                    'nama_jenis'=> "New Ret",
                ];
                $this->m_pull->insert_ret($isi2);
            }
            $query = $this->m_pull->cek($key['id_retribusi '],$key['tgl ']); // cek apakah data yang diambil sudah ada di database sistem ini atau tidak
            $test =$query->num_rows();
            if($test>0){ // jika ada data yang sama, akan melakukan update
                $isi =[
                    'target' => $key['target '],
                    'realisasi' => $key['realisasi '],
                ];
                $this->m_pull->update_trx($key['id_retribusi '],$isi);
            }else{ // jika data tidak ada didalam sistem, maka akan melakukan proses insert ke dalam database
                $masuk =[
                    'id_jenis_ret'=> $key['id_retribusi '],
                    'tgl'   => $key['tgl '],
                    'target' => $key['target '],
                    'realisasi' => $key['realisasi '],
                ];
                $this->m_pull->simpan_trx($masuk);
            }
                
        }
            $datas=[
				'data'=>$data
			];	
        $this->load->view('v_pull',$datas);
   	}
}
