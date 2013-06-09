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
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('first_name'), 'first_name', array('class' => 'control-label')), array($first_name));
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('last_name'), 'last_name', array('class' => 'control-label')), array($last_name));
					?>
				</div>

				<div class="span5">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('username'), 'username', array('class' => 'control-label')), array($username));
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('company').' / '.$this->siebel->getLang('departement'), 'company', array('class' => 'control-label')), array($company));
					?>				
				</div>

			</div>

			<div class="row">

				<div class="span6">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('email'), 'email', array('class' => 'control-label')), array($email));
					?>
				</div>

				<div class="span5">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('phone'), 'phone', array('class' => 'control-label')), array($phone));
					?>				
				</div>

			</div>

			<div class="row">

				<div class="span6">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('password'), 'password', array('class' => 'control-label')), array($password), '<span class="labelRandomPassword"></span>');
					?>
				</div>

				<div class="span5">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('confirm_password'), 'password_confirm', array('class' => 'control-label')), array($password_confirm), FALSE, '<button class="btn" id="generateRandomPassword" type="button"><i class="icon-refresh"></i></button>');
					?>
				</div>

			</div>

			<div class="row">

				<div class="span6">
					<?php 
					// Dropdown for languages
					$label = $this->siebel->getLang('lang');
					$name = (isset($lang['value']) && !empty($lang['value'])) ? $lang['value'] : $this->siebel->getLang('choose');
					$values = array('nl' => 'NL', 'fr' => 'FR', 'de' => 'DE', 'en' => 'EN');
					echo $this->bootstrap->dropdown(FALSE, $label, $name, 'lang', $values, FALSE, FALSE, $lang['value']);
					?>
				</div>

				<div class="span5">
					<?php 
					// Dropdown for Groups
					$label = $this->siebel->getLang('group');
					$currentgroup = $this->ion_auth->group($group['value'])->result();
					$name = (isset($group['value']) && !empty($group['value'])) ? $currentgroup[0]->description : $this->siebel->getLang('choose');
					$values = $this->ion_auth->getUserGroups();
					echo $this->bootstrap->dropdown(FALSE, $label, $name, 'group', $values, FALSE, FALSE, $group['value']);
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
