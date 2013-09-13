<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class holidays extends CI_Controller {
	
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
		$this->load->model('holidays_model');
	}
	
	public function index() 
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		// Load the general view
		$data['view'] = 'holidays/index';
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
		
		$data['items'] = $this->holidays_model->get($cuno, $id);
		
		if(isset($id) && !empty($id))
		{
			if($id == 'new')
			{
				$data['item'] = $this->holidays_model->getColumns();
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
	
	public function delete($customernumber, $id) {
		$this->customernumber = $customernumber;
		$this->id = $id;
		
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
		
		if($this->holidays_model->delete($id))
		{
			$this->session->set_flashdata('message', $this->siebel->getLang('success_contactdelete'). ' <a class="btn btn-small" href="'.site_url($this->module.'/undelete/'.$this->customernumber.'/'.$this->id).'"><i class="icon-undo"></i> '.$this->siebel->getLang('undo').'</a>');
			redirect(site_url($this->module.'/customer/'.$this->customernumber), 'refresh');
		}
	}
	
	public function undelete($customernumber, $id) {
		$this->customernumber = $customernumber;
		$this->id = $id;
		
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
		
		
		if($this->holidays_model->undelete($id))
		{
			$this->session->set_flashdata('success', $this->siebel->getLang('success_contactrecover'));
			redirect(site_url($this->module.'/customer/'.$this->customernumber), 'refresh');
		}
	}

	public function toExcel() {
		if(isset($_POST) && !empty($_POST)) {
			$this->holidays_model->toExcel();
		}
		
		// Load the general view
		$data['view'] = 'holidays/filter';
		$this->load->view('DomainView', $data);
		
	}
	
}

