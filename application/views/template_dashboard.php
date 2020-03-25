<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>DASHBOARD RETRIBUSI</title>

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
	<!-- imagesLoaded -->
	<script src="<?php echo base_url()?>assets_users/js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
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
	<!-- Theme framework -->
	<script src="<?php echo base_url()?>assets_users/js/eakroko.js"></script>
	<!-- Theme scripts -->
	<script src="<?php echo base_url()?>assets_users/js/application.min.js"></script>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url()?>assets/img/riau.png" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?>assets/img/riau.png" />
</head>



<body>
<div>
	<a href="<?php echo site_url('') ?>">	
		<img src="<?php echo base_url()?>assets_users/img/rbdclogo.png" />
	</a>
</div>
	<div style="background-color:#2777c5; height:2px;">&nbsp;</div>
	
<div  class="container-fluid nav-hidden" id="content">
				<div id="main" style="margin-left:0px;">
				
				<?php
					ini_set('memory_limit', '512M');	
					echo $contents;
				?>
				
				</div>
			
		</div>
	</body>
	<script type="text/javascript">
		$('.datepick').datepicker({
    		format: 'yyyy-mm-dd'
 		});
 		
	</script>
	</html>