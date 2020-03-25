<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>DATA SELURUH RETRIBUSI</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/bootstrap-responsive.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/themes.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/plugins/datepicker/datepicker.css">


	<!-- jQuery -->
	<script src="<?php echo base_url()?>assets_users/js/jquery.min.js"></script>
	
	<!-- jQuery UI -->
	<script src="<?php echo base_url()?>assets_users/js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="<?php echo base_url()?>assets_users/js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="<?php echo base_url()?>assets_users/js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="<?php echo base_url()?>assets_users/js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="<?php echo base_url()?>assets_users/js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<!-- slimScroll -->
	<script src="<?php echo base_url()?>assets_users/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url()?>assets_users/js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="<?php echo base_url()?>assets_users/js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Bootbox -->
	<script src="<?php echo base_url()?>assets_users/js/plugins/form/jquery.form.min.js"></script>

	<!-- Theme framework -->
	<script src="<?php echo base_url()?>assets_users/js/eakroko.js"></script>
	<!-- Theme scripts -->
	<script src="<?php echo base_url()?>assets_users/js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="<?php echo base_url()?>assets_users/js/demonstration.min.js"></script>
</head>
<body>
    <?php
$total=0;
?>
<div class="row-fluid">
    <div class="box box-color box-bordered">
            <div class="box-title">
                <h3>
                    <i class="icon-bar-chart"></i>
                    Data Seluruh Retribusi
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
                            <th>No</th>
                            <th>Jenis Retribusi</th>
                            <th>Target</th>
                            <th>Realisasi</th>
                        </tr>
                        <?php 
                            $count = count($all);
                            for($i=0;$i<$count;$i++){?>
                        <tr>
                            <td><?=$i+1;?>
                            <td><?=$all[$i]['jenis_ret'];?></td>
                            <td><?=number_format($all[$i]['target'], 0, '.', ',');?></td>
                            <td><?=number_format($all[$i]['realisasi'], 0, '.', ',');?></td>
                        </tr>
                        <?php 
                        $total+=$all[$i]['realisasi'];
                        } ?>
                        <tr>
                                    <td colspan="2">Total</td>
                                    <td><strong>0<strong></td>
                                    <td><strong><?=number_format($total, 0, '.', ',');?></strong></td>
                                </tr>
                    </thead>
                </table>
            </div><!--box content-->
        </div><!--box box-color box-bordered-->
    </div> <!--span-4-->
</div><!--row fluid-->
</body>
<script type="text/javascript">
    $('.datepick').datepicker({
        format: 'yyyy-mm-dd'
    });
    
</script>
</html>