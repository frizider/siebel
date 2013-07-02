<?php
class deliveryterms extends widget {
    
    function run() {
        //$this->loadModel();
		$data['title'] = ucfirst($this->siebel->getLang('deliveryterms'));
		$data['customernumber'] = $this->uri->segment(3);
		$this->load->model('deliveryterms_model');
		$data['deliveryterms_content'] = $this->deliveryterms_model->getTerms($data['customernumber']);
		$this->render($data);
    }
    
    
} 
?>
