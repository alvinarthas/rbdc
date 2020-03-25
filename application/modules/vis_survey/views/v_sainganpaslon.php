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
    <div class="control-group">
        <label for="textfield" class="control-label">Pilih Kelurahan</label>
        <select data-rule-required="true" name="kelurahan" id="kelurahan" class="js-example-basic-single js-states form-control" onchange="kel_select(this.value)">
        </select>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#kabupaten').select2();
        $('#kecamatan').select2();
        $('#kelurahan').select2();
    });
    function kab_select(id){
        var daerah = "kabupaten";
        var jenis = "Calon Gubernur Saingan Terberat Lukman - Hardi";
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
            url: '<?php echo site_url('vis_survey/saingan')?>',
            dataType: 'html',
            type    : 'POST',
            data		: {'id_kab' : id,'daerah':daerah, 'jenis':jenis
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

    function kec_select(id){
        var id_kab = $('#kabupaten').val();
        var daerah = "kecamatan";
        var jenis = "Calon Gubernur Saingan Terberat Lukman - Hardi";
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
        $.ajax({
            url: '<?php echo site_url('vis_survey/saingan')?>',
            dataType: 'html',
            type    : 'POST',
            data		: {'id_kec' : id,'id_kab':id_kab,'daerah':daerah, 'jenis':jenis
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
        var id_kab = $('#kabupaten').val();
        var id_kec = $('#kecamatan').val();
        var daerah = "kelurahan";
        var jenis = "Calon Gubernur Saingan Terberat Lukman - Hardi";
        $.ajax({
            url: '<?php echo site_url('vis_survey/saingan')?>',
            dataType: 'html',
            type    : 'POST',
            data		: {'id_kel' : id,'id_kab':id_kab,'id_kec':id_kec,'daerah':daerah, 'jenis':jenis
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