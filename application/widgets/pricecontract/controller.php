<?php
class pricecontract extends widget {
    
    function run() {
        //$this->loadModel();
		$data['title'] = ucfirst($this->siebel->getLang('pricecontract'));
		$data['customernumber'] = $this->uri->segment(3);
		$this->load->model('domain_model');
		$this->load->model('pricecontract_model');
		$data['pricecontracts_content'] = $this->pricecontract_model->addSalesOrders($this->domain_model->get($data['customernumber'], FALSE, array("table"=>"pricecontract", "db"=>"default")));
		$this->render($data);
    }
    
    
} 
?>
