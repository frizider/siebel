<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tonnagelist extends CI_Controller {
		
	private $module;
	private $customernumber;
	private $id;

	public function __construct()
	{
		// load Controller constructor
		parent::__construct();
		$this->module = get_class();
		$this->customernumber = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';
		$this->id = ($this->uri->segment(4)) ? $this->uri->segment(4) : '';
		
		// Check if the current logged in user is permitted
		/*
		if(!is_permitted('View overview')) {
			redirect('auth/login', 'refresh');
		};
		 */
		
		// load the model we will be using
		$this->load->model('tonnagelist_model');
	}
	
	public function index() 
	{
		/*
		 * Todo
		 * prijs laten zien
		 */
		
		$data['module'] = $this->module;
		$data['customernumber'] = $this->customernumber;
		$data['id'] = $this->id;
		
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		if(isset($_POST) && !empty($_POST)) {
			
			$this->tonnagelist_model->getTonnages($_POST);
			
		}
		
		
		// Load the general view
		$data['view'] = 'tonnagelist/index';
		$this->load->view('DomainView', $data);
	}
	
}

