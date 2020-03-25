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
				<?php echo form_open('ref_users/tambih_robih',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				
				<input type="hidden" name="id_users" id="id_users" value="<?php echo isset($field->id)?$field->id:'';?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

				<input type="hidden" value="<?php echo $this->input->ip_address(); ?>" name="ip_address">

                
                <div class="control-group">
                	<label for="textfield" class="control-label">Username</label>
                		<div class="controls">
                			<input type="text" name="username" id="username" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->username)?$field->username:'';?>">
						</div>
				</div>

                <div class="control-group">
                	<label for="textfield" class="control-label">Nama Lengkap</label>
                		<div class="controls">
                			<input type="text" name="nama_users" id="nama_users" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->nama_lengkap)?$field->nama_lengkap:'';?>">
						</div>
				</div>

                <div class="control-group">
                	<label for="textfield" class="control-label">Hp</label>
                		<div class="controls">
                			<input type="text" name="hp_users" id="hp_users" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->hp)?$field->hp:'';?>">
						</div>	
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Email</label>
                		<div class="controls">
                			<input type="email" name="email_users" id="email_users" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->email)?$field->email:'';?>">
						</div>
				</div>
				<?php if ($role == "insert") { ?>
				<div class="control-group password">
                	<label for="textfield" class="control-label">Password</label>
                		<div class="controls">
                			<input type="password" name="password_users" id="password_users" class="input-xxlarge"  <?php echo isset($field->password)?"":"data-rule-required='true'";?> >
						</div>
				</div>
				<?php }elseif($role == "update"){ ?>
				<div class="control-group password">
                	<label for="textfield" class="control-label">Password</label>
                		<div class="controls">
                			<input type="password" name="password_users" id="password_users" class="input-xxlarge">
						</div>
				</div>
				<?php } ?>

				<div class="control-group">
                	<label for="textfield" class="control-label">User Group</label>
                		<div class="controls">
                			<select data-rule-required="true" name="group_users" class="input-xxlarge">
                				<option value="">Pilih</option>
								<?php foreach ($user_group as $key => $value) { ?>
								<option value="<?php echo $value->id_user_group ?>" 
								<?php echo isset($field->id_user_group)?($field->id_user_group==$value->id_user_group?'selected=""':''):''?>
								>
								<?php echo $value->nama_user_group." </option>";
								 } ?>
                			</select>
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Mendaftar Sebagai</label>
                		<div class="controls">
                			<select data-rule-required="true" name="profil" class="input-xxlarge">
                				<option value="" disabled selected>Pilih</option>
								<?php foreach ($profil as $key) { 
									if($field->user_profil == $key->profil){ ?>
										<option value="<?php echo $key->profil ?>" selected><?php echo $key->profil ?></option>
									<?php }else{?>
										<option value="<?php echo $key->profil ?>"><?php echo $key->profil ?></option>
								 <?php }
								 } ?>
                			</select>
						</div>
				</div>

				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url();?>ref_users/">Kembali</a>
				</div>

				</form>
			</div>       
		</div>
	</div>						
</div>