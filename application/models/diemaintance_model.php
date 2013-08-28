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
	
	public function get($customernumber, $only = false) {
		/*
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_dm_customernumber'), $customernumber);
		$results = $dbAsw->get(param('param_asw_database_table_diemaintance'))->result_array();
		return $results;
		 * 
		 */
		$customernumber = explode('MB', $customernumber);
		$customernumber = $customernumber[1];
		
		$dies = $this->getUniqueDies($customernumber);
		$return = '';
		if(!empty($dies)) {
			$results = $this->getLastDieVersion($dies);
		}
		
		// Filter if only tensile or meaurement report
		if($only) {
			
			foreach ($results as $result) {
				$tensile = $result[param('param_asw_database_column_dm_tensile')];
				$measurement = $result[param('param_asw_database_column_dm_measurement_report')];
				
				if( $tensile == 'Y' || $tensile == '1' ) {
					$return[] = $result;
				}
				elseif( $measurement == 'Y' || $measurement == '1' ) {
					$return[] = $result;
				}
				
			}
			
		} else {
			$return = $results;
		}
		
		return $return;
	}
	
	public function getUniqueDies($customernumber) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->select(param('param_asw_database_column_dm_number'));
		$dbAsw->like(param('param_asw_database_column_dm_customernumber'), $customernumber);
		$dbAsw->order_by(param('param_asw_database_column_dm_number'), 'asc');
		$results = $dbAsw->get(param('param_asw_database_table_diemaintance'))->result_array();
		$array = array();
		
		if(!empty($results)) {
			foreach($results as $result) {
				$array[] = $result[param('param_asw_database_column_dm_number')];
			}
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
	
	public function saveDieSheet($dienumber, $saveData) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_dm_number'), strtoupper($dienumber));
		if($dbAsw->update(param('param_asw_database_table_diemaintance'), $saveData)) {
			return TRUE;
		}
	}
}

/* End of file */