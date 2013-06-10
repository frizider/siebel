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
		$this->load->model('comments_model');
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
		$data['pageclass'] = 'bg-graybright dashboard';
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		$data['customernumber'] = $this->uri->segment(3);
		
		$widgetsModifications = array(
			'comments__0' => $this->comments_model->getCategoriesAsWidgetsArray()
		);
		
		$data['widgets'] = $this->dashboard_model->getWidgets($widgetsModifications);
		
		$data['userDashboard'] = $this->dashboard_model->getUserDashboard();
		
		
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