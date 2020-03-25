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

			<div class="box-title">
				<div class="pull-right">
					<ul class="stats">
						<li class='satgreen'>
							<i class="fa fa-money"></i>
							<div class="details">
								<span class="big">Progress Input Suara Masuk</span>
								<span><?=$count?>/<?=$sum?></span>
								<span><?=number_format($persentase, 2, '.', '');?> %</span>
							</div>
						</li>
					</ul>
				</div>
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
						<option value="provgraf" >Provinsi Riau Grafik</option>
						<option value="provtab" >Provinsi Riau Tabel</option>
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

				<div class="control-group">
                <label for="textfield" class="control-label">Kelurahan</label>
                    <div class="controls">
                        <select data-rule-required="true" name="kelurahan" id="kelurahan" class="input-xxlarge" onchange="kel_select(this.value)">
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

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script>
	function kab_select(id){
		var aidi = $('#kabupaten').val();
		if(aidi == "provgraf"){
			$('#kecamatan').empty();
			$('#kelurahan').empty();
			$.ajax({
				url: '<?php echo site_url('info_suara/provgraf')?>',
				dataType: 'html',
				type    : 'POST',
				data		: {'aidi' : id,
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
		}else if(aidi == "provtab"){
			$('#kecamatan').empty();
			$('#kelurahan').empty();
			$.ajax({
				url: '<?php echo site_url('info_suara/provtab')?>',
				dataType: 'html',
				type    : 'POST',
				data		: {'aidi' : id,
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
			$('#kecamatan').empty();
			$('#kelurahan').empty();
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
			var daerah="kabupaten";
			$.ajax({
				url: '<?php echo site_url('info_suara/index_tps')?>',
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
		var daerah="kecamatan";
		var kabupaten = $('#kabupaten').val();
		$.ajax({
			url: '<?php echo site_url('info_suara/index_tps')?>',
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

	function kel_select(id){
		var daerah="kelurahan";
		var kabupaten = $('#kabupaten').val();
		var kecamatan = $('#kecamatan').val();
		$.ajax({
			url: '<?php echo site_url('info_suara/index_tps')?>',
			dataType: 'html',
			type    : 'POST',
			data		: {'kelurahan' : id,'daerah':daerah,'kabupaten':kabupaten,'kecamatan':kecamatan
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