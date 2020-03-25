<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3><i class=" icon-plus-sign"></i><?php echo $judul_form." ".$sub_judul_form;?> </h3>
			</div>
			<div class="box-content">
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				
				<div class="container-fluid">
					<!-- PASLON -->
						<?php foreach($result as $key){ ?>
							<?php echo form_open('polling/post_vote',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
							<input type="hidden" name="id_calon" id="id_calon" class="input-xxlarge"  value="<?=$key['id']?>">
							<input type="hidden" name="ip_address" id="ip_address" class="input-xxlarge"  value="<?php echo $this->input->ip_address();?>">
							<div class="container-fluid">
								<div class="row">
									<center><img src="<?=$key['gambar']?>" width="25%" alt=""></center>
								</div>
								<div class="row">
									<center>
								<?php foreach($key['partai'] as $par){ ?>
										<span><img src="<?=$par['gambar']?>" width="5%" alt=""></span>
								<?php } ?>	
									</center>
								</div>
								<div class="row" style="align:center;">
									<center><h5><?php echo $key['nm_cagub']." - ".$key['nm_cawagub'];?></h5></center>
									<center><h6>No Urut <?=$key['no_urut']?></h6></center>
								</div>
								<div class="row">
										<center><button class="btn btn-primary" type="submit" onclick="return confirm('Anda Yakin ingin Memilih?');"><span class="glyphicon glyphicon-thumbs-up"></span> Pilih</button></center>
								</div>
						</div>
						</form>
						<br><br>
						<?php } ?>
					<!-- PASLON -->
				</div>
			</div>  
		</div>
	</div>						
</div>