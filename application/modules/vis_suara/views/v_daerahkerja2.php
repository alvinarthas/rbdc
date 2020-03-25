<div class="box-content">
    <div class="control-group">
        <label for="textfield" class="control-label">Pilih Kategori</label>
        <select data-rule-required="true" name="kategori" id="kategori" class="js-example-basic-single js-states form-control" onchange="kategori_select(this.value)">
            <option value="" disabled selected>Pilih</option>
            <option value="*">Semua Pekerjaan</option>
            <option value="pekerjaan">Pekerjaan</option>
            <option value="penghasilan">Penghasilan</option>
            <option value="umur">Umur</option>
            <option value="pendidikan">Pendidikan</option>
        </select>
    </div>

    <div class="control-group">
        <label for="textfield" class="control-label">Pilih Jenis</label>
        <select data-rule-required="true" name="jenis2" id="jenis2" class="js-example-basic-single js-states form-control">
        </select>
    </div>
    <div class="control-group">
        <label for="textfield" class="control-label">Pilih Kabupaten/Kota</label>
        <select data-rule-required="true" name="kabupaten" id="kabupaten" class="js-example-basic-single js-states form-control" onchange="kab_select(this.value)">
            <option value="" disabled selected>Pilih</option>
            <option value="prov">Provinsi Riau</option>
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
        $('#jenis2').select2();
        $('#kabupaten').select2();
        $('#kecamatan').select2();
        $('#kelurahan').select2();
        $('#kategori').select2();
    });

    function kategori_select(id){
        if(id == "*"){
            $('#jenis2').empty();
        }else{
            $.ajax({
				url: '<?php echo site_url('vis_survey/get_jenis')?>',
				dataType: 'json',
				type    : 'POST',
				data		: {'kategori' : id
								},
				success: function(data){
					$('#jenis2').empty();
					$('#jenis2').append(data);
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

    function kab_select(id){
        var kategori = $('#kategori').val();
        var jenis2 = $('#jenis2').val();
        var daerah = "kabupaten";
        var jenis = "Persentase Masyarakat yang mengenal Lukman - Hardi";
        var aidi = $('#kabupaten').val();
        if(aidi=="prov"){
            $('#kecamatan').empty();
            $('#kelurahan').empty();
            if(kategori == "*"){
                $.ajax({
                    url: '<?php echo site_url('vis_survey/all_kenal')?>',
                    dataType: 'html',
                    type    : 'POST',
                    data		: {'id_kab' : id,'kategori':kategori, 'daerah':daerah, 'jenis':jenis
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
                $.ajax({
                    url: '<?php echo site_url('vis_survey/all_kenal_job')?>',
                    dataType: 'html',
                    type    : 'POST',
                    data		: {'id_kab' : id,'kategori':kategori, 'daerah':daerah, 'jenis2':jenis2, 'jenis':jenis
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
        }else{
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
            if(kategori == "*"){
                $.ajax({
                    url: '<?php echo site_url('vis_survey/kenal_kat_all')?>',
                    dataType: 'html',
                    type    : 'POST',
                    data		: {'id_kab' : id,'kategori':kategori, 'daerah':daerah, 'jenis':jenis
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
                $.ajax({
                    url: '<?php echo site_url('vis_survey/kenal_kat_job')?>',
                    dataType: 'html',
                    type    : 'POST',
                    data		: {'id_kab' : id,'kategori':kategori, 'daerah':daerah, 'jenis2':jenis2, 'jenis':jenis
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
	}

    function kec_select(id){
        var jenis = "Persentase Masyarakat yang mengenal Lukman - Hardi";
        var kategori = $('#kategori').val();
        var jenis2 = $('#jenis2').val();
        var id_kab = $('#kabupaten').val();
        var daerah = "kecamatan";
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
        if(kategori == "*"){
            $.ajax({
                url: '<?php echo site_url('vis_survey/kenal_kat_all')?>',
                dataType: 'html',
                type    : 'POST',
                data		: {'id_kec' : id,'kategori':kategori,'id_kab':id_kab,'daerah':daerah, 'jenis':jenis
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
            $.ajax({
                url: '<?php echo site_url('vis_survey/kenal_kat_job')?>',
                dataType: 'html',
                type    : 'POST',
                data		: {'id_kec' : id,'id_kab' : id,'kategori':kategori, 'daerah':daerah, 'jenis2':jenis2, 'jenis':jenis
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

    function kel_select(id){
        var jenis = "Persentase Masyarakat yang mengenal Lukman - Hardi";
        var kategori = $('#kategori').val();
        var jenis2 = $('#jenis2').val();
        var id_kab = $('#kabupaten').val();
        var id_kec = $('#kecamatan').val();
        var daerah = "kelurahan";
        if(kategori == "*"){
            $.ajax({
                url: '<?php echo site_url('vis_survey/kenal_kat_all')?>',
                dataType: 'html',
                type    : 'POST',
                data		: {'id_kel' : id,'kategori':kategori,'id_kab':id_kab,'id_kec':id_kec,'daerah':daerah, 'jenis':jenis
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
            $.ajax({
                url: '<?php echo site_url('vis_survey/kenal_kat_job')?>',
                dataType: 'html',
                type    : 'POST',
                data		: {'id_kel' : id,'id_kab' : id,'kategori':kategori, 'daerah':daerah, 'jenis2':jenis2,'id_kec':id_kec, 'jenis':jenis
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
</script>