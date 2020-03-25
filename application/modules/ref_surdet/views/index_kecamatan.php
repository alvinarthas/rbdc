<div align="right">
	<a class="btn btn-green" href="<?php echo site_url("ref_surdet/cetak_excel_kec/$daerah/$id_kab");?>"><i class="icon-print"></i> Cetak Rekap Excel</a>
</div>
<div class="table-responsive">				
<table id="myTable" width="100%" class="table table-hover">
	<thead>
		<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">Kecamatan</th>
			<th rowspan="2">Jumlah DPT</th>
			<th rowspan="2">Jumlah TPS</th>
			<th rowspan="2">Target Suara DPT</th>
			<th colspan="5"><center>Pasangan Calon</center></th>
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
	foreach($kecall as $kab) { ?>
	<tr>
		<td><?=$i?></td>
		<td><?=$kab['kecamatan']?></td>
		<td><?php echo number_format($kab['total_dpt']); ?></td>
		<td><?=$kab['total_tps']?></td>
		<td><?php echo number_format($kab['target_dpt']); ?></td>
		<td><?=$kab['calon1']?></td>
		<td><?=$kab['calon2']?></td>
		<td><?=$kab['calon3']?></td>
		<td><?=$kab['calon4']?></td>
		<td><?=$kab['xcalon']?></td>
		<td><?php echo number_format($kab['sisa_ttl']); ?></td>
	<tr>
	<?php $i++;
	}?>
	</tbody>
</table>
