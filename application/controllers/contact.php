<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact extends CI_Controller {
	
	private $module;
	private $customernumber;
	private $id;

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->module = get_class();
		$this->customernumber = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';
		$this->id = ($this->uri->segment(4)) ? $this->uri->segment(4) : '';
		// Check if the current logged in user is permitted
		
		// Load stuff
		$this->load->model('contact_model');
		
	}
	
	public function index()
	{
		if(!perm('View contacts')) { redirect(base_url(), 'refresh'); }
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
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
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
		
		$customernumber = $this->customernumber;
		$id = $this->id;
		
		
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
				$data['form_attributes'] = array('class' => 'form-horizontal');
				
				if (isset($_POST) && !empty($_POST))
				{
					if($id = $this->contact_model->save($_POST, $id))
					{
						//redirect them back to the admin page
						$this->session->set_flashdata('success', $this->siebel->getLang('success_contactsaved'));
						redirect(site_url('contacts/customer/'.$customernumber.'/'.$id), 'refresh');
					}
				}
				
				$data['message'] = (validation_errors() ? validation_errors() : FALSE);
				
				if($id == 'new')
				{
					$fields = $this->contact_model->getFields(param('param_asw_database_table_contact'));
					foreach ($fields as $field) {
						$contact[$field] = '';
					};
					$contact[param('param_asw_database_column_contact_customernumber')] = $customernumber;
					$data['contact'] = $contact;
				}
				else
				{
					$data['contacts'] = $this->contact_model->contacts($customernumber, $id);
					$data['contact'] = $data['contacts'][0];
					$contact = $data['contact'];
				}
				
				$fields = $this->contact_model->getFields(param('param_asw_database_table_contact'));
				foreach($fields as $field)
				{
					$data[$field] = array(
						'name'  => $field,
						'id'    => $field,
						'class'    => $field,
						'type'  => 'text',
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
								dev($_POST);
								$lang = strtolower(trim($this->siebel->getCustomerdata($_POST[param('param_asw_database_column_contact_customernumber')], param('param_asw_database_column_customerlang'))));
								$this->load->model('messenger_model');
								$content = array('custom' => $this->messenger_model->newContactMail($_POST[param('param_asw_database_column_contact_customernumber')], $lang, $md5));
								$subject = $this->messenger_model->getMailText('subject_welcome_aliplast', $lang);
								$this->messenger_model->sendMail('newcontact', $subject, $content, $lang, $_POST[param('param_asw_database_column_contact_email')], FALSE, $_POST[param('param_asw_database_column_contact_customernumber')]);

								$this->session->set_flashdata('success', $this->siebel->getLang('success_contactsaved'));
								redirect(site_url('contacts/customer/'.$_POST[param('param_asw_database_column_contact_customernumber')]), 'refresh');
							}
						}
					}
				}
				
				$data['contacts'] = $this->contact_model->contacts($customernumber);
				$contacts = $data['contacts'];
				$data['departments'] = $this->contact_model->getDepartments();
				
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
		
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
		
		$id = $this->id;
		$data['contact'] = $this->contact_model->contacts($data['customernumber'], $id);
		$data['contact'] = $data['contact'][0];
		
		
		// Load the general view
		$data['view'] = 'contacts/edit';
		$this->load->view('DomainView', $data);
	}
	
	public function delete() {
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
		
		$customernumber = $this->customernumber;
		$id = $this->id;
		if($this->contact_model->delete($id))
		{
			$this->session->set_flashdata('message', $this->siebel->getLang('success_contactdelete'));
			redirect(site_url('contacts/customer/'.$customernumber), 'refresh');
		}
	}
	
}

/* End of file */
/* Location: ./application/controllers/ContactController.php */