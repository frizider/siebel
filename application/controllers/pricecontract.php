<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pricecontract extends CI_Controller {
	
	public function __construct()
	{
		// load Controller constructor
		parent::__construct();
		
		// Check if the current logged in user is permitted
		/*
		if(!is_permitted('View overview')) {
			redirect('auth/login', 'refresh');
		};
		 */
		
		// load the model we will be using
		$this->load->model('pricecontract_model');
	}
	
	public function index() 
	{
		redirect(base_url());
	}
	
	public function customer() {
		$data['form_attributes'] = array('class' => 'form-horizontal');
		$customernumber = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		
		// Load the general view
		$data['view'] = 'pricecontract/index';
		$this->load->view('DomainView', $data);
		
	}
	
	

}

