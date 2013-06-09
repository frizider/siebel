<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contactcontroller extends CI_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		
		// Check if the current logged in user is permitted
		
		// Load stuff
		$this->load->model('contact_model');
		
	}
	
	public function index()
	{
		if(!perm('View contacts')) { redirect(base_url(), 'refresh'); }
		$data['customers'] = $this->contact_model->customers();
		
		// Load the general view
		$data['view'] = 'contacts/index';
		$this->load->view('DomainView', $data);
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function customer() {
		if(!perm('View contacts')) { redirect(base_url(), 'refresh'); }
		
		$customernumber = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		
		if(empty($customernumber))
		{
			redirect('contacts', 'refresh');
		}
		else
		{
			$data['customernumber'] = $customernumber;
			
			if(isset($id) && !empty($id)) 
			{
				if(!perm('Edit contact')) { redirect(base_url(), 'refresh'); }
				//validate form input
				//$this->form_validation->set_rules('id', 'id', 'is_unique['.param('param_asw_database_column_contact_id').']');
				//$this->form_validation->set_rules('customerid', 'customerid', 'required|xss_clean|exact_length[32]');
				$this->form_validation->set_rules('customernumber', $this->siebel->getLang('customernumber'), 'required|xss_clean|alpha_numeric');
				$this->form_validation->set_rules('name', $this->siebel->getLang('name'), 'required|xss_clean');
				$this->form_validation->set_rules('email', $this->siebel->getLang('email'), 'xss_clean|valid_email');
				$this->form_validation->set_rules('phone', $this->siebel->getLang('phone'), 'xss_clean|numeric');
				$this->form_validation->set_rules('fax', $this->siebel->getLang('fax'), 'xss_clean|numeric');
				$this->form_validation->set_rules('general', $this->siebel->getLang('department_general'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('billing', $this->siebel->getLang('department_billing'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('order', $this->siebel->getLang('department_order'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('purchase', $this->siebel->getLang('department_purchase'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('transport', $this->siebel->getLang('department_transport'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('packing', $this->siebel->getLang('department_packing'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('quality', $this->siebel->getLang('department_quality'), 'required|xss_clean|integer');
				
				// Form attributes
				$data['form_attributes'] = array('class' => 'form-horizontal');
				
				if (isset($_POST) && !empty($_POST))
				{
					if ($this->form_validation->run() === TRUE)
					{
						if($id = $this->contact_model->save($_POST, $id))
						{
							//redirect them back to the admin page
							$this->session->set_flashdata('success', $this->siebel->getLang('success_contactsaved'));
							redirect(site_url('contacts/customer/'.$customernumber.'/'.$id), 'refresh');
						}
					}
				}
				
				$data['message'] = (validation_errors() ? validation_errors() : FALSE);
				
				if($id == 'new')
				{
					$contact = array(
						'id' => '',
						'customernumber' => $customernumber,
						'name' => '',
						'email' => '',
						'fax' => '',
						'phone' => '',
						'customerid' => '',
						'general' => 0,
						'billing' => 0,
						'order' => 0,
						'purchase' => 0,
						'transport' => 0,
						'packing' => 0,
						'quality' => 0,
					);
					$data['contact'] = $contact;
				}
				else
				{
					$data['contacts'] = $this->contact_model->contacts($customernumber, $id);
					$data['contact'] = $data['contacts'][0];
					$contact = $data['contact'];
				}
				
				$fields = array('email', 'phone', 'fax', 'name');
				foreach($fields as $field)
				{
					$data[$field] = array(
						'name'  => $field,
						'id'    => $field,
						'class'    => $field,
						'type'  => 'text',
						'value' => $this->form_validation->set_value($field, trim($contact[$field])),
					);
				}
				
				$fields = array('id', 'customernumber', 'customerid');
				foreach($fields as $field)
				{
					$data[$field] = array(
						'name'  => $field,
						'id'    => $field,
						'class'    => $field,
						'type'  => 'hidden',
						'value' => trim($contact[$field]),
					);
				}

				// Load the general view
				$data['view'] = 'contacts/edit';
				
			}
			else 
			{
				if(isset($_POST) && !empty($_POST))
				{
					if(!perm('create contact')) { redirect(base_url(), 'refresh'); }
					if(isset($_POST['newcontact']) && !empty($_POST['newcontact']))
					{
						if($_POST['newcontact'] == 1)
						{
							unset($_POST['newcontact']);
							if($md5 = $this->contact_model->saveNew($_POST))
							{
								$lang = strtolower(trim($this->siebel->getCustomerdata($_POST['customernumber'], param('param_asw_database_column_customerlang'))));
								$content = array('custom' => $this->siebel->newContactMail($_POST['customernumber'], $lang, $md5));
								$subject = $this->siebel->getMailText('subject_welcome_aliplast', $lang);
								$this->siebel->sendMail('newcontact', $subject, $content, $lang, $_POST['email'], FALSE, $_POST['customernumber']);

								$this->session->set_flashdata('success', $this->siebel->getLang('success_contactsaved'));
								redirect(site_url('contacts/customer/'.$_POST['customernumber']), 'refresh');
							}
						}
					}
				}
				
				$data['contacts'] = $this->contact_model->contacts($customernumber, $id);
				$contacts = $data['contacts'];
				
				if(empty($contact)) 
				{
					// Do something
				}
				
				// Load the general view
				$data['view'] = 'contacts/customer';
			}

			// Load the general view
			$this->load->view('DomainView', $data);
		}
		
	}

	public function edit() 
	{
		if(!perm('Edit contact')) { redirect(base_url(), 'refresh'); }
		
		$data['customernumber'] = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$data['contact'] = $this->contact_model->contacts($data['customernumber'], $id);
		$data['contact'] = $data['contact'][0];
		
		
		// Load the general view
		$data['view'] = 'contacts/edit';
		$this->load->view('DomainView', $data);
	}
	
	public function delete() {
		$customernumber = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		if($this->contact_model->delete($id))
		{
			$this->session->set_flashdata('message', $this->siebel->getLang('success_contactdelete'));
			redirect(site_url('contacts/customer/'.$customernumber), 'refresh');
		}
	}
	
}

/* End of file */
/* Location: ./application/controllers/ContactController.php */