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

class Permissions_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * create_permission
	 *
	 * @author aditya menon
	*/
	public function create_permission($permission_name = FALSE, $permission_description = NULL, $groups = NULL)
	{
		// bail if the permission name was not passed
		if(!$permission_name)
		{
			return FALSE;
		}

		// bail if the permission name already exists
		$existing_permission = $this->db->get_where('permissions', array('name' => $permission_name))->row();
		if(!empty($existing_permission))
		{
			return FALSE;
		}
		
		// insert the new permission
		$this->db->insert('permissions', array('name' => $permission_name, 'description' => $permission_description));
		$permission_id = $this->db->insert_id();
		
		foreach ($groups as $group) {
			$this->db->insert('permissions_groups', array('permissions_id' => $permission_id, 'group_id' => $group));
		}

		// return the brand new permission id
		return $permission_id;
	}

	/**
	 * update_permission
	 *
	 * @return bool
	 * @author aditya menon
	 **/
	public function update_permission($permission_id = FALSE, $permission_name = FALSE, $permission_description = NULL, $groups = NULL)
	{
		$dbDefault = $this->load->database('default', TRUE);
		$mandatory = array($permission_id, $permission_name);

		// bail if no permission id or name given
		foreach ($mandatory as $mandatory_param) {		
			if(!$mandatory_param || empty($mandatory_param))
			{
				return FALSE;
			}
		}
		
		$existing_permission = $dbDefault->get_where('permissions', array('name' => $permission_name))->row();
		if(isset($existing_permission->id) && $existing_permission->id != $permission_id)
		{
			return FALSE;
		}

		$query_data = array(
			'name' => $permission_name,
			'description' => $permission_description,
		);

		$dbDefault->update('permissions', $query_data, array('id' => $permission_id));
		
		// Reset permissions-groups
		$dbDefault->delete('permissions_groups', array('permissions_id' => $permission_id));
		foreach ($groups as $group) {
			$dbDefault->insert('permissions_groups', array('permissions_id' => $permission_id, 'group_id' => $group));
		};
		

		return TRUE;
	}

}
