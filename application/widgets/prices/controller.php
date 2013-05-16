<?php
class prices extends widget {
    
    function run() {
        //$this->loadModel();
		$data['title'] = ucfirst($this->siebel->getLang('prices'));
		$data['customernumber'] = $this->uri->segment(3);
		$this->load->model('prices_model');
		$data['prices_content'] = $this->prices_model->getPrices($data['customernumber'], FALSE);
		$this->render($data);
    }
    
    
} 
?>
