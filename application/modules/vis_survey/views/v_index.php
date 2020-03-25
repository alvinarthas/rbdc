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
	<div class="span4">
        <div class="box">
			<div class="box-content">
                <div class="control-group">
					<label for="textfield" class="control-label">Dashboard</label>
					<select data-rule-required="true" name="jenis" id="jenis" class="js-example-basic-single js-states form-control" onchange="choice_select(this.value)">
                        <option value="" disabled selected>Pilih</option>
                        <option value="c1">Hasil Survey Calon Gubernur</option>
                        <option value="c2">Mengenal Lukman Hardi</option>
                        <option value="c4">Saingan Terberat Lukman Hardi</option>
                        <option value="c5">Tokoh yang Berpengaruh</option>
                    </select>
				</div>
            </div>

            <div id="choice-element">
            </div>   
		</div>
	</div>
    <div class="span8">
        <div id="form-element">	
        </div> 
    </div>				
</div>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script>
    $(document).ready(function() {
        $('#jenis').select2();
    });

	function choice_select(id){
        $.ajax({
            url: '<?php echo site_url('vis_survey/ajx_choice')?>',
            dataType: 'html',
            type    : 'POST',
            data		: {'jenis' : id,
            },
            success: function(data){
                $("#choice-element").html(data);
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