<?php 

echo form_open(current_url(), $form_attributes);
//echo form_submit('submit', 'Save User', 'class="button blue save"');
echo form_hidden('id', $permission['id']);
?>

	<div class="row">
		<div class="span12">
			<div class="well">
				<div class="row">

					<div class="span5">
						<?php 
						echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('name'), 'name', array('class' => 'control-label')), array($name));
						?>
					</div>

					<div class="span6">
						<?php 
						echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('description'), 'description', array('class' => 'control-label')), array($description));
						?>				
					</div>

				</div>
			</div>
			<div class="well">
				<div class="row">

					<div class="span5">
						<?php 
						$groups = $this->ion_auth->getUserGroups();
						$permissions_groups = $this->ion_auth->getPermissionsGroups($permission['name']);
						
						foreach ($groups as $key => $value) {
							
							if(empty($permissions_groups))
							{
								$checked = FALSE;
							}
							else
							{
								if(in_array($key, $permissions_groups)) {
									$checked = TRUE;
								} else {
									$checked = FALSE;
								}
							}
							
							echo form_checkbox('groups[]', $key, $checked);
							echo '<label class="title">'.$value.'</label>';
							echo '<br/>';
						}
						?>
					</div>

					<div class="span6">
						<?php 
						?>				
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="span12">
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Save changes</button>
				<button class="btn">Cancel</button>
			</div>
		</div>
	</div>

</form>
