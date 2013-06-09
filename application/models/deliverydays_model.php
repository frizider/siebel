<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deliverydays_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function getDeliveryAddresses($customernumber, $id = FALSE) 
	{
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where('UPPER ('.param('param_asw_database_column_deliveryaddress_cuno').') = ', strtoupper($customernumber));
		
		if($id)
		{
			$dbAsw->where(param('param_asw_database_column_deliveryaddress_id'), $id);
		}
		
		return $dbAsw->get(param('param_asw_database_table_deliveryaddress'))->result_array();
	}
	
	public function getDeliveryDay($customernumber, $address_id)
	{
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('customernumber', $customernumber);
		$dbDefault->where('address_id', $address_id);
		$query = $dbDefault->get('deliverydays');
		$rows = $query->num_rows();
		
		if($rows > 0)
		{
			$result = $query->result_array();
			return $result[0];
		}
		else
		{
			return $this->deliveryDaysFields();
		}
	}
	
	public function deliveryDaysFields()
	{
		$dbDefault = $this->load->database('default', TRUE);
		$fields = $dbDefault->list_fields('deliverydays');
		foreach($fields as $key => $value)
		{
			$fieldset[$value] = FALSE;
		}
		return $fieldset;
	}
	
	public function save($customernumber, $address_id, $data)
	{
		$data['customernumber'] = $customernumber;
		$data['address_id'] = $address_id;
		
		$dbDefault = $this->load->database('default', TRUE);
		
		if($this->deliveryDayExists($customernumber, $address_id))
		{
			$dbDefault->where('customernumber', $customernumber);
			$dbDefault->where('address_id', $address_id);
			if($dbDefault->update('deliverydays', $data))
			{
				return TRUE;
			}
		}
		else
		{
			if($dbDefault->insert('deliverydays', $data))
			{
				return TRUE;
			}
		}
	}
	
	public function deliveryDayExists($customernumber, $address_id)
	{
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('customernumber', $customernumber);
		$dbDefault->where('address_id', $address_id);
		$query = $dbDefault->get('deliverydays');
		$rows = $query->num_rows();
		
		if($rows > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function getFilter()
	{
		$monday_close = $this->input->post('monday_close');
		$tuesday_close = $this->input->post('tuesday_close');
		$wednesday_close = $this->input->post('wednesday_close');
		$thursday_close = $this->input->post('thursday_close');
		$friday_close = $this->input->post('friday_close');
		$monday_delivery = $this->input->post('monday_delivery');
		$tuesday_delivery = $this->input->post('tuesday_delivery');
		$wednesday_delivery = $this->input->post('wednesday_delivery');
		$thursday_delivery = $this->input->post('thursday_delivery');
		$friday_delivery = $this->input->post('friday_delivery');
		$country = $this->input->post('country');
		$postcode = $this->input->post('postcode');
		$addressname = $this->input->post('addressname');
		
		$deliverydays = $this->getFilterDeliveryDays($monday_close, $tuesday_close, $wednesday_close, $thursday_close, $friday_close, $monday_delivery, $tuesday_delivery, $wednesday_delivery, $thursday_delivery, $friday_delivery);
		foreach($deliverydays as $deliveryday)
		{
			$addresses[] = $this->getFilterAsw($deliveryday, $country, $postcode, $addressname);
		}
		return $addresses;
	}
	
	public function getFilterDeliveryDays($monday_close, $tuesday_close, $wednesday_close, $thursday_close, $friday_close, $monday_delivery, $tuesday_delivery, $wednesday_delivery, $thursday_delivery, $friday_delivery)
	{
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->select('customernumber, address_id');
		if($monday_close) {$dbDefault->where('monday_close', 1);}
		if($tuesday_close) {$dbDefault->where('tuesday_close', 1);}
		if($wednesday_close) {$dbDefault->where('wednesday_close', 1);}
		if($thursday_close) {$dbDefault->where('thursday_close', 1);}
		if($friday_close) {$dbDefault->where('friday_close', 1);}
		
		if($monday_delivery) {$dbDefault->where('monday_delivery', 1);}
		if($tuesday_delivery) {$dbDefault->where('tuesday_delivery', 1);}
		if($wednesday_delivery) {$dbDefault->where('wednesday_delivery', 1);}
		if($thursday_delivery) {$dbDefault->where('thursday_delivery', 1);}
		if($friday_delivery) {$dbDefault->where('friday_delivery', 1);}
		
		return $dbDefault->get('deliverydays')->result_array();
	}
	
	public function getFilterAsw($deliveryday, $country, $postcode, $addressname)
	{
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->like('LOWER ('.param('param_asw_database_column_deliveryaddress_cuno').') ', strtolower($deliveryday['customernumber']));
		$dbAsw->like(param('param_asw_database_column_deliveryaddress_id'), $deliveryday['address_id']);
		if($country) {$dbAsw->like('LOWER ('.param('param_asw_database_column_deliveryaddress_country').') ', strtolower($country));}
		if($postcode) {$dbAsw->like('LOWER ('.param('param_asw_database_column_deliveryaddress_pc').') ', strtolower($postcode));}
		if($addressname) {$dbAsw->like('LOWER ('.param('param_asw_database_column_deliveryaddress_name').') ', strtolower($addressname));}
		return $dbAsw->get(param('param_asw_database_table_deliveryaddress'))->result_array();
	}
	
}

/* End of file */
/* Location: ./application/models/deliverydays_model.php */