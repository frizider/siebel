<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {
	
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
		$this->load->model('dashboard_model');
	}
	
	public function index() 
	{
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		// Load the general view
		$data['view'] = 'dashboard/index';
		$this->load->view('DomainView', $data);
	}
	
	public function customer() 
	{
		$data['containerClassMainnav'] = '-fluid';
		$data['containerClassContent'] = '-fluid';
		$data['customernumber'] = $this->uri->segment(3);
		$data['form_attributes'] = array('class' => 'form-horizontal');
		$data['widgets'] = $this->siebel->getWidgets();
		$data['userDashboard'] = $this->siebel->getUserDashboard();
		$data['pageclass'] = 'bg-graybright';
		
		// Load the general view
		$data['view'] = 'dashboard/index';
		$this->load->view('DomainView', $data);
	}
	
	public function saveUserDashboard()
	{
		if($this->dashboard_model->saveUserDashboard())
		{
			return TRUE;
		}
	}
	
}

