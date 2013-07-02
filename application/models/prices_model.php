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
	
	public function getPrices($cuno, $id = FALSE, $search = FALSE) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('customernumber', $cuno);
		if($id)
		{
			$dbDefault->where('id', $id);
		}
		
		// Search
		if($search) {
			
			if(!empty($search['search_price'])) {
				$dbDefault->like('price', $search['search_price']);
			}
			if(!empty($search['search_priceunit'])) {
				$dbDefault->where('priceunit_id', $search['search_priceunit']);
			}
			if(!empty($search['search_profile'])) {
				$dbDefault->like('profile', $search['search_profile']);
			}
			if(!empty($search['search_finish'])) {
				$dbDefault->like('finish', $search['search_finish']);
			}
			if(!empty($search['search_length'])) {
				$dbDefault->like('length', $search['search_length']);
			}
			
		}
		
		$dbDefault->order_by('date', 'desc');
		$results = $dbDefault->get('prices')->result();
		
		foreach($results as $result) {
			if(isset($result->priceunit_id) && !empty($result->priceunit_id)) {
				$result->priceunit = $this->getPriceUnit($result->priceunit_id)->short;
			}
		}
		
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
	
	public function getPriceUnit($id) {
		if(isset($id) && !empty($id)) {
			$dbDefault = $this->load->database('default', TRUE);
			$dbDefault->where('id', $id);
			$result = $dbDefault->get('priceunits')->result();
			return $result[0];
		}
	}

	public function getDropdownValues($table, $key = 'id', $value = 'short') {
		$dbDefault = $this->load->database('default', TRUE);
		$results = $dbDefault->get($table)->result();
		foreach ($results as $result) {
			$group[$result->$key] = $result->$value;
		}
		return $group;
	}

}

/* End of file */