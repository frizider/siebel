<div class="row">
	<div class="span12">

		<?php
		echo form_open(current_url(), array('class' => 'form-horizontal'));
		?>

		<div class="well">
			<div class="row">
				<div class="span8">
					<?php
					$field = 'premium';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field,
						'type' => 'text',
						'value' => number_format(floatval($premium->premium), 2),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>&euro;</span>');
					?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="span12">
				<div class="form-actions">
					<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('save')); ?></button>
				</div>
			</div>
		</div>

		</form>

