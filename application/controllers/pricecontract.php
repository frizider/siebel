<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricecontract extends CI_Controller {
	
	private $module;
	private $customernumber;
	private $id;
	
	public function __construct()
	{
		// load Controller constructor
		parent::__construct();
		$this->module = $this->uri->segment(1);
		$this->customernumber = $this->uri->segment(3);
		$this->id = $this->uri->segment(4);
		
		// Check if the current logged in user is permitted
		/*
		if(!is_permitted('View overview')) {
			redirect('auth/login', 'refresh');
		};
		 */
		
		// load the model we will be using
		//$this->load->model('pricecontract_model');
		$this->load->model('domain_model', 'model');
	}
	
	public function index() 
	{
		redirect(base_url());
	}
	
	public function customer() {
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		if(isset($this->id) && !empty($this->id)) {
			if($this->id == 'new')
			{
				$data['item'] = $this->model->getColumns();
				$data['item']->startdate = $this->siebel->date_to_mysql(date('d/m/Y', now()));
				$data['item']->enddate = $this->siebel->date_to_mysql(date('d/m/Y', now()));
			}
			else 
			{
				$data['item'] = $this->model->get($this->customernumber, $this->id)->row();
				dev($data['item']);
			}
			
			// Create fields sets for input fields in view
			//$data['fields'] = $this->model->createFields($data['item'], $extra = array());

			if(isset($_POST) && !empty($_POST)) {
				
				$saveData = $_POST;
				$saveData['date'] = $this->siebel->date_to_mysql_human($saveData['date']);
				$saveData['startdate'] = $this->siebel->date_to_mysql_human($saveData['startdate']);
				$saveData['enddate'] = $this->siebel->date_to_mysql_human($saveData['enddate']);
				$saveData['customernumber'] = $this->customernumber;
				
				if($newId = $this->model->save($this->customernumber, $this->id, $saveData)) {
					$this->session->set_flashdata('success', 'Contract saved!');
					redirect(site_url($this->module.'/customer/'.$cuno.'/'.$newId), 'refresh');
				}
			}
		} else {
			$data['items'] = $this->model->get($this->customernumber, $this->id);
		}
		
		// Load the general view
		$data['view'] = 'pricecontract/index';
		$this->load->view('DomainView', $data);
		
	}
	
	public function delete()
	{
		$this->module = $this->uri->segment(1);
		$this->customernumber = $this->uri->segment(4);
		$this->id = $this->uri->segment(4);
		if($this->model->delete($this->id))
		{
			$this->session->set_flashdata('error', 'Holiday deleted!');
			redirect(site_url($this->module.'/customer/'.$this->customernumber), 'refresh');
		}
	}
	
}

