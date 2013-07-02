<?php 
echo form_open(current_url(), $form_attributes);
//dev(eval('return $'. param('param_asw_database_column_contact_name') . '["name"];'));
echo form_hidden(eval('return $'. param('param_asw_database_column_contact_id') . '["name"];'), 
		eval('return $'. param('param_asw_database_column_contact_id') . '["value"];'));
echo form_hidden(eval('return $'. param('param_asw_database_column_contact_customerid') . '["name"];'),
		eval('return $'. param('param_asw_database_column_contact_customerid') . '["value"];'));
echo form_hidden(eval('return $'. param('param_asw_database_column_contact_customernumber') . '["name"];'),
		eval('return $'. param('param_asw_database_column_contact_customernumber') . '["value"];'));
echo form_hidden(eval('return $'. param('param_asw_database_column_contact_name') . '["name"];'),
		eval('return $'. param('param_asw_database_column_contact_name') . '["value"];'));
?>

<div class="row">
	<div class="span12">
		<div class="well">
			<div class="row">

				<div class="span5">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('name'), 'customer', array('class' => 'control-label')), array(eval('return $'. param('param_asw_database_column_contact_name') . ';')));
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('email'), 'email', array('class' => 'control-label')), array(eval('return $'. param('param_asw_database_column_contact_email') . ';')));
					?>
				</div>

				<div class="span5">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('gsm'), 'gsm', array('class' => 'control-label')), array(eval('return $'. param('param_asw_database_column_contact_gsm') . ';')));
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('phone'), 'phone', array('class' => 'control-label')), array(eval('return $'. param('param_asw_database_column_contact_phone') . ';')));
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('fax'), 'fax', array('class' => 'control-label')), array(eval('return $'. param('param_asw_database_column_contact_fax') . ';')));
					?>				
				</div>

			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="span12">
		<div class="well">
			
			<?php
			$departments = $this->contact_model->getDepartments();
			foreach($departments as $key => $value)
			{
			?>
			
				<div class="row">
					<div class="span4">
						<label><b><?php echo ucfirst($value) ?></b></label>
					</div>
					<div class="span7">
						<?php 
						$values = array('geen','email','fax','print');
						echo $this->bootstrap->radio(FALSE, $key, $contact[$key], $values, TRUE);
						?>
					</div>
				</div>
				<hr class="clear" />
				
			<?php
			}
			?>
			
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

</form>
