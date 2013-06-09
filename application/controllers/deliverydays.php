<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deliverydays extends CI_Controller {
	
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
		$this->load->model('deliverydays_model');
	}
	
	public function index() 
	{
		redirect(site_url(), 'refresh');
	}

	public function customer() 
	{
		$customernumber = strtoupper($this->uri->segment(3));
		$data['customernumber'] = $customernumber;
		if(!isset($customernumber) || empty($customernumber))
		{
			redirect(site_url(), 'refresh');
		}
		
		$data['form_attributes'] = array('class' => 'form-horizontal');
		$data['addresses'] = $this->deliverydays_model->getDeliveryAddresses($customernumber);
		
		// Load the general view
		$data['view'] = 'deliverydays/index';
		$this->load->view('DomainView', $data);
	}

	public function edit() 
	{
		$customernumber = strtoupper($this->uri->segment(3));
		$data['customernumber'] = $customernumber;
		$address_id = strtoupper($this->uri->segment(4));
		$data['address_id'] = $address_id;
		if(!isset($customernumber) || empty($customernumber) || !isset($address_id) || empty($address_id))
		{
			redirect(site_url(), 'refresh');
		}
		
		$data['form_attributes'] = array('class' => 'form-horizontal');
		$data['deliveryday'] = $this->deliverydays_model->getDeliveryDay($customernumber, $address_id);
		$data['address'] = $this->deliverydays_model->getDeliveryAddresses($customernumber, $address_id);
		$data['address'] = $data['address'][0];
		$address = $data['address'];
		$deliveryday = $data['deliveryday'];
		
		if(isset($_POST) && !empty($_POST))
		{
			if($this->deliverydays_model->save($customernumber, $address_id, $_POST))
			{
				//redirect them back to the admin page
				$this->session->set_flashdata('success', $this->siebel->getLang('success_deliverydayssaved'));
				redirect(site_url('deliverydays/edit/'.$customernumber.'/'.$address_id), 'refresh');
			}

		}
		else 
		{
			$fields = $this->deliverydays_model->deliveryDaysFields();
			foreach($fields as $key => $value)
			{
				$data['deliverydatdata'][$key] = array(
					'name'  => $key,
					'id'    => $key,
					'class'    => $key,
					'type'  => 'text',
					'value' => $deliveryday[$key],
				);
			}
		}
		
		// Load the general view
		$data['view'] = 'deliverydays/edit';
		$this->load->view('DomainView', $data);
	}
	
	public function filter()
	{
		$data['form_attributes'] = array('class' => 'form-horizontal');
		if(isset($_POST) && !empty($_POST))
		{
			$data['addresses'] = $this->deliverydays_model->getFilter();
		}
		else 
		{
			$data['addresses'] = FALSE;
		}
		
		// Load the general view
		$data['view'] = 'deliverydays/filter';
		$this->load->view('DomainView', $data);
	}

}

