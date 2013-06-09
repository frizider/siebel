<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deliveryterms extends CI_Controller {
	
	public function __construct()
	{
		// load Controller constructor
		parent::__construct();
		
		// Check if the current logged in user is permitted
		/*
		if(!is_permitted('View overview')) {
			redirect('auth/login', 'refresh');
		};
		 */
		
		// load the model we will be using
		$this->load->model('deliveryterms_model');
	}
	
	public function index() 
	{
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		// Load the general view
		$data['view'] = 'deliveryterms/index';
		$this->load->view('DomainView', $data);
	}

	public function customer() 
	{
		$data['customernumber'] = $this->uri->segment(3);
		$cuno = $data['customernumber'];
		$data['id'] = $this->uri->segment(4);
		$id = $data['id'];
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		$data['terms'] = $this->deliveryterms_model->getTerms($cuno, $id);
		
		if(isset($id) && !empty($id))
		{
			if($id == 'new')
			{
				$data['term'] = (object) array(
					'id' => 'new',
					'customernumber' => '',
					'term' => '',
					'comment' => '',
					'date' => '',
				);
			}
			else 
			{
				$data['term'] = $data['terms'][0];
			}
			
			if(isset($_POST) && !empty($_POST))
			{
				if($newId = $this->deliveryterms_model->saveTerms($cuno, $id))
				{
					$this->session->set_flashdata('success', 'Comment saved!');
					redirect(site_url('deliveryterms/customer/'.$cuno.'/'.$newId), 'refresh');
				}
			}
			
		}
		
		// Load the general view
		$data['view'] = 'deliveryterms/index';
		$this->load->view('DomainView', $data);
	}

}

