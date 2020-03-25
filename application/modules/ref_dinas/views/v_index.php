<div class="container-fluid">
	<br>
	<div class="breadcrumbs">
		<ul>
			<li>
				<a href="#">Data Master</a>
				<i class="icon-angle-right"></i>
			</li>
			<li>
				<a href="#">Dinas</a>
				<i class="icon-angle-right"></i>
			</li>
			
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
				<form action="<?php echo site_url('ref_dinas/index'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
					<div align="right">
						<?php if ($role['insert'] == "TRUE") { ?>
						<a class="btn btn-green" href="<?php echo site_url();?>ref_dinas/tambih"><i class="icon-plus-sign"></i> Tambah Data</a>
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
									<th>Nama</th>
									<th width="10%">Aksi</th>
									<th width="10%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (count($ListData) > 0) {
									foreach($ListData as $row)
									{
								?>
										<tr></tr>
											<td><?php echo $row['nama']; ?></td>
											<td>
												<?php if ($role['update'] == "TRUE") { ?>
												<a class="btn btn-mini btn-warning " href="<?php echo site_url();?>ref_dinas/robih/<?php echo $row['id_dinas']; ?>"><i class="icon-pencil"></i>Ubah</a> 
												<?php } ?>

											</td>
											<td>
												<?php if ($role['delete'] == "TRUE") { ?>
												<a class="btn btn-mini btn-danger" href="<?php echo site_url('ref_dinas/hupus/'.$row['id_dinas']);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><i class="icon-trash"></i> Hapus</a>
												<?php } ?>
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
			</div> <!-- /box content-->
		</div> <!-- /box-->
	</div> <!-- /span12-->
</div> <!-- /row fluid-->

<script type="text/javascript">
    $("#cari_dinas").keyup(function(){
        var cari_dinas = document.getElementById("cari_dinas").value;
        console.log(cari_dinas);
        $.ajax({
            type:'GET',
            url:'<?php echo site_url('ref_dinas/ajx_dinas');?>',
            dataType:'json',
            delay:250,
            data:{
                'cari_dinas':cari_dinas
            },
            success:function(data){
                console.log(data);
            }
        });
    });
</script>