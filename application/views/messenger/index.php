<script type="text/javascript" src="<?php echo base_url() ?>/assets/ckeditor/ckeditor.js"></script>

<?php
echo form_open(current_url(), $form_attributes);
$name = ($this->input->post('department')) ? $this->input->post('department') : $this->siebel->getLang('choose');
$departmentBox = $this->bootstrap->dropdown(FALSE, $this->siebel->getLang('department'), $name, 'department', $this->contact_model->getDepartments(), 'pull-right');
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
								'class' => $field . ' span9',
								'id' => $field,
								'type' => 'text',
								'value' => $this->input->post($field),
							);
							echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('subject') . ' NL', $field, array('class' => 'control-label')), array($input));
							?>
						</div>
					</div>

					<div class="row">
						<div class="span11">
							<div class="control-group">
								<label for="message_nl" class="control-label"><?php echo ucfirst($this->siebel->getLang('message')) ?></label>
								<div class="controls">
									<div>
										<div id="header">
											<p>
												<b><?php echo $this->messenger_model->getMailText('greeting', 'nl'); ?></b>
											</p>
										</div>
									</div>
									<div>
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
									<div>
										<div id="footer">
											<hr />
											<table border=0 cellspacing=0 cellpadding=0 width="100%" style="width:100%; border-collapse:collapse;" class="footer">
												<tr>
													<td valign="top" class="leftcolumn"><b><?php echo $this->ion_auth->getUserdata('first_name') . ' ' . $this->ion_auth->getUserdata('last_name'); ?></b></td>
													<td valign="bottom"><b><?php echo $this->messenger_model->getMailText('thanks', 'nl'); ?></b> <span style="float:right; font-style: italic; text-align:right;">Think before you <img width=20 height=20 src="http://customer.aliplast.com/vp/public/img/mail_green_print.png" alt="">print</span></td>
												</tr><tr>
													<td valign="top" class="leftcolumn"><img border=0 width=113 height=24 src="http://customer.aliplast.com/vp/public/img/mail_logo_aliplast.jpg" alt="<?php echo param('param_company_name'); ?>" style="margin-top:5px;"></td>
													<td valign="top">
														<?php echo $this->ion_auth->getUserdata('company'); ?> <br/>
														<?php echo param('param_company_address'); ?> - <?php echo param('param_company_location'); ?> <br />
														<a href="mailto:<?php echo $this->ion_auth->getUserdata('email'); ?>">
															M: <?php echo $this->ion_auth->getUserdata('email'); ?>
														</a> - 
														<a href="tel:<?php echo $this->ion_auth->getUserdata('phone'); ?>">
															T: <?php echo $this->ion_auth->getUserdata('phone'); ?>
														</a> - F: <?php echo param('param_company_fax'); ?></td>
												</tr>
											</table>
										</div>										
									</div>
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
								'class' => $field . ' span9',
								'id' => $field,
								'type' => 'text',
								'value' => $this->input->post($field),
							);
							echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('subject') . ' FR', $field, array('class' => 'control-label')), array($input));
							?>
						</div>
					</div>

					<div class="row">
						<div class="span11">
							<div class="control-group">
								<label for="message_fr" class="control-label"><?php echo ucfirst($this->siebel->getLang('message')) ?></label>
								<div class="controls">
									<div>
										<div id="header">
											<p>
												<b><?php echo $this->messenger_model->getMailText('greeting', 'fr'); ?></b>
											</p>
										</div>
									</div>
									<div>
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
									<div>
										<div id="footer">
											<hr />
											<table border=0 cellspacing=0 cellpadding=0 width="100%" style="width:100%; border-collapse:collapse;" class="footer">
												<tr>
													<td valign="top" class="leftcolumn"><b><?php echo $this->ion_auth->getUserdata('first_name') . ' ' . $this->ion_auth->getUserdata('last_name'); ?></b></td>
													<td valign="bottom"><b><?php echo $this->messenger_model->getMailText('thanks', 'fr'); ?></b> <span style="float:right; font-style: italic; text-align:right;">Think before you <img width=20 height=20 src="http://customer.aliplast.com/vp/public/img/mail_green_print.png" alt="">print</span></td>
												</tr><tr>
													<td valign="top" class="leftcolumn"><img border=0 width=113 height=24 src="http://customer.aliplast.com/vp/public/img/mail_logo_aliplast.jpg" alt="<?php echo param('param_company_name'); ?>" style="margin-top:5px;"></td>
													<td valign="top">
														<?php echo $this->ion_auth->getUserdata('company'); ?> <br/>
														<?php echo param('param_company_address'); ?> - <?php echo param('param_company_location'); ?> <br />
														<a href="mailto:<?php echo $this->ion_auth->getUserdata('email'); ?>">
															M: <?php echo $this->ion_auth->getUserdata('email'); ?>
														</a> - 
														<a href="tel:<?php echo $this->ion_auth->getUserdata('phone'); ?>">
															T: <?php echo $this->ion_auth->getUserdata('phone'); ?>
														</a> - F: <?php echo param('param_company_fax'); ?></td>
												</tr>
											</table>
										</div>										
									</div>
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
								'class' => $field . ' span9',
								'id' => $field,
								'type' => 'text',
								'value' => $this->input->post($field),
							);
							echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('subject') . ' DE', $field, array('class' => 'control-label')), array($input));
							?>
						</div>
					</div>

					<div class="row">
						<div class="span11">
							<div class="control-group">
								<label for="message_de" class="control-label"><?php echo ucfirst($this->siebel->getLang('message')) ?></label>
								<div class="controls">
									<div>
										<div id="header">
											<p>
												<b><?php echo $this->messenger_model->getMailText('greeting', 'de'); ?></b>
											</p>
										</div>
									</div>
									<div>
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
									<div>
										<div id="footer">
											<hr />
											<table border=0 cellspacing=0 cellpadding=0 width="100%" style="width:100%; border-collapse:collapse;" class="footer">
												<tr>
													<td valign="top" class="leftcolumn"><b><?php echo $this->ion_auth->getUserdata('first_name') . ' ' . $this->ion_auth->getUserdata('last_name'); ?></b></td>
													<td valign="bottom"><b><?php echo $this->messenger_model->getMailText('thanks', 'de'); ?></b> <span style="float:right; font-style: italic; text-align:right;">Think before you <img width=20 height=20 src="http://customer.aliplast.com/vp/public/img/mail_green_print.png" alt="">print</span></td>
												</tr><tr>
													<td valign="top" class="leftcolumn"><img border=0 width=113 height=24 src="http://customer.aliplast.com/vp/public/img/mail_logo_aliplast.jpg" alt="<?php echo param('param_company_name'); ?>" style="margin-top:5px;"></td>
													<td valign="top">
														<?php echo $this->ion_auth->getUserdata('company'); ?> <br/>
														<?php echo param('param_company_address'); ?> - <?php echo param('param_company_location'); ?> <br />
														<a href="mailto:<?php echo $this->ion_auth->getUserdata('email'); ?>">
															M: <?php echo $this->ion_auth->getUserdata('email'); ?>
														</a> - 
														<a href="tel:<?php echo $this->ion_auth->getUserdata('phone'); ?>">
															T: <?php echo $this->ion_auth->getUserdata('phone'); ?>
														</a> - F: <?php echo param('param_company_fax'); ?></td>
												</tr>
											</table>
										</div>										
									</div>
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
								'class' => $field . ' span9',
								'id' => $field,
								'type' => 'text',
								'value' => $this->input->post($field),
							);
							echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('subject') . ' EN', $field, array('class' => 'control-label')), array($input));
							?>
						</div>
					</div>

					<div class="row">
						<div class="span11">
							<div class="control-group">
								<label for="message_en" class="control-label"><?php echo ucfirst($this->siebel->getLang('message')) ?></label>
								<div class="controls">
									<div>
										<div id="header">
											<p>
												<b><?php echo $this->messenger_model->getMailText('greeting', 'en'); ?></b>
											</p>
										</div>
									</div>
									<div>
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
									<div>
										<div id="footer">
											<hr />
											<table border=0 cellspacing=0 cellpadding=0 width="100%" style="width:100%; border-collapse:collapse;" class="footer">
												<tr>
													<td valign="top" class="leftcolumn"><b><?php echo $this->ion_auth->getUserdata('first_name') . ' ' . $this->ion_auth->getUserdata('last_name'); ?></b></td>
													<td valign="bottom"><b><?php echo $this->messenger_model->getMailText('thanks', 'en'); ?></b> <span style="float:right; font-style: italic; text-align:right;">Think before you <img width=20 height=20 src="http://customer.aliplast.com/vp/public/img/mail_green_print.png" alt="">print</span></td>
												</tr><tr>
													<td valign="top" class="leftcolumn"><img border=0 width=113 height=24 src="http://customer.aliplast.com/vp/public/img/mail_logo_aliplast.jpg" alt="<?php echo param('param_company_name'); ?>" style="margin-top:5px;"></td>
													<td valign="top">
														<?php echo $this->ion_auth->getUserdata('company'); ?> <br/>
														<?php echo param('param_company_address'); ?> - <?php echo param('param_company_location'); ?> <br />
														<a href="mailto:<?php echo $this->ion_auth->getUserdata('email'); ?>">
															M: <?php echo $this->ion_auth->getUserdata('email'); ?>
														</a> - 
														<a href="tel:<?php echo $this->ion_auth->getUserdata('phone'); ?>">
															T: <?php echo $this->ion_auth->getUserdata('phone'); ?>
														</a> - F: <?php echo param('param_company_fax'); ?></td>
												</tr>
											</table>
										</div>										
									</div>
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
					<span class="span5 pull-right"><?php echo $departmentBox; ?></span>
				</div>
			</div>
		</div>
	</div>
</div>

</form>


<div class="row">
	<div class="span12">
		<?php
		if (isset($sended) && !empty($sended)) {
			foreach ($sended as $row) {
				echo '<div class="row"><div class="span12">' . $row . '</div></div>';
			}
		}
		?>
	</div>
</div>