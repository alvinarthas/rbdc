<style type="text/css">
	th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
</style>
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
			<!-- <form action="#" method="POST" class='form-horizontal form-validate' id="bb"> -->
				<?php echo form_open('ref_role/robih_pv',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
				<?php 
				if ($this->session->flashdata('message_gagal')) {
					echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
				}					
				if ($this->session->flashdata('message_sukses')) {
					echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
				}?>
				
				<input type="hidden" name="id_user_group" id="id_user_group" value="<?php echo isset($field->id_user_group)?$field->id_user_group:'';?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                
                <div class="control-group">
                	<label for="textfield" class="control-label">Nama Group Pengguna</label>
                		<div class="controls">
                			<input readonly="" style="border: none;background: none;" type="text" name="nama_user_group" id="nama_user_group" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->nama_user_group)?$field->nama_user_group:'';?>">
						</div>
				</div>
				<div class="control-group">
					<label class="control-label">Previlege</label>
							<table class="a">
							<tr>
								<th rowspan="2">Menu</th>
								<th colspan="3">Previlege</th>								
							</tr>
							<tr>
								<th>Insert</th>
								<th>Update</th>
								<th>Delete</th>																
							</tr>

							<?php 
							if (isset($categoryList)) {
    							foreach($categoryList as $key => $value){

									$cb ="";
									$role = "";												
    								$query = $this->db->query("select count(*) as 
    									jml from ref_menu where parrent='".$value['id_menu']."'")->row();
									if (isset($menu_user)) {
										foreach ($menu_user as $keys => $values) {
											if($values->id_menu==$value['id_menu']){
												$cb = "checked=''";
												$role = decode_role($values->role);	
//												{"update":"TRUE","insert":"TRUE","delete":"FALSE"}											
											}
										}
									}
									
								?>
								<tr>
   									<td> 
   										<input type="checkbox" name="cb_pv[]" value="<?= $value['id_menu'] ?>" <?php echo $cb ?>> 
   										<?= $value['nama_menu'] ?>
   									</td>
   									<td> 
   										<input type="checkbox" name="role[<?= $value['id_menu'] ?>][]" value="C" 
   										<?php echo (isset($role["insert"]) && $role["insert"] =="TRUE") ? 'checked="" ' : '' ; ?> > Insert
   									</td>
   									<td> 
   										<input type="checkbox" name="role[<?= $value['id_menu'] ?>][]" value="U" 
   										<?php echo (isset($role["update"]) && $role["update"]=="TRUE") ? 'checked="" ' : '' ; ?> > Update
   									</td>
   									<td> 
   										<input type="checkbox" name="role[<?= $value['id_menu'] ?>][]" value="D" 
   										<?php echo (isset($role["delete"]) && $role["delete"]=="TRUE") ? 'checked="" ' : '' ; ?> > Delete
   									</td>
   								</tr>										
									<?php
								}
							}
							?>

							</table>
				</div>


				<div class="form-actions">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a class="btn btn-danger"  href="<?php echo site_url("ref_role");?>">Kembali</a>
				</div>

				</form>
			</div>       
		</div>
	</div>						
</div>