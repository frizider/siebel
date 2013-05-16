<?php
class deliverydays extends widget {
    
    function run() {
        //$this->loadModel();
		$data['title'] = ucfirst($this->siebel->getLang('deliverydays').' &amp; '.$this->siebel->getLang('businesshours'));
		$data['customernumber'] = $this->uri->segment(3);
		$this->load->model('deliverydays_model');
		$data['addresses'] = $this->deliverydays_model->getDeliveryAddresses($data['customernumber']);
		$data['days'] = array('monday','tuesday','wednesday','thursday','friday');

		for ($i = 0; $i < count($data['addresses']); $i++)
		{
			$address = $data['addresses'][$i];
			$addressSet = '<b>'.utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_name')])).'</b><br />';
			$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_ad1')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_ad1')])).' ';
			$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_ad2')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_ad2')])).' ';
			$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_ad3')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_ad3')])).' - ';
			$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_pc')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_pc')])).' ';
			$addressSet .= (trim($address[param('param_asw_database_column_deliveryaddress_city')]) == '') ? '' : utf8_encode(trim($address[param('param_asw_database_column_deliveryaddress_city')]));
					
			$data['deliverydays'][$i] = $this->deliverydays_model->getDeliveryDay($data['customernumber'], trim($address[param('param_asw_database_column_deliveryaddress_id')]));			
			$data['deliverydays'][$i]['address_id'] = trim($address[param('param_asw_database_column_deliveryaddress_id')]);
			$data['deliverydays'][$i]['addressSet'] = $addressSet;
		}
		
		$this->render($data);
    }
    
    
} 
?>
