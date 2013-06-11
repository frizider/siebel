<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pricecontract_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function getTest() {
		return 'Hello Test!';
	}
	
}

/* End of file */