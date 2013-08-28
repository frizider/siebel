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
		$this->customernumber = '';
		$this->id = '';
		
		// Check if the current logged in user is permitted
		/*
		if(!is_permitted('View overview')) {
			redirect('auth/login', 'refresh');
		};
		 */
		
		// load the model we will be using
		$this->load->model('formulas_model');
	}
	
	public function index($id = false) 
	{
		$data['id'] = $id;
		$data['customernumber'] = '';
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		
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
				$data['copy'] = $this->uri->segment(4);
				$copy = $data['copy'];
				if($newId = $this->formulas_model->save($id, $copy))
				{
					$this->session->set_flashdata('success', 'Successful saved!');
					redirect(site_url('formulas/index/'.$newId), 'refresh');
				}
			}
		}
		
		// Load the general view
		$data['view'] = 'formulas/index';
		$this->load->view('DomainView', $data);
	}

	public function delete($id) {
		$this->id = $id;
		
		$data['id'] = $this->id;
		$data['module'] = $this->module;
		
		if($this->formulas_model->delete($id))
		{
			$this->session->set_flashdata('message', $this->siebel->getLang('success_contactdelete'). ' <a class="btn btn-small" href="'.site_url($this->module.'/undelete/'.$id).'"><i class="icon-undo"></i> '.$this->siebel->getLang('undo').'</a>');
			redirect(site_url($this->module), 'refresh');
		}
	}
	
	public function undelete($id) {
		$this->id = $id;
		
		$data['id'] = $this->id;
		$data['module'] = $this->module;
		
		
		if($this->formulas_model->undelete($id))
		{
			$this->session->set_flashdata('success', $this->siebel->getLang('success_contactrecover'));
			redirect(site_url($this->module), 'refresh');
		}
	}
}

