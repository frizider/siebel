<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function getComments($custNo, $id = FALSE) {
		if($id)
		{
			$categories = (object) array((object)array('id' => $id));
		}
		else
		{
			$categories = $this->siebel->getCommentsCategories();
		}
		$return = array();
		
		foreach($categories as $category)
		{
			$dbDefault = $this->load->database('default', TRUE);
			
			$dbDefault->where('delete', 0);
			$dbDefault->where('customernumber', $custNo);
			$dbDefault->where('category', $category->id);
			
			$dbDefault->order_by("priority", "desc");
			$dbDefault->order_by("date", "desc");
			$return[$category->id] = $dbDefault->get('comments')->result();
		}
		
		return $return;
	}
	
	public function getSingleComment($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('delete', 0);
		$dbDefault->where('id', $id);
		$return = $dbDefault->get('comments')->row();
		return $return;
	}
	
	public function getGlobalComments() {
		$categories = $this->siebel->getCommentsCategories();
		$return = array();
		
		foreach($categories as $category)
		{
			$dbDefault = $this->load->database('default', TRUE);
			
			$dbDefault->where('global', 1);
			$dbDefault->where('delete', 0);
			$dbDefault->where('category', $category->id);
			$dbDefault->order_by("priority", "desc");
			$dbDefault->order_by("date", "desc");
			$return[$category->id] = $dbDefault->get('comments')->result();
		}
		
		return $return;
	}
	
	public function saveComment($data, $id = FALSE)
	{
		$dbDefault = $this->load->database('default', TRUE);
		if(isset($data['global']) && !empty($data['global']) && $data['global'] == 1)
		{
			$data['customernumber'] = '';
		}
		if($id > 0 && $id != 'new')
		{
			$dbDefault->where('id', $id);
			if($dbDefault->update('comments', $data))
			{
				return $id;
			}
		}
		else 
		{
			if($dbDefault->insert('comments', $data))
			{
				return $dbDefault->insert_id();;
			}
		}
	}
	
	public function saveCategory($data, $id = FALSE)
	{
		$dbDefault = $this->load->database('default', TRUE);
		$short = 'category_'.$data['slug'];
		$category_set = array(
			'title' => $data['title'],
			'slug' => $data['slug'],
			'color' => $data['color'],
		);
		
		$lang_set = array(
			'nl' => $data['category_lang_nl'],
			'fr' => $data['category_lang_fr'],
			'de' => $data['category_lang_de'],
			'en' => $data['title'],
			'short' => $short,
		);
		
		if($id > 0 && $id != 'new')
		{
			$dbDefault->where('id', $id);
			if($dbDefault->update('comments_categories', $category_set))
			{
				if($this->saveCategoryLang($lang_set, $data['category_lang_id']))
				{
					return $id;
				}
			}
		}
		else 
		{
			if($dbDefault->insert('comments_categories', $category_set))
			{
				$newId = $dbDefault->insert_id();
				if($this->saveCategoryLang($lang_set))
				{
					return $newId;
				}
			}
		}
	}	
	public function saveCategoryLang($data, $id = FALSE)
	{
		$dbDefault = $this->load->database('default', TRUE);
		if($id)
		{
			$dbDefault->where('id', $id);
			if($dbDefault->update('language', $data))
			{
				return TRUE;
			};
		}
		else 
		{
			if($dbDefault->insert('language', $data))
			{
				return TRUE;
			};
		}
	}
	
	public function delete($id)
	{
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		if($dbDefault->update('comments', array('delete' => 1)))
		{
			return TRUE;
		};
		
	}
	
	
}

/* End of file */
/* Location: ./application/models/comments_model.php */