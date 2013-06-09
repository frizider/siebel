<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class newcustomer extends CI_Controller {
	
	public function __construct()
	{
		// load Controller constructor
		parent::__construct();
		
		// load the model we will be using
		$this->load->model('newcustomer_model');
		$this->load->model('messenger_model');
	}
	
	public function index() 
	{
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
				$content = array('custom' => $this->messenger_model->getMailText('subject_newcontact_saved'.$data['customerNo'].'. <br/>Link: '.site_url('contacts/customer/'.$data['customerNo']), $lang));
				$subject = $this->messenger_model->getMailText('subject_newcontact_saved'.$data['customerNo'], $lang);
				$to = $this->siebel->get_return_to_sender('newcontact',$data['customerNo'])->email;
				$this->messenger_model->sendMail('savenewcontact', $subject, $content, $lang, $to, param('param_mailhost'), $data['customerNo']);
				
				$this->session->set_flashdata('success', $this->siebel->getLang('success_contactsaved', $data['lang']));
				redirect(current_url(), 'refresh');
			}
		}
		
		$data['contacts'] = $this->newcustomer_model->getContacts($data['customerId']);
		
		// Load the general view
		$data['view'] = 'contacts/newcustomer';
		$this->load->view('DomainView', $data);
	}

}

