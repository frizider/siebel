<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
		
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
		$this->load->model('test_model');
	}
	
	public function index() {
		
	}
	
}

