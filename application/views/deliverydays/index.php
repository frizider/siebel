<?php

//dev($addresses);
$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));
echo $this->bootstrap->heading(1, $this->siebel->getLang('deliverydays'), $customerName. ' | '. $customernumber, '<a class="backbutton" title="Go back" href="'.site_url('dashboard/customer/'.$customernumber).'"><span><i class="icon-chevron-left"></i></span></a> '); 
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
			
<?php } ?>
</div>
