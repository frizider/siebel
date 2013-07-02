<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller {
	
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
	}
	
	public function index() 
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$config['login']='packingextrusion@aliplast.com';
		$config['pass']='Juni7410';
		$config['host']='pod51016.outlook.com';
		$config['port']='993';
		$config['service_flags'] = '/imap/ssl/novalidate-cert';

		$this->load->library('peeker', $config);

		if ($this->peeker->message_waiting())
		{
			$data['message_waiting'] = 'Message count:' . $this->peeker->get_message_count();
		}
		else
		{
			$data['message_waiting'] = 'No messages waiting.';
		}

		$this->peeker->close();

		// tell the story of the connection
		$data['trace'] = $this->peeker->trace();
		
		// Load the general view
		$data['view'] = 'mail/index';
		$this->load->view('DomainView', $data);
	}

}

