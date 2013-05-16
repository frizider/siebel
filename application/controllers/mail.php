<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller {
	
	public function __construct()
	{
		// load Controller constructor
		parent::__construct();
	}
	
	public function index() 
	{
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

