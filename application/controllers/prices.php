<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prices extends CI_Controller {
	
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
		$this->load->model('prices_model');
	}
	
	public function index() 
	{
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		// Load the general view
		$data['view'] = 'prices/index';
		$this->load->view('DomainView', $data);
	}

	
	public function customer() 
	{
		$data['form_attributes'] = array('class' => 'form-horizontal');
		$data['customernumber'] = $this->uri->segment(3);
		$cuno = $data['customernumber'];
		$data['id'] = $this->uri->segment(4);
		$id = $data['id'];
		$data['copy'] = $this->uri->segment(5);
		$copy = $data['copy'];
		
		$data['prices'] = $this->prices_model->getPrices($cuno, $id);
		
		if(isset($id) && !empty($id))
		{
			$data['dropdown_formulas'] = $this->prices_model->getDropdownValues('formulas', 'id', 'formulaname');
			$data['dropdown_priceunits'] = $this->prices_model->getDropdownValues('priceunits');
			
			if($id == 'new')
			{
				$data['price'] = $this->siebel->getColumns('prices');
				$data['price']->date = $this->siebel->date_to_mysql(date('d/m/Y', now()));
			}
			else 
			{
				$data['price'] = $data['prices'][0];
			}
			
			if(isset($_POST) && !empty($_POST))
			{
				if($newId = $this->prices_model->save($cuno, $id, $copy))
				{
					$this->session->set_flashdata('success', 'Price saved!');
					redirect(site_url('prices/customer/'.$cuno.'/'.$newId), 'refresh');
				}
			}
		}
		
		// Load the general view
		$data['view'] = 'prices/index';
		$this->load->view('DomainView', $data);
		
	}
	
	public function delete()
	{
		$data['customernumber'] = $this->uri->segment(3);
		$data['id'] = $this->uri->segment(4);
		
		if($this->prices_model->delete($data['id']))
		{
			$this->session->set_flashdata('error', 'Price deleted!');
			redirect(site_url('prices/customer/'.$data['customernumber']), 'refresh');
		}
		
	}

}

