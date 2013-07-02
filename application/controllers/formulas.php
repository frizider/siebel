<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formulas extends CI_Controller {
	
	private $module;
	private $customernumber;
	private $id;
	
	public function __construct()
	{
		// load Controller constructor
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
		
		// load the model we will be using
		$this->load->model('formulas_model');
	}
	
	public function index() 
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		$data['id'] = $this->uri->segment(2);
		$id = $data['id'];
		
		$data['items'] = $this->formulas_model->get($id);
		
		if(isset($id) && !empty($id))
		{
			if($id == 'new')
			{
				$data['item'] = (object) array(
					'formulaname' => '',
					'formula' => '',
				);
			}
			else
			{
				$data['item'] = $data['items'][0];
			}
			if(isset($_POST) && !empty($_POST))
			{
				if($newId = $this->formulas_model->save($id))
				{
					$this->session->set_flashdata('success', 'Successful saved!');
					redirect(site_url('formulas/'.$newId), 'refresh');
				}
			}
		}
		
		// Load the general view
		$data['view'] = 'formulas/index';
		$this->load->view('DomainView', $data);
	}

}

