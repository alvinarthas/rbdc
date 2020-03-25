<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>RIAU BANGKIT</title>

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
	
	<!-- Nice Scroll -->
	<script src="<?php echo base_url()?>assets_users/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
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
	<!-- Bootbox -->
	<script src="<?php echo base_url()?>assets_users/js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Bootbox -->
	<script src="<?php echo base_url()?>assets_users/js/plugins/form/jquery.form.min.js"></script>
	<!-- Validation -->
	<script src="<?php echo base_url()?>assets_users/js/plugins/validation/jquery.validate.min.js"></script>
	<script src="<?php echo base_url()?>assets_users/js/plugins/validation/additional-methods.min.js"></script>
      <script src="<?php echo base_url()?>assets_users/js/plugins/complexify/jquery.complexify-banlist.min.js"></script>
	<script src="<?php echo base_url()?>assets_users/js/plugins/complexify/jquery.complexify.min.js"></script>  

        <!-- Datepicker -->
	<script src="<?php echo base_url(); ?>assets_users/js/plugins/datepicker/bootstrap-datepicker.js"></script>

	<!-- Theme framework -->
	<script src="<?php echo base_url()?>assets_users/js/eakroko.js"></script>
	<!-- Theme scripts -->
	<script src="<?php echo base_url()?>assets_users/js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="<?php echo base_url()?>assets_users/js/demonstration.min.js"></script>

	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	<style type="text/css">
tr.bordered {
    border-bottom: 1px solid #000;
}
</style>
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	<!-- Favicon -->
			<link rel="shortcut icon" href="<?php echo base_url()?>assets/img/logobandung.png" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?>assets/img/logobandung.png" />
</head>



<body>
<div>
	<a href="<?php echo site_url('') ?>">
		<img src="<?php echo base_url()?>assets_users/img/rbdclogo.png" />
	</a>
</div>
	<div style="background-color:#2777c5; height:2px;">&nbsp;</div>
	<div id="navigation">
		<div class="container-fluid">
		<ul class='main-nav'>
				<?php if(!$this->session->userdata('atos_tiasa_leubeut')){ ?>
				
				
				<li class=''>
					<a href="<?php echo site_url(); ?>">
						<span>Beranda</span>
					</a>
				</li>
				
				<li class=''>
					<a href="<?php echo site_url(); ?>loginapp">
						<span>Login</span>
					</a>
				</li>
				
				<?php } ?>
				
				<?php if($this->session->userdata('atos_tiasa_leubeut')){ ?>
				<?php 
				echo menu_nav();
				?>
				<?php } ?>
							
			</ul>		
		
			
			<div class="user">
				
				<ul class="icon-nav"> </ul>
				
				<?php if($this->session->userdata('atos_tiasa_leubeut')){ ?>
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">Selamat datang, <strong><?php echo $this->session->userdata('sesi_nama_lengkap'); ?></strong> <img src="<?php echo base_url()?>assets_users/img/default.png" alt=""></a>
					<ul class="dropdown-menu pull-right">
					   
						<li>
							<a href="<?php echo site_url();?>editpass/">Ubah Password</a>
						</li>
						<li>
							<a href="<?php echo site_url();?>loginapp/logout/">Logout</a>
						</li>
					</ul>
					
				</div>
				<?php } ?>
				
				
			</div>
		</div>
	</div>
	
	
	
	
	
	
	<!--<div class="container-fluid nav-hidden" id="content">
		
		<div id="row-fluid"></div> 
		
		<div id="main" style="margin-left:0px;">
			<div class="container-fluid">
				
				
				
				
				
				
				init
				
				
			</div>
		</div>
		</div>-->
		
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