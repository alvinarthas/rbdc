<?php
class Register extends CI_Controller{

    public function __construct() {
		parent::__construct();
		$this->load->model('m_regis');
    }
    
    public function index() {
		$data['breadcrumbs'] = array(
			array (
				'link' => '#',
				'name' => 'Home'
			)
		);

		$data['judul_form']="Daftar";
		$data['sub_judul_form']="Pengguna ";
		$data['profil']=$this->m_regis->profil();
		$this->template->load('template_frontend','v_regis',$data);
    }

	public function daftar(){
		$data = array(
			'username' => $this->input->post('username'),
			'password' => sha1(md5($this->input->post('password'))),
			'nama_lengkap' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'tgl_daftar' => date('Y-m-d H:i:s'),
			'ip' => $this->input->ip_address(),
			'status_aktif' => "Y",
			'hp' => $this->input->post('hp'),
			'user_profil' => $this->input->post('profil'),
			'id_user_group' => 5,
		);

		$xss_data = $this->security->xss_clean($data);
		$this->db->insert('ref_users', $xss_data);
		$data2 = array(
			'sesi_id' => $this->db->insert_id(),
			'sesi_username' => $this->input->post('username'),
			'sesi_user_group' =>5,												
			'sesi_email' => $this->input->post('email'),
			'sesi_nama_lengkap' => $this->input->post('nama'),
			'atos_tiasa_leubeut' => TRUE
			);
		$this->session->set_userdata($data2);
		if (!is_dir('./uploads/'.$this->session->userdata('sesi_username')))
			{
				mkdir('./uploads/'.$this->session->userdata('sesi_username'), 0777, true);
			}
				
		redirect('welcome');
	}
}
