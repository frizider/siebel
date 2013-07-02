<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class diamond extends CI_Controller {
	
	private $module;
	private $customernumber;
	private $id;

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->module = get_class();
		$this->customernumber = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';
		$this->id = ($this->uri->segment(4)) ? $this->uri->segment(4) : '';
		
		// Check if the current logged in user is permitted
		/*
		if(!is_permitted('View overview')) {
			redirect('auth/login', 'refresh');
		};
		 */
		
	}
	
	public function index()
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		// Load the general view
		$current_view = $this->uri->segment(2);
		$data['view'] = 'diamond/'.$current_view;
		$this->load->view('DomainView', $data);
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	
}

/* End of file */
/* Location: ./application/controllers/diamond.php */