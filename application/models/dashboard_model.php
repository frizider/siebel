<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function saveUserDashboard()
	{
		$sort = $this->input->post('sort');
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $this->ion_auth->getUserdata('id'));
		if($dbDefault->update('users', array('userDashboard' => $sort)))
		{
			return TRUE;
		}
	}
	
	public function getUserDashboard() {
		$userDashboard = $this->ion_auth->getUserdata('userDashboard');
		if(!empty($userDashboard))
		{
			$userDashboard = explode('||', $userDashboard);
			unset($userDashboard[count($userDashboard) - 1]);
			foreach ($userDashboard as $key => $value) {
				if(!empty($value)) {

					foreach(explode(',', $value) as $item)
					{
						$itemSet = explode('__', $item);
						$newValues[$itemSet[0].'__'.$itemSet[1]] = array($itemSet[0], $itemSet[1]);
					}
					$newUserDashboard[$key + 1] = $newValues;
					$newValues = '';

				}
			}
		}
		else 
		{
			$newUserDashboard = array(
				'1' => array(),
				'2' => array(),
				'3' => array(),
			);
		}

		return $newUserDashboard;
	}

	public function getWidgets($widgetsModification = FALSE) {
		foreach (glob(APPPATH . 'widgets/*') as $folder)
		{
			$folder = explode('/', $folder);
			$folders[$folder[2].'__0'] = array($folder[2], '0');
		}
		
		$widgets = $folders;
		
		if($widgetsModification)
		{
			foreach($widgetsModification as $key => $value)
			{
				if(array_key_exists($key, $folders))
				{
					unset($widgets[$key]);
					$widgets = array_merge($widgets, $value);
				}
			}
		}
		
		return $widgets;
	}
}

/* End of file */