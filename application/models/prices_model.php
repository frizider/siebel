<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prices_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function getPrices($cuno, $id = FALSE) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('customernumber', $cuno);
		if($id)
		{
			$dbDefault->where('id', $id);
		}
		$dbDefault->order_by('date', 'desc');
		$results = $dbDefault->get('prices')->result();
		return $results;
	}
	
	public function save($cuno, $id, $copy) 
	{
		$dbDefault = $this->load->database('default', TRUE);
		
		$data = $_POST;
		$data['price'] = round($this->siebel->math($this->siebel->formula_to_plain($data['formula_data'], 0)), 2);
		$data['date'] = $this->siebel->date_to_mysql_human($data['date']);
		
		if($copy)
		{
			$id = 'new';
		}
		
		if($id == 'new')
		{
			$data['formula_string'] = $this->siebel->getFormula($data['formula_id'])->formula;
			$data['customernumber'] = $cuno;
			if($dbDefault->insert('prices', $data))
			{
				return $dbDefault->insert_id();
			}
		}
		else
		{
			$dbDefault->where('id', $id);
			if($dbDefault->update('prices', $data))
			{
				return $id;
			}

		}
	}
	
	public function delete($id)
	{
		$dbDefault = $this->load->database('default', TRUE);
		if($dbDefault->delete('prices', array('id' => $id)))
		{
			return TRUE;
		};
		
	}
	
}

/* End of file */