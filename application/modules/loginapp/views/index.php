<div class="container-fluid">
	<div class="row-fluid">
		<div class="span3"></div>
		<div class="span6">
			<div class="box">
				<div class="box-content">
					<div class="box box-color box-bordered">
						<div class="box-title">
							<h3><i class="icon-user"></i>Login Akun</h3>
						</div>
						
						<div class="box-content">
							<form novalidate="novalidate" class="form-horizontal form-validate" id="bb" name="bb" accept-charset="utf-8" method="post" action="">	
							<?php if (isset($pesan)) { ?><hr><div class="alert alert-danger alert-dismissable"><?php echo $pesan; ?></div><?php } ?>								
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">						
								<div class="control-group">
									<label for="textfield" class="control-label">Username</label>
									<div class="controls">
										<input type="text" data-rule-required="true" data-rule-email="false" placeholder="" id="username" class="input-xlarge" name="username" value="<?php if(!empty($username)){ echo $username;} ?>">
										<span class="required-server"><?php echo form_error('username','<p style="color:#F83A18">','</p>'); ?></span>
									</div>
								</div>
								
								<div class="control-group">
									<label for="password" class="control-label">Password</label>
									<div class="controls">
										<input type="password" data-rule-required="true" name="user_password" id="user_password" placeholder="" class="input-xlarge" value="<?php if(!empty($user_password)){ echo $user_password;} ?>">
										<span class="required-server"><?php echo form_error('user_password','<p style="color:#F83A18">','</p>'); ?></span>
									</div>
								</div>
								
								<div class="control-group">
									<label for="password" class="control-label">Masukan Kode</label>
									<div class="controls">
									<input type="text" data-rule-maxlength="6" data-rule-required="true" data-rule-number="true" autocomplete="off" name="userCaptcha" class="input-small" placeholder="" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
									<?php echo $captcha['image']; ?>
									<span class="required-server"><?php echo form_error('userCaptcha','<p style="color:#F83A18">','</p>'); ?></span> 
									</div>
								</div>
								<button name="submitlogin" type="submit" class="btn btn-primary"><i class="icon-check"></i>&nbsp;LOGIN</button>
								<a class="btn btn-danger"  href="<?php echo site_url();?>register/">Daftar</a>
							</form>
						</div>       
					</div>				
				</div>
			</div>
		</div>
	</div>				
</div>