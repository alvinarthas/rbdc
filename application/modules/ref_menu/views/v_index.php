<div class="container-fluid">
	<br>
	<div class="breadcrumbs">
		<ul>
			<?php foreach ($breadcrumbs as $key => $value) { ?>
			<li>
				<a href=<?php echo site_url($value['link'])?> > <?php echo $value['name']; ?></a>
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

				<form action="<?php echo site_url('ref_menu/index'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
					<div align="right">
						<?php if ($role['insert'] == "TRUE") { ?>
						<a class="btn btn-green" href="<?php echo site_url("ref_menu/tambih");?>"><i class="icon-plus-sign"></i>Tambah Menu</a>
						<?php } ?>
					</div>

					<div class="control-group">
						&nbsp;
					</div>
					<div class="table-responsive">
						<table width="100%" class="table table-hover">
							<thead>
								<tr>
									<th>Nama Menu</th>					
									<th width="15%" colspan="3">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($categoryList as $key => $value){
									$query = $this->db->query("select count(*) as jml from ref_menu where parrent='".$value['id_menu']."'")->row();
									?>
									<tr>
										<td>
											<?php if ($query->jml==0) { ?>
											<em style="color:#555;"><?php echo $value['nama_menu']; ?></em>
											<?php } else { echo "<strong>".$value['nama_menu']."</strong>"; } ?>
										</td>
										<td>
											<?php if ($role['update'] == "TRUE") { ?>
											<a class="btn btn-mini btn-warning " href="<?php echo site_url();?>ref_menu/robih/<?php echo $value['id_menu']; ?>"><i class="icon-pencil"></i>Ubah</a> 

											<?php } ?>

										</td>
										<td>
											<?php if ($role['delete'] == "TRUE") { ?>
											<a class="btn btn-mini btn-danger" href="<?php echo site_url('ref_menu/hupus/'.$value['id_menu']);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><i class="icon-trash"></i> Hapus</a>
											<?php } ?>


										</td>

									</tr>
									<?php } ?>	
								</tbody>
							</table>										
						</div>						
					</form>	
				</div>
			</div>
		</div>
	</div> 