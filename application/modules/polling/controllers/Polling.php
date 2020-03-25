<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Polling extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
		$this->load->model('m_polling');
    }   

	public function awal(){
		$this->template->load('template_awal','v_awal');
	}
	public function index( $offset = 0 ) {
		$paslon = array();
        $calon = $this->m_polling->get_paslon();
        $data['status'] = "success";
        $data['message'] = "Data Berhasil dikirim";
        foreach($calon as $key){
            $data_calon['id'] = $key['id'];
            $data_calon['nm_cagub'] = $key['nm_cagub'];
            $data_calon['nm_cawagub'] = $key['nm_cawagub'];
            $data_calon['gambar'] = base_url().'assets_users/paslon/'.$key['gambar'];
            $data_calon['no_urut'] = $key['no_urut'];
            $partai = $this->m_polling->get_partais($key['id']);
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
		$data['judul_form']="Survey";
		$data['sub_judul_form']="Pilkada Riau";
		$this->template->load('template_poll','v_index',$data);	
   	}
	
	
	public function post_vote(){
        $ip_address = $this->input->post('ip_address');
        $check = $this->m_polling->cek_address($ip_address);
        if($check > 0){
            $this->session->set_flashdata('message_gagal', 'Maaf, Anda telah melakukan Voting sebelumnya');
			redirect('polling');
        }else{
            $data['id_calon'] = $this->input->post('id_calon');
            $data['ip_address'] = $this->input->post('ip_address');
            $xss_data = $this->security->xss_clean($data);
            $this->db->insert('tbl_polling', $xss_data);
            $this->session->set_flashdata('message_sukses', 'Selamat, Anda Telah melakukan Voting!');
			redirect('polling');
        }
	}
	
	public function show_graph(){
		$calon = $this->m_polling->get_paslon();
		$hasil = array();
        foreach($calon as $key){
            $polling  = $this->m_polling->get_polling($key['id']);
            $data_polling['country'] = $polling[0]['nm_cagub']." - ".$polling[0]['nm_cawagub'];
            $data_polling['visits'] = $polling[0]['total'];
            array_push($hasil,$data_polling);
        }
        $data['result'] = json_encode($hasil);
        $this->template->load('template_poll','v_graph',$data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
