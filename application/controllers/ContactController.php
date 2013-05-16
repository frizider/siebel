<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactController extends CI_Controller {

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
				//$this->form_validation->set_rules('REIDNO', 'REIDNO', 'is_unique['.param('param_asw_database_column_contact_id').']');
				//$this->form_validation->set_rules('RECUID', 'RECUID', 'required|xss_clean|exact_length[32]');
				$this->form_validation->set_rules('RECUNO', $this->siebel->getLang('customernumber'), 'required|xss_clean|alpha_numeric');
				$this->form_validation->set_rules('RENAM1', $this->siebel->getLang('name'), 'required|xss_clean');
				$this->form_validation->set_rules('REEMAIL', $this->siebel->getLang('email'), 'xss_clean|valid_email');
				$this->form_validation->set_rules('REPHONE', $this->siebel->getLang('phone'), 'xss_clean|numeric');
				$this->form_validation->set_rules('REFAX', $this->siebel->getLang('fax'), 'xss_clean|numeric');
				$this->form_validation->set_rules('RETGEN', $this->siebel->getLang('department_general'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('RETBIL', $this->siebel->getLang('department_billing'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('RETORD', $this->siebel->getLang('department_order'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('RETPUR', $this->siebel->getLang('department_purchase'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('RETRAN', $this->siebel->getLang('department_transport'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('RETPAC', $this->siebel->getLang('department_packing'), 'required|xss_clean|integer');
				$this->form_validation->set_rules('RETQUA', $this->siebel->getLang('department_quality'), 'required|xss_clean|integer');
				
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
						'REIDNO' => '',
						'RECUNO' => $customernumber,
						'RENAM1' => '',
						'REEMAIL' => '',
						'REFAX' => '',
						'REPHONE' => '',
						'RECUID' => '',
						'RETGEN' => 0,
						'RETBIL' => 0,
						'RETORD' => 0,
						'RETPUR' => 0,
						'RETRAN' => 0,
						'RETPAC' => 0,
						'RETQUA' => 0,
					);
					$data['contact'] = $contact;
				}
				else
				{
					$data['contacts'] = $this->contact_model->contacts($customernumber, $id);
					$data['contact'] = $data['contacts'][0];
					$contact = $data['contact'];
				}
				
				$fields = array('REEMAIL', 'REPHONE', 'REFAX', 'RENAM1');
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
				
				$fields = array('REIDNO', 'RECUNO', 'RECUID');
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
								$lang = strtolower(trim($this->siebel->getCustomerdata($_POST['RECUNO'], param('param_asw_database_column_customerlang'))));
								$content = array('custom' => $this->siebel->newContactMail($_POST['RECUNO'], $lang, $md5));
								$subject = $this->siebel->getMailText('subject_welcome_aliplast', $lang);
								$this->siebel->sendMail('newcontact', $subject, $content, $lang, $_POST['REEMAIL'], FALSE, $_POST['RECUNO']);

								$this->session->set_flashdata('success', $this->siebel->getLang('success_contactsaved'));
								redirect(site_url('contacts/customer/'.$_POST['RECUNO']), 'refresh');
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
		
		$customernumber = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$data['contact'] = $this->contact_model->contacts($customernumber, $id);
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