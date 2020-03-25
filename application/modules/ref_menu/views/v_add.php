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
				<h3><i class=" icon-plus-sign"></i><?php echo $judul_form." ".$sub_judul_form;?> </h3>
			</div>
			<div class="box-content">
			<!-- <form action="#" method="POST" class='form-horizontal form-validate' id="bb"> -->
				<?php echo form_open('ref_menu/tambih_robih',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				
				<input type="hidden" name="id_menu" id="id_menu" value="<?php echo isset($field->id_menu)?$field->id_menu:'';?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

                		<input type="hidden" value="<?php echo $this->input->ip_address(); ?>" name="ip_address">

                
                <div class="control-group">
                	<label for="textfield" class="control-label">Nama Menu</label>
                		<div class="controls">
                			<input type="text" name="nama_menu" id="nama_menu" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->nama_menu)?$field->nama_menu:'';?>">
						</div>
				</div>

				<div class="control-group password">
                	<label for="textfield" class="control-label">Parrent</label>
                		<div class="controls">
                			<select data-rule-required="true" name="parrent" class="input-xxlarge">
                				<option value="0">Pilih</option>
								<?php 
								 
								

								foreach($categoryList as $key => $value){
    								
    								$query = $this->db->query("select count(*) as jml from ref_menu where parrent='".$value['id_menu']."'")->row();


											echo "<option value='".$value['id_menu']."' ";
    								if (isset($field->id_menu)){
										if ($field->id_menu!=$value['id_menu']) {
											echo $field->parrent==$value['id_menu']?'selected=""':'';
										}											
									}
											echo ">";
        									echo $value['nama_menu'];
											echo " </option>";									
    							?>
      							<tr>
        							<td>
        								<?php if ($query->jml==0) { ?>
        									<em style="color:#555;"><?php echo $value['nama_menu']; ?></em>
        								<?php } else { echo "<strong>".$value['nama_menu']."</strong>"; } ?>
        							</td>
									<td>
										<a class="btn btn-mini btn-warning " href="<?php echo site_url();?>ref_menu/robih/<?php echo $value['id_menu']; ?>"><i class="icon-pencil"></i>Ubah</a> 
									</td>
									<td>
										<a class="btn btn-mini btn-danger" href="<?php echo site_url('ref_menu/hupus/'.$value['id_menu']);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><i class="icon-trash"></i> Hapus</a>
									</td>

      							</tr>
      							<?php } ?>
                			</select>
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Link</label>
                		<div class="controls">
                			<input type="text" name="link" id="link" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->link)?$field->link:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Urutan</label>
                		<div class="controls">
                			<input type="number" name="urutan" id="urutan" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->urutan)?$field->urutan:'';?>">
						</div>
				</div>

				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url();?>ref_menu/">Kembali</a>
				</div>

				</form>
			</div>       
		</div>
	</div>						
</div>