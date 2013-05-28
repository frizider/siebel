<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function getCustomer($term) {
		
		$dbAsw = $this->load->database('asw', TRUE);
		
		$dbAsw->like('LOWER('.param('param_asw_database_column_customerinternalname').')',
				$term);
		
		$dbAsw->like(param('param_asw_database_column_customernumber'), 
				param('param_asw_database_column_customernumber_prefix'));
		
		$dbAsw->not_like(param('param_asw_database_column_customer_state'), 
				param('param_asw_database_column_customer_state_active'));
		
		$results = $dbAsw->get(param('param_asw_database_table_customer'))->result_array();
		
		foreach($results as $r)
		{
			$address = (trim(utf8_encode($r[param('param_asw_database_column_customer_adress1')])) == "") ? "" : trim(utf8_encode($r[param('param_asw_database_column_customer_adress1')]))."\n";
			$address .= (trim(utf8_encode($r[param('param_asw_database_column_customer_adress2')])) == "") ? "" : trim(utf8_encode($r[param('param_asw_database_column_customer_adress2')]))."\n";
			$address .= (trim(utf8_encode($r[param('param_asw_database_column_customer_adress3')])) == "") ? "" : trim(utf8_encode($r[param('param_asw_database_column_customer_adress3')]))."\n";
			$address .= (trim(utf8_encode($r[param('param_asw_database_column_customer_postalcode')])) == "") ? "" : trim(utf8_encode($r[param('param_asw_database_column_customer_postalcode')]))." ";
			$address .= (trim(utf8_encode($r[param('param_asw_database_column_customer_city')])) == "") ? "" : trim(utf8_encode($r[param('param_asw_database_column_customer_city')]));
			
			$rows[] = array(
				"label" => trim(utf8_encode($r[param('param_asw_database_column_customerinternalname')])), 
				"value" => trim(utf8_encode($r[param('param_asw_database_column_customernumber')])),
				"address" => $address
				);
		}
		
		return $rows;
	}
	
}

/* End of file */