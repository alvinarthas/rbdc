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
				<?php echo form_open('ref_survey/tambih_robih',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				
                <div class="control-group">
					<label for="textfield" class="control-label">Nama Lengkap</label>
					<select data-rule-required="true" name="nama_lengkap" id="nama_lengkap" class="js-example-basic-single js-states form-control">
					</select>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">1. Siapakah Gubernur Pilihan Anda ?</label>
					<div class="controls">
						<select data-rule-required="true" name="paslon_pil" class="input-xxlarge">
							<option value="" disabled selected>Pilih</option>
							<?php foreach ($paslon as $key) { ?>
							<option value="<?=$key->id?>"><?=$key->nm_cagub?> - <?=$key->nm_cawagub?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">2. Apakah Anda Mengenal Lukman Edy - Hardianto ?</label>
                		<div class="controls">
                			<select data-rule-required="true" name="paslon_kenal" class="input-xxlarge">
                				<option value="" disabled selected>Pilih</option>
								<option value="Iya">Iya</option>
								<option value="Tidak">Tidak</option>
                			</select>
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">3. Berapa Target perolehan Suara Lukman Edy - Hardianto di TPS Anda ?</label>
                		<div class="controls">
							<input type="number" maxlength="3" name="target" id="target" class="input-xxlarge" data-rule-required="true">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">4. Siapakah saingan terberat Lukman Edy - Hardianto menurut anda ?</label>
					<div class="controls">
						<select data-rule-required="true" name="saingan" class="input-xxlarge">
							<option value="" disabled selected>Pilih</option>
							<?php foreach ($paslon as $key) {
								if($key->no_urut == 2 || $key->no_urut == 5){ ?>
							<?php }else{ ?>
								<option value="<?=$key->id?>"><?=$key->nm_cagub?> - <?=$key->nm_cawagub?></option>
						<?php }}?>
						</select>
					</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">5. Siapa yg paling mempengaruhi pilihan masy di tmpat tinggal Anda ?</label>
					<div class="controls">
						<select data-rule-required="true" name="pengaruh" class="input-xxlarge">
							<option value="" disabled selected>Pilih</option>
							<?php foreach ($tokoh as $key) { ?>
								<option value="<?=$key->id?>"><?=$key->pengaruh?></option>
						<?php }?>
						</select>
					</div>
				</div>

				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url();?>ref_survey">Kembali</a>
				</div>
				</form>
			</div>       
		</div>
	</div>						
</div>

<script>

$(document).ready(function() {
    $('#nama_lengkap').select2({
		placeholder:"Pilih Nama",
        ajax:{
            url: "<?php echo site_url('ref_survey/ajx_user')?>",
            dataType:'json',    
            delay:250,
            data:function(params){
                
                return{
                    nama_user:params.term,
                };
            },
            processResults:function(data){
                var item = $.map(data, (value)=>{ //map buat ngemap object data kyk foreach
                    return { id: value.id, text: value.text };
                });

                return {
                    results: item
                }
            },
            cache: true
        },
        minimumInputLength: 1,
	});
});

	function select_kec(id){
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

	function select_kel(id){
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