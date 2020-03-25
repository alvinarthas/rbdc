<div class="table-responsive">				
<table id="myTable" width="100%" class="table table-hover" border="2">
	<thead>
		<tr>																		
			<th rowspan="2">No</th>
			<th rowspan="2">Kabupaten</th>
			<th rowspan="2">DPT</th>
			<th colspan="8"><center>Paslon</center></th>
			<th colspan="3"><center>Suara</center></th>
			<th colspan="3"><center>TPS</center></th>
			<th rowspan="2">Partisipasi</th>
		</tr>
		<tr>
			<th style="background-color:#bfbfbf" colspan="2">Syamsuar - Edy Nasution</th>
			<th style="background-color:#00cc00" colspan="2">Lukman Edy - Hardianto</th>
			<th style="background-color:#0099ff" colspan="2">Firdaus - Rusli Effendi</th>
			<th style="background-color:#ffff1a" colspan="2">Andi Rachman - Suyatno</th>
			<th>Sah</th>
			<th>Tidak Sah</th>
			<th>Total</th>
			<th>Jumlah</th>
			<th>Masuk</th>
			<th>Kurang</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i=1; 
	foreach($tabel as $key) { ?>
		<tr>
			<td><?=$i?></td>
			<td><?=$key['kabupaten']?></td>
			<td><?=$key['dpt']?></td>
			<td><?=$key['calon1']?></td>
			<td><?=number_format($key['persen1'], 2, '.', '');?> %</td>
			<td><?=$key['calon2']?></td>
			<td><?=number_format($key['persen2'], 2, '.', '');?> %</td>
			<td><?=$key['calon3']?></td>
			<td><?=number_format($key['persen3'], 2, '.', '');?> %</td>
			<td><?=$key['calon4']?></td>
			<td><?=number_format($key['persen4'], 2, '.', '');?> %</td>
			<td><?=$key['sah']?></td>
			<td><?=$key['tdk']?></td>
			<td><?=$key['total']?></td>
			<td><?=$key['jumlah']?></td>
			<td><?=$key['masuk']?></td>
			<td><?=$key['keluar']?></td>
			<td><?=number_format($key['partisipasi'], 2, '.', '');?> %</td>
		</tr>
	<?php $i++;
	}?>
	</tbody>
</table>
