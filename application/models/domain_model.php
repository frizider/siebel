<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domain_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function demo() {
		$this->db->where('deleted', 0);
		$this->db->order_by("ID", "desc");
		$this->db->limit(20);
		return $this->db->get('sheets')->result_object();
	}
	
	
	
}

/* End of file */
/* Location: ./application/models/domain_model.php */