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
		//$this->load->model('measurements_model');
	}
	
	public function index() 
	{
		$dbAsw = $this->load->database('asw', TRUE);
		
		/*
		$dbAsw->where(param('param_asw_database_column_soh_customernumber'), 'MB9032');
		$results = $dbAsw->get(param('param_asw_database_table_salesorderheader'))->result_array();
		 * 
		 */
		
		$dbAsw->where(param('param_asw_database_column_soh_salesordernumber'), '801131');
		$data = array(param('param_asw_database_column_soh_contractnumber') => '0000000003');
		$dbAsw->update(param('param_asw_database_table_salesorderheader'), $data);
	
		
		//dev($results);
		
		
		
		// Load the general view
		//$data['view'] = 'test';
		//$this->load->view('DomainView', $data);
	}
	
	

}

