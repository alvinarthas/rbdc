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
				<?php echo form_open('ref_daerah/tambah_action',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

				<div class="control-group">
                	<label for="textfield" class="control-label">Pilih Daerah</label>
                		<div class="controls">
                			<select data-rule-required="true" id="daerah" name="daerah" class="input-xxlarge" onchange="select_daerah(this.value)">
                				<option value="*" disabled selected>Pilih</option>
								<option value="kabupaten">Per Kabupaten</option>
								<option value="kecamatan">Per Kecamatan</option>
								<option value="kelurahan">Per Kelurahan</option>
                			</select>
						</div>
				</div>

				<div id="form-element">
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

<script>

function select_daerah(id){
	$.ajax({
		url: '<?php echo site_url('ref_daerah/ajx_daerah')?>',
		dataType: 'html',
		type    : 'POST',
		data		: {'daerah' : id,
		},
		success: function(data){
			$("#form-element").html(data);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			if (XMLHttpRequest.status === 200) {
				bootbox.alert(textStatus+' errornya '+errorThrown);
			}else{
				unloading();
				unloading(); bootbox.alert('Maaf, Terjadi kesalahan dalam sistem!!');
			}
		}
	});
}

</script>