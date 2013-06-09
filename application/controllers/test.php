<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
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
		//$this->load->model('measurements_model');
	}
	
	public function index() 
	{
		/*
		$dbDefault = $this->load->database('default', TRUE);
		$dummy = $dbDefault->get('deliveryterms_dummy')->result();
		$group = $dbDefault->get('customers')->result();
		
		foreach($group as $item)
		//for($i = 0; $i < 100; $i++)
		{
			for($i = 0; $i < rand(0, 5); $i++) {
				
				$data = $dummy[rand(0, (count($dummy)-1))];
				unset($data->id);
				$data->customernumber = $item->customernumber;
				dev($data);
				$dbDefault->insert('deliveryterms', $data);
				
			}
		}
		 * 
		 */
		
		/*
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		// Load the general view
		$data['view'] = 'test';
		$this->load->view('DomainView', $data);
		 * 
		 */
	}
	
	

}

