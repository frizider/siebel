<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deliveryterms extends CI_Controller {
	
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
		$this->load->model('deliveryterms_model');
	}
	
	public function index() 
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		// Load the general view
		$data['view'] = 'deliveryterms/index';
		$this->load->view('DomainView', $data);
	}

	public function customer() 
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

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

	public function delete($customernumber, $id) {
		$this->customernumber = $customernumber;
		$this->id = $id;
		
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
		
		if($this->deliveryterms_model->delete($id))
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
		
		
		if($this->deliveryterms_model->undelete($id))
		{
			$this->session->set_flashdata('success', $this->siebel->getLang('success_contactrecover'));
			redirect(site_url($this->module.'/customer/'.$this->customernumber), 'refresh');
		}
	}
	
	public function toExcel() {
		$this->deliveryterms_model->toExcel();
	}
}

