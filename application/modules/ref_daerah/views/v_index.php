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
				<h3><i class=" icon-plus-sign"></i>Tampilkan Daerah</h3>
			</div>

			<div class="box-content">
				<?php echo form_open('ref_daerah/index',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>

                <div class="control-group">
                <label for="textfield" class="control-label">Kabupaten/Kota</label>
                    <div class="controls">
                        <select data-rule-required="true" name="kabupaten" id="kabupaten" class="input-xxlarge" onchange="kab_select(this.value)">
                        <option value="*" disabled selected>Pilih</option>
						<option value="prov" >Provinsi Riau</option>
                        <?php foreach($kabupaten as $key){
                            if($field->kabupaten == $key->id){?>
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
                        </select>
                    </div>
                </div>

				<div id="form-element">
					
				</div>

				</form>
			</div>       
		</div>
	</div>						
</div>

<script>
	function kab_select(id){
		var aidi = $('#kabupaten').val();
		var daerah="kabupaten";
		if(aidi == "prov"){
			$('#kecamatan').empty();
			$.ajax({
				url: '<?php echo site_url('ref_daerah/index_kab')?>',
				dataType: 'html',
				type    : 'POST',
				data		: {'kabupaten' : id,'daerah':daerah
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
		}else{
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

			$.ajax({
				url: '<?php echo site_url('ref_daerah/index_kec')?>',
				dataType: 'html',
				type    : 'POST',
				data		: {'kabupaten' : id,'daerah':daerah
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
	}

	function kec_select(id){
		var daerah="kecamatan";
		var kabupaten = $('#kabupaten').val();
		$.ajax({
			url: '<?php echo site_url('ref_daerah/index_kel')?>',
			dataType: 'html',
			type    : 'POST',
			data		: {'kecamatan' : id,'daerah':daerah,'kabupaten':kabupaten
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