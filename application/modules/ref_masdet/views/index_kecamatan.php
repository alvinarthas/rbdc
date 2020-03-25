<div align="right">
	<a class="btn btn-green" href="<?php echo site_url("ref_masdet/kec_excel/$kec");?>"><i class="icon-print"></i> Cetak Rekap Excel</a>
</div>
<div class="table-responsive">				
<table id="myTable" width="100%" class="table table-hover">
	<thead>
		<tr>																		
			<th>No</th>
			<th>No KTP</th>
			<th>Nama Lengkap</th>
			<th>No Hp</th>
			<th>Alamat</th>
			<th>Kelurahan</th>
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
			<td><?=$key['kelurahan']?></td>
			<td><?=$key['no_tps']?></td>
			<td><?=$key['profil']?></td>
		</tr>
	<?php $i++;
	}?>
	</tbody>
</table>
