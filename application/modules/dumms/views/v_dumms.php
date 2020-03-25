<div class="container-fluid">
	<br>
	<div class="breadcrumbs">
		<ul>
			<li>
				<a href="#">Data Master</a>
				<i class="icon-angle-right"></i>
			</li>
			<li>
				<a href="#">Dinas</a>
				<i class="icon-angle-right"></i>
			</li>
			
		</ul>
		<div class="close-bread">
			<a href="#"><i class="icon-remove"></i></a>
		</div>
	</div> <!-- /breadcrumbs-->
</div> <!-- /container-fluid-->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3>
					<i class="icon-reorder"></i>
                    List Profile Dinas
				</h3>
			</div> <!-- /box title-->
			<div class="box-content">
				<form action="<?php echo site_url('dumms/view_profile'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
					<div class="table-responsive">				
						<table width="100%" class="table table-hover">
							<thead>
								<tr>
									<th>Nama</th>
                                    <th>Aksi 1 </th>
									<th>Aksi 2 </th>
								</tr>
							</thead>
							<tbody>
										<tr>
                                            <td><a href="<?php echo site_url('dumms/view_profile')?>">Dinas A</a></td>
                                            <td><a href="<?php echo site_url('dumms/updet_data')?>">Update Data ( Via Input )</a></td>
											<td><a href="<?php echo site_url('dumms/pull_data')?>">Update Data (Via Web Service)</a></td>
                                        </tr>
							</tbody>
						</table></div>									
					</form>	
				</div>
			</div> <!-- /box content-->
		</div> <!-- /box-->
	</div> <!-- /span12-->
</div> <!-- /row fluid-->