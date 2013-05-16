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
	
	public function getLmeByDate($date)
	{
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('date', $date);
		$dbDefault->order_by('date', 'desc');
		$results = $dbDefault->get('lme')->row();
		return $results;
	}
	
}

/* End of file */