<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function Dashboard(){
		parent::__construct();
        $this->load->model('m_dashboard');
	}
	
	
	public function index() {
		$query = $this->m_dashboard->get_all();
		$data['cek'] = $query;
		$this->template->load('template_dashboard','v_index',$data);	
   	}
	
	public function ajx_dash($id){
		$masuk =array();
		$coba=array();
		$query = $this->m_dashboard->getret($id);
		foreach($query as $key){
			$query2 = $this->m_dashboard->get_trx($id,$key['id_jenis']);
				foreach($query2 as $value){
					$masuk = [
						'id_jenis_ret' => $value['id_jenis_ret'],
						'target' => $value['target'],
						'realisasi'=>$value['realisasi'],
						'nama'=>$value['nama_jenis'],
					];
					array_push($coba,$masuk);
				}
		}
		echo json_encode($coba);
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */