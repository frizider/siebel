<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prices extends CI_Controller {
	
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
		$this->load->model('prices_model');
	}
	
	public function index() 
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		// Load the general view
		$data['view'] = 'prices/index';
		$this->load->view('DomainView', $data);
	}

	
	public function customer() 
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		$data['customernumber'] = $this->uri->segment(3);
		$cuno = $data['customernumber'];
		$data['id'] = $this->uri->segment(4);
		$id = $data['id'];
		$data['copy'] = $this->uri->segment(5);
		$copy = $data['copy'];
		
		$data['dropdown_priceunits'] = $this->prices_model->getDropdownValues('priceunits');
		
		if(isset($id) && !empty($id))
		{
			$data['dropdown_formulas'] = $this->prices_model->getDropdownValues('formulas', 'id', 'formulaname');
			
			if($id == 'new')
			{
				$data['price'] = $this->siebel->getColumns('prices');
				$data['price']->date = $this->siebel->date_to_mysql(date('d/m/Y', now()));
			}
			else 
			{
				$data['prices'] = $this->prices_model->getPrices($cuno, $id);
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
			
		} else {
			
			if(isset($_POST) && !empty($_POST)) {
				$data['search_priceunit_name'] = (isset($_POST['search_priceunit']) && !empty($_POST['search_priceunit'])) ? $this->prices_model->getPriceUnit($_POST['search_priceunit'])->short : '';
				$search = $_POST;
			} else{
				$search = FALSE;
			}
			
			$data['prices'] = $this->prices_model->getPrices($cuno, $id, $search);
			
		}
		
		// Load the general view
		$data['view'] = 'prices/index';
		$this->load->view('DomainView', $data);
		
	}
	
	public function delete()
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['customernumber'] = $this->uri->segment(3);
		$data['id'] = $this->uri->segment(4);
		
		if($this->prices_model->delete($data['id']))
		{
			$this->session->set_flashdata('error', 'Price deleted!');
			redirect(site_url('prices/customer/'.$data['customernumber']), 'refresh');
		}
		
	}

}

