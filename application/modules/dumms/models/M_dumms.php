<?php
class M_dumms extends CI_Model{
	
	function __construct(){
        parent::__construct();
        		//set time
		date_default_timezone_set("Asia/Bangkok"); // set waktu yang sekarang di region indonesia
		date_default_timezone_get();
    }

    public function save(){
        $data= [
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
        ];

        if($this->db->insert('tbl_test_2',$data)){
            return [
                'id'=>$this->db->insert_id(),
                'success'=>true,
                'message'=>'data berhasil dimasukkan',
                'ip_address'=>$this->input->ip_address(),
                'input_time'=>date("Y-m-d H:i:s"),
            ];
        }
    }

    public function get($key = null)
    {
         $query = $this->db->query("SELECT * from tbl_test_real where u_id ='$key'");
         return $query->result_array();
    }

    public function updatess($data){
        $this->db->query("INSERT INTO tbl_test_2 select * from tbl_test_real where u_id = 'u_1'");
        $this->db->query("DELETE FROM tbl_test_real  where u_id = 'u_1'");
        $this->db->insert('tbl_test_real',$data);
    }
}