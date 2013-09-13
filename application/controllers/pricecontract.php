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
		$this->load->model('pricecontract_model');
		$this->load->model('prices_model');
		$this->load->model('domain_model', 'model');
	}
	
	public function index() 
	{
		redirect(base_url());
	}
	
	public function customer() {
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		$data['module'] = $this->module;
		$data['customernumber'] = $this->customernumber;
		$data['id'] = $this->id;
		
		if(isset($this->id) && !empty($this->id)) {
			if(isset($_POST) && !empty($_POST)) {
				
				$saveData = $_POST;
				$priceDate = $saveData['startdate'];
				$saveData['date'] = $this->siebel->date_to_mysql_human($saveData['date']);
				$saveData['startdate'] = $this->siebel->date_to_mysql_human($saveData['startdate']);
				$saveData['enddate'] = $this->siebel->date_to_mysql_human($saveData['enddate']);
				$saveData['customernumber'] = $this->customernumber;
				
				$saveDataMultiCust = $saveData['multiCust'];
				unset($saveData['multiCust']);
				
				$copy = $this->uri->segment(5);
				
				if($newId = $this->model->save($this->id, $saveData, array("copy"=>$copy)) ) {
					$this->id = $newId;
					if($this->pricecontract_model->saveMultiCust($saveDataMultiCust, $newId, $this->customernumber)) {
						$saveData['startdate'] = $priceDate;
						if($newPriceId = $this->pricecontract_model->savePrice($saveData, $this->customernumber, $newId)) {
							if($this->prices_model->saveMultiCust($saveDataMultiCust, $newPriceId, $this->customernumber)) {
								$this->session->set_flashdata('success', 'Contract saved!');
								redirect(site_url($this->module.'/customer/'.$this->customernumber.'/'.$newId), 'refresh');
							}
						}
					}
				}
				
			}
			
			$this->load->library('ckeditor');
			$this->ckeditor->basePath = base_url().'assets/ckeditor/';
			$this->ckeditor->config['toolbar'] = array(
							array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
																);
			$this->ckeditor->config['language'] = 'en';
			$this->ckeditor->config['height'] = '210px';  

			if($this->id == 'new')
			{
				$data['item'] = $this->model->getColumns();
				$data['item']->startdate = $this->siebel->date_to_mysql(date('d/m/Y', now()));
				$data['item']->enddate = $this->siebel->date_to_mysql(date('d/m/Y', now()));
				$data['item']->price_id = 'new';
			}
			else 
			{
				$data['item'] = $this->pricecontract_model->getContractById($this->id);
				
			}
			
			// Create fields for form
			foreach($data['item'] as $key => $value)
			{
				$data['fields']->$key = array(
					'name'  => $key,
					'id'    => $key,
					'class'    => $key,
					'type'  => 'text',
					'value' => $data['item']->$key,
				);
			}
			
		} else {
			$data['items'] = $this->pricecontract_model->listContracts($this->customernumber);
		}
		
		// Load the general view
		$data['view'] = (isset($this->id) && !empty($this->id)) ? $this->module.'/edit' : $this->module.'/index';
		$this->load->view('DomainView', $data);
		
	}
	
	public function delete($customernumber, $id) {
		$this->customernumber = $customernumber;
		$this->id = $id;
		
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
		
		if($this->pricecontract_model->delete($id))
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
		
		
		if($this->pricecontract_model->undelete($id))
		{
			$this->session->set_flashdata('success', $this->siebel->getLang('success_contactrecover'));
			redirect(site_url($this->module.'/customer/'.$this->customernumber), 'refresh');
		}
	}
	
	public function toExcel($customernumber = FALSE) {
		
		if($customernumber) {
			
			$toExcel = array(
				'items' => $this->pricecontract_model->listContracts($customernumber),
				'customernumber' => $customernumber, 
				'lang' => strtolower($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customerlang'))), 
				'contractsActive' => 1, 
			);

			$this->load->model('tonnagelist_model');
			$this->tonnagelist_model->toExcel($toExcel);
			
		} else {
			
			$this->pricecontract_model->toExcel();
			
		}
	}
	
}