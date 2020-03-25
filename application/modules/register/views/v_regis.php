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
				<?php echo form_open('register/daftar',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                
                <div class="control-group">
                	<label for="textfield" class="control-label">Nama Lengkap</label>
                		<div class="controls">
                			<input type="text" name="nama" id="nama" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->urusan)?$field->urusan:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Username</label>
                		<div class="controls">
                			<input type="text" name="username" id="username" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->urusan)?$field->urusan:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Password</label>
                		<div class="controls">
                			<input type="password" name="password" id="password" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->urusan)?$field->urusan:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Email</label>
                		<div class="controls">
                			<input type="email" name="email" id="email" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->urusan)?$field->urusan:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">No HP</label>
                		<div class="controls">
                			<input type="text" name="hp" id="hp" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->urusan)?$field->urusan:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Mendaftar Sebagai</label>
                		<div class="controls">
                			<select data-rule-required="true" name="profil" class="input-xxlarge">
                				<option value="" disabled selected>Pilih</option>
								<?php foreach ($profil as $key) { ?>
								<option value="<?php echo $key->profil;?>">
									<?php echo $key->profil;?>
								</option>
								<?php } ?>
                			</select>
						</div>
				</div>


				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url();?>">Kembali</a>
				</div>

				</form>
			</div>       
		</div>
	</div>						
</div>