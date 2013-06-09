<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class holidays_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function get($cuno, $id = FALSE) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('customernumber', $cuno);
		if($id)
		{
			$dbDefault->where('id', $id);
		}
		$dbDefault->order_by('from', 'desc');
		$results = $dbDefault->get('holidays')->result();
		return $results;
	}
	
	public function save($cuno, $id) 
	{
		$dbDefault = $this->load->database('default', TRUE);
		
		$data = $_POST;
		$data['from'] = $this->siebel->date_to_mysql_human($data['from']);
		$data['until'] = $this->siebel->date_to_mysql_human($data['until']);
		
		if($id == 'new')
		{
			$data['customernumber'] = $cuno;
			if($dbDefault->insert('holidays', $data))
			{
				return $dbDefault->insert_id();
			}
		}
		else
		{
			$dbDefault->where('id', $id);
			if($dbDefault->update('holidays', $data))
			{
				return $id;
			}

		}
	}
	
	public function delete($id)
	{
		$dbDefault = $this->load->database('default', TRUE);
		if($dbDefault->delete('holidays', array('id' => $id)))
		{
			return TRUE;
		};
		
	}
}

/* End of file */