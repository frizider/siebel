<?php
class contacts extends widget {
    
    function run() {
        //$this->loadModel();
		$data['title'] = ucfirst($this->siebel->getLang('contacts'));
		$data['customernumber'] = $this->uri->segment(3);
		$this->load->model('contact_model');
		$data['contacts_content'] = $this->contact_model->contacts($data['customernumber'], FALSE);
		$this->render($data);
    }
    
    
} 
?>
