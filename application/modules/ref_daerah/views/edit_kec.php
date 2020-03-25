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
				<?php echo form_open('ref_daerah/edit_action',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>

                <input type="hidden" name="daerah" id="daerah" value="kecamatan">
                <input type="hidden" name="id" id="id" value="<?=$kecamatan->id?>">
				
                <div class="control-group">
				<label for="textfield" class="control-label">Kabupaten/Kota</label>
					<div class="controls">
						<select data-rule-required="true" name="kabupaten" id="kabupaten" class="input-xxlarge">
						<option value="*" disabled selected>Pilih</option>
						<?php foreach($kabupaten as $key){
							if($kab->id == $key->id){?>
								<option value="<?=$key->id?>" selected><?=$key->kabupaten?></option>
							<?php }else{?>
								<option value="<?=$key->id?>"><?=$key->kabupaten?></option>
							<?php }
							} ?>
						</select>
					</div>
				</div>

				<div class="control-group">
					<label for="textfield" class="control-label">Nama Kecamatan</label>
						<div class="controls">
							<input type="text" name="kecamatan" id="kecamatan" class="input-xxlarge" data-rule-required="true" value="<?=$kecamatan->kecamatan?>">
						</div>
				</div>

				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url();?>ref_daerah">Kembali</a>
				</div>
				</form>
			</div>       
		</div>
	</div>						
</div>