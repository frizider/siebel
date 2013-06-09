<?php
class holidays extends widget {
    
    function run() {
        //$this->loadModel();
		$data['title'] = ucfirst($this->siebel->getLang('holidays'));
		$data['customernumber'] = $this->uri->segment(3);
		$this->load->model('holidays_model');
		$data['holidays_content'] = $this->holidays_model->get($data['customernumber']);
		$this->render($data);
    }
    
    
} 
?>
