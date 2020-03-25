<div align="right">
	<a class="btn btn-primary" href="<?php echo site_url("ref_daerah/tambah");?>"><i class="icon-plus"></i> Tambah Daerah</a>
</div>
<div class="table-responsive">				
<table id="myTable" width="100%" class="table table-hover">
	<thead>
		<tr>																		
			<th>No</th>
			<th>Kabupaten</th>
			<th colspan="2">Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i=1; 
	foreach($daerah as $key) { ?>
		<tr>
			<td><?=$i?></td>
			<td><?=$key->kabupaten?></td>
			<td>
				<a class="btn btn-mini btn-warning " href="<?php echo site_url();?>ref_daerah/edit/kabupaten/<?=$key->id?>"><i class="icon-pencil"></i>Ubah</a> 
			</td>
			<td>
				<a class="btn btn-mini btn-danger" href="<?php echo site_url('ref_daerah/delete/kabupaten/'.$key->id);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><i class="icon-trash"></i> Hapus</a>
			</td>
		</tr>
	<?php $i++;
	}?>
	</tbody>
</table>
