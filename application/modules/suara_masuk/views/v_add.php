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
				<h3><i class=" icon-plus-sign"></i>Atur Suara Masuk</h3>
			</div>

			<div class="box-content">
				<?php echo form_open('suara_masuk/atur_data',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>

				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<input type="hidden" name="id_tps" value="<?php echo isset($field->id)?$field->id:'';?>" style="display: none">

				<div class="control-group">
                	<label for="textfield" class="control-label">Jumlah DPT per TPS</label>
                		<div class="controls">
							<input type="number" name="dpt_tps" id="dpt_tps" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->dpt)?$field->dpt:'';?>" readonly>
						</div>
				</div>

				<div class="control-group">
						<label for="textfield" class="control-label">Jumlah Suara Calon No Urut 1</label>
                		<div class="controls">
							<input type="number" name="suara1" id="suara1"  data-rule-required="true" value="<?php echo isset($field->calon1)?$field->calon1:'';?>" onkeyup="_suara_sah_()">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Jumlah Suara dan Persentase Calon No Urut 2</label>
                		<div class="controls">
							<input type="number" name="suara2" id="suara2" data-rule-required="true" value="<?php echo isset($field->calon2)?$field->calon2:'';?>" onkeyup="_suara_sah_()">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Jumlah Suara dan Persentase Calon No Urut 3</label>
                		<div class="controls">
							<input type="number" name="suara3" id="suara3" data-rule-required="true" value="<?php echo isset($field->calon3)?$field->calon3:'';?>" onkeyup="_suara_sah_()">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Jumlah Suara dan Persentase No Urut 4</label>
                		<div class="controls">
							<input type="number" name="suara4" id="suara4" data-rule-required="true" value="<?php echo isset($field->calon4)?$field->calon4:'';?>" onkeyup="_suara_sah_()">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Jumlah Suara Sah</label>
                		<div class="controls">
							<input type="number" name="sah" id="sah" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->suara_sah)?$field->suara_sah:'';?>" readonly>
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Jumlah Suara Tidak Sah</label>
                		<div class="controls">
							<input type="number" name="tdk_sah" id="tdk_sah" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->suara_tdk)?$field->suara_tdk:'';?>" onkeyup="_suara_tdksah_()">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Total Suara</label>
                		<div class="controls">
							<input type="number" name="ttl_suara" id="ttl_suara" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->suara_ttl)?$field->suara_ttl:'';?>" readonly>
						</div>
				</div>

				<div class="form-actions">
					<button class="btn btn-primary" id="btnSubmit" type="submit" onclick="_submit_()">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url();?>suara_masuk">Kembali</a>
				</div>

				</form>
			</div>       
		</div>
	</div>						
</div>

<script>
	var dpt = document.getElementById("dpt_tps").value;
	function _suara_sah_(){
		var suara1 = document.getElementById("suara1").value;
		var suara2 = document.getElementById("suara2").value;
		var suara3 = document.getElementById("suara3").value;
		var suara4 = document.getElementById("suara4").value;
		var suara_sah2 =(+suara1 + +suara2 + +suara3 + +suara4);
		$("#sah").val(suara_sah2);
		_suara_tdksah_();
	}

	function _suara_tdksah_(){
		var sah = document.getElementById("sah").value;
		var tdk_sah = document.getElementById("tdk_sah").value;
		var suara_total =(+sah + +tdk_sah);
		$("#ttl_suara").val(suara_total);
	}

	function _submit_(){
		var total_suara = document.getElementById("ttl_suara").value;
		if(total_suara > dpt){
			event.preventDefault();
			alert("Total Suara tidak boleh melebihi jumlah DPT")
		}else{
			$("#btnSubmit").submit();
		}
	}
</script>