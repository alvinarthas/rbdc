<!DOCTYPE html>
<?php 
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$filename.".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
?>
<html>
	<head>
		<title>Rekap Survey</title>
	</head>
	<body>
		<div>
		<table border="1">
			<thead>
				<tr>
					<th colspan="8">Rekap Survey per </th>
				</tr>
				<tr>
					<th colspan="8">Riau Bangkit Data Center (RBDC)</th>
				</tr>
				<tr>
					<th rowspan="2">No</th>
					<th rowspan="2"><?=$daerah?></th>
					<th rowspan="2">Jumlah DPT</th>
					<th colspan="4">Calon yang Dipilih</th>
					<th rowspan="2">Belum Memilih</th>
				</tr>
				<tr>
					<th>Paslon 1</th>
					<th>Paslon 2</th>
					<th>Paslon 3</th>
					<th>Paslon 4</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i=1; 
			foreach($survey as $kab) { ?>
			<tr>
				<td><?=$i?></td>
				<td><?=$kab['daerah']?></td>
				<td><?=$kab['total_dpt']?></td>
				<td><?=$kab['calon1']?></td>
				<td><?=$kab['calon2']?></td>
				<td><?=$kab['calon3']?></td>
				<td><?=$kab['calon4']?></td>
				<td><?=$kab['sisa_ttl']?></td>
			<tr>
			<?php $i++;
			}?>
            </tbody>
		</table>
		</div>
	</body>
</html>