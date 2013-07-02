<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class packaging_model extends CI_Model
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
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_packing_customernumber'), $customernumber);
		$dbAsw->order_by(param('param_asw_database_packing_profile'), 'asc');
		$results = $dbAsw->get(param('param_asw_database_packing'))->result_array();
		
		return $results;
	}
	
}

/* End of file */