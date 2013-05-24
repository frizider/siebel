<!DOCTYPE html>
<!-- Development and design by Jens De Schrijver -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<!-- Apple webapp icon setting -->
		<link rel="apple-touch-icon" href="<?= base_url(); ?>public/img/apple-touch-icon-precomposed-57.png" /> <!-- Default size = 57x57 -->
		<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url(); ?>public/img/apple-touch-icon-precomposed-72.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url(); ?>public/img/apple-touch-icon-precomposed-114.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="<?= base_url(); ?>public/img/apple-touch-icon-precomposed-144.png" />
		<link rel="apple-touch-startup-image" href="<?= base_url(); ?>public/img/apple_app_startup.png" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		
		<!-- Palm and Blackberry -->
		<meta name="HandheldFriendly" content="true" />

		<!-- TITLE -->
		<title><?= param('param_pagetitle') ?></title>
		
		<!-- STYLESHEETS -->
		<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/loading.css" />
		
		<!--[if lte IE 8]>
		<link href="<?= base_url(); ?>assets/css/introjs-ie.css" rel="stylesheet">
		<!-- <![endif]-->
		
		<!--<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/app.css" />-->
		<link rel="stylesheet/less" type="text/css" href="<?= base_url(); ?>assets/less/app.less" />
		
		<!-- JAVASCRIPTS -->
		<script type="text/javascript">
			less = {
				env: "development",		// or "production"
				async: true,			// load imports async
				fileAsync: true,		// load imports async when in a page under
										// a file protocol
				poll: 1000,				// when in watch mode, time in ms between polls
				relativeUrls: false		// whether to adjust url's to be relative
										// if false, url's are already relative to the
										// entry less file
			};
		</script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/less.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.js" ></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery-ui.js" ></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap.js" ></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap-datepicker.js" ></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/modernizr.js" ></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/intro.js" ></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/infieldlabel.js" ></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/app.js" ></script>
		
	</head>

	<body data-spy="scroll" data-target=".subnav" data-offset="50" class="<?= (isset($pageclass)) ? $pageclass : '' ?>">
		
		<div class="loading">
			<ul class="bokeh">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>

		<header>
			<?php
			if ($this->ion_auth->logged_in())
			{
				echo $this->load->view('include/top_menu'); 
			}
			else
			{
				echo $this->load->view('include/welcome'); 
			}
			?>
		</header>
		<div class="container">
			<div class="row">
				<div class="span12">
					<?php 
					echo (isset($message) && !empty($message)) ? $this->bootstrap->alert($message) : '';
					echo ($this->session->flashdata('success')) ? $this->bootstrap->alert($this->session->flashdata('success'), 'alert-success') : '' ;
					echo ($this->session->flashdata('error')) ? $this->bootstrap->alert($this->session->flashdata('error'), 'alert-error') : '' ;
					?>
				</div>
			</div>
		</div>
		<div class="container<?php echo (isset($containerClassContent))?$containerClassContent:''; ?>">
			
