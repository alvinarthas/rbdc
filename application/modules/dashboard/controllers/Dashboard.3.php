<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok"); // set waktu yang sekarang di region indonesia
		date_default_timezone_get();
        $this->load->model('m_dashboard'); //set model dashboard
		// setting database
	}
	
	public function index() {
		//connection odbc
		$serverName = 'simda.bandung.go.id';//only the server name
		$conn = odbc_connect("Driver={SQL Server};Server=".$serverName."; Database=apbd_2017;","bppd","lapbppd"); 

		//connection mysql
		$servernama = "localhost";
		$username = "root";
		$password = "";
		$dbname = "disyanjak_retribusi";
		$conn2 = new mysqli($servernama, $username, $password, $dbname);

		// koneksi database odbc
		$sql_unit = "SELECT * from ref_unit order by id_unit";
		$result_unit = $conn2->query($sql_unit);
		$dash = array();
		$chart = array();

		//Loop berdasarkan unit
		while($row_unit = $result_unit->fetch_assoc()) {
			$unit = $row_unit["Nm_Unit"];
			$color= $row_unit["color"];

			$sql = "SELECT * from jenis_retribusi where Nm_Unit='$unit' order by id";
			$result = $conn2->query($sql);

			if($result->num_rows >0){
				$jumlah_now=0;

				// Loop berdasarkan retribusi
				while($row = $result->fetch_assoc()) {
					$Kd_Rek_1=$row["Kd_Rek_1"];
					$Kd_Rek_2=$row["Kd_Rek_2"];
					$Kd_Rek_3=$row["Kd_Rek_3"];
					$Kd_Rek_4=$row["Kd_Rek_4"];
					$Kd_Rek_5=$row["Kd_Rek_5"];
					$Nm_Rek_5=$row["Nm_Rek_5"];
					$Nm_Unit=$row["Nm_Unit"];
				
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
							if(odbc_result($result2, "Jumlah")===null){
								$Jumlah=0;
							}else{
								$Jumlah = odbc_result($result2, "Jumlah");
							}
							$jumlah_now+= $Jumlah;
						}
					
				}
				
				// Push into Array
				$data_dash['unit']= $unit;
				$data_chart['country']= $unit;
				$data_dash['target']=0;
				$data_dash['realisasi']=$jumlah_now;
				$data_chart['visits']=$jumlah_now;
				$data_chart['color']=$color;
				array_push($dash,$data_dash);
				array_push($chart,$data_chart);
				$jumlah_now=0;
			}
		}
		$data=[
			'dashboard' =>$dash,
			'chart' =>json_encode($chart),
		];
		$this->template->load('template_dashboard','v_index',$data);	// send to view
   	}

	public function detail_page($id){
		$serverName = 'simda.bandung.go.id';//only the server name
		$conn = odbc_connect("Driver={SQL Server};Server=".$serverName."; Database=apbd_2017;","bppd","lapbppd"); 

		$servernama = "localhost";
		$username = "root";
		$password = "";
		$dbname = "disyanjak_retribusi";
		$conn2 = new mysqli($servernama, $username, $password, $dbname);
		// koneksi database odbc
		$ids = str_replace('%20', ' ', $id);
		$jumlah_total=0;			
		$sqls = "SELECT * from jenis_retribusi where Nm_Unit='$ids' order by id";
		$results = $conn2->query($sqls);
		$Jumlah=0;
		$dtl =array();
		$dash =array();
		if ($results->num_rows > 0) {
    // output data of each row
			while($row = $results->fetch_assoc()) {
				$Kd_Rek_1=$row["Kd_Rek_1"];
				$Kd_Rek_2=$row["Kd_Rek_2"];
				$Kd_Rek_3=$row["Kd_Rek_3"];
				$Kd_Rek_4=$row["Kd_Rek_4"];
				$Kd_Rek_5=$row["Kd_Rek_5"];
				$Nm_Rek_5=$row["Nm_Rek_5"];
				$Nm_Unit=$row["Nm_Unit"];
			
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

		$data=[
			'detail' =>$dtl,
			'id' =>$ids,
		];
		$this->template->load('template_dashboard','v_detail',$data);	
	}

	public function all_retribusi(){
		$serverName = 'simda.bandung.go.id';//only the server name
		$conn = odbc_connect("Driver={SQL Server};Server=".$serverName."; Database=apbd_2017;","bppd","lapbppd"); 

		$servernama = "localhost";
		$username = "root";
		$password = "";
		$dbname = "disyanjak_retribusi";
		$conn2 = new mysqli($servernama, $username, $password, $dbname);
		// koneksi database odbc
		$jumlah_total=0;			
		$sqls = "SELECT * from jenis_retribusi order by id";
		$results = $conn2->query($sqls);
		$jml_now=0;

		$all =array();
		if ($results->num_rows > 0) {
    // output data of each row
			while($row = $results->fetch_assoc()) {
				$Kd_Rek_1=$row["Kd_Rek_1"];
				$Kd_Rek_2=$row["Kd_Rek_2"];
				$Kd_Rek_3=$row["Kd_Rek_3"];
				$Kd_Rek_4=$row["Kd_Rek_4"];
				$Kd_Rek_5=$row["Kd_Rek_5"];
				$Nm_Rek_5=$row["Nm_Rek_5"];
				$Nm_Unit=$row["Nm_Unit"];
			
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */