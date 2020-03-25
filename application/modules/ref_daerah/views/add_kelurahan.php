<div class="control-group">
<label for="textfield" class="control-label">Kabupaten/Kota</label>
    <div class="controls">
        <select data-rule-required="true" name="kabupaten" id="kabupaten" class="input-xxlarge" onchange="select_kec(this.value)">
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
<input type="hidden" name="daerah" id="daerah" value="kelurahan">
<div class="control-group">
<label for="textfield" class="control-label">Kecamatan</label>
    <div class="controls">
        <select data-rule-required="true" name="kecamatan" id="kecamatan" class="input-xxlarge">
        <option value="*" disabled selected>Pilih</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label for="textfield" class="control-label">Nama Kelurahan</label>
        <div class="controls">
            <input type="text" name="kelurahan" id="kelurahan" class="input-xxlarge" data-rule-required="true">
        </div>
</div>

<!-- <div class="control-group">
    <label for="textfield" class="control-label">Jumlah DPT Per Kelurahan</label>
        <div class="controls">
            <input type="number" maxlength="5" name="dpt" id="dpt" class="input-xxlarge" data-rule-required="true">
        </div>
</div>

<div class="control-group">
    <label for="textfield" class="control-label">Jumlah TPS Per Kelurahan</label>
        <div class="controls">
            <input type="number" maxlength="3" name="tps" id="tps" class="input-xxlarge" data-rule-required="true">
        </div>
</div> -->

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