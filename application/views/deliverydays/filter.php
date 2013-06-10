<?php
echo $this->bootstrap->heading(1, $this->siebel->getLang('filter_deliverydays')); 
?>

<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
		?>
		
		<div class="row">
			<div class="span5">

				<div class="well">
					<div class="row">
						<div class="span2"></div>
						<div class="span1"><?php echo ucfirst($this->siebel->getLang('closeday')); ?></div>
						<div class="span1"><?php echo ucfirst($this->siebel->getLang('deliveryday')); ?></div>
					</div>
					<hr class="separator" />
					<?php
					$days = array(
						'monday',
						'tuesday',
						'wednesday',
						'thursday',
						'friday',
						);

					foreach ($days as $day)
					{
					?>
					<div class="row">
						<div class="span2"><?php echo ucfirst($this->siebel->getLang($day)); ?></div>
						<div class="span1"><?php echo $this->bootstrap->checkbox(FALSE, $day.'_close', (isset($_POST[$day.'_close']) && !empty($_POST[$day.'_close'])) ? $_POST[$day.'_close'] : '', array('1' => '')); ?></div>
						<div class="span1"><?php echo $this->bootstrap->checkbox(FALSE, $day.'_delivery', (isset($_POST[$day.'_delivery']) && !empty($_POST[$day.'_delivery'])) ? $_POST[$day.'_delivery'] : '', array('1' => '')); ?></div>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="span7">

				<div class="well">
					<div class="row">
						<div class="span6">
							<?php 
							// Dropdown for languages
							$label = $this->siebel->getLang('country');
							$name = (isset($_POST['country']) && !empty($_POST['country'])) ? $_POST['country'] : $this->siebel->getLang('choose');
							echo $this->bootstrap->dropdown(FALSE, $label, $name, 'country', $countries, FALSE, FALSE, (isset($_POST['country']) && !empty($_POST['country'])) ? $_POST['country'] : '');
							?>
						</div>
					</div>
					<div class="row">
						<div class="span6">
							<?php
							$postcode = array(
								'name' => 'postcode',
								'is' => 'postcode',
								'class' => 'postcode',
								'type' => 'text',
								'value' => (isset($_POST['postcode']) && !empty($_POST['postcode'])) ? $_POST['postcode'] : '',
							);
							echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('postcode'), 'postcode', array('class' => 'control-label')), array($postcode)); 
							?>
						</div>
					</div>
					<div class="row">
						<div class="span6">
							<?php
							$addressname = array(
								'name' => 'addressname',
								'is' => 'addressname',
								'class' => 'addressname',
								'type' => 'text',
								'value' => (isset($_POST['addressname']) && !empty($_POST['addressname'])) ? $_POST['addressname'] : '',
							);
							echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('addressname'), 'addressname', array('class' => 'control-label')), array($addressname)); 
							?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="span7">
						<div class="form-actions">
							<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('save')); ?></button>
							<button type="reset" class="btn">Cancel</button>
						</div>
					</div>
				</div>

			</div>
		</div>
			
		</form>
		
	</div>
</div>

<?php 
if($addresses)
{
	//dev($addresses);
?>
<div class="row">
	
	<div class="span12">
		
			<?= form_open(current_url(), array('class' => 'subnav')); ?>

				<ul class="nav nav-pills">
					<li class="span4"><a><?php echo ucfirst($this->siebel->getLang('name')); ?></a></li>
					<li class="span6"><a><?php echo ucfirst($this->siebel->getLang('address')); ?></a></li>
				</ul>

			</form>
	
	</div> <!-- End span12 -->
	
</div> <!-- end row -->

<div class="container list list-striped">

<?php foreach($addresses as $address) { 
	if(isset($address) && !empty($address))
	{
		$address = $address[0];
		$customernumber = trim($address[param('param_asw_database_column_deliveryaddress_cuno')]);
		$addressSet = '';
		$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_ad1')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_ad1')])).'<br/>';
		$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_ad2')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_ad2')])).'<br/>';
		$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_ad3')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_ad3')])).'<br/>';
		$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_pc')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_pc')])).' ';
		$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_city')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_city')]));	
?>
	<div class="row">
		<div class="span12">
			<div class="row">
				<div class="span4">
					<p><b><?= utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_name')])) ?></b><br /></p>
				</div>
				<div class="span6">
					<p>
						<?php echo $addressSet; ?>
					</p>
				</div>
				<div class="align-right">
					<p>
						<a href="<?php echo site_url('deliverydays/edit/'. $customernumber .'/' .trim($address[param('param_asw_database_column_deliveryaddress_id')])); ?>" class="btn btn-small edit"><i class="icon-pencil"></i> <?php echo $this->siebel->getLang('edit') ?></a>
					</p>
				</div>
			</div>
		</div>
	</div>
			
<?php 
	}
} 
?>
</div>

<?php }	?>
