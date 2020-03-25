<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_api extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok"); // set waktu yang sekarang di region indonesia
        date_default_timezone_get();
        $this->load->helper('url');
        $this->load->model('m_api'); //set model dashboard
    }

    public function get_paslon(){
        $paslon = array();
        $calon = $this->m_api->get_calon();
        $data['status'] = "success";
        $data['message'] = "Data Berhasil dikirim";
        foreach($calon as $key){
            $data_calon['id'] = $key['id'];
            $data_calon['nm_cagub'] = $key['nm_cagub'];
            $data_calon['nm_cawagub'] = $key['nm_cawagub'];
            $data_calon['gambar'] = base_url().'assets_users/paslon/'.$key['gambar'];
            $data_calon['no_urut'] = $key['no_urut'];
            $partai = $this->m_api->get_partai($key['id']);
            $partais = array();
            foreach($partai as $par){
                $data_partai['nm_partai'] = $par['nm_partai'];
                $data_partai['gambar'] = base_url().'assets_users/partai/'.$par['gambar'];
                array_push($partais,$data_partai);
            }
            $data_calon['partai'] = $partais;
            array_push($paslon,$data_calon);
        }
        $data['result'] = $paslon;
        $myJSON = json_encode($data);

        echo $myJSON;
    }

    public function post_vote(){
        $ip_address = $this->input->post('ip_address');
        $check = $this->m_api->cek_address($ip_address);
        if($check > 0){
            $datax['status'] = "failed";
            $datax['message'] = "Maaf Anda telah melakukan voting sebelumnya";
        }else{
            $data['id_calon'] = $this->input->post('id_calon');
            $data['ip_address'] = $this->input->post('ip_address');
            $xss_data = $this->security->xss_clean($data);
            $this->db->insert('tbl_polling', $xss_data);
            $datax['status'] = "success";
            $datax['message'] = "Selamat anda telah melakukan Voting!";
        }
        $myJSON = json_encode($datax);
        echo $myJSON;
    }

    public function get_polling(){
        $data = array();
        $hasil = array();
        $data['status'] = "success";
        $data['message'] = "Data Berhasil dikirim";
        $calon = $this->m_api->get_calon();
        foreach($calon as $key){
            $polling  = $this->m_api->get_polling($key['id']);
            $data_polling['nm_cagub'] = $polling[0]['nm_cagub'];
            $data_polling['nm_cawagub'] = $polling[0]['nm_cawagub'];
            $data_polling['total'] = $polling[0]['total'];
            array_push($hasil,$data_polling);
        }
        $data['result'] = $hasil;
        $myJSON = json_encode($data);

        echo $myJSON;
    }
}
