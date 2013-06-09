<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messenger_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function getContacts($department = FALSE) {
		$dbContact = $this->load->database('contact', TRUE);
		if($department)
		{
			$dbContact->where($department, 1);
		}
		$dbContact->where(param('param_asw_database_column_contact_state').' != ', 99);
		$contacts = $dbContact->get(param('param_asw_database_table_contact'))->result_array();
		
		foreach($contacts as $contact)
		{
			$contact['RELANG'] = $this->siebel->getCustomerdata(trim($contact['RECUNO']), param('param_asw_database_column_customerlang'));
			$contactlist[] = $contact;
		}
		
		return $contactlist;
	}
	
}

/* End of file */