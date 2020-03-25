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
				<?php echo form_open('map_partai/tambih_robih',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

				<div class="control-group">
                	<label for="textfield" class="control-label">Pasangan Calon</label>
                		<div class="controls">
                			<select data-rule-required="true" name="paslon" class="input-xxlarge">
								<option value="*"disabled selected>Pilih Paslon</option>
								<?php foreach ($paslon as $key) { ?>
									<option value="<?php echo $key['id'] ?>"><?php echo $key['nm_cagub'].' - '.$key['nm_cawagub'];?></option>
								 <?php } ?>
                			</select>
						</div>
				</div>	

				<div class="control-group">
                	<label for="textfield" class="control-label">Partai</label>
                		<div class="controls">
                			<select data-rule-required="true" name="partai" class="input-xxlarge">
								<option value="*"disabled selected>Pilih Partai</option>
								<?php foreach ($partai as $keys) { ?>
									<option value="<?php echo $keys['id'] ?>"><?=$keys['nm_partai']?></option>
								 <?php } ?>
                			</select>
						</div>
				</div>				

				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url();?>map_partai/">Kembali</a>
				</div>

				</form>
			</div>       
		</div>
	</div>						
</div>