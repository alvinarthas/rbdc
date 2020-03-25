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
				<?php echo form_open('ref_saksi/tambih_robih',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				<input type="hidden" name="id_masy" id="id_masy" value="<?php echo isset($field->id)?$field->id:'';?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				
				<div class="control-group">
					<label for="textfield" class="control-label">Nama Lengkap</label>
					<select data-rule-required="true" name="nama_lengkap" id="nama_lengkap" class="js-example-basic-single js-states form-control">
					</select>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Apakah anda bersedia menjadi saksi ?</label>
                		<div class="controls">
                			<select data-rule-required="true" name="sedia" class="input-xxlarge" onchange="select_next(this.value)">
                				<option value="" disabled selected>Pilih</option>
								<option value="Iya">Iya</option>
								<option value="Tidak">Tidak</option>
                			</select>
						</div>
				</div>

				<div id="form-element">
				</div>

				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url();?>ref_saksi">Kembali</a>
				</div>
				</form>
			</div>       
		</div>
	</div>						
</div>

<script>
	$(document).ready(function() {
    $('#nama_lengkap').select2({
		placeholder:"Pilih Nama",
        ajax:{
            url: "<?php echo site_url('ref_saksi/ajx_user')?>",
            dataType:'json',    
            delay:250,
            data:function(params){
                
                return{
                    nama_user:params.term,
                };
            },
            processResults:function(data){
                var item = $.map(data, (value)=>{ //map buat ngemap object data kyk foreach
                    return { id: value.id, text: value.text };
                });

                return {
                    results: item
                }
            },
            cache: true
        },
        minimumInputLength: 1,
	});
});

	function select_next(id){
		$.ajax({
			url: '<?php echo site_url('ref_saksi/show_index')?>',
			dataType: 'html',
			type    : 'POST',
			data		: {'sedia' : id,
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