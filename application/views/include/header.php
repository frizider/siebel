<?php
$season = current_season(); 
$random = rand(1, 5);
?>

<!DOCTYPE html>
<!-- Development and design by Jens De Schrijver -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- TITLE -->
		<title><?= param('param_pagetitle') ?></title>

		<!-- STYLESHEETS -->
		<!--[if lte IE 8]>
		<link href="<?= base_url(); ?>assets/css/introjs-ie.css" rel="stylesheet">
		<!-- <![endif]-->

		<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/app_<?php echo $season; ?>.css" />

		<!-- LESS CSS -->
		<!--
		<link rel="stylesheet/less" type="text/css" href="<?= base_url(); ?>assets/less/app.less" />
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
		-->

		<!-- JAVASCRIPTS -->
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.js" ></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery-ui.js" ></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/diamond.js" ></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/datepicker.js" ></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/shortcut.js" ></script>
		<!-- 
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/infieldlabel.js" ></script> 
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/modernizr.js" ></script>
		-->
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/app.js" ></script>

		<style>
			body.dashboard div#background {
				background: url("<?php echo base_url() ?>assets/img/<?php echo $season.'/'.$random; ?>.jpg") 50% 50% no-repeat;
				position: fixed;
				top: -10px;
				right: -10px;
				bottom: -10px;
				left: -10px;
				height: 110%;
				width: 110%;
				z-index: -1;
				background-size: 110%;
				-webkit-filter: blur(2px);
				opacity: 0.5;
			}
			body.dashboard hr {
				border-top: none;
			}
			.widget {
				background-color: rgba(255, 255, 255, 0.65);
			}
			.widget h3 {
				margin: 10px;
			}
			.widget .content {
				padding: 10px;
				margin: 10px;
			}
		</style>

	</head>

	<body data-spy="scroll" data-target=".subnav" data-offset="50" class="<?= (isset($pageclass)) ? $pageclass : '' ?>">
		<div id="background"></div>
		<!--
		<div class="loading">
			<ul class="bokeh">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
		-->

		<header>
			<?php
			if ($this->ion_auth->logged_in()) {
				echo $this->load->view('include/top_menu');
			} else {
				echo $this->load->view('include/welcome');
			}
			?>
		</header>
		<div class="container">
			<div class="row">
				<div class="span12">
<?php
echo (isset($message) && !empty($message)) ? $this->bootstrap->alert($message) : '';
echo ($this->session->flashdata('message')) ? $this->bootstrap->alert($this->session->flashdata('message'), 'alert-info') : '';
echo ($this->session->flashdata('success')) ? $this->bootstrap->alert($this->session->flashdata('success'), 'alert-success') : '';
echo ($this->session->flashdata('error')) ? $this->bootstrap->alert($this->session->flashdata('error'), 'alert-error') : '';
?>
				</div>
			</div>
		</div>
		<div class="container<?php echo (isset($containerClassContent)) ? $containerClassContent : ''; ?>">

