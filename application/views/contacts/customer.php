<?php 
$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));
$customerLang = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customerlang')));
echo $this->bootstrap->heading(1, $this->siebel->getLang('contactslist'), utf8_encode($customerName).' | '.$customernumber.' | '.$customerLang, '<a class="backbutton" title="Go back" href="'.site_url('contacts/').'"><span><i class="icon-chevron-left"></i></span></a> '); 

if(empty($contacts))
{
	
	// View a empty state page with a startup form is the customer has no contacts yet.
?>
	
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="empty-state">
				<div class="empty-img"></div>
				<div class="empty-txt">
					<h3><?php echo $this->siebel->getLang('empty_heading_contacts'); ?></h3>
					<p><?php echo $this->siebel->getLang('empty_text_contacts'); ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<?php 
			echo form_open(current_url(), array('class' => 'well')); 
			echo form_input(array(
				'name' => 'newcontact',
				'class' => 'newcontact',
				'type' => 'hidden',
				'value' => 1,
			));
			echo form_input(array(
				'name' => 'RECUNO',
				'class' => 'RECUNO',
				'type' => 'hidden',
				'value' => $customernumber,
			));
			echo form_input(array(
				'name' => 'RETGEN',
				'class' => 'RETGEN',
				'type' => 'hidden',
				'value' => 1,
			));
			?>
			
				
			<div class="row">
				<div class="span3 offset2">
					<label for="RENAM1"><b><?php echo ucfirst($this->siebel->getLang('name')) ?></b></label>
					<?php 
						echo form_input(array(
							'name' => 'RENAM1',
							'class' => 'RENAM1',
							'type' => 'text',
							'value' => '',
						));
					?>
				</div>
				<div class="span3">
					<label for="REEMAIL"><b><?php echo ucfirst($this->siebel->getLang('email')) ?></b></label>
					<?php 
						echo form_input(array(
							'name' => 'REEMAIL',
							'class' => 'REEMAIL',
							'type' => 'text',
							'value' => '',
						));
					?>
				</div>
				<div class="">
					<label><b>&nbsp;</b></label>
					<input class="btn btn-primary span2 submit" type="submit" value="<?php echo $this->siebel->getLang('send'); ?>" />
				</div>
			</div>
				
			</form>
		</div>
	</div>
</div>

<?php
}
else 
{
	// Else view a page with a list of the contacts.
?>

<div class="row">
	
	<div class="span12">
		
			<?= form_open(current_url(), array('class' => 'subnav')); ?>

				<ul class="nav nav-pills">
					
					<li class="span2">
						<p><input name="search_customer" class="span2" placeholder="Klant..."></p>
					</li>
					
					<li class="span4">
						<a href="#">Email</a>
					</li>
					
					<li class="span2">
						<a href="#">Phone / Fax</a>
					</li>
					
					<?php
					$department = (isset($_POST['search_department']) && !empty($_POST['search_department'])) ? $_POST['search_department'] : '';
					echo $this->bootstrap->dropdown(TRUE, FALSE, $this->siebel->getLang('department'), 'search_department', $this->siebel->getDepartments(), 'span2', FALSE, $department);
					?>
					
					<li class="span2 align-right">
						<p>
							<span class="btn btn-small btn-primary search submit"><i class="icon-search icon-white"></i> <?php echo $this->siebel->getLang('search') ?></span>
							<span class="btn btn-small create href" data-href="<?php echo current_url() ?>/new"><i class="icon-plus"></i> <?php //echo $this->siebel->getLang('create') ?></span>
						</p>
					</li>
					
				</ul>

			</form>
	
	</div> <!-- End span12 -->
	
</div> <!-- end row -->
	
<?php	
	foreach($contacts as $contact) { 
?>
<div class="container list list-striped">
	<div class="row">
		<div class="span12">
			<div class="row">
				<div class="span2">
					<p><b><?= trim($contact[param('param_asw_database_column_contact_name')]) ?></b> <br/></p>
				</div>
				<div class="span4">
					<p><b><i class="icon-envelope"></i> <a href="mailto:<?= trim($contact[param('param_asw_database_column_contact_email')]) ?>"><?= trim($contact[param('param_asw_database_column_contact_email')]) ?></a></b> <br/></p>
				</div>
				<div class="span2">
					<p>
						<b>T: <?= trim($contact[param('param_asw_database_column_contact_phone')]) ?></b><br/>
						<b>F: <?= trim($contact[param('param_asw_database_column_contact_fax')]) ?></b>
					</p>
				</div>
				<div class="span2">
					<p><ul><?php 
						/* echo utf8_encode($contact[param('param_asw_database_column_contact_general')]) */ 
						$departments = $this->siebel->listDepartments($contact);
						
						foreach($departments as $department)
						{
							if(!empty($department))
							{
								echo '<li>'.ucfirst(utf8_encode($department)).'</li>';
							}
						}
						
					?></ul> <br/></p>
				</div>
				<div class="span2 align-right">
					<p>
						<a href="<?php echo site_url("contacts/customer/".$customernumber.'/'.trim($contact[param('param_asw_database_column_contact_id')])); ?>" class="btn btn-small edit"><i class="icon-pencil"></i> <?php echo $this->siebel->getLang('edit') ?></a>
						<a href="#delete" data-href="<?php echo site_url("contacts/delete/".$customernumber.'/'.trim($contact[param('param_asw_database_column_contact_id')])); ?>" class="btn btn-small btn-danger delete"><i class="icon-remove icon-white"></i></a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
			
<?php 
	}; // End foreach

}; // End if else
?>
