<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dumms extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
		Modules::run('ref_role/permissions');
		$this->atos_tiasa_leubeut();
        $this->load->model('m_dumms');
    }

    // Check if already logged in
	public function atos_tiasa_leubeut(){
		
		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
    }

    public function index(){
        $this->template->load('template_frontend','v_dumms');	
    }
    
    public function response($data){
        $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
        exit;
    }

    public function pull_data(){
        $ch = curl_init();
        $u_id='u_1';
        curl_setopt($ch, CURLOPT_URL,"http://localhost/sipkp/restserver/index.php/api/get_dummy/dummy");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"u_id=".$u_id);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);

        $curl_result = json_decode($server_output);
        // print_r($curl_result);die();
        if ($curl_result != '') {
            $dataIn= [
                'tgl' => $curl_result->tgl,
                'a' => $curl_result->a,
                'b'  => $curl_result->b,
                'c'  => $curl_result->c,
                'd'  => $curl_result->d,
                'e' => $curl_result->e,
                'f'  => $curl_result->f,
                'g'  => $curl_result->g,
                'h'  => $curl_result->h,
                'i' => $curl_result->i,
                'j'  => $curl_result->j,
                'k'  => $curl_result->k,
                'l'  => $curl_result->l,
                'm' => $curl_result->m,
                'n'  => $curl_result->n,
                'o'  => $curl_result->o,
                'p'  => $curl_result->p,
                'q' => $curl_result->q,
                'r'  => $curl_result->r,
                's'  => $curl_result->s,
                't'  => $curl_result->t,
                'time'=>date("Y-m-d H:i:s"),
                'ip_address'=>$this->input->ip_address(),
                'u_id' => 'u_1',
            ];
            $xss_data = $this->security->xss_clean($dataIn);
            $this->m_dumms->updatess($xss_data);
            redirect('dumms');
        }else{
            $this->session->set_flashdata('message', '<div class="message">Anda salah memasukkan username atau password. Coba ulangi lagi.</div>');
            redirect('dumms');
        }
    }

    public function view_profile(){
        $uid="u_1";
        // $query = $this->m_dumms->get($uid);
            // echo $query->num_rows(); die();
        $ray = array();
        $query = $this->db->query("SELECT a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t from tbl_test_real where u_id ='$uid'");
        $a=$query->row();
        $i=1;
        foreach ($a as $key) {
            $qcolor = $this->db->query("SELECT * from tbl_color where id='$i'");
            $qnama = $this->db->query("SELECT * from tbl_label where id='$i'");
            $b=$qcolor->row()->color;
            $c=$qnama->row()->nama;
            $val = array(
                'value' => $key,
                'color' => $b,
                'nama' => $c
            );
            array_push($ray,$val);
            $i++;
        }
        $data=[
            'chart' =>json_encode($ray),
        ];
        $this->template->load('template_frontend','show',$data);	
    }

    public function updet_data(){
        $this->template->load('template_frontend','dums_input');	
    }

    public function add(){
        $data= [
            'tgl' => $this->input->post('tgl'),
            'a' => $this->input->post('a'),
            'b'  => $this->input->post('b'),
            'c'  => $this->input->post('c'),
            'd'  => $this->input->post('d'),
            'e' => $this->input->post('e'),
            'f'  => $this->input->post('f'),
            'g'  => $this->input->post('g'),
            'h'  => $this->input->post('h'),
            'i' => $this->input->post('i'),
            'j'  => $this->input->post('j'),
            'k'  => $this->input->post('k'),
            'l'  => $this->input->post('l'),
            'm' => $this->input->post('m'),
            'n'  => $this->input->post('n'),
            'o'  => $this->input->post('o'),
            'p'  => $this->input->post('p'),
            'q' => $this->input->post('q'),
            'r'  => $this->input->post('r'),
            's'  => $this->input->post('s'),
            't'  => $this->input->post('t'),
            'time'=>date("Y-m-d H:i:s"),
            'ip_address'=>$this->input->ip_address(),
            'u_id' => 'u_1',
        ];
        $xss_data = $this->security->xss_clean($data);

        $this->m_dumms->updatess($xss_data);
        redirect('dumms');
    }
}