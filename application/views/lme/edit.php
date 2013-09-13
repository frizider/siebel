<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
		?>

		<div class="well">
			<div class="row">
				<div class="span6">
					<?php 
					$field = 'exchange';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field,
						'type' => 'text',
						'value' => $lme->$field,
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>$/&euro;</span>');
					?>
				</div>
				<div class="span5">
					<div class="control-group">
						<label for="date" class="control-label"><?php echo $this->siebel->getLang('date') ?></label>
						<div class="controls">
							<div class="input-append date" id="datepicker" data-date="<?php echo date('d/m/Y',  mysql_to_unix($lme->date)); ?>" data-date-format="dd/mm/yyyy" data-date-weekstart="1">
								<input type="text" name="date" value="<?php echo date('d/m/Y',  mysql_to_unix($lme->date)); ?>" id="date" class="date">
								<span class="add-on"><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span6">
					<?php 
					$field = 'cash';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field,
						'type' => 'text',
						'value' => $lme->$field,
					);
					echo $this->bootstrap->formControlGroup(array('Cash', $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>$</span>');
					?>
				</div>
				<div class="span5">
					<?php 
					$field = 'mth';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field,
						'type' => 'text',
						'value' => $lme->$field,
					);
					echo $this->bootstrap->formControlGroup(array('3-month', $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>$</span>');
					?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="span12">
				<div class="form-actions">
					<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('save')); ?></button>
					<a href="<?php echo site_url('lme'); ?>" class="btn">Cancel</a>
				</div>
			</div>
		</div>
		
		</form>

	</div>
</div>
