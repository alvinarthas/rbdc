<div class="control-group">
    <label for="textfield" class="control-label">Nama Kabupaten/Kota</label>
        <div class="controls">
            <input type="text" name="kabupaten" id="kabupaten" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->alamat)?$field->alamat:'';?>">
        </div>
</div>
<input type="hidden" name="daerah" id="daerah" value="kabupaten">
