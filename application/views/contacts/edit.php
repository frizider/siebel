<?php 
echo $this->bootstrap->heading(1, $this->siebel->getLang('edit_contact'), $contact[param('param_asw_database_column_contact_name')], '<a class="backbutton" title="Go back" href="'.site_url('contacts/customer/'.$customernumber).'"><span><i class="icon-chevron-left"></i></span></a> '); 
echo form_open(current_url(), $form_attributes);
echo form_input($REIDNO);
echo form_input($RECUID);
echo form_input($RECUNO);
echo form_hidden($RENAM1['name'], $RENAM1['value']);
?>

<div class="row">
	<div class="span12">
		<div class="well">
			<div class="row">

				<div class="span5">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('name'), 'customer', array('class' => 'control-label')), array($RENAM1));
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('email'), 'email', array('class' => 'control-label')), array($REEMAIL));
					?>
				</div>

				<div class="span5">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('phone'), 'phone', array('class' => 'control-label')), array($REPHONE));
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('fax'), 'fax', array('class' => 'control-label')), array($REFAX));
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
			$departments = $this->siebel->getDepartments();
			foreach($departments as $key => $value)
			{
			?>
			
				<div class="row">
					<div class="span4">
						<label><b><?php echo ucfirst($value) ?></b></label>
					</div>
					<div class="span7">
						<?php 
						$values = array(
							'0' => 'geen',
							'1' => 'email',
							'2' => 'fax',
							'3' => 'print',
						);
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
