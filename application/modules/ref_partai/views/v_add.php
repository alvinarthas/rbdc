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
            <?php echo form_open('ref_partai/tambih_robih',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
            
                <?php 
                    if ($this->session->flashdata('message_gagal')) {
                        echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
                    }      
                    if ($this->session->flashdata('message_sukses')) {
                        echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
                    }
                ?>
                    
                <input type="hidden" name="id_partai" id="id_partai" class="input-xxlarge"  value="<?php echo isset($field['id'])?$field['id']:'';?>">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                    
                <div class="control-group">
                        <label for="textfield" class="control-label">Nama Partai</label>
                        <div class="controls">
                            <input type="text" name="nm_partai" id="nm_partai" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field['nm_partai'])?$field['nm_partai']:'';?>">
                        </div>
                </div>

                <div class="control-group">
                	<label for="textfield" class="control-label">Gambar</label>
                		<div class="controls">
							<input type='file' name="file" id="imgInp" /> <br />
							<img id="blah" src="#" style="width: 200px;margin-top: 10px;" />
    					</div>
				</div>

                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <a class="btn btn-danger"  href="<?php echo site_url();?>ref_partai/">Kembali</a>
                </div>
            <?=form_close();?>
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
</script>