<!DOCTYPE html>
<?php 
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$filename.".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
?>
<html>
	<head>
		<title>Rekap Saksi</title>
	</head>
	<body>
<div class="table-responsive">				
<table border="1">
	<thead>
		<tr>
			<th colspan="8">Rekap Survey per </th>
		</tr>
		<tr>
			<th colspan="8">Riau Bangkit Data Center (RBDC)</th>
		</tr>
		<tr>																		
			<th>No</th>
			<th>No KTP</th>
			<th>Nama Lengkap</th>
			<th>No HP</th>
			<th>Alamat</th>
			<th>No TPS</th>
			<th>Asal Profil</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i=1; 
	foreach($saksi as $key) { ?>
		<tr>
			<td><?=$i?></td>
			<td><?=$key['ktp']?></td>
			<td><?=$key['nama_lengkap']?></td>
			<td><?=$key['hp']?></td>
			<td><?=$key['alamat']?></td>
			<td><?=$key['no_tps']?></td>
			<td><?=$key['profil']?></td>
		</tr>
	<?php $i++;
	}?>
	</tbody>
</table>
</div>
	</body>
</html>
