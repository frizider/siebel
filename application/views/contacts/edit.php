<?php 
echo $this->bootstrap->heading(1, $this->siebel->getLang('edit_contact'), $contact[param('param_asw_database_column_contact_name')], '<a class="backbutton" title="Go back" href="'.site_url('dashboard/customer/'.$customernumber['value']).'"><span><i class="icon-chevron-left"></i></span></a> '); 
echo form_open(current_url(), $form_attributes);
echo form_input($id);
echo form_input($customerid);
echo form_input($customernumber);
echo form_hidden($name['name'], $name['value']);
?>

<div class="row">
	<div class="span12">
		<div class="well">
			<div class="row">

				<div class="span5">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('name'), 'customer', array('class' => 'control-label')), array($name));
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('email'), 'email', array('class' => 'control-label')), array($email));
					?>
				</div>

				<div class="span5">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('phone'), 'phone', array('class' => 'control-label')), array($phone));
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('fax'), 'fax', array('class' => 'control-label')), array($fax));
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
