<!DOCTYPE html>
<!-- Development and design by Jens De Schrijver -->
<html>
	<head>
		<meta charset="utf-8">
		<title><?= param('param_pagetitle') ?></title>
		<link rel="stylesheet" href="<?= base_url(); ?>public/css/template.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="<?= base_url(); ?>public/css/1140.css" type="text/css" media="screen"/>
		<script type="text/javascript" src="<?= base_url(); ?>public/js/jquery.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>public/js/jquery-ui.js"></script>
		<!--[if !msie]>
			<link rel="stylesheet" href="<?= base_url(); ?>public/css/ie.css" type="text/css" media="screen"/>
			<style>
				#view #content {
					padding-top: 50px;
				}

			</style>
		<![endif]-->

	</head>

	<body id="<?= $pageid; ?>">
		
		<div class="contents">
		<!-- <a href="#" class="feedback">Feedback</a> -->
		
			<div id="login-bg">
				<div id="login-bg-inner">
					<div class="inner"></div>
				</div>
			</div>

			<div id="wrap">
				<div class="wrap-inner">


					<!-- Header -->
					<div id="loginheader">
						<h1><a title="<?= param('param_pagetitle') ?>" href="#"></a></h1>
					</div>

					<!-- LOGIN BOX -->
					<div class="loginbox">
						<div id="main-body">
							<div class="inner">
								<div class="title">
									<?php 
									if (!empty($message)) {
											echo '<h2 class="error">'.$message.'</h2>';
									} else {
										echo '<h2>'.$title.'</h2>';
									}
									?>
								</div>
										<p class="text">
											<span>
												<label>New Password (at least <?php echo $min_password_length;?> characters long):</label>
												<?= form_input($new_password); ?>
											</span>
										</p>
										<p class="text">
											<span>
												<label>Confirm New Password:</label>
												<?= form_input($new_password_confirm); ?>
											</span>
										</p>
										<p>
											<?= form_submit('submit', 'Submit', 'class = loginbutton'); ?>
										</p>
										<p class="clear">
									<?= form_close(); ?>
							</div>
						</div>
					</div>


					<div id="footer_spacer"></div>

					<div id="bottom">
						<ul>
							<?php echo '<li class="first"><a href="forgot_password">Forgot your password?</a></li>'; ?>
							<?php echo '<li><a href="'.base_url().index_page().'contact">Contact</a></li>'; ?>
							<li class="last"><a href="http://www.aliplast.com">&copy; Aliplast</a></li>
						</ul>
					</div>
				</div>
			</div>

			<script type="text/javascript">
				$(document).ready(function() {
					$("input#email").focus(); 
					$("input#email").focus(function(){ $(this).select(); });
					<?php if(!empty($message)) { ?>
					$("#login .loginbox").effect("shake", { times: 4 }, 64);
					<?php } ?>
					
				});
			</script>

<!--
<div id="confirmOverlayFeedback" style="display:none;">
	<div id="confirmBox">
		<form action="<?= base_url() . index_page() . 'feedback' ?>" id="feedbackform" name="feedbackform" method="post">
			<h1>Feedback</h1>
			<p>Geef hieronder in wat er fout gaat:</p>
			<textarea name="feedback"></textarea>
			<input type="text" class="input" name="url" disabled="disabled" value="<?= current_url() ?>">
			<div id="confirmButtons">
				<a href="#" class="button blue submitfeedbackform"><span>Feedback verzenden</span></a>
				<a href="#" class="button white cancel"><span>Annuleren</span></a>
			</div>
		</form>
	</div>
</div>
-->

		</div>
	</body>
</html>
