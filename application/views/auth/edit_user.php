<?php echo $this->bootstrap->heading(1, $this->siebel->getLang('edit_user'), $username); ?>

<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
			//echo form_submit('submit', 'Save User', 'class="button blue save"');
			echo form_hidden('username', $username);
			//echo form_input($group);
			echo form_hidden('id', $user->id);
			echo form_hidden($csrf);
			?>
			
		<div class="well">
			<div class="row">

				<div class="span6">
					<?php 
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('company').' / '.$this->siebel->getLang('departement'), 'company', array('class' => 'control-label')), array($company));
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
			
		</form>
		
	</div>
</div>
