<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formulas_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function get($id = FALSE) {
		$dbDefault = $this->load->database('default', TRUE);
		
		if($id)
		{
			$dbDefault->where('id', $id);
		}

		return $dbDefault->get('formulas')->result();
	}
	
	public function save($id) 
	{
		$dbDefault = $this->load->database('default', TRUE);
		
		unset($_POST['arithmetic']);
		unset($_POST['lme']);
		
		$data = $_POST;
		if($id == 'new')
		{
			if($dbDefault->insert('formulas', $data))
			{
				return $dbDefault->insert_id();
			}
		}
		else
		{
			$dbDefault->where('id', $id);
			if($dbDefault->update('formulas', $data))
			{
				return $id;
			}

		}
	}
	
}

/* End of file */