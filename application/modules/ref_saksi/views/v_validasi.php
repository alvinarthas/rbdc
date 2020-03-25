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
				<form action="<?php echo site_url('ref_saksi/index'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<?php if ($role['insert'] == "TRUE") { ?>
				<div align="right">
					<a class="btn btn-green" href="<?php echo site_url("ref_saksi/tambih");?>"><i class="icon-plus-sign"></i> Tambah Data</a>
				</div>
				<?php } ?>
				
				<div class="control-group">
					<label class="control-label" for="textfield">Pencarian</label>
					<div class="controls">
						<input type="text" value="<?php echo $this->session->userdata('s_cari_global'); ?>" class="form-control" name="cari_global" placeholder="Masukan kata kunci... (Nama)"  >	
					</div>
				</div>
				</form>	
				<form action="<?php echo site_url('ref_saksi/validasi'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
				<div class="table-responsive">				
					<table id="myTable" width="100%" class="table table-hover">
						<thead>
							<th>No</th>
							<th>No KTP</th>
							<th>Nama Lengkap</th>
							<th>Alamat</th>																				
							<th>Status Validasi</th>
							<th>Validasi</th>																			
							<th>Aksi</th>
						</thead>
						<tbody>
							<?php if (count($ListData) > 0) {
								$i=1;
								foreach($ListData as $row){	?>
							<tr>
								<td><?=$i?></td>
								<td><?=$row->ktp?></td>
								<td><?=$row->nama_lengkap?></td>
								<td><?=$row->alamat?></td>
								<?php if($row->valid_rekomendasi == "Sudah"){ ?>
									<td><?=$row->valid_rekomendasi?>  <a class="btn btn-mini btn-success" href="<?php echo site_url('ref_saksi/cetak/'.$row->id);?>" onclick="return confirm('Anda Yakin ingin Mencetak?'); "><i class="icon-print"></i> Cetak</a></td>
									<td><a class="btn btn-mini btn-danger" href="<?php echo site_url('ref_saksi/un_validate/'.$row->id);?>" onclick="return confirm('Anda Yakin ingin Membatalkan?'); ">Batalkan</a></td>
								<?php }else{?>
								<td><?=$row->valid_rekomendasi?></td>
								<td><input type="checkbox" name="validasi[]" value="<?=$row->id?>"></td>
								<?php } ?>
								<td>
									<?php if ($role['delete'] == "TRUE") { ?>
									<a class="btn btn-mini btn-danger" href="<?php echo site_url('ref_saksi/hupus/'.$row->id);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><i class="icon-trash"></i> Hapus</a>
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
					</table>
				</div>
				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Validasi</button>
				</div>							
				</form>	
			</div>
		</div>
	</div>
</div> 