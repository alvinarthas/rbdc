<div class="row-fluid">
<div class="span12">&nbsp;</div>
</div>


<div class="row-fluid">
<div class="span2">&nbsp;</div>

<div class="span8">






<div class="box box-color box-bordered">
<div class="box-title">
								<h3><i class="icon-user"></i>Form Ubah Password</h3>
								<div class="actions">
									<!--<a class="btn btn-mini content-refresh" href="#"><i class="icon-refresh"></i></a>
									<a class="btn btn-mini content-remove" href="#"><i class="icon-remove"></i></a>-->
									<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
								</div>
							</div>
                            
 <div class="box-content">
 
								<!-- <form action="#" method="POST" class='form-horizontal form-validate' id="bb"> -->
								<?php echo form_open('editpass/submit',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate'));?>
									
									
									<?php if (isset($pesan)) { 
									echo '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$pesan.'</div>';
									}
									?>
									
							
									
									
								
                                   
                                    <div class="control-group">
										<label class="control-label" for="textfield">Masukan password lama</label>
										
										<div class="controls">
                                        <input type="text" class='' id="kunci_masuk_lama" name="kunci_masuk_lama" data-rule-required="true" value="" />
											
										</div>
									</div>
                                    
                                    
                                    <div class="control-group">
										<label class="control-label" for="textfield">Masukan password baru</label>
										
										<div class="controls">
                                        <input type="text" class='' id="kunci_masuk_baru" name="kunci_masuk_baru" data-rule-required="true" value="" />
											
										</div>
									</div>
                                    
                 
                                            <hr />
                                            
                                    
                                    
                                           
                      								
									
									
									
									<button class="btn btn-primary" type="submit"><i class="icon-check"></i>&nbsp;SIMPAN PERUBAHAN</button>
                                    <!--<a href="<?=site_url()?>/" class="btn btn-danger" type="submit"><i class="icon-reply"></i>&nbsp;KEMBALI</a>-->
									
								</form>
							</div>       
 
 
</div>






</div>

<div class="span2">&nbsp;</div>								
</div>
