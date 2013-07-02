<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diemaintance_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function get($customernumber) {
		/*
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_dm_customernumber'), $customernumber);
		$results = $dbAsw->get(param('param_asw_database_table_diemaintance'))->result_array();
		return $results;
		 * 
		 */
		$dies = $this->getUniqueDies($customernumber);
		$return = $this->getLastDieVersion($dies);
		return $return;
	}
	
	public function getUniqueDies($customernumber) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->select(param('param_asw_database_column_dm_number'));
		$dbAsw->where(param('param_asw_database_column_dm_customernumber'), $customernumber);
		$dbAsw->order_by(param('param_asw_database_column_dm_number'), 'asc');
		$results = $dbAsw->get(param('param_asw_database_table_diemaintance'))->result_array();
		
		foreach($results as $result) {
			$array[] = $result[param('param_asw_database_column_dm_number')];
		}
		
		$array = array_unique($array);
		
		return $array;
		
	}
	
	public function getLastDieVersion($dies) {
		foreach($dies as $die) {
			$dbAsw = $this->load->database('asw', TRUE);
			$dbAsw->where(param('param_asw_database_column_dm_number'), $die);
			$dbAsw->order_by(param('param_asw_database_column_dm_version'), 'desc');
			$results = $dbAsw->get(param('param_asw_database_table_diemaintance'))->result_array();
			
			$array[] = $results[0];
		}
		return $array;
	}
	
}

/* End of file */