<div class="container-fluid">
	<br>
	<div class="breadcrumbs">
		<ul>
		<?php foreach ($breadcrumbs as $key => $value) { ?>
			<li>
				<a href=<?php echo site_url($value['link'])?> >
				<?php echo $value['name']; ?></a>
				<?php echo (count($breadcrumbs)-1)==$key?"":"<i class='icon-angle-right'></i>"; ?>
			</li>
		<?php } ?>
		</ul>
		<div class="close-bread">
			<a href="#"><i class="icon-remove"></i></a>
		</div>
	</div>
</div>
			
			
			
<div class="row-fluid">
		<div class="span12">
			<div class="box">
				<div class="box-title">
					<h3>
						<i class="icon-reorder"></i>
						<?php echo $sub_judul_form;?>
					</h3>
				</div>
				<div class="box-content">
				<form action="<?php echo site_url('map_partai/index'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div align="right">
					<a class="btn btn-green" href="<?php echo site_url("map_partai/tambih");?>"><i class="icon-plus-sign"></i> Tambah Data</a>
				</div>
			<div class="table-responsive">				
				<table width="100%" class="table table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Cagub</th>
							<th>Nama Cawagub</th>
							<th>Nama Partai</th>														
							<th>Aksi</th>																									</tr>
					</thead>
					<tbody>
						<?php
							$i=1;
							foreach($ListData as $row){	?>
						<tr>
							<td><?=$i?></td>
							<td><?php echo $row['nm_cagub']; ?></td>
							<td><?php echo $row['nm_cawagub']; ?></td>										
							<td><?php echo $row['nm_partai']; ?></td>
							<td>
								<a class="btn btn-mini btn-danger" href="<?php echo site_url('map_partai/hupus/'.$row['id_calon'].'/'.$row['id_partai']);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><i class="icon-trash"></i> Hapus</a> 
							</td>
							</tr>
						<?php
						
						$paging=(!empty($pagermessage) ? $pagermessage : '');
								$i++;
							}
							echo "<tr><td colspan='9'><div style='background:000;'>$paging &nbsp;".$this->pagination->create_links()."</div></td></tr>";
						?>
					</tbody>
				</table>
			</div>									
			</form>	
			</div>
		</div>
	</div>
</div> 
