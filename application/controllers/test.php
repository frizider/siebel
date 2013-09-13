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
		//$this->load->model('test_model');
	}
	
	public function index() {

		/*
		$config['param_asw_database_table_diemaintance'] = 'Z2OODIEVRS';
			$config['param_asw_database_column_dm_number'] = 'MVPRDC';
			$config['param_asw_database_column_dm_reference'] = 'DIEITEM';
			$config['param_asw_database_column_dm_version'] = 'MVBATC';
			$config['param_asw_database_column_dm_customernumber'] = 'DIECUNO';
			$config['param_asw_database_column_dm_tensile'] = 'TENSILE';
			$config['param_asw_database_column_dm_measurement_report'] = 'MESURREP';
			$config['param_asw_database_column_dm_weight'] = 'MVWGHT';
			$config['param_asw_database_column_dm_perimeter'] = 'MVPERI';
			$config['param_asw_database_column_dm_press'] = 'MVPERS';
			$config['param_asw_database_column_dm_alloy'] = 'ALLOYCOND';
			$config['param_asw_database_column_dm_sample'] = 'SAMPLES';
			$config['param_asw_database_column_dm_sample_comment'] = 'SAMPLERE';
			$config['param_asw_database_column_dm_invoice'] = 'INVOICE';
			$config['param_asw_database_column_dm_invoice_amount'] = 'INVAMOU';
			$config['param_asw_database_column_dm_representative'] = 'SALESMAN';
		 */

		
		$db = $this->load->database('asw', TRUE);
		/*
		$db->where(param('param_asw_database_column_dm_customernumber'), 'MB'.'1443');
		$data = array(
			//param('param_asw_database_column_dm_customernumber') => 'MB1974',
			param('param_asw_database_column_dm_tensile') => 'N',
			param('param_asw_database_column_dm_measurement_report') => 'N',
		);
		dev($db->update(param('param_asw_database_table_diemaintance'), $data));
		 * 
		 */
	}
	
}

