<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comments extends CI_Controller {
	
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
		$this->load->model('comments_model');
	}
	
	public function index() 
	{
		
		// CK Editor
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
						array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
													);
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['height'] = '210px';            
		
		
		$data['id'] = $this->uri->segment(4);
		$data['customernumber'] = strtoupper($this->uri->segment(3));
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		if(isset($data['id']) && !empty($data['id']))
		{
			
			if(isset($_POST) && !empty($_POST))
			{
				if($newId = $this->comments_model->saveComment($_POST, $data['id']))
				{
					$this->session->set_flashdata('success', 'Comment saved!');
					redirect(site_url('comments/customer/'.$data['customernumber'].'/'.$newId), 'refresh');
				}
			}
			
			if($data['id'] == 'new')
			{
				$com = array(
					'title' => '',
					'global' => '',
					'priority' => '',
					'category' => '', 
					'description' => ''
				);
				
				$comment = new stdClass();
				foreach ($com as $key => $value)
				{
					$comment->$key = $value;
				}
				$data['comment'] = $comment;

			}
			else
			{
				$data['comment'] = $this->comments_model->getSingleComment($data['id']);
				$comment = $data['comment'];
				$data['current_category'] = $this->comments_model->getCommentsCategories($comment->category);
			}
			
			$data['categories'] = $this->comments_model->getCommentsCategories();

			// Text fields
			$fields = array('title');
			foreach($fields as $field)
			{
				$data[$field] = array(
					'name'  => $field,
					'id'    => $field,
					'class'    => $field,
					'type'  => 'text',
					'value' => $comment->$field,
				);
			}

			// Textaera fields
			$fields = array('description');
			foreach($fields as $field)
			{
				$data[$field] = array(
					'name'  => $field,
					'id'    => $field,
					'class'    => $field,
					'type'  => 'textarea',
					'value' => $comment->$field,
				);
			}

			// Hidden fields
			$fields = array('priority', 'category', 'global');
			foreach($fields as $field)
			{
				$data[$field] = array(
					'name'  => $field,
					'id'    => $field,
					'class'    => $field,
					'type'  => 'hidden',
					'value' => $comment->$field,
				);
			}

		}
		else
		{
			$data['comments'] = $this->comments_model->getComments($data['customernumber']);
		}
		
		// Load the general view
		$data['view'] = 'comments/index';
		$this->load->view('DomainView', $data);
	}

	public function categories() 
	{
		$data['id'] = $this->uri->segment(3);
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		if(isset($data['id']) && !empty($data['id']))
		{
			
			if(isset($_POST) && !empty($_POST))
			{
				if($newId = $this->comments_model->saveCategory($_POST, $data['id']))
				{
					$this->session->set_flashdata('success', 'Category saved!');
					redirect(site_url('comments/categories/'.$newId), 'refresh');
				}
			}
			
			if($data['id'] == 'new')
			{
				$cats = array(
					'title' => '',
					'slug' => '',
					'color' => ''
				);
				
				$cats_lang = array(
					'id' => '', 
					'nl' => '', 
					'fr' => '', 
					'de' => '', 
					'en' => ''
				);
				
				$category = new stdClass();
				foreach ($cats as $key => $value)
				{
					$category->$key = $value;
				}
				$data['category'] = $category;

				$category_lang = new stdClass();
				foreach ($cats_lang as $key => $value)
				{
					$category_lang->$key = $value;
				}

				
			}
			else
			{
				$data['category'] = $this->siebel->getCommentsCategories($data['id']);
				$data['category'] = $data['category'][0];
				$category = $data['category'];
				
				$category_lang = $this->siebel->getCommentsCategoriesLang('category_'.$category->slug);
			}
				
			// Text fields
			$fields = array('title', 'slug', 'color');
			foreach($fields as $field)
			{
				$data[$field] = array(
					'name'  => $field,
					'id'    => $field,
					'class' => $field,
					'type'  => 'text',
					'value' => $category->$field,
				);
			}

			// Language fields
			$fields = array('id', 'nl', 'fr', 'de', 'en');
			foreach($fields as $field)
			{
				$data['category_lang_'.$field] = array(
					'name'  => 'category_lang_'.$field,
					'id'    => 'category_lang_'.$field,
					'class' => 'category_lang_'.$field,
					'type'  => 'text',
					'value' => $category_lang->$field,
				);
			}

		}
		else
		{
			$data['categories'] = $this->siebel->getCommentsCategories();
		}
		
		// Load the general view
		$data['view'] = 'comments/categories';
		$this->load->view('DomainView', $data);
	}

	public function globalComments() 
	{
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
						array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
															);
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['height'] = '210px';            

		
		
		$data['id'] = $this->uri->segment(3);
		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		if(isset($data['id']) && !empty($data['id']))
		{
			
			if(isset($_POST) && !empty($_POST))
			{
				if($newId = $this->comments_model->saveComment($_POST, $data['id']))
				{
					$this->session->set_flashdata('success', 'Comment saved!');
					redirect(site_url('comments/globalcomments/'.$newId), 'refresh');
				}
			}
			
			if($data['id'] == 'new')
			{
				$com = array(
					'title' => '',
					'global' => '',
					'priority' => '',
					'category' => '', 
					'description' => ''
				);
				
				$comment = new stdClass();
				foreach ($com as $key => $value)
				{
					$comment->$key = $value;
				}
				$data['comment'] = $comment;

			}
			else
			{
				$data['comment'] = $this->comments_model->getSingleComment($data['id']);
				$comment = $data['comment'];
			}
				
				// Text fields
				$fields = array('title');
				foreach($fields as $field)
				{
					$data[$field] = array(
						'name'  => $field,
						'id'    => $field,
						'class'    => $field,
						'type'  => 'text',
						'value' => $comment->$field,
					);
				}
				
				// Textaera fields
				$fields = array('description');
				foreach($fields as $field)
				{
					$data[$field] = array(
						'name'  => $field,
						'id'    => $field,
						'class'    => $field,
						'type'  => 'textarea',
						'value' => $comment->$field,
					);
				}
				
				// Hidden fields
				$fields = array('priority', 'category', 'global');
				foreach($fields as $field)
				{
					$data[$field] = array(
						'name'  => $field,
						'id'    => $field,
						'class'    => $field,
						'type'  => 'hidden',
						'value' => $comment->$field,
					);
				}

		}
		else
		{
			$data['comments'] = $this->comments_model->getGlobalComments();
		}
		
		// Load the general view
		$data['view'] = 'comments/global';
		$this->load->view('DomainView', $data);
	}
	
	public function delete()
	{
		$data['customernumber'] = $this->uri->segment(3);
		$data['id'] = $this->uri->segment(4);
		
		if($this->comments_model->delete($data['id']))
		{
			$this->session->set_flashdata('error', 'Comment deleted!');
			if($data['customernumber'] == 'global')
			{
				redirect(site_url('comments/globalcomments'), 'refresh');
			}
			else
			{
				redirect(site_url('comments/customer/'.$data['customernumber']), 'refresh');
			}
		}
		
	}

	
	
}

