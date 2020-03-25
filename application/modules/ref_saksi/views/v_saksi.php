<?php if($sedia == "Iya"){ ?>
    <div class="control-group">
    <label for="textfield" class="control-label">Apakah anda pernah terlibat dalam Pilkada ?</label>
    <div class="controls">
        <select data-rule-required="true" name="terlibat" class="input-xxlarge">
            <option value="" disabled selected>Pilih</option>
            <option>Tim Sukses Kepala Desa</option>
            <option>Tim Sukses Calon Legislatif</option>
            <option>Tim Sukses Bupati</option>
            <option>Saksi TPS</option>
            <option>Panitia Pengawas Pemilu</option>
            <option>PPK atau Penyelenggara Pemilu</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label for="textfield" class="control-label">Di tingkat apa anda menjadi saksi ?</label>
    <div class="controls">
        <select data-rule-required="true" name="tingkat" class="input-xxlarge">
            <option value="" disabled selected>Pilih</option>
            <option>PPK</option>
            <option>PPS</option>
            <option>PPD</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label for="textfield" class="control-label">Siapa yang merekmondasikan anda menjadi saksi ?</label>
    <div class="controls">
        <select data-rule-required="true" name="rekomendasi" class="input-xxlarge">
            <option value="" disabled selected>Pilih</option>
            <option>PKB</option>
            <option>Gerindra</option>
            <option>Relawan</option>
        </select>
    </div>
</div>
<?php }else{ ?>
    <!-- <div></div> -->
<?php } ?>