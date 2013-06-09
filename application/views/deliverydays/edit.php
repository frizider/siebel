<?php

//dev($deliverydatdata);

$addressSet = '';
$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_ad1')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_ad1')])).'<br/>';
$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_ad2')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_ad2')])).'<br/>';
$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_ad3')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_ad3')])).'<br/>';
$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_pc')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_pc')])).' ';
$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_city')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_city')]));	


$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));
echo $this->bootstrap->heading(1, $this->siebel->getLang('edit_deliverydays'), $customerName. ' | '. $customernumber, '<a class="backbutton" title="Go back" href="'.site_url('dashboard/customer/'.$customernumber).'"><span><i class="icon-chevron-left"></i></span></a> '); 
?>
<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
		?>
		
		<div class="well">
			<div class="row">
				<div class="span4">
					<b><?php echo utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_name')])); ?></b>
				</div>
				<div class="span6"><?php echo $addressSet; ?>
				</div>
			</div>
		</div>
		
		<div class="well">
			<div class="row">
				<div class="span2"></div>
				<div class="span3"><?php echo ucfirst($this->siebel->getLang('businesshours')) . ' ' . $this->siebel->getLang('morning'); ?></div>
				<div class="span3"><?php echo ucfirst($this->siebel->getLang('businesshours')) . ' ' . $this->siebel->getLang('afternoon'); ?></div>
				<div class="span1"><?php echo ucfirst($this->siebel->getLang('closeday')); ?></div>
				<div class="span1"><?php echo ucfirst($this->siebel->getLang('deliveryday')); ?></div>
			</div>
			<div class="row">
				<div class="span2"></div>
				<div class="span1"><?php echo $this->siebel->getLang('from'); ?></div>
				<div class="span2"><?php echo $this->siebel->getLang('to'); ?></div>
				<div class="span1"><?php echo $this->siebel->getLang('from'); ?></div>
				<div class="span2"><?php echo $this->siebel->getLang('to'); ?></div>
				<div class="span1"></div>
				<div class="span1"></div>
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
				$copyvalues = ($day == 'monday') ? '<a class="copyvalues" href="#"><i class="icon-chevron-down"></i></a>' : '';
			?>
			<div class="row">
				<div class="span2"><?php echo $copyvalues . ucfirst($this->siebel->getLang($day)); ?></div>
				<div class="span1">
					<?php
					// Set AM
					$values = $this->siebel->hourSet('am');
					$name = (isset($deliverydatdata[$day.'_am_from']['value']) && !empty($deliverydatdata[$day.'_am_from']['value'])) ? $deliverydatdata[$day.'_am_from']['value'] : $this->siebel->getLang('choose');
					echo $this->bootstrap->dropdown(FALSE, FALSE, $name, $day.'_am_from', $values, FALSE, FALSE, $deliverydatdata[$day.'_am_from']['value'], TRUE);
					?>
				</div>
				<div class="span2">
					<?php
					// Set AM
					$values = $this->siebel->hourSet('am');
					$name = (isset($deliverydatdata[$day.'_am_to']['value']) && !empty($deliverydatdata[$day.'_am_to']['value'])) ? $deliverydatdata[$day.'_am_to']['value'] : $this->siebel->getLang('choose');
					echo $this->bootstrap->dropdown(FALSE, FALSE, $name, $day.'_am_to', $values, FALSE, FALSE, $deliverydatdata[$day.'_am_to']['value'], TRUE);
					?>
				</div>
				<div class="span1">
					<?php
					// Set PM
					$values = $this->siebel->hourSet('pm');
					$name = (isset($deliverydatdata[$day.'_pm_from']['value']) && !empty($deliverydatdata[$day.'_pm_from']['value'])) ? $deliverydatdata[$day.'_pm_from']['value'] : $this->siebel->getLang('choose');
					echo $this->bootstrap->dropdown(FALSE, FALSE, $name, $day.'_pm_from', $values, FALSE, FALSE, $deliverydatdata[$day.'_pm_from']['value'], TRUE);
					?>
				</div>
				<div class="span2">
					<?php
					// Set PM
					$values = $this->siebel->hourSet('pm');
					$name = (isset($deliverydatdata[$day.'_pm_to']['value']) && !empty($deliverydatdata[$day.'_pm_to']['value'])) ? $deliverydatdata[$day.'_pm_to']['value'] : $this->siebel->getLang('choose');
					echo $this->bootstrap->dropdown(FALSE, FALSE, $name, $day.'_pm_to', $values, FALSE, FALSE, $deliverydatdata[$day.'_pm_to']['value'], TRUE);
					?>
				</div>
				<div class="span1"><?php echo $this->bootstrap->checkbox(FALSE, $day.'_close', $deliverydatdata[$day.'_close']['value'], array('1' => '')); ?></div>
				<div class="span1"><?php echo $this->bootstrap->checkbox(FALSE, $day.'_delivery', $deliverydatdata[$day.'_delivery']['value'], array('1' => '')); ?></div>
			</div>
			<?php } ?>
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
		
	</div>
</div>

<script type="text/javascript">

$(document).ready(function() {
	$(document).delegate('.copyvalues', 'click', function(e) {
		e.preventDefault();
		var am_from = $('input.monday_am_from').val();
		var am_to = $('input.monday_am_to').val();
		var pm_from = $('input.monday_pm_from').val();
		var pm_to = $('input.monday_pm_to').val();
		
		$.each(['tuesday','wednesday','thursday','friday'], function(i, day) {
			$('input.'+day+'_am_from').val(am_from);
			$('a.'+day+'_am_from span').text(am_from);
			$('input.'+day+'_am_to').val(am_to);
			$('a.'+day+'_am_to span').text(am_to);
			$('input.'+day+'_pm_from').val(pm_from);
			$('a.'+day+'_pm_from span').text(pm_from);
			$('input.'+day+'_pm_to').val(pm_to);
			$('a.'+day+'_pm_to span').text(pm_to);
		})
	})
})

</script>
