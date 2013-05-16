
<?php 
echo $this->bootstrap->heading(1, $this->siebel->getLang('create_user')); 
echo form_open(current_url(), $form_attributes); 
?>
<div class="row">
	<div class="span12">

			
		<div class="well">
			<div class="row">

				<div class="span6">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('group'), 'group_name', array('class' => 'control-label')), array($group_name));
					?>
				</div>

				<div class="span5">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('description'), 'description', array('class' => 'control-label')), array($description));
					?>				
				</div>

			</div>

		</div>
			
	</div>
</div>

<div class="row">
	<div class="span12">
		<div class="form-actions">
			<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('save')); ?></button>
			<button class="btn">Cancel</button>
		</div>
	</div>
</div>
		
<?php echo form_close(); ?>
