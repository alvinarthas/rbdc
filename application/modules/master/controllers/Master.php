<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Master extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
		$this->atos_tiasa_leubeut();
		$this->load->model('master_model');
    }   
    
    
	public function atos_tiasa_leubeut(){
		
		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
    }

		
	public function get_dinas($where = NULL){
    	return $this->master_model->get_dinas($where);
  	}
	
	public function get_prov($where = NULL){
    	return $this->master_model->get_prov($where);
  	}

  	public function get_kokab($where = NULL){
    	return $this->master_model->get_kokab($where);  		
  	}

    public function get_kecamatan($where = NULL){
      return $this->master_model->get_kecamatan($where);      
    }

    public function get_kelurahan($where = NULL){
      return $this->master_model->get_kelurahan($where);      
    }

    public function get_agama($where = NULL){
      return $this->master_model->get_agama($where);      
    }

    public function get_fakultas($where = NULL){
      return $this->master_model->get_fakultas($where);      
    }

    public function get_prodi($where = NULL){
      return $this->master_model->get_prodi($where);      
    }

    public function get_pendidikan($where = NULL){
      return $this->master_model->get_pendidikan($where);      
    }

    public function get_kokab_prov($idprov = null){
      $output = '<option value="">Pilih Kota / Kab</option>';
      if($idprov !=null){
    $sql = "select * from kabupaten where prov_id=".$idprov."";   
    $query = $this->db->query($sql);
    foreach($query->result() as $row){
      $output .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
      }
    }
    echo json_encode($output);
  }

    public function get_kec_kokab($idkokab = null){
      $output = '<option value="">Pilih Kecamatan</option>';
      if ($idkokab != null) {
      
        $sql = "select * from kecamatan where kab_id=".$idkokab."";   
        $query = $this->db->query($sql);
        foreach($query->result() as $row){
          $output .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
        }
      } 
      echo json_encode($output);
    }

    public function get_desa_kec($idkec = null){
      $output = '<option value="">Pilih Desa</option>';
      if ($idkec != null) {
        $sql = "select * from desa where kec_id=".$idkec."";   
        $query = $this->db->query($sql);
        foreach($query->result() as $row){
          $output .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
        }
      }
      echo json_encode($output);
    }

  public function get_prodi_fakultas($idfakultas=null){
  $output = '<option value="">Pilih Prodi</option>';
    if ($idfakultas != null) {
      $sql = "select * from ref_fakultas_prodi where id_fakultas=".$idfakultas."";   
      $query = $this->db->query($sql);
      foreach($query->result() as $row){
        $output .= '<option value="'.$row->id_prodi.'">'.$row->prodi.' ('.$row->jenjang.')</option>';
      }
    }
    echo json_encode($output);
  }

  public function get_instansi_name($id){
  $output ='';
    if ($id != null) {
      $sql = "select * from ref_instansi where id_instansi=".$id."";   
      $query = $this->db->query($sql);
      $data = $query->row();
      $output.= $data->instansi;
    }
    echo $output;
  }

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
