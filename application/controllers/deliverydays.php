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

		// Hourset
		$data['hoursAm'] = array(
			'00:00' => '00:00', '00:15' => '00:15', '00:30' => '00:30', '00:45' => '00:45',
			'01:00' => '01:00', '01:15' => '01:15', '01:30' => '01:30', '01:45' => '01:45',
			'02:00' => '02:00', '02:15' => '02:15', '02:30' => '02:30', '02:45' => '02:45',
			'03:00' => '03:00', '03:15' => '03:15', '03:30' => '03:30', '03:45' => '03:45',
			'04:00' => '04:00', '04:15' => '04:15', '04:30' => '04:30', '04:45' => '04:45',
			'05:00' => '05:00', '05:15' => '05:15', '05:30' => '05:30', '05:45' => '05:45',
			'06:00' => '06:00', '06:15' => '06:15', '06:30' => '06:30', '06:45' => '06:45',
			'07:00' => '07:00', '07:15' => '07:15', '07:30' => '07:30', '07:45' => '07:45',
			'08:00' => '08:00', '08:15' => '08:15', '08:30' => '08:30', '08:45' => '08:45',
			'09:00' => '09:00', '09:15' => '09:15', '09:30' => '09:30', '09:45' => '09:45',
			'10:00' => '10:00', '10:15' => '10:15', '10:30' => '10:30', '10:45' => '10:45',
			'11:00' => '11:00', '11:15' => '11:15', '11:30' => '11:30', '11:45' => '11:45',
			'12:00' => '12:00', '12:15' => '12:15', '12:30' => '12:30', '12:45' => '12:45',
			'13:00' => '13:00'
		);
		$data['hoursPm'] = array(
			'11:00' => '11:00', '11:15' => '11:15', '11:30' => '11:30', '11:45' => '11:45',
			'12:00' => '12:00', '12:15' => '12:15', '12:30' => '12:30', '12:45' => '12:45',
			'13:00' => '13:00', '13:15' => '13:15', '13:30' => '13:30', '13:45' => '13:45',
			'14:00' => '14:00', '14:15' => '14:15', '14:30' => '14:30', '14:45' => '14:45',
			'15:00' => '15:00', '15:15' => '15:15', '15:30' => '15:30', '15:45' => '15:45',
			'16:00' => '16:00', '16:15' => '16:15', '16:30' => '16:30', '16:45' => '16:45',
			'17:00' => '17:00', '17:15' => '17:15', '17:30' => '17:30', '17:45' => '17:45',
			'18:00' => '18:00', '18:15' => '18:15', '18:30' => '18:30', '18:45' => '18:45',
			'19:00' => '19:00', '19:15' => '19:15', '19:30' => '19:30', '19:45' => '19:45',
			'20:00' => '20:00', '20:15' => '20:15', '20:30' => '20:30', '20:45' => '20:45',
			'21:00' => '21:00', '21:15' => '21:15', '21:30' => '21:30', '21:45' => '21:45',
			'22:00' => '22:00', '22:15' => '22:15', '22:30' => '22:30', '22:45' => '22:45',
			'23:00' => '23:00', '23:15' => '23:15', '23:30' => '23:30', '23:45' => '23:45',
			'23:59' => '23:59'
		);
			
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
		
		$data['countries'] = $this->deliverydays_model->getDeliveryCountries();
		
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

