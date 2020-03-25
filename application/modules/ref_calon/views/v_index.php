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
	</div> <!-- /breadcrumbs-->
</div> <!-- /container-fluid-->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3>
					<i class="icon-reorder"></i>
					<?php echo $sub_judul_form;?>
				</h3>
			</div> <!-- /box title-->
			<div class="box-content">
				<form action="<?php echo site_url('ref_calon/index'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
					<div align="right">
						<?php if ($role['insert'] == "TRUE") { ?>
						<a class="btn btn-green" href="<?php echo site_url();?>ref_calon/tambih"><i class="icon-plus-sign"></i> Tambah Data</a>
						<?php } ?>

					</div>
					
					<div class="control-group">
						<label class="control-label" for="textfield">Pencarian</label>
						<div class="controls">
							<input type="text" class="form-control" id="cari_dinas" name="cari_global" placeholder="Masukan kata kunci...">	
							
						</div>
					</div>
					<div class="table-responsive">				
						<table width="100%" class="table table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>No Urut</th>
									<th>Nama Calon Gub</th>
									<th>Nama Calon WaGub</th>
									<th>Gambar</th>
									<th width="10%">Aksi</th>
									<th width="10%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (count($ListData) > 0) {
									$i=1;
									foreach($ListData as $row)
									{
								?>
									<tr></tr>
										<td><?=$i?></td>
										<td><?=$row['no_urut']; ?></td>
										<td><?=$row['nm_cagub']; ?></td>
										<td><?=$row['nm_cawagub']; ?></td>
										<td><img src="<?php echo site_url();?>assets_users/paslon/<?=$row['gambar']?>" width="25%" alt=""></td>
										<td>
											<?php if ($role['update'] == "TRUE") { ?>
											<a class="btn btn-mini btn-warning " href="<?php echo site_url();?>ref_calon/robih/<?php echo $row['id']; ?>"><i class="icon-pencil"></i>Ubah</a> 
											<?php } ?>

										</td>
										<td>
											<?php if ($role['delete'] == "TRUE") { ?>
											<a class="btn btn-mini btn-danger" href="<?php echo site_url('ref_calon/hupus/'.$row['id']);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><i class="icon-trash"></i> Hapus</a>
											<?php } ?>
										</td>
									</tr>
									<?php
									$paging=(!empty($pagermessage) ? $pagermessage : '');
									$i++;
									}
									echo "<tr><td colspan='9'><div style='background:000;'>$paging &nbsp;".$this->pagination->create_links()."</div></td></tr>";
								} else {
									echo "<tbody><tr><td colspan='9' style='padding:10px; background:#F00; border:none; color:#FFF;'>Data Tidak Tersedia</td></tr></tbody>";
								}
								?>
							</tbody>
						</table></div>									
					</form>	
				</div>
			</div> <!-- /box content-->
		</div> <!-- /box-->
	</div> <!-- /span12-->
</div> <!-- /row fluid-->