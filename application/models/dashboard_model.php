<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function get() {
		return 'Hello Test!';
	}
	
	public function saveUserDashboard()
	{
		$sort = $this->input->post('sort');
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $this->siebel->getUserdata('id'));
		if($dbDefault->update('users', array('userDashboard' => $sort)))
		{
			return TRUE;
		}
	}
	
}

/* End of file */