<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Model
*
* Author:  Ben Edmunds
* 		   ben.edmunds@gmail.com
*	  	   @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

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
				$contact['REIDNO'] = $this->siebel->newId();
				$contact['RESTATE'] = '1';
				$dbContact->insert(param('param_asw_database_table_contact'), $contact);
			}
			
			// Check each contact if the types are all set
			$check = $this->siebel->checkNewContactTypes($post);
			$firstContactId = $this->siebel->firstContact($customerNo)->REIDNO;
			$dbContact->where(param('param_asw_database_column_contact_id'), $firstContactId);
			$dbContact->update(param('param_asw_database_table_contact'), $check);
			
			return TRUE;
		};
	}
	
	
	
}

/* End of file */
/* Location: ./application/models/domain_model.php */