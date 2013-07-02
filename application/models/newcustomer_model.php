<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class newcustomer_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function getContacts($customerId) {
		$dbContact = $this->load->database('contact', TRUE);
		$dbContact->where(param('param_asw_database_column_contact_customerid'), $customerId);
		$return = $dbContact->get(param('param_asw_database_table_contact'))->result();
		
		return $return;
	}
	
	public function save($post, $customerNo)
	{
		// First delete all the contacts in the database for this current customer number
		$dbContact = $this->load->database('contact', TRUE);
		$dbContact->where(param('param_asw_database_column_contact_customernumber'), $customerNo);
		if($dbContact->delete(param('param_asw_database_table_contact'), array(param('param_asw_database_column_contact_customernumber') => $customerNo)))
		{
			// Insert each new contact
			foreach($post as $contact)
			{
				$this->load->model('contact_model');
				$contact['REIDNO'] = $this->contact_model->newId();
				$contact['RESTATE'] = '1';
				$dbContact->insert(param('param_asw_database_table_contact'), $contact);
			}
			
			// Check each contact if the types are all set
			$check = $this->checkNewContactTypes($post);
			$firstContactId = $this->firstContact($customerNo)->REIDNO;
			$dbContact->where(param('param_asw_database_column_contact_id'), $firstContactId);
			$dbContact->update(param('param_asw_database_table_contact'), $check);
			
			return TRUE;
		};
	}
	
	/*
	 * If a new contact (customer) enterd its contacts, this function will check which types are set and which aren't.
	 */
	public function checkNewContactTypes($contacts) {
		// Basic values
		$columns = array(
			'RETGEN' => 0,
			'RETBIL' => 0,
			'RETORD' => 0,
			'RETPUR' => 0,
			'RETRAN' => 0,
			'RETPAC' => 0,
			'RETQUA' => 0,
		);

		// Check for each contact if the value is set to 1 or not.
		// If is set to 1, then change the basic value to 1.
		foreach ($contacts as $contact) {
			$keys = array('RETGEN', 'RETBIL', 'RETORD', 'RETPUR', 'RETRAN', 'RETPAC', 'RETQUA');
			foreach ($keys as $key) {
				if ($contact[$key] == 1) {
					$columns[$key] = 1;
				}
			}
		}

		// Unset the values which are 0
		foreach ($columns as $key => $value) {
			if ($value == 1) {
				unset($columns[$key]);
			}
		}

		// Reverse values
		foreach ($columns as $key => $value) {
			$columns[$key] = 1;
		}

		return $columns;
	}

	public function firstContact($customerNo) {
		$dbContact = $this->load->database('contact', TRUE);
		$dbContact->where(param('param_asw_database_column_contact_customernumber'), $customerNo);
		$dbContact->where(param('param_asw_database_column_contact_general'), 1);
		$dbContact->order_by(param('param_asw_database_column_contact_id'), 'asc');
		$return = $dbContact->get(param('param_asw_database_table_contact'))->result();

		if (empty($return)) {
			$dbContact->where(param('param_asw_database_column_contact_customernumber'), $customerNo);
			$dbContact->order_by(param('param_asw_database_column_contact_id'), 'asc');
			$return = $dbContact->get(param('param_asw_database_table_contact'))->result();
		}

		return $return[0];
	}

}

/* End of file */
/* Location: ./application/models/domain_model.php */