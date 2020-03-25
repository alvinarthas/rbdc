<div align="right">
	<a class="btn btn-primary" href="<?php echo site_url("ref_tps/add_tps");?>"><i class="icon-print"></i>Tambah Data TPS</a>
</div>
<div class="table-responsive">				
<table id="myTable" width="100%" class="table table-hover">
	<thead>
		<tr>																		
			<th>No</th>
			<th>No TPS</th>
			<th>Jumlah DPT</th>
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
			<td><?=$key['dpt']?></td>
			<td>
			<a class="btn btn-mini btn-warning " href="<?php echo site_url();?>ref_tps/edit_tps/<?php echo $key['id']; ?>"><i class="icon-pencil"></i>Ubah</a>
			<a class="btn btn-mini btn-danger" href="<?php echo site_url('ref_tps/hupus/'.$key['id']);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><i class="icon-trash"></i> Hapus</a></td>
		</tr>
        <?php $i++;
        }?>
	</tbody>
</table>
