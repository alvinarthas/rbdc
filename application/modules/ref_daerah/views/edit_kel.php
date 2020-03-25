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
				<?php echo form_open('ref_daerah/edit_action',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>

                <input type="hidden" name="daerah" id="daerah" value="kelurahan">
                <input type="hidden" name="id" id="id" value="<?=$kelurahan->id?>">
				
                <div class="control-group">
				<label for="textfield" class="control-label">Kabupaten/Kota</label>
					<div class="controls">
						<select data-rule-required="true" name="kabupaten" id="kabupaten" class="input-xxlarge" onchange="select_kec(this.value)">
						<option value="*" disabled selected>Pilih</option>
						<?php foreach($kabupaten as $key){
							if($kecamatan->id_kab == $key->id){?>
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
                        <select data-rule-required="true" name="kecamatan" id="kecamatan" class="input-xxlarge">
                        <option value="*" disabled>Pilih</option>
                        <option value="<?=$kecamatan->id?>" selected><?=$kecamatan->kecamatan?></option>
                        </select>
                    </div>
                </div>

				<div class="control-group">
					<label for="textfield" class="control-label">Nama Kelurahan</label>
						<div class="controls">
							<input type="text" name="kelurahan" id="kelurahan" class="input-xxlarge" data-rule-required="true" value="<?=$kelurahan->kelurahan?>">
						</div>
				</div>

                <!-- <div class="control-group">
                    <label for="textfield" class="control-label">Jumlah DPT Per Kelurahan</label>
                        <div class="controls">
                            <input type="number" maxlength="5" name="dpt" id="dpt" class="input-xxlarge" data-rule-required="true" value="<?=$kelurahan->dpt?>">
                        </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Jumlah TPS Per Kelurahan</label>
                        <div class="controls">
                            <input type="number" maxlength="3" id="tps" class="input-xxlarge" data-rule-required="true" value="<?=$kelurahan->tps?>">
                        </div>
                </div> -->

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
    </script>