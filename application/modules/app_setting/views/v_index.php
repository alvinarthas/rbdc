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
				<h3><i class=" icon-plus-sign"></i><?php echo $sub_judul_form;?> </h3>
			</div>
			<div class="box-content">
			<!-- <form action="#" method="POST" class='form-horizontal form-validate' id="bb"> -->
				<?php echo form_open('app_setting/add',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
               

                <div class="control-group">
                	<label for="textfield" class="control-label">Nama</label>
                		<div class="controls">
							<input type='file' name="file" id="imgInp" /> <br />
							<img id="blah" src="#" style="width: 200px;margin-top: 10px;" />
    					</div>
				</div>


				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url();?>">Kembali</a>
				</div>

				</form>

				<hr />
				<div class="span12">
                	<h3>Current Sildeshow</h3>
                		<div class="controls">
                			<?php
                				foreach ($ListData as $key => $gambar) {
							?>
							<div class="span2">
								<img src="<?= site_url('assets_users/img/slideshow/'.$gambar['source']) ?>" class="img img-rounded" >
								<a onclick="deleteFile('<?= $gambar['id'] ?>')" class="btn btn-inverse" style="margin-top: 5px"><span class="icon-remove"></span></a>
							</div>
							<?php } ?>
						</div>
				</div>

			</div>       
		</div>
	</div>						
</div>

<script type="text/javascript">
	function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});

function deleteFile(id){
$.ajax({
	url     : '<?php echo site_url('app_setting/hupus');?>/'+id,
	success : function(data){
		alert(data);
		location.reload();
	}
});
}
</script>
