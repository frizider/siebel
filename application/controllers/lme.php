<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lme extends CI_Controller {
	
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
		$this->load->model('lme_model');
	}
	
	public function index() 
	{
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		$data['id'] = $this->uri->segment(2);
		$id = $data['id'];
		
		if($id == 'lme')
		{
			$date = $this->siebel->date_to_mysql_human($this->input->post('date'));
			$type = $this->input->post('type');
			$lme = $this->lme_model->getLmeByDate($date);
			//dev($lme);
			echo json_encode(round(($lme->$type/$lme->exchange), 2));
		}
		else
		{
			
			$data['lmes'] = $this->lme_model->getLme($id);

			if(isset($id) && !empty($id))
			{
				if($id == 'new')
				{
					$data['lme'] = $this->lme_model->getColumns('lme');
					$data['lme']->date = $this->siebel->date_to_mysql(date('d/m/Y', now()));
				}
				else 
				{
					$data['lme'] = $data['lmes'][0];
				}

				if(isset($_POST) && !empty($_POST))
				{
					if($newId = $this->lme_model->save($id))
					{
						$this->session->set_flashdata('success', 'Comment saved!');
						redirect(site_url('lme/'.$newId), 'refresh');
					}
				}
			}
			// Load the general view
			$data['view'] = 'lme/index';
			$this->load->view('DomainView', $data);
		}
	}
	
}

