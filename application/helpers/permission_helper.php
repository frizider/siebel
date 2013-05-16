<?php

/*
 * Development and design by Jens De Schrijver
 * Permission helper
 */

function is_permitted($permission_name) 
{
	$ci = get_instance();
	if (!$ci->ion_auth->logged_in())
	{
		redirect('auth/login');
	}
	
	if($ci->ion_auth->is_admin()) 
	{
		return TRUE;
		
	} else {
		
		// Get all the groups of the current user
		$user_groups = $ci->ion_auth->get_users_groups()->result_array();
		$user_groups = $user_groups[0]['id'];

		// Get all the groups of the asked permission
		$permission_groups = get_permissions_groups($permission_name);

		// Check is the users group is in the permissions groups
		if(in_array($user_groups, $permission_groups)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
}

function get_permissions_groups($permission_name) 
{
	$permission_id = get_permissions_id($permission_name);
	
	if($permission_id != FALSE) {
		$ci = get_instance();
		$groups =  $ci->db	->select('group_id')
							->where('permissions_id', $permission_id)
							->get('permissions_groups')
							->result_array();

		foreach ($groups as $group) {
			$groups_array[] = $group['group_id'];
		};

	} else {
		$groups_array = array();
	};
	
	return $groups_array;
}

function get_permissions_id($permission_name) 
{
	$ci = get_instance();
	$permission_id =  $ci->db	->select('id')
								->where('name', $permission_name)
								->get('permissions')
								->result_array();
	
	if(empty($permission_id)) {
		return FALSE;
	} else {
		return $permission_id[0]['id'];
	}
}

function get_permissions() 
{
	$ci = get_instance();
	$permission =  $ci->db->get('permissions')->result_array();
	
	return $permission;
}

function group_name($id)
{
	$ci = get_instance();
	$group_name =  $ci->db	->where('id', $id)
							->get('groups')->result_array();
	
	return $group_name[0]['name'];
}

function get_groups()
{
	$ci = get_instance();
	$groups =  $ci->db->get('groups')->result_array();
	
	return $groups;
}

?>
