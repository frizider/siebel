<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {
	
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
		$this->load->model('dashboard_model');
		$this->load->model('comments_model');
	}
	
	public function index() 
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		// Load the general view
		$data['view'] = 'dashboard/index';
		$this->load->view('DomainView', $data);
	}
	
	public function customer() 
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['containerClassMainnav'] = '-fluid';
		$data['containerClassContent'] = '-fluid';
		$data['pageclass'] = 'bg-graybright dashboard';
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		$customerData = $this->siebel->getCustomerdata($this->customernumber);
		$representative = param('param_asw_database_column_customer_representative');
		$representative = $customerData->$representative;
		$customer_service = param('param_asw_database_column_customer_service');
		$customer_service = $customerData->$customer_service;
		$data['heading_small_extra'] = ' | '.$representative.' | '.$customer_service;
		
		$data['customernumber'] = $this->customernumber;
		
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