<?php $total=0; $ttl_trg=0; ?>
<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Dashboard <?=$id?></h1>
					</div>
					<div class="pull-right">
						
						<ul class="stats">
							
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="#">Beranda</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo site_url('dashboard');?>">Dashboard</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				
				<div class="row-fluid">
					<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-bar-chart"></i>
									Detail
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div><!--box title-->
							<div class="box-content">
								<table class="table table-hover table-nomargin">
									<thead>
                                        <tr>
                                            <th>Jenis Retribusi</th>
                                            <th>Target</th>
                                            <th>Realisasi</th>
                                        </tr>
                                        <?php 
                                            $count = count($detail);
                                            for($i=0;$i<$count;$i++){?>
										<tr>
											<td><?=$detail[$i]['jenis_ret'];?></td>
                                            <td><?=number_format($detail[$i]['target'], 0, '.', ',');?></td>
                                            <td><?=number_format($detail[$i]['realisasi'], 0, '.', ',');?></td>
										</tr>
                                       <?php 
                                       $total+=$detail[$i]['realisasi'];
                                       } ?>
                                       <tr>
													<td>Total</td>
													<td><strong><?=$ttl_trg?><strong></td>
													<td><strong><?=number_format($total, 0, '.', ',');?></strong></td>
												</tr>
									</thead>
								</table>
							</div><!--box content-->
						</div><!--box box-color box-bordered-->
					</div> <!--span-4-->
				</div><!--row fluid-->
</div><!--container fluid-->
	<script src="<?php echo base_url()?>assets_users/amcharts/amcharts.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_users/amcharts/serial.js" type="text/javascript"></script>