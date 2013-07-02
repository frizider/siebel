<?php
class packaging extends widget {
    
    function run() {
		$data['title'] = ucfirst($this->siebel->getLang('packaging'));
		$data['customernumber'] = $this->uri->segment(3);
		$this->load->model('packaging_model');
		$data['packaging_content'] = $this->packaging_model->get($data['customernumber']);
		$this->render($data);
    }
    
    
} 
?>
