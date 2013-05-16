<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Typeahead extends CI_Controller {
	
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
		redirect(site_url(), 'refresh');
	}
	
	public function customers()
	{
		$name = strtolower(utf8_decode($_GET['term']));
		$connection = odbc_connect(param('param_asw_database_host'), param('param_asw_database_username'), param('param_asw_database_password')) or die('Connection failed!');
		$sql = "SELECT ".param('param_asw_database_column_customernumber').", ".param('param_asw_database_column_customerinternalname')." 
			FROM ".param('param_asw_database_database').".".param('param_asw_database_table_customer')." 
			WHERE (LOWER(".param('param_asw_database_column_customerinternalname').") Like '%".$name."%') 
			AND (".param('param_asw_database_column_customernumber')." Like '".param('param_asw_database_column_customernumber_prefix')."%') 
			AND (".param('param_asw_database_column_customer_state')." != '".param('param_asw_database_column_customer_state_active')."')";
		$results = odbc_exec($connection, $sql);
		while($r = odbc_fetch_array($results)) {
			$rows[] = array(
				"label" => trim(utf8_encode($r[param('param_asw_database_column_customerinternalname')])), 
				"value" => trim(utf8_encode($r[param('param_asw_database_column_customernumber')]))
				);
		};
		echo json_encode($rows);		
	}
	
}

