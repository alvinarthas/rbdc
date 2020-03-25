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
				<?php echo form_open('ref_masy/tambih_robih',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				<input type="hidden" name="id_masy" id="id_masy" value="<?php echo isset($field->id)?$field->id:'';?>">
				<input type="hidden" name="id_user" id="id_user" value="<?php echo $this->session->userdata('sesi_id');?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				
                <div class="control-group">
                	<label for="textfield" class="control-label">Nama Lengkap</label>
                		<div class="controls">
                			<input type="text" name="nama" id="nama" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->nama_lengkap)?$field->nama_lengkap:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Nama panggilan</label>
                		<div class="controls">
                			<input type="text" name="nama_pgl" id="nama_pgl" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->nama_panggilan)?$field->nama_panggilan:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Jenis Kelamin</label>
                		<div class="controls">
                			<select data-rule-required="true" name="jns_kel" class="input-xxlarge">
                				<option value="" disabled selected>Pilih</option>
								<option value="Laki-Laki">Laki-Laki</option>
								<option value="Perempuan">Perempuan</option>
                			</select>
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Alamat</label>
                		<div class="controls">
                			<input type="text" name="alamat" id="alamat" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->alamat)?$field->alamat:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">No KTP</label>
                		<div class="controls">
							<input type="number" maxlength="18" name="ktp" id="ktp" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->ktp)?$field->ktp:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">No HP</label>
                		<div class="controls">
							<input type="number" maxlength="14" name="hp" id="hp" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->hp)?$field->hp:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Kabupaten/Kota</label>
                		<div class="controls">
                			<select data-rule-required="true" name="kabupaten" id="kabupaten" class="input-xxlarge" onchange="select_kec(this.value)">
							<option value="*" disabled selected>Pilih</option>
							<?php foreach($kabupaten as $key){
								if($field->kabupaten == $key['id']){?>
									<option value="<?=$key['id']?>" selected><?=$key['kabupaten']?></option>
								<?php }else{?>
									<option value="<?=$key['id']?>"><?=$key['kabupaten']?></option>
								<?php }
								} ?>
                			</select>
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Kecamatan</label>
                		<div class="controls">
                			<select data-rule-required="true" name="kecamatan" id="kecamatan" class="input-xxlarge" onchange="select_kel(this.value)">
							<option value="*" disabled selected>Pilih</option>
                			</select>
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Kelurahan</label>
                		<div class="controls">
                			<select data-rule-required="true" name="kelurahan" id="kelurahan" class="input-xxlarge">
							<option value="*"disabled selected>Pilih</option>
                			</select>
						</div>
				</div>
				
				<div class="control-group">
                	<label for="textfield" class="control-label">Pekerjaan</label>
                		<div class="controls">
                			<select data-rule-required="true" name="pekerjaan" id="pekerjaan" class="input-xxlarge">
							<option value="*"disabled selected>Pilih</option>
							<?php foreach($pekerjaan as $key){
								if($field->pekerjaan == $key['id']){?>
									<option value="<?=$key['id']?>" selected><?=$key['pekerjaan']?></option>
								<?php }else{?>
									<option value="<?=$key['id']?>"><?=$key['pekerjaan']?></option>
								<?php }
								} ?>
                			</select>
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Penghasilan</label>
                		<div class="controls">
                			<select data-rule-required="true" name="penghasilan" id="penghasilan" class="input-xxlarge">
							<option value="*"disabled selected>Pilih</option>
							<?php foreach($penghasilan as $key){ 
								if($field->penghasilan == $key['id']){?>
									<option value="<?=$key['id']?>" selected><?=$key['penghasilan']?></option>
								<?php }else{?>
									<option value="<?=$key['id']?>"><?=$key['penghasilan']?></option>
								<?php }
								} ?>
                			</select>
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Umur</label>
                		<div class="controls">
                			<select data-rule-required="true" name="umur" id="umur" class="input-xxlarge">
							<option value="*"disabled selected>Pilih</option>
							<?php foreach($umur as $key){ 
								if($field->umur == $key['id']){?>
									<option value="<?=$key['id']?>" selected><?=$key['umur']?></option>
								<?php }else{?>
									<option value="<?=$key['id']?>"><?=$key['umur']?></option>
								<?php }
								} ?>
                			</select>
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Pendidikan Terakhir</label>
                		<div class="controls">
                			<select data-rule-required="true" name="pendidikan" id="pendidikan" class="input-xxlarge">
							<option value="*"disabled selected>Pilih</option>
							<?php foreach($pendidikan as $key){ 
								if($field->pendidikan == $key['id']){?>
									<option value="<?=$key['id']?>" selected><?=$key['pendidikan']?></option>
								<?php }else{?>
									<option value="<?=$key['id']?>"><?=$key['pendidikan']?></option>
								<?php }
								} ?>
                			</select>
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Jumlah Keluarga dengan Hak Pilih</label>
                		<div class="controls">
							<input type="number" maxlength="2" name="keluarga" id="keluarga" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->anggota_kel)?$field->anggota_kel:'';?>">
						</div>
				</div>
				
				<div class="control-group">
					<label for="textfield" class="control-label">No TPS</label>
					<select name="no_tps" id="no_tps" class="js-example-basic-single js-states form-control">
					<?php echo isset($field->no_tps)?'<option selected>'.$field->no_tps.'</option>':'';?>
					</select>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Profil</label>
                		<div class="controls">
                			<select data-rule-required="true" name="profil" id="profil" class="input-xxlarge">
							<option value="*"disabled selected>Pilih</option>
							<?php foreach($profil as $key){
								if($field->profil == $key['profil']){?>
									<option selected><?=$key['profil']?></option>
								<?php }else{?>
									<option><?=$key['profil']?></option>
								<?php }
								} ?>
                			</select>
						</div>
				</div>

				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url();?>ref_masy">Kembali</a>
				</div>
				</form>
			</div>       
		</div>
	</div>						
</div>

<script>
$(document).ready(function() {
    $('#no_tps').select2({
		placeholder:"Pilih TPS",
        ajax:{
            url: "<?php echo site_url('ref_masy/ajx_tps')?>",
            dataType:'json',    
            delay:250,
            data:function(params){
                
                return{
                    no_tps:params.term,
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