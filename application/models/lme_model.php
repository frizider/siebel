<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lme_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function getLme($id = FALSE) {
		$dbDefault = $this->load->database('default', TRUE);
		if($id)
		{
			$dbDefault->where('id', $id);
		}
		$dbDefault->order_by('date', 'desc');
		$results = $dbDefault->get('lme')->result();
		return $results;
	}
	
	public function save($id) 
	{
		$dbDefault = $this->load->database('default', TRUE);
		
		$data = $_POST;
		$data['date'] = $this->siebel->date_to_mysql_human($data['date']);
		
		if($id == 'new')
		{
			if($dbDefault->insert('lme', $data))
			{
				return $dbDefault->insert_id();
			}
		}
		else
		{
			$dbDefault->where('id', $id);
			if($dbDefault->update('lme', $data))
			{
				return $id;
			}

		}
	}
	
	public function getLmeByDate($date)
	{
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('date', $date);
		$dbDefault->order_by('date', 'desc');
		$results = $dbDefault->get('lme')->row();
		return $results;
	}
	
	public function getColumns() {
		$dbDefault = $this->load->database('default', TRUE);

		foreach ($dbDefault->list_fields('lme') as $key => $value) {
			$return->$value = '';
		}

		return $return;
	}
	
}

/* End of file */