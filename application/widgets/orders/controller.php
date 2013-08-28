<?php
class orders extends widget {
    
    function run() {
		$data['title'] = ucfirst($this->siebel->getLang('orders'));
		$data['customernumber'] = $this->uri->segment(3);
		$this->load->model('tonnagelist_model');

		$today = date('Ymd', now());
		
		$array = array(
			'customernumber' => $data['customernumber'],
			'from' => $today
		);
		$customerOrders = $this->tonnagelist_model->getTonnages($array, FALSE);
		unset($array['customernumber']);
		$globalOrders = $this->tonnagelist_model->getTonnages($array, FALSE);
		
		$data['orders'] = array(
			'customerOrders' => $customerOrders,
			'globalOrders' => $globalOrders
		);
		
		$this->render($data);
    }
    
    
} 
?>
