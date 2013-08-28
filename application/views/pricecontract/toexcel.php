<form action="<?php echo current_url(); ?>" method="post" accept-charset="utf-8" class="form-horizontal">
	<div class="well">
		<div class="row">
			<div class="span5"><?php echo $this->bootstrap->checkbox(array($this->siebel->getLang('closed'), 'closed', array('class' => 'control-label')), 'closed', 0, array('1' => '')); ?></div>
		</div>
		<div class="row">
			<div class="span5"><?php echo $this->bootstrap->checkbox(array($this->siebel->getLang('active'), 'active', array('class' => 'control-label')), 'active', 0, array('1' => '')); ?></div>
		</div>
		<div class="row">
			<div class="span5"><?php echo $this->bootstrap->checkbox(array($this->siebel->getLang('future'), 'future', array('class' => 'control-label')), 'future', 0, array('1' => '')); ?></div>
		</div>
	</div>

	<div class="row">
		<div class="span12">
			<div class="form-actions">
				<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('search')); ?></button>
			</div>
		</div>
	</div>

</form>