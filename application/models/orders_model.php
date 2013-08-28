<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function getOrders($customer = FALSE) {
		$dbAsw = $this->load->database('asw', TRUE);
		if($customer) {
			$dbAsw->where(param('param_asw_database_column_soh_customernumber'), $customer);
		}
		
		$today = date('Ymd', now());
		$today = '20130717';
		$dbAsw->where(param('param_asw_database_column_soh_date'), $today);
		
		$salesorders = $dbAsw->get(param('param_asw_database_table_salesorderheader'))->result_array();
		
		return $salesorders;
	}
	
}

/* End of file */