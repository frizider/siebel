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

class Contact_model extends CI_Model
{
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function customers() 
	{
		// Load customers from ASW database
		$dbAsw = $this->load->database('asw', TRUE);
		
		$customernumber = strtolower($this->input->post('search_customer'));
		if($customernumber) 
		{
			$dbAsw->like('LOWER('.param('param_asw_database_column_customernumber').')', $customernumber);
		}
		$dbAsw->like(param('param_asw_database_column_customernumber'), param('param_asw_database_column_customernumber_prefix'));
		$dbAsw->where(param('param_asw_database_column_customer_state').' !=', param('param_asw_database_column_customer_state_active'));
		$dbAsw->order_by(param('param_asw_database_column_customernumber'), 'desc');
		$dbAsw->limit(20);
		$result = $dbAsw->get(param('param_asw_database_table_customer'))->result_array();

		return $result;
	}
	
	public function contacts($customernumber, $id = false) 
	{
		// Load contact database
		$dbContact = $this->load->database('contact', TRUE);
		
		if(!empty($customernumber))
		{
			$dbContact->where(param('param_asw_database_column_contact_customernumber'), $customernumber);
			
			if(empty($id) || $id == false)
			{
				if(isset($_POST) && !empty($_POST))
				{
					if(isset($_POST['search_customer']) && !empty($_POST['search_customer']))
					{
						$dbContact->like('LOWER('.param('param_asw_database_column_contact_name').')', $_POST['search_customer']);
					}
					if(isset($_POST['search_department']) && !empty($_POST['search_department']))
					{
						$dbContact->where($_POST['search_department'].' !=', '0');
					}
				}
			}

		}
		
		if(!empty($id))
		{
			$dbContact->where(param('param_asw_database_column_contact_id'), $id);
		}
		
		$dbContact->where(param('param_asw_database_column_contact_state').' !=', 99);
		$dbContact->order_by(param('param_asw_database_column_contact_name'), 'desc');
		$result = $dbContact->get(param('param_asw_database_table_contact'))->result_array();
		
		$contacts= array();
		foreach($result as $contact) {
			$departments = array(
				'general' => $this->siebel->getDepartmentLang('department_general', $contact[param('param_asw_database_column_contact_general')]),
				'billing' => $this->siebel->getDepartmentLang('department_billing', $contact[param('param_asw_database_column_contact_billing')]),
				'order' => $this->siebel->getDepartmentLang('department_order', $contact[param('param_asw_database_column_contact_order')]),
				'purchase' => $this->siebel->getDepartmentLang('department_purchase', $contact[param('param_asw_database_column_contact_purchase')]),
				'transport' => $this->siebel->getDepartmentLang('department_transport', $contact[param('param_asw_database_column_contact_transport')]),
				'packing' => $this->siebel->getDepartmentLang('department_packing', $contact[param('param_asw_database_column_contact_packing')]),
				'quality' => $this->siebel->getDepartmentLang('department_quality', $contact[param('param_asw_database_column_contact_quality')]),
			);
			$contact['departments'] = $departments;
			$contacts[] = $contact;
		}
		
		return $contacts;
	}
	
	public function save($data, $id)
	{
		$dbAsw = $this->load->database('asw', TRUE);
		
		if($id == 'new')
		{
			$id = $this->newId();
			$data[param('param_asw_database_column_contact_customerid')] = md5($data[param('param_asw_database_column_contact_customernumber')]);
			$data[param('param_asw_database_column_contact_id')] = $id;
			if($dbAsw->insert(param('param_asw_database_table_contact'), $data))
			{
				return $id;
			};
			
		}
		else
		{
			$dbAsw->where(param('param_asw_database_column_contact_id'), $data[param('param_asw_database_column_contact_id')]);
			if($dbAsw->update(param('param_asw_database_table_contact'), $data))
			{
				return $id;
			};
			
		}
	}
	
	public function saveNew($data)
	{
		$dbContact = $this->load->database('contact', TRUE);
		
		$id = $this->newId();
		$md5 = md5($data['RECUNO']);
		$data['RECUID'] = $md5;
		$data['REIDNO'] = $id;
		$data['RETBIL'] = 0;
		$data['RETORD'] = 0;
		$data['RETPUR'] = 0;
		$data['RETRAN'] = 0;
		$data['RETPAC'] = 0;
		$data['RETQUA'] = 0;
		if($dbContact->insert(param('param_asw_database_table_contact'), $data))
		{
			return $md5;
		};
	}
	
	public function delete($id) {
		$dbContact = $this->load->database('contact', TRUE);
		$dbContact->where(param('param_asw_database_column_contact_id'), $id);
		if($dbContact->update(param('param_asw_database_table_contact'), array(param('param_asw_database_column_contact_state') => 99)))
		{
			return TRUE;
		};
	}
	
	public function unDelete($id) {
		$dbContact = $this->load->database('contact', TRUE);
		$dbContact->where(param('param_asw_database_column_contact_id'), $id);
		if($dbContact->update(param('param_asw_database_table_contact'), array(param('param_asw_database_column_contact_state') => 1)))
		{
			return TRUE;
		};
	}
	
	public function getDepartments($lang = FALSE) {
		$dbDefault = $this->load->database('default', TRUE);
		$departments = $dbDefault->get('departments')->result();

		foreach ($departments as $department) {
			$return[$department->asw_field] = $this->siebel->getLang('department_' . $department->name, $lang);
		}

		return $return;
	}	

	public function getContactypes($name = FALSE) {
		$dbDefault = $this->load->database('default', TRUE);

		if ($name) {
			$dbDefault->where('name', $name);
		}

		$results = $dbDefault->get('contacttypes')->result();
		foreach ($results as $result) {
			$return[$result->name] = $result->description;
		}

		return $return;
	}

	public function newId() {
		$dbAsw = $this->load->database('asw', TRUE);

		$dbAsw->select_max(param('param_asw_database_column_contact_id'));
		$query = $dbAsw->get(param('param_asw_database_table_contact'))->result_array();
		$return = $query[0][param('param_asw_database_column_contact_id')] + 1;

		return $return;
	}
	
	public function getFields() {
		$dbContact = $this->load->database('contact', TRUE);
		$dbContact->limit(1);
		$record = $dbContact->get(param('param_asw_database_table_contact'))->result_array();
		foreach ($record[0] as $key => $value) {
			$fields[] = $key;
		}
		
		return $fields;
	}

}

/* End of file */
/* Location: ./application/models/contact_model.php */