<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricecontract_model extends CI_Model
{
	private $table = 'pricecontract';
	private $dbDefault;

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->dbDefault = $this->load->database('default', TRUE);
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function get($cuno, $id = FALSE) {
		$this->dbDefault->where('customernumber', $cuno);
		if($id)
		{
			$this->dbDefault->where('id', $id);
		}
		$this->dbDefault->order_by('startdate', 'desc');
		$results = $this->dbDefault->get($this->table)->result();
		return $results;
	}
	
	public function save($cuno, $id) 
	{
		$data = $_POST;
		$data['from'] = $this->siebel->date_to_mysql_human($data['from']);
		$data['until'] = $this->siebel->date_to_mysql_human($data['until']);
		
		if($id == 'new')
		{
			$data['customernumber'] = $cuno;
			if($this->dbDefault->insert($this->table, $data))
			{
				return $this->dbDefault->insert_id();
			}
		}
		else
		{
			$this->dbDefault->where('id', $id);
			if($this->dbDefault->update($this->table, $data))
			{
				return $id;
			}

		}
	}
	
	public function delete($id)
	{
		if($this->dbDefault->delete($this->table, array('id' => $id)))
		{
			return TRUE;
		};
		
	}
	
	public function getColumns() {

		foreach ($this->dbDefault->list_fields($this->table) as $key => $value) {
			$return->$value = '';
		}

		return $return;
	}
	
}

/* End of file */