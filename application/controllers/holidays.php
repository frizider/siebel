<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class holidays extends CI_Controller {
	
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
		$this->load->model('holidays_model');
	}
	
	public function index() 
	{
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		// Load the general view
		$data['view'] = 'holidays/index';
		$this->load->view('DomainView', $data);
	}
	
	public function customer() 
	{
		$data['form_attributes'] = array('class' => 'form-horizontal');
		$data['customernumber'] = $this->uri->segment(3);
		$cuno = $data['customernumber'];
		$data['id'] = $this->uri->segment(4);
		$id = $data['id'];
		
		$data['items'] = $this->holidays_model->get($cuno, $id);
		
		if(isset($id) && !empty($id))
		{
			if($id == 'new')
			{
				$data['item'] = $this->siebel->getColumns('holidays');
				$data['item']->from = $this->siebel->date_to_mysql(date('d/m/Y', now()));
				$data['item']->until = $this->siebel->date_to_mysql(date('d/m/Y', now()));
			}
			else 
			{
				$data['item'] = $data['items'][0];
			}
			
			if(isset($_POST) && !empty($_POST))
			{
				if($newId = $this->holidays_model->save($cuno, $id))
				{
					$this->session->set_flashdata('success', 'Holiday saved!');
					redirect(site_url('holidays/customer/'.$cuno.'/'.$newId), 'refresh');
				}
			}
		}
		
		// Load the general view
		$data['view'] = 'holidays/index';
		$this->load->view('DomainView', $data);
		
	}
	
	public function delete()
	{
		$data['customernumber'] = $this->uri->segment(3);
		$data['id'] = $this->uri->segment(4);
		
		if($this->holidays_model->delete($data['id']))
		{
			$this->session->set_flashdata('error', 'Holiday deleted!');
			redirect(site_url('holidays/customer/'.$data['customernumber']), 'refresh');
		}
		
	}


}

