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
				<h3><i class=" icon-plus-sign"></i>Tambah Data TPS</h3>
			</div>

			<div class="box-content">
				<?php echo form_open('ref_tps/action',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>

				<input type="hidden" name="id_tps" id="id_tps" value="<?php echo isset($field->id)?$field->id:'';?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

                <div class="control-group">
                <label for="textfield" class="control-label">Kabupaten/Kota</label>
                    <div class="controls">
                        <select data-rule-required="true" name="kabupaten" id="kabupaten" class="input-xxlarge" onchange="kab_select(this.value)">
                        <option value="*" disabled selected>Pilih</option>
                        <?php foreach($kabupaten as $key){
                            if($field->kabupaten == $key->kabupaten){?>
                                <option value="<?=$key->id?>" selected><?=$key->kabupaten?></option>
                            <?php }else{?>
                                <option value="<?=$key->id?>"><?=$key->kabupaten?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                <label for="textfield" class="control-label">Kecamatan</label>
                    <div class="controls">
                        <select data-rule-required="true" name="kecamatan" id="kecamatan" class="input-xxlarge" onchange="kec_select(this.value)">
                        <option value="*" disabled selected>Pilih</option>
						<option value="*1" selected><?php echo isset($field->kecamatan)?$field->kecamatan:'';?></option>
                        </select>
                    </div>
                </div>

				<div class="control-group">
                <label for="textfield" class="control-label">Kelurahan</label>
                    <div class="controls">
                        <select data-rule-required="true" name="kelurahan" id="kelurahan" class="input-xxlarge" onchange="kel_select(this.value)">
                        <option value="*" disabled selected>Pilih</option>
						<option value="<?php echo isset($field->id_kel)?$field->id_kel:'';?>" selected><?php echo isset($field->kelurahan)?$field->kelurahan:'';?></option>
                        </select>
                    </div>
                </div>

				<div class="control-group">
                	<label for="textfield" class="control-label">NO TPS</label>
                		<div class="controls">
							<input type="number" minlength="3" maxlength="3" name="tps" id="tps" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->tps)?$field->tps:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Jumlah DPT</label>
                		<div class="controls">
							<input type="number" maxlength="5" name="dpt" id="dpt" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->dpt)?$field->dpt:'';?>">
						</div>
				</div>

				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url();?>ref_tps">Kembali</a>
				</div>

				</form>
			</div>       
		</div>
	</div>						
</div>

<script>
	function kab_select(id){
		var daerah="kabupaten";
		$.ajax({
				url: '<?php echo site_url('ref_masy/get_kecamatan')?>',
				dataType: 'json',
				type    : 'POST',
				data		: {'kabupaten' : id
								},
				success: function(data){
					$('#kecamatan').empty();
					$('#kecamatan').append(data);
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

	function kec_select(id){
		var daerah="kecamatan";
		var kabupaten = $('#kabupaten').val();
		$.ajax({
				url: '<?php echo site_url('ref_masy/get_kelurahan')?>',
				dataType: 'json',
				type    : 'POST',
				data		: {'kecamatan' : id
								},
				success: function(data){
					$('#kelurahan').empty();
					$('#kelurahan').append(data);
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