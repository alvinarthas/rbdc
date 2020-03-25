<div class="box-content">
    <div class="control-group">
        <label for="textfield" class="control-label">Pilih Kabupaten/Kota</label>
        <select data-rule-required="true" name="kabupaten" id="kabupaten" class="js-example-basic-single js-states form-control" onchange="kab_select(this.value)">
            <option value="" disabled selected>Pilih</option>
            <?php foreach ($kabupaten as $key) { ?>
                <option value="<?=$key->id?>"><?=$key->kabupaten?></option>
            <?php } ?>
        </select>
    </div>

    <div class="control-group">
        <label for="textfield" class="control-label">Pilih Kecamatan</label>
        <select data-rule-required="true" name="kecamatan" id="kecamatan" class="js-example-basic-single js-states form-control" onchange="kec_select(this.value)">
        </select>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#kabupaten').select2();
        $('#kecamatan').select2();
    });
</script>