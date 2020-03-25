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
							
							
							
							
								<form action="<?php echo site_url('ref_role/index'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
								<div align="right">
						<?php if ($role['insert'] == "TRUE") { ?>
                            <a class="btn btn-green" href="<?php echo site_url("ref_role/tambih");?>"><i class="icon-plus-sign"></i> Tambah Data</a>
						<?php } ?>

                            </div>
								
									<div class="control-group">
										<label class="control-label" for="textfield">Pencarian</label>
										<div class="controls">
										<input type="text" value="<?php echo $this->session->userdata('s_cari_global'); ?>" class="form-control" name="cari_global" placeholder="Masukan kata kunci..."  >	
									
									  </div>
									</div>
						<div class="table-responsive">				
							<table width="100%" class="table table-hover">
	    						<thead>
									<tr>
										<th>Nama</th>											
										<th width="18%" colspan="3">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if (count($ListData) > 0) {
										foreach($ListData as $row){	?>
									<tr>
										<td><?php echo $row['nama_user_group']; ?></td>
										<td>
											<a class="btn btn-mini btn-success " href="<?php echo site_url();?>ref_role/lengkep/<?php echo $row['id_user_group']; ?>"><i class="icon-external-link"></i>Detail</a> 
										</td>									     
									     <td>
											<a class="btn btn-mini btn-warning " href="<?php echo site_url();?>ref_role/robih/<?php echo $row['id_user_group']; ?>"><i class="icon-pencil"></i>Ubah</a> 
										</td>
									    <td>
											<a class="btn btn-mini btn-danger" href="<?php echo site_url('ref_role/hupus/'.$row['id_user_group']);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><i class="icon-trash"></i> Hapus</a> 
										</td>
									  </tr>

				<?php
				
				$paging=(!empty($pagermessage) ? $pagermessage : '');
						
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
						</div>
					</div>
				</div> 
