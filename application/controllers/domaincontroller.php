<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class domaincontroller extends CI_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		
		// Check if the current logged in user is permitted
		/*
		if(!is_permitted('View overview')) {
			redirect('auth/login', 'refresh');
		};
		 */
		
	}
	
	public function index()
	{
		$data['lists'] = $this->domain_model->demo();
		
		// Load the general view
		$data['view'] = 'MainView';
		$this->load->view('DomainView', $data);
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	
	
}

/* End of file */
/* Location: ./application/controllers/DomainController.php */