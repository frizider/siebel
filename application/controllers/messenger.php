<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messenger extends CI_Controller {
	
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
		$this->load->model('messenger_model');
	}
	
	public function index() 
	{
		$data['form_attributes'] = array('class' => 'form-horizontal');
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
						array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
															);
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['height'] = '450px';            

		
		if(isset($_POST) && !empty($_POST))
		{
			$department = (isset($_POST['department']) && !empty($_POST['department'])) ? $_POST['department'] : FALSE;
			$contacts = $this->messenger_model->getContacts($department);
			$data['contacts'] = $contacts;
			foreach($contacts as $contact)
			{
				$lang = strtolower(trim($contact['RELANG']));
				$name = trim($contact['RENAM1']);
				$email = strtolower(trim($contact['REEMAIL']));
				$cuno = trim($contact['RECUNO']);
				if($this->messenger_model->sendMail('messenger', $_POST['subject_'.$lang], $content = array('custom' => $_POST['message_'.$lang]), $lang, $email, $cuno))
				{
					$sended[] = 'Message was succesfull sended to '.$name.' - '.$email.' - '.$cuno.';';
				}
				
			};
			
			$data['sended'] = $sended;
			
		}
		
		
		// Load the general view
		$data['view'] = 'messenger/index';
		$this->load->view('DomainView', $data);
	}

}

