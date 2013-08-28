<?php
class uploaddiesheet extends widget {
    
    function run() {
		$data['title'] = ucfirst($this->siebel->getLang('uploaddiesheet'));
		$data['customernumber'] = $this->uri->segment(3);
		$this->load->model('diemaintance_model');
		$data['profiles_content'] = $this->diemaintance_model->get($data['customernumber']);
		$this->render($data);
    }
    
    
} 
?>
