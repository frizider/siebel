<?php
class comments extends widget {
    
    function run() {
        //$this->loadModel();
		$data['title'] = ucfirst($this->siebel->getLang('comments'));
		$data['customernumber'] = $this->uri->segment(3);
		$this->load->model('comments_model');
		$data['comments_content'] = $this->comments_model->getComments($data['customernumber'], $_GET['dataId']);
		$this->render($data);
    }
    
    
} 
?>
