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
				<?php echo form_open('ref_role/tambih_robih',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				
				<input type="hidden" name="id_user_group" id="id_user_group" value="<?php echo isset($field->id_user_group)?$field->id_user_group:'';?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                
                <div class="control-group">
                	<label for="textfield" class="control-label">Nama Group Pengguna</label>
                		<div class="controls">
                			<input type="text" name="nama_user_group" id="nama_user_group" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->nama_user_group)?$field->nama_user_group:'';?>">
						</div>
				</div>


				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url("ref_role");?>">Kembali</a>
				</div>

				</form>
			</div>       
		</div>
	</div>						
</div>