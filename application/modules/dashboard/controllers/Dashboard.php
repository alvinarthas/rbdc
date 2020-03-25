<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//set time
		date_default_timezone_set("Asia/Bangkok"); // set waktu yang sekarang di region indonesia
		date_default_timezone_get();
		//set model
        $this->load->model('m_dashboard'); //set model dashboard
	}
	
	public function index() {
		//connection odbc
		$serverName = 'simda.bandung.go.id';//only the server name
		$conn = odbc_connect("Driver={SQL Server};Server=".$serverName."; Database=apbd_2017;","bppd","lapbppd");

		// get setiap unit
		$sql_unit = $this->m_dashboard->get_unit();
		$dash = array();
		$chart = array();

		//Loop berdasarkan unit
		foreach($sql_unit->result() as $row_unit){
			$unit = $row_unit->Nm_Unit;
			$color= $row_unit->color;

			$sql = $this->m_dashboard->get_retribusi($unit);

			if($sql->num_rows() >0){
				$jumlah_now=0;

				// Loop berdasarkan retribusi
				foreach($sql->result() as $row){
					$Kd_Rek_1=$row->Kd_Rek_1;
					$Kd_Rek_2=$row->Kd_Rek_2;
					$Kd_Rek_3=$row->Kd_Rek_3;
					$Kd_Rek_4=$row->Kd_Rek_4;
					$Kd_Rek_5=$row->Kd_Rek_5;
					$Nm_Rek_5=$row->Nm_Rek_5;
					$Nm_Unit=$row->Nm_Unit;
				
					//query ke odbc
					$sql2 = "select  rr5.Nm_Rek_5, sum(tbpr.Nilai) as Jumlah 
					from Ta_Bukti_Penerimaan_Rinc tbpr 
					INNER JOIN Ref_Rek_5 rr5 on (
						tbpr.Kd_Rek_1=rr5.Kd_Rek_1 and
					tbpr.Kd_Rek_2=rr5.Kd_Rek_2 and
					tbpr.Kd_Rek_3=rr5.Kd_Rek_3 and
					tbpr.Kd_Rek_4=rr5.Kd_Rek_4 and
					tbpr.Kd_Rek_5=rr5.Kd_Rek_5 )
					WHERE tbpr.Kd_Rek_1 = $Kd_Rek_1 and tbpr.Kd_Rek_2 = $Kd_Rek_2 and tbpr.Kd_Rek_3 = $Kd_Rek_3 and tbpr.Kd_Rek_4 = $Kd_Rek_4 and tbpr.Kd_Rek_5 = $Kd_Rek_5
					GROUP BY rr5.Nm_Rek_5";

					//looping penjumlahan
					$result2 = odbc_exec($conn, $sql2);
						while (odbc_fetch_row($result2)) {
							if(odbc_result($result2, "Jumlah")===null){
								$Jumlah=0;
							}else{
								$Jumlah = odbc_result($result2, "Jumlah");
							}
							$jumlah_now+= $Jumlah;
						}
					
				}
				
				// push ke dalam array
				$data_dash['unit']= $unit;
				$data_chart['country']= $unit;
				$data_dash['target']=0;
				$data_dash['realisasi']=$jumlah_now;
				$data_chart['visits']=$jumlah_now;
				$data_chart['color']=$color;
				array_push($dash,$data_dash);
				array_push($chart,$data_chart);
				//set back jumlah menjadi nol
				$jumlah_now=0;
			}
		}
		// array dimasukkan ke dalam variable data
		$data=[
			'dashboard' =>$dash,
			'chart' =>json_encode($chart),
		];
		// load view
		$this->template->load('template_dashboard','v_index',$data);	// send to view
   	}

	public function detail_page($id){
		//koneksi database odbc
		$serverName = 'simda.bandung.go.id';//only the server name
		$conn = odbc_connect("Driver={SQL Server};Server=".$serverName."; Database=apbd_2017;","bppd","lapbppd"); 

		$ids = str_replace('%20', ' ', $id); // menghilangkan %20 menjadi space
		$jumlah_total=0; // set jumalh total nol
		$sqls = $this->m_dashboard->get_retribusi($ids); // get retribusi dari id yang didapat

		$Jumlah=0; // set jumlah nol
		// atur array
		$dtl =array();
		$dash =array();

		if ($sqls->num_rows() >0) { // cek jika hasil row > 0
    
			foreach($sqls->result() as $row){ //loop hasil query
				$Kd_Rek_1=$row->Kd_Rek_1;
				$Kd_Rek_2=$row->Kd_Rek_2;
				$Kd_Rek_3=$row->Kd_Rek_3;
				$Kd_Rek_4=$row->Kd_Rek_4;
				$Kd_Rek_5=$row->Kd_Rek_5;
				$Nm_Rek_5=$row->Nm_Rek_5;
				$Nm_Unit=$row->Nm_Unit;
			
				//melakukan query dengan odbc
				$sql2 = "select  rr5.Nm_Rek_5, sum(tbpr.Nilai) as Jumlah 
				from Ta_Bukti_Penerimaan_Rinc tbpr 
				INNER JOIN Ref_Rek_5 rr5 on (
					tbpr.Kd_Rek_1=rr5.Kd_Rek_1 and
				tbpr.Kd_Rek_2=rr5.Kd_Rek_2 and
				tbpr.Kd_Rek_3=rr5.Kd_Rek_3 and
				tbpr.Kd_Rek_4=rr5.Kd_Rek_4 and
				tbpr.Kd_Rek_5=rr5.Kd_Rek_5 )
				WHERE tbpr.Kd_Rek_1 = $Kd_Rek_1 and tbpr.Kd_Rek_2 = $Kd_Rek_2 and tbpr.Kd_Rek_3 = $Kd_Rek_3 and tbpr.Kd_Rek_4 = $Kd_Rek_4 and tbpr.Kd_Rek_5 = $Kd_Rek_5
				GROUP BY rr5.Nm_Rek_5";
				
				// looping penjumlahan
				$result2 = odbc_exec($conn, $sql2);
				while (odbc_fetch_row($result2)) {
					if(odbc_result($result2, "Jumlah")===null){
						$Jumlah= 0;
					}else{
						$Jumlah = odbc_result($result2, "Jumlah");
					}
				}

				$data_dtl['unit'] = $Nm_Unit;
				$data_dtl['jenis_ret']=$Nm_Rek_5;
				$data_dtl['realisasi']=$Jumlah;
				$data_dtl['target']=0;
				array_push($dtl,$data_dtl);
				$Jumlah=0;
			}
		} else {
			echo "Not Found";
		}
		// array dimasukkan ke dalam variable data
		$data=[
			'detail' =>$dtl,
			'id' =>$ids,
		];
		// load view
		$this->template->load('template_dashboard','v_detail',$data);	
	}

	public function all_retribusi(){
		// koneksi database odbc
		$serverName = 'simda.bandung.go.id';//only the server name
		$conn = odbc_connect("Driver={SQL Server};Server=".$serverName."; Database=apbd_2017;","bppd","lapbppd"); 

		$jumlah_total=0;			
		$sqls = $this->m_dashboard->all_retribusi();
		$jml_now=0;
		$all =array();

		if ($sqls->num_rows() >0) {

			foreach($sqls->result() as $row){
				$Kd_Rek_1=$row->Kd_Rek_1;
				$Kd_Rek_2=$row->Kd_Rek_2;
				$Kd_Rek_3=$row->Kd_Rek_3;
				$Kd_Rek_4=$row->Kd_Rek_4;
				$Kd_Rek_5=$row->Kd_Rek_5;
				$Nm_Rek_5=$row->Nm_Rek_5;
				$Nm_Unit=$row->Nm_Unit;
			
				$sql2 = "select  rr5.Nm_Rek_5, sum(tbpr.Nilai) as Jumlah 
				from Ta_Bukti_Penerimaan_Rinc tbpr 
				INNER JOIN Ref_Rek_5 rr5 on (
					tbpr.Kd_Rek_1=rr5.Kd_Rek_1 and
				tbpr.Kd_Rek_2=rr5.Kd_Rek_2 and
				tbpr.Kd_Rek_3=rr5.Kd_Rek_3 and
				tbpr.Kd_Rek_4=rr5.Kd_Rek_4 and
				tbpr.Kd_Rek_5=rr5.Kd_Rek_5 )
				WHERE tbpr.Kd_Rek_1 = $Kd_Rek_1 and tbpr.Kd_Rek_2 = $Kd_Rek_2 and tbpr.Kd_Rek_3 = $Kd_Rek_3 and tbpr.Kd_Rek_4 = $Kd_Rek_4 and tbpr.Kd_Rek_5 = $Kd_Rek_5
				GROUP BY rr5.Nm_Rek_5";
				
				$result2 = odbc_exec($conn, $sql2);
				while (odbc_fetch_row($result2)) {
					if(odbc_result($result2, "Jumlah")==null){
						$Jumlah=0;
					}else{
						$Jumlah = odbc_result($result2, "Jumlah");
					}
				}
				$data_all['unit'] = $Nm_Unit;
				$data_all['jenis_ret']=$Nm_Rek_5;
				$data_all['realisasi']=$Jumlah;
				$data_all['target']=0;
				array_push($all,$data_all);
				$Jumlah=0;
			}
		} else {
			echo "Not Found";
		}

		$data=[
			'all' =>$all,
		];
		$this->load->view('dashboard/v_all',$data);
	}
}