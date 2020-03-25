<?php
class Loginapp extends CI_Controller{

    public function __construct() {
        parent::__construct();
		$this->load->helper('captcha');
    }
    
    public function index() {
	
	
	//validating form fields
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('user_password', 'Password', 'required');
    $this->form_validation->set_rules('userCaptcha', 'Captcha', 'required|callback_check_captcha');
    $userCaptcha = $this->input->post('userCaptcha');
	
    if ($this->form_validation->run() == false){
      // numeric random number for captcha
      $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
      // setting up captcha config
      $vals = array(
             'word' => $random_number,
             'img_path' => './captcha/',
             'img_url' => base_url().'captcha/',
             'img_width' => 140,
             'img_height' => 32,
             'expiration' => 7200
            );
      $data['captcha'] = create_captcha($vals);
      $this->session->set_userdata('captchaWord',$data['captcha']['word']);
      $this->template->load('template_frontend','index',$data);
    }
    else {
		$username=$this->input->post('username');
		$user_password= sha1(md5($this->input->post('user_password')));
		
		$sqlcek="SELECT * FROM ref_users WHERE username	=? AND password=?";
		$querycek = $this->db->query($sqlcek,array($username,$user_password));
		$ceking=$querycek->num_rows();
			if ($ceking==0) {
				$random_number = substr(number_format(time() * rand(),0,'',''),0,6);
				// setting up captcha config
				$vals = array(
						'word' => $random_number,
						'img_path' => './captcha/',
						'img_url' => base_url().'captcha/',
						'img_width' => 140,
						'img_height' => 32,
						'expiration' => 7200
					);
				$data['captcha'] = create_captcha($vals);
				$this->session->set_userdata('captchaWord',$data['captcha']['word']);
				$data["pesan"]="Username/Password Anda Salah";
				$this->template->load('template_frontend','index',$data);
			} else {
				$sqlcek2="SELECT * FROM ref_users WHERE username=? AND password=? ";
					$querycek2 = $this->db->query($sqlcek2,array($username,$user_password));
					$ceking2=$querycek2->num_rows();
					if ($ceking2==0) {
					$random_number2 = substr(number_format(time() * rand(),0,'',''),0,6);
					// setting up captcha config
					$vals2 = array(
							'word' => $random_number2,
							'img_path' => './captcha/',
							'img_url' => base_url().'captcha/',
							'img_width' => 140,
							'img_height' => 32,
							'expiration' => 7200
						);
					$data['captcha'] = create_captcha($vals2);
					$this->session->set_userdata('captchaWord',$data['captcha']['word']);
					
					$data["pesan"]="Username/Password Anda Salah";
					
					$this->template->load('template_frontend','index',$data);
					}else{

					$row2 = $querycek2->row();
						
						
						$data2 = array(
								'sesi_id' => $row2->id,
								'sesi_username' => $row2->username,
								'sesi_user_group' =>$row2->id_user_group,												
								'sesi_email' => $row2->email,
								'sesi_nama_lengkap' =>$row2->nama_lengkap,
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
			}
    }
	//$data["test"]="";
	public function check_captcha($str){
		$word = $this->session->userdata('captchaWord');
		if(strcmp(strtoupper($str),strtoupper($word)) == 0){
			return true;
		}
		else{
			$this->form_validation->set_message('check_captcha', 'KODE CAPTCHA SALAH !');
			return false;
		}
	}
   
	public function logout(){
		$this->session->sess_destroy();
		redirect('loginapp');
	}

}
