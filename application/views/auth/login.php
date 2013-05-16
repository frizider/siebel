<!-- 
<div class="row">

	<div class="span12">
		
	</div>
	
</div>
-->

<div class ="loginbox">

	<!-- <h1><a title="<?= param('param_pagetitle') ?>" href="#" class="login-logo"><?= param('param_pagetitle') ?></a></h1> -->
	<?= form_open('auth/login'); ?>
		<div class="control-group">
			<div class="input-prepend">
				<span class="add-on"><span class="icon-user"></span></span><?= form_input($identity); ?>
			</div>
		</div>
		<div class="control-group">
			<div class="input-prepend">
				<span class="add-on"><span class="icon-lock"></span></span><?= form_password($password); ?>
			</div>
		</div>
		<div class="control-group">
			<button type="submit" class="btn btn-primary span3">Login</button>
		</div>
		<input type="hidden" name="location_hash" value="" />
		<input type="hidden" name="redirect" value="" />
		<div class="clearfix"></div>
	</form>

</div>
		
<script type="text/javascript">
	$(document).ready(function() {
		
		<?php if(!empty($message)) { ?>
		$("#login .loginbox").effect("shake", { times: 4 }, 64);
		<?php } ?>
			
		$('input[rel=popover]').popover({
			trigger: "focus"
		});
	});
</script>
