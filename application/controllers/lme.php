<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lme extends CI_Controller {
	
	private $module;
	private $id;
	
	public function __construct()
	{
		// load Controller constructor
		parent::__construct();
		$this->module = get_class();
		$this->id = ($this->uri->segment(2)) ? $this->uri->segment(2) : '';
		
		// Check if the current logged in user is permitted
		/*
		if(!is_permitted('View overview')) {
			redirect('auth/login', 'refresh');
		};
		 */
		
		// load the model we will be using
		$this->load->model('lme_model');
	}
	
	public function index() 
	{
		$data['id'] = $this->id;
		$data['module'] = $this->module;
		$data['customernumber'] = '';
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		if($this->id == 'lme') {
			// This gets the LME by Ajax request
			$date = $this->siebel->date_to_mysql_human($this->input->post('date'));
			$type = $this->input->post('type');
			$lme = $this->lme_model->getLmeByDate($date);
			//dev($lme);
			echo json_encode(round(($lme->$type/$lme->exchange), 2));

		} elseif($this->id == 'report') {
			if (!$this->ion_auth->logged_in()) {
				$this->session->set_flashdata('error', 'De LME historiek is niet beschikbaar voor u. Gelieve eerst in te loggen.');
				redirect('auth/login');
			} else {
				$this->lme_model->toExcel();
			}
		} elseif($this->id == 'mail') {
			
			$this->id = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';
			$data['id'] = $this->id;
			if(isset($this->id) && !empty($this->id))
			{
				
				if($this->uri->segment(4) == 'delete') {
					if($this->lme_model->deleteMail($this->id))
					{
						$this->session->set_flashdata('error', 'Deleted!');
						redirect(site_url('lme/mail'), 'refresh');
					}
				}
				
				if(isset($_POST) && !empty($_POST))
				{
					if($newId = $this->lme_model->saveMail($this->id))
					{
						$this->id = $newId;
						$this->session->set_flashdata('success', 'Saved!');
						redirect(site_url('lme/mail/'.$newId), 'refresh');
					}
				}
				
				if($this->id == 'new')
				{
					$data['lme_mail'] = $this->lme_model->getColumns('lme_mail');
				}
				else 
				{
					$_POST['id'] = $this->id;
					$data['lme_mail'] = $this->lme_model->getLmeMail($_POST);
					$data['lme_mail'] = $data['lme_mail'][0];
				}
				
			} else {
				
				$data['lme_mails'] = $this->lme_model->getLmeMail($_POST);
				
			}
			
			// Load the general view
			$data['view'] = 'lme/mail';
			$this->load->view('DomainView', $data);
			
			
			
		} else {
			
			if(isset($this->id) && !empty($this->id))
			{
				if(isset($_POST) && !empty($_POST))
				{
					if($newId = $this->lme_model->save($this->id))
					{
						$this->id = $newId;
						$this->session->set_flashdata('success', 'Saved!');
						redirect(site_url('lme/'.$newId), 'refresh');
					}
				}
				
				if($this->id == 'new')
				{
					$data['lme'] = $this->lme_model->getColumns('lme');
					$data['lme']->date = $this->siebel->date_to_mysql(date('d/m/Y', now()));
				}
				else 
				{
					$_POST['id'] = $this->id;
					$data['lme'] = $this->lme_model->getLme($_POST);
					$data['lme'] = $data['lme'][0];
				}

			} else {
				$data['lmes'] = $this->lme_model->getLme($_POST);
			}
			// Load the general view
			$data['view'] = 'lme/index';
			$this->load->view('DomainView', $data);
		}
	}
	
	public function toexcel() {
		return $this->lme_model->toExcel();
	}
	
}

