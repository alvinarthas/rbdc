<!DOCTYPE html>
<html>
	<head>
		<title>FORM Data Masyarakat</title>
	</head>
	<style type="text/css">
	body{
		font-size: 12pt;
	}
		table{
			 border-collapse: collapse;
	   		border: 1px solid black;
			font-size: 12pt;
		}
		th {
		    background-color: #DDDDDD;
		    color: #333;
		    padding: 10px 0px;		    
		    border: solid 1px #AAA;
		font-size: 12pt;		    
		}
		td {
    		border: 1px solid #ddd;
    		text-align: center;
		font-size: 12pt;
		}			
		tr:nth-child(even) {background-color: #f9f9f9}
	</style>

	<body>
		<div style="text-align: center;margin-bottom: 0px">
		<center>
				<p style="font-size: 12pt;font-weight: bold;font-family: sans-serif;text-transform: uppercase;">FORM Data Masyarakat</p>
                <h4>RIAU BANGKIT DATA CENTER (RBDC)</h4>
		</center>
		</div>

		<div style="font-size: 10pt;">
        <form action="/action_page.php">
            Nama Lengkap :<br><input type="text" name="text" size="100" value="<?php echo isset($field->nama_lengkap)?$field->nama_lengkap:'';?>"><br><br>
            Nama Panggilan  : <br><input type="text" name="text" size="100"  value="<?php echo isset($field->nama_panggilan)?$field->nama_panggilan:'';?>"><br><br>
            Jenis Kelamin   : <br><input type="text" name="text" size="100"  value="<?php echo isset($field->jns_kel)?$field->jns_kel:'';?>"><br><br>
            Alamat          : <br><input type="text" name="text" size="100" value="<?php echo isset($field->alamat)?$field->alamat:'';?>"><br><br>
            No KTP          : <br><input type="text" name="text" size="100" value="<?php echo isset($field->ktp)?$field->ktp:'';?>"><br><br>
            No HP           : <br><input type="text" name="text" size="100" value="<?php echo isset($field->hp)?$field->hp:'';?>"><br><br>
            Kabupaten/Kota  : <br><input type="text" name="text" size="100" value="<?php echo isset($field->kabupaten)?$field->kabupaten:'';?>"><br><br>
            Kecamatan       : <br><input type="text" name="text" size="100" value="<?php echo isset($field->kecamatan)?$field->kecamatan:'';?>"><br><br>
            Kelurahan       : <br><input type="text" name="text" size="100" value="<?php echo isset($field->kelurahan)?$field->kelurahan:'';?>"><br><br>
            Pekerjaan       :<br> <input type="text" name="text" size="100" value="<?php echo isset($field->pekerjaan)?$field->pekerjaan:'';?>"><br><br>
            Penghasilan     : <br><input type="text" name="text" size="100" value="<?php echo isset($field->penghasilan)?$field->penghasilan:'';?>"><br><br>
            Umur            : <br><input type="text" name="text" size="100" value="<?php echo isset($field->umur)?$field->umur:'';?>"><br><br>
            Pendidikan Terakhir: <br><input type="text" name="text" size="100" value="<?php echo isset($field->pendidikan)?$field->pendidikan:'';?>"><br><br>
			Jumlah Anggota Keluarga: <br><input type="text" name="text" size="100" value="<?php echo isset($field->anggota_kel)?$field->anggota_kel:'';?>"><br><br>
			No TPS: <br><input type="text" name="text" size="100" value="<?php echo isset($field->no_tps)?$field->no_tps:'';?>"><br><br>
        </form>
		</div>
	</body>
</html>