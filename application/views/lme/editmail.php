<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
		?>

		<div class="well">
			<div class="row">
				<div class="span10">
					<?php 
					$field = 'email';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field,
						'type' => 'text',
						'value' => $lme_mail->$field,
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value));
					?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="span12">
				<div class="form-actions">
					<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('save')); ?></button>
					<button class="btn">Cancel</button>
					<a class="btn btn-danger pull-right" href="<?php echo current_url() ?>/delete"><?php echo ucfirst($this->siebel->getLang('delete')); ?></a>
				</div>
			</div>
		</div>
		
		</form>

	</div>
</div>
