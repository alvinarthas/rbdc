<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function navigasi() {
	$CI =& get_instance();
	$query = $CI->db->query("SELECT * from ref_menu")->result();
	$a="";
	foreach ($query as $key => $value) {
		$a.=$value->nama_menu;
		$a.=" - ";
	}
	return $a;
}


function info_user($id){
	$CI =& get_instance();
	$query = $CI->db->query("SELECT * from ref_users where id='$id' limit 1");
   return $query->row();
}

function penugasan_decrypt($id = null){
	switch ($id) {
		case 1:
			$return = "Pemerintahan Pusat";
			break;
		case 2:
			$return = "Pemerintahan Provinsi";
			break;
		case 3:
			$return = "Pemerintahan Kab / Kota";
			break;
		case 4:
			$return = "Pemerintahan Kecamatan";
			break;									
		case 5:
			$return = "Pemerintahan Kelurahan";
			break;
		
		default:
			$return = "-";
			break;
	}
   return $return;
}

	function menu_nav(){
		$CI =& get_instance();
		$menunav = '';
		$user_id = $CI->session->userdata('sesi_id');
		$user_id_group = info_user($user_id)->id_user_group;		
		$sql = "SELECT ref_menu.id_menu, nama_menu, link 
				FROM ref_menu
				LEFT JOIN ref_group_menu ON ref_group_menu.id_menu = ref_menu.id_menu
				WHERE id_user_group = '".$user_id_group."' AND parrent = 0 ORDER BY urutan asc";
		$query = $CI->db->query($sql);
		$i=0;
		foreach($query->result_array() as $row)
		{
			if(toogle($row['id_menu'],$user_id_group) > 0){
				$menunav .= "<li>";
				$menunav .= '<a href=# class="dropdown-toggle" data-toggle="dropdown">
								<span>'.$row['nama_menu'].'</span>
								<b class="caret"></b>
							</a>';
				$menunav .=	formatTree($row['id_menu'],$user_id_group);
				$menunav .= "</li>";
			}else{
				$menunav .= "<li>";
				$menunav .= '<a href="'.site_url($row['link']).'">
								<span>'.$row['nama_menu'].'</span>
							</a>';
				$menunav .= "</li>";
			}
			$i++;
		}
		
		echo $menunav;
	}		
	
	function formatTree($id_parent,$user_id_group){
		$CI =& get_instance();

		$sql = "SELECT ref_menu.id_menu, nama_menu, link 
				FROM ref_menu
				LEFT JOIN ref_group_menu ON ref_group_menu.id_menu = ref_menu.id_menu
				WHERE id_user_group = '".$user_id_group."' AND parrent = '".$id_parent."' ORDER BY urutan asc";

		
		$query = $CI->db->query($sql);
		$menunav = "<ul class='dropdown-menu'>";
        foreach($query->result_array() as $item){
			if(toogle($item['id_menu'],$user_id_group) > 0){
				$menunav .= "<li class='dropdown-submenu'>";
				$menunav .= '<a href="#">'.$item['nama_menu'].'</a>';
				$menunav.= formatTree($item['id_menu'],$user_id_group);
				$menunav.= "</li>";		
		
			}else{
				$menunav .= "<li>";
				$menunav .= '<a href="'.site_url($item['link']).'">'.$item['nama_menu'].'</a>';
				$menunav.= "</li>";	
			}
        }


      $menunav.= "</ul>";
	  return $menunav;
    }
	
	function toogle($id_parent,$user_id_group){
		$CI =& get_instance();
		$sql = "SELECT ref_menu.id_menu, nama_menu, link 
				FROM ref_menu
				LEFT JOIN ref_group_menu ON ref_group_menu.id_menu = ref_menu.id_menu
				WHERE id_user_group = '".$user_id_group."' AND parrent = '".$id_parent."' ORDER BY urutan asc";					
		$query = $CI->db->query($sql);
		return $query->num_rows();
    }

	function toogle2($id_parent){
		$CI =& get_instance();
		$sql = "SELECT * 
				FROM ref_menu
				WHERE parrent = '".$id_parent."' ORDER BY urutan asc";					
		$query = $CI->db->query($sql);
		return $query->num_rows();
    }    


    function menu_json_format(){
		$CI =& get_instance();
		$menunav = '';
		$user_id = $CI->session->userdata('sesi_id');
		$sql = "SELECT * FROM ref_menu
				WHERE parrent = 0 ORDER BY urutan asc";
		$query = $CI->db->query($sql);
		$i=0;
		foreach($query->result_array() as $row)
		{
			if(toogle2($row['id_menu']) > 0){
				$data[]= array(
							'id_menu' => $row['id_menu'],
							'parrent' => $row['parrent'],
							'nama_menu' => $row['nama_menu'],
							'link' => $row['link'],
							'class_active' => $row['class_active'],
							'icon' => $row['icon'],							
							'child' =>formatTree2($row['id_menu'])
							);
			}else{
				$data[]= array(
							'id_menu' => $row['id_menu'],
							'parrent' => $row['parrent'],							
							'nama_menu' => $row['nama_menu'],
							'link' => $row['link'],
							'class_active' => $row['class_active'],
							'icon' => $row['icon']
							);
			}
			$i++;
		}
		
		return $data;
	}


function decode_role($string) {		
	
	$role_return['update'] = "FALSE";
	$role_return['insert'] = "FALSE";
	$role_return['delete'] = "FALSE";			
	
	$role_array = str_split($string);
	foreach ($role_array as $key => $value) {
		switch ($value) {
		    case "C":
				$role_return['insert'] = "TRUE";
			break;
		    case "U":
				$role_return['update'] = "TRUE";
			break;
		    case "D":
				$role_return['delete'] = "TRUE"; 
			break;		        
		    default:
				"";
		}

	}
	return $role_return;	
}

function get_role($iduser, $action = null) {
	$CI =& get_instance();
	$link = $CI->uri->segment(1);
	$idmenu = $CI->db->query("SELECT id_menu from ref_menu where link = '".$link."'")->row();
	$idmenu = $idmenu->id_menu;

	$query = $CI->db->query("SELECT role from ref_group_menu 
		WHERE id_user_group = '".$iduser."' 
			AND id_menu = '".$idmenu."' ")->row();
	$data = decode_role($query->role);	
	if ($action == null) {
		return $data;	
	} else {
		permission_role($query->role,$action);
	}
	
}


function permission_role($role, $action) {
	switch ($action) {
		case 'insert':
		$find   = 'C';
		break;

		case 'update':
		$find   = 'U';
		break;

		case 'delete':
		$find   = 'D';
		break;

		default:
		$find	 = 'ZZ';
		break;
		}
		$pos = strpos($role, $find);
		if ($pos === false) {
			echo "Oops, You dont have permissions giving action '".strtoupper($action)."' into this page. please <a href=".base_url().">back now!</a>";
			exit();
		} else {
			return TRUE;
		}
}
	

?>