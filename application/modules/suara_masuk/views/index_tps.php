<div align="right">
	<a class="btn btn-primary" href="<?php echo site_url("ref_tps/add_tps");?>"><i class="icon-print"></i>Tambah Data TPS</a>
</div>
<div class="table-responsive">				
<table id="myTable" width="100%" class="table table-hover">
	<thead>
		<tr>																		
			<th>No</th>
			<th>No TPS</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i=1; 
	foreach($tps as $key) { ?>
		<tr>
			<td><?=$i?></td>
			<td><?=$key['tps']?></td>
			<td><a class="btn btn-mini btn-primary" href="<?php echo site_url('suara_masuk/atur/'.$key['id']);?>"><i class="icon-write"></i> Entry Data Suara Masuk</a></td>
		</tr>
        <?php $i++;
        }?>
	</tbody>
</table>
