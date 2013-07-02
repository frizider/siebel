<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class newcustomer extends CI_Controller {
	
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
	
		// load the model we will be using
		$this->load->model('newcustomer_model');
		$this->load->model('messenger_model');
		$this->load->model('contact_model');
	}
	
	public function index() 
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		$data['customerNo'] = $this->uri->segment(2);
		$data['lang'] = $this->uri->segment(3);
		$data['customerId'] = $this->uri->segment(4);
		if(empty($data['customerId']))
		{
			redirect(base_url(), 'refresh');
		}
		
		if(isset($_POST) && !empty($_POST))
		{
			if($this->newcustomer_model->save($_POST, $data['customerNo']))
			{
				$lang = $data['lang'];
				$content = array('custom' => $this->messenger_model->getMailText('subject_newcontact_saved', $lang).$data['customerNo'].'. <br/>Link: '.site_url('contacts/customer/'.$data['customerNo']));
				$subject = $this->messenger_model->getMailText('subject_newcontact_saved',$lang).$data['customerNo'];
				$to = $this->messenger_model->getReturnToSender('newcontact',$data['customerNo'])->email;
				$this->messenger_model->sendMail('savenewcontact', $subject, $content, $lang, $to, param('param_mailhost'), $data['customerNo']);
				
				$this->session->set_flashdata('success', $this->siebel->getLang('success_contactsaved', $lang));
				redirect(current_url(), 'refresh');
			}
		}
		
		$data['departments'] = $this->contact_model->getDepartments($data['lang']);
		$data['contacts'] = $this->newcustomer_model->getContacts($data['customerId']);
		
		// Load the general view
		$data['view'] = 'contacts/newcustomer';
		$this->load->view('DomainView', $data);
	}

}

