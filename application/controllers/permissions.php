<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Check if the current logged in user is permitted
		if(!is_permitted('View permissions')) {
			redirect('auth/login', 'refresh');
		};

		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->model('permissions_model');

		$this->load->database();

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
	}

	//redirect if needed, otherwise display the user list
	function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin())
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect('/', 'refresh');
		}
		else
		{
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['permissions'] = $this->db->get('permissions')->result_array();

			$this->load->view('header', array('pageid' => 'auth'));
			$this->load->view('sidebar');
			$this->load->view('permissions/index', $this->data);
			$this->load->view('footer');
		}
	}

	// create a new permission
	function create_permission()
	{
		$this->data['title'] = "Create Permission";
		$this->data['form_attributes'] = array('class' => 'jqtransform');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		//validate form input
		$this->form_validation->set_rules('permission_name', 'Permission name', 'required|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'xss_clean');

		if ($this->form_validation->run() == TRUE)
		{
			$new_permission_id = $this->permissions_model->create_permission($this->input->post('permission_name'), $this->input->post('description'), $this->input->post('groups'));
			if($new_permission_id)
			{
				// check to see if we are creating the permission
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("permissions", 'refresh');
			}
		}
		else
		{
			//display the create permission form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['permission_name'] = array(
				'name'  => 'permission_name',
				'id'    => 'permission_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('permission_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->load->view('header', array('pageid' => 'user'));
			$this->load->view('sidebar');
			$this->load->view('permissions/create_permission', $this->data);
			$this->load->view('footer');
		}
	}

	//edit a permission
	function edit_permission()
	{
		$this->data['form_attributes'] = array('class' => 'jqtransform');
		
		$id = $this->uri->segment(3);
		
		// bail if no permission id given
		if(!$id || empty($id))
		{
			redirect('permissions', 'refresh');
		}

		$this->data['title'] = "Edit Permission";

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$permission = $this->db	->where('id', $id)
								->get('permissions')->result_array();

		if (isset($_POST) && !empty($_POST))
		{
			$permission_update = $this->permissions_model->update_permission($id, $_POST['name'], $_POST['description'], $_POST['groups']);

			if($permission_update)
			{
				$this->session->set_flashdata('message', "Permission Saved");
				redirect('permissions', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
			}
			redirect("permissions", 'refresh');
		}

		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['permission'] = $permission;

			$this->load->view('header', array('pageid' => 'user'));
			$this->load->view('sidebar');
			$this->load->view('permissions/edit_permission', $this->data);
			$this->load->view('footer');
	}

}
