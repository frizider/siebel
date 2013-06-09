<script type="text/javascript" src="<?php echo base_url() ?>/assets/ckeditor/ckeditor.js"></script>

<?php 
echo form_open(current_url(), $form_attributes);
$name = ($this->input->post('department')) ? $this->input->post('department') : $this->siebel->getLang('choose');
$departmentBox = $this->bootstrap->dropdown(FALSE, $this->siebel->getLang('department'), $name, 'department', $this->contact_model->getDepartments(), 'pull-right');
echo $this->bootstrap->heading(1, $this->siebel->getLang('messenger'), $departmentBox); 
?>

<div class="row">
	<div class="span12">
			
		<ul id="tabs" class="nav nav-tabs">
			<li class="active"><a href="#mail_nl" data-toggle="tab">NL</a></li>
			<li><a href="#mail_fr" data-toggle="tab">FR</a></li>
			<li><a href="#mail_de" data-toggle="tab">DE</a></li>
			<li><a href="#mail_en" data-toggle="tab">EN</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade active in" id="mail_nl">
				<div class="well">
					<div class="row">
						<div class="span11">
							<?php 
							$field = 'subject_nl';
							$input = array(
								'name' => $field,
								'class' => $field.' span9',
								'id' => $field,
								'type' => 'text',
								'value' => $this->input->post($field),
							);
							echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('subject').' NL', $field, array('class' => 'control-label')), array($input));
							?>
						</div>
					</div>

					<div class="row">
						<div class="span11">
							<div class="control-group">
								<label for="message_nl" class="control-label"><?php echo ucfirst($this->siebel->getLang('message')) ?></label>
								<div class="controls">
									<?php 
									$field = 'message_nl';
									$input = array(
										'name' => $field,
										'class' => $field,
										'id' => $field,
										'type' => 'textarea',
										'value' => $this->input->post($field),
									);
									echo $this->ckeditor->editor($input['name'], $input['value']);
									?>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>


			<div class="tab-pane fade" id="mail_fr">
				<div class="well">
					<div class="row">
						<div class="span11">
							<?php 
							$field = 'subject_fr';
							$input = array(
								'name' => $field,
								'class' => $field.' span9',
								'id' => $field,
								'type' => 'text',
								'value' => $this->input->post($field),
							);
							echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('subject').' FR', $field, array('class' => 'control-label')), array($input));
							?>
						</div>
					</div>

					<div class="row">
						<div class="span11">
							<div class="control-group">
								<label for="message_fr" class="control-label"><?php echo ucfirst($this->siebel->getLang('message')) ?></label>
								<div class="controls">
									<?php 
									$field = 'message_fr';
									$input = array(
										'name' => $field,
										'class' => $field,
										'id' => $field,
										'type' => 'textarea',
										'value' => $this->input->post($field),
									);
									echo $this->ckeditor->editor($input['name'], $input['value']);
									?>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>


			<div class="tab-pane fade" id="mail_de">
				<div class="well">
					<div class="row">
						<div class="span11">
							<?php 
							$field = 'subject_de';
							$input = array(
								'name' => $field,
								'class' => $field.' span9',
								'id' => $field,
								'type' => 'text',
								'value' => $this->input->post($field),
							);
							echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('subject').' DE', $field, array('class' => 'control-label')), array($input));
							?>
						</div>
					</div>

					<div class="row">
						<div class="span11">
							<div class="control-group">
								<label for="message_de" class="control-label"><?php echo ucfirst($this->siebel->getLang('message')) ?></label>
								<div class="controls">
									<?php 
									$field = 'message_de';
									$input = array(
										'name' => $field,
										'class' => $field,
										'id' => $field,
										'type' => 'textarea',
										'value' => $this->input->post($field),
									);
									echo $this->ckeditor->editor($input['name'], $input['value']);
									?>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>


			<div class="tab-pane fade" id="mail_en">
				<div class="well">
					<div class="row">
						<div class="span11">
							<?php 
							$field = 'subject_en';
							$input = array(
								'name' => $field,
								'class' => $field.' span9',
								'id' => $field,
								'type' => 'text',
								'value' => $this->input->post($field),
							);
							echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('subject').' EN', $field, array('class' => 'control-label')), array($input));
							?>
						</div>
					</div>

					<div class="row">
						<div class="span11">
							<div class="control-group">
								<label for="message_en" class="control-label"><?php echo ucfirst($this->siebel->getLang('message')) ?></label>
								<div class="controls">
									<?php 
									$field = 'message_en';
									$input = array(
										'name' => $field,
										'class' => $field,
										'id' => $field,
										'type' => 'textarea',
										'value' => $this->input->post($field),
									);
									echo $this->ckeditor->editor($input['name'], $input['value']);
									?>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
			
		<div class="row">
			<div class="span12">
				<div class="form-actions">
					<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('send')); ?></button>
					<button class="btn">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>

</form>


<div class="row">
	<div class="span12">
		<?php 
			if(isset($sended) && !empty($sended))
			{
				foreach($sended as $row)
				{
					echo '<div class="row"><div class="span12">'.$row.'</div></div>';
				}
			}
		?>
	</div>
</div>