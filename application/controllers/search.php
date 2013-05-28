<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search extends CI_Controller {
	
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
		$this->load->model('search_model');
	}
	
	public function index() 
	{
		$term = strtolower(utf8_decode($_GET['term']));
		$customer = $this->search_model->getCustomer($term);
		
		echo json_encode( $customer );
		
	}
	
}

