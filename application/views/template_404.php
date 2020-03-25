<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>404 Error Page!</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/bootstrap-responsive.min.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/themes.css">


	<!-- jQuery -->
	<script src="<?php echo base_url()?>assets_users/js/jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="<?php echo base_url()?>assets_users/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url()?>assets_users/js/bootstrap.min.js"></script>

	<!--[if lte IE 9]>
		<script src="<?php echo base_url()?>assets_users/js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url()?>assets_users/img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?>assets_users/img/apple-touch-icon-precomposed.png" />

	<style type="text/css">
		.background {
		width: 100%;
	 	height: 100%;
	  	position: relative;
	  	background-size: 100% 100%;
		}

		.clouds {
		  width: 200px;
		  height: 300px;
		  position: absolute;
		  margin-top: -55px;
		}

		.cloud1 {
			top: 0px;
		  z-index: 100;
		  fill: #eee;
		  width: 200px;
		  -webkit-animation: move 20s linear infinite;
		  -moz-animation: move 20s linear infinite;
		  -o-animation: move 20s linear infinite;
		  animation: move 20s linear infinite;
		}

		.cloud3 {
			top: 0px;
		  z-index: 100;
		  fill: #eee;
		  width: 200px;
		  -webkit-animation: move 30s linear infinite;
		  -moz-animation: move 30s linear infinite;
		  -o-animation: move 30s linear infinite;
		  animation: move 30s linear infinite;
		}

		.cloud2 {
		top: 100px;
		  z-index: 200;
		  fill: #eee;
		  width: 200px;
		  -webkit-animation: move 15s linear infinite backwards;
		  -moz-animation: move 15s linear infinite backwards;
		  -o-animation: move 15s linear infinite backwards;
		  animation: move 15s linear infinite backwards;
		}

		.cloud12 {
		top: 100px;
		  z-index: 200;
		  fill: #eee;
		  width: 200px;
		  -webkit-animation: move 15s linear 5s infinite backwards;
		  -moz-animation: move 15s linear 5s infinite backwards;
		  -o-animation: move 15s linear 5s infinite backwards;
		  animation: move 15s linear 5s infinite backwards;
		}

		.cloud22 {
		top: 100px;
		  z-index: 200;
		  fill: #eee;
		  width: 200px;
		  -webkit-animation: move 20s linear 5s infinite backwards;
		  -moz-animation: move 20s linear 5s infinite backwards;
		  -o-animation: move 20s linear 5s infinite backwards;
		  animation: move 20s linear 5s infinite backwards;
		}

		.cloud3x {
			top: 0px;
		  z-index: 100;
		  fill: #eee;
		  width: 200px;
		  -webkit-animation: back 30s linear infinite;
		  -moz-animation: back 30s linear infinite;
		  -o-animation: back 30s linear infinite;
		  animation: back 30s linear infinite;
		}

		.cloud12x {
		top: 100px;
		  z-index: 200;
		  fill: #eee;
		  width: 200px;
		  -webkit-animation: back 15s linear 5s infinite backwards;
		  -moz-animation: back 15s linear 5s infinite backwards;
		  -o-animation: back 15s linear 5s infinite backwards;
		  animation: back 15s linear 5s infinite backwards;
		}

		.cloud22x {
		top: 100px;
		  z-index: 200;
		  fill: #eee;
		  width: 200px;
		  -webkit-animation: back 20s linear 5s infinite backwards;
		  -moz-animation: back 20s linear 5s infinite backwards;
		  -o-animation: back 20s linear 5s infinite backwards;
		  animation: back 20s linear 5s infinite backwards;
		}

		@-webkit-keyframes move {
		  from {-webkit-transform: translateX(-400px);}
		  to {-webkit-transform: translateX(1350px);}
}

		@-webkit-keyframes back {
		  from {-webkit-transform: translateX(1350px);}
		  to {-webkit-transform: translateX(-400px);}
}

	</style>

</head>



<body class="error" style="background: #6CB7EF">
<div class="background">
   <svg class="clouds cloud1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
	</svg>
  <svg class="clouds cloud2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
	</svg>
  <svg class="clouds cloud3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
	</svg>

  <svg class="clouds cloud12" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
	</svg>

  <svg class="clouds cloud22" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
	</svg>


	<svg class="clouds cloud3x" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
	</svg>

  <svg class="clouds cloud12x" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
	</svg>

  <svg class="clouds cloud22x" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
	</svg>

</div>
	<center>
	<div class="wrapper" style="width: 400px;left: 46%;top:43%">
		<div class="code">
		<p style="font-size: 12pt;font-weight: bold;position: absolute;color: #000;z-index: 1000">Maaf, Halaman yang anda cari bermasalah!</p>
		<img src="<?= base_url("assets_users/img/404.png") ?>" class="img img-responsive">
		</div>
		<div class="desc"></div>
		<div class="buttons">
		<a href="<?= base_url() ?>" class="btn btn-satblue"><i class="icon-arrow-left"></i> Silahkan kembali ke beranda</a>
		</div>
	</div>
	</center>		
		
	</body>

	</html>