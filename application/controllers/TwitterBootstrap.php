<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TwitterBootstrap extends CI_Controller {

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
		// Load the general view
		$current_view = $this->uri->segment(2);
		$data['view'] = 'twitterbootstrap/'.$current_view;
		$this->load->view('DomainView', $data);
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	
}

/* End of file */
/* Location: ./application/controllers/TwitterBootstrap.php */