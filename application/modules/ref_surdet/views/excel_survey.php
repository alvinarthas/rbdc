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
					<th colspan="10">Rekap Survey per <?=$daerah;?></th>
				</tr>
				<tr>
					<th colspan="10">Riau Bangkit Data Center (RBDC)</th>
				</tr>
				<tr>
					<th rowspan="2">No</th>
					<th rowspan="2"><?=$daerah2;?></th>
					<th rowspan="2">Jumlah DPT</th>
					<th rowspan="2">Jumlah TPS</th>
					<th rowspan="2">Target Suara DPT</th>
					<th colspan="5">Calon yang Dipilih</th>
					<th rowspan="2">Belum Menentukan Pilihan</th>
				</tr>
				<tr>
				<th>Syamsuar - Edy Nasution</th>			
				<th>Lukman Edy - Hardianto</th>
				<th>Firdaus - Rusli Effendi</th>
				<th>Andi Rachman - Suyatno</th>
				<th>Belum Mengetahui Pilihan</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i=1; 
			foreach($survey as $kab) { ?>
			<tr>
				<td><?=$i?></td>
				<td><?=$kab['daerah']?></td>
				<td><?php echo number_format($kab['total_dpt']); ?></td>
				<td><?=$kab['total_tps']?></td>
				<td><?php echo number_format($kab['target_dpt']); ?></td>
				<td><?=$kab['calon1']?></td>
				<td><?=$kab['calon2']?></td>
				<td><?=$kab['calon3']?></td>
				<td><?=$kab['calon4']?></td>
				<td><?=$kab['xcalon']?></td>
				<td><?=$kab['sisa_ttl']?></td>
			<tr>
			<?php $i++;
			}?>
            </tbody>
		</table>
		</div>
	</body>
</html>