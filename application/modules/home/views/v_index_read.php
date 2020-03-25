

<div class="row-fluid">






<div class="span12"><br>
							
							
							
							<div class="box">
							
							<div class="box-content">
								
								<div class="post-content">
										<h4 class="post-title">
											<?php echo $field['judul']; ?>
										</h4>
										
										<div class="post-text"><hr>
											<p>
											
											<?php echo $field['isi']; ?>
											
											<?php if ($field['id']=="3") { 
											
											$sqllampiran = "select a.* from ref_files a";
									$querylampiran = $this->db->query($sqllampiran);
									foreach($querylampiran->result_array() as $row){

											?>
											
											<ul>
												<li><a href="<?php echo base_url();?>downloads/documents/<?php echo  $row['FILE']; ?>" target="_blank"><?php echo  $row['NAMA']; ?></a></li>
											</ul>
											
											<?php 
											}
												} ?>
											
											
											
											
											</p>
											
											
											
											
											
										</div>
									</div>
								
								
							</div>
						</div>
							
							
							
							
							

						</div>
						
						
						



					
					
					
					
				
				</div> 