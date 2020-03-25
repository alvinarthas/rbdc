<div class="control-group">
<label for="textfield" class="control-label">Kabupaten/Kota</label>
    <div class="controls">
        <select data-rule-required="true" name="kabupaten" id="kabupaten" class="input-xxlarge">
        <option value="*" disabled selected>Pilih</option>
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
<input type="hidden" name="daerah" id="daerah" value="kecamatan">

<div class="control-group">
    <label for="textfield" class="control-label">Nama Kecamatan</label>
        <div class="controls">
            <input type="text" name="kecamatan" id="kecamatan" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->alamat)?$field->alamat:'';?>">
        </div>
</div>