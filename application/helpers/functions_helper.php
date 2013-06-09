<?php

/*
 * Development and design by Jens De Schrijver
 * Functions helper
 */

// Developer debug for print_r function with pre tags.
function dev($var) {
	echo '<pre style="position:relative; z-index:999999;">';
	print_r($var);
	echo '</pre>';
}

function perm($permission_name) 
{
	$ci = get_instance();
	if (!$ci->ion_auth->logged_in())
	{
		redirect('auth/login');
	}
	
	if($ci->ion_auth->is_admin()) 
	{
		return TRUE;
		
	} else {
		
		// Get all the groups of the current user
		$user_groups = $ci->ion_auth->get_users_groups()->result_array();
		$user_groups = $user_groups[0]['id'];

		// Get all the groups of the asked permission
		$permission_groups = $ci->siebel->getPermissionsGroups($permission_name);

		// Check is the users group is in the permissions groups
		if(in_array($user_groups, $permission_groups)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
}


















// Fucntion to get the value of a parameter from the params config file
function param($name) {
	$ci =& get_instance();
	return $ci->config->item($name);
}

// Function to get text in the language of the user.
function lang($short, $lang = '') {
	$ci = & get_instance();
	$ci->load->database();
	
	if (empty($lang)) {
		$user = $ci->ion_auth->user()->row();
		$lang = $user->lang;
	}
	

	// select from 'options' according to given ID
	$lang = strtoupper($lang);
	$ci->db->select($lang);
	$ci->db->where('short', $short);
	$value = $ci->db->get('language')->result_array();

	return $value[0][$lang];

}

// Fucntion to retrieve the language of the current user
function user($type) {
	$ci = & get_instance();
	$user = $ci->ion_auth->user()->row();
	return $user->$type;
}

// Fucntion to check ether you're logged in or not
function is_logged_in() {
	$ci = & get_instance();
	$is_logged_in = $ci->session->userdata('is_logged_in');
	if (!isset($is_logged_in) || $is_logged_in != true) {
		redirect(base_url() . index_page() . 'login');
		die();
	}
}

function loginstate() {
	$ci = & get_instance();
	$is_logged_in = $ci->session->userdata('is_logged_in');
	if (!isset($is_logged_in) || $is_logged_in != true) {
		return false;
	} else {
		return true;
	}
}

// Function that retaun YES/NO language according to a given value
function isYesNo($value) {
	$ci = & get_instance();
	if ($value == 1) {
		$isYesNo = lang('yes');
	} else {
		$isYesNo = lang('no');
	}
	return $isYesNo;
}

function ifset(&$var) {
	if (isset($var) && $var == 1) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function checkboxPost($post) {
	if (isset($_POST[$post])) {
		$value = 1;
	} else {
		$value = 0;
	};
	return $value;
}

function ucsentence($string)
{
	//first we make everything lowercase, and then make the first letter if the entire string capitalized
	$string = ucfirst(strtolower($string));

	//now we run the function to capitalize every letter AFTER a full-stop (period).
	$string = preg_replace_callback('/[.!?].*?\w/', create_function('$matches', 'return strtoupper($matches[0]);'),$string);

	//return the result
	return $string;
}

function get_states() 
{
	$ci = get_instance();
	$states =  $ci->db->get('states')->result_array();
	
	return $states;
}

function getStateShort($id) {
	$ci = get_instance();
	$ci->db->select('short');
	$ci->db->where('id', $id);
	$stateshort = $ci->db->get('states')->result_array();
	
	return $stateshort[0]['short'];
	
}


function get_email_users($user_id) 
{
	if($user_id != FALSE) {
		$ci = get_instance();
		$emails =  $ci->db	->select('state_id')
							->where('user_id', $user_id)
							->get('email_users')
							->result_array();

		foreach ($emails as $email) {
			$emails_array[] = $email['state_id'];
		};

	} else {
		$emails_array = array();
	};
	
	return (!empty($emails_array)) ? $emails_array : array();
}

function getPack($id) {
	$ci = get_instance();
	$ci->db->select('pack');
	$ci->db->where('id', $id);
	$pack = $ci->db->get('measurements')->result_array();
	return $pack[0]['pack'];
}

function hasPrintDate($id) {
	$ci = get_instance();
	$ci->db->select('date');
	$ci->db->where('measurements_id', $id);
	$result = $ci->db->get('print')->result_array();
	
	if ($result)  {
		return $result[0]['date'];
	} else {
		return false;
	}
}

function getMinMax($table, $column, $die = '', $alloy = '') {
	
	$devider = '-';
	$min = getMin($table, $column, $die, $alloy);
	$max = getMax($table, $column, $die, $alloy);
	
	if($max != 0) {
		return $min.$devider.$max;
	} else {
		return $min;
	}
}

function getMin($table, $column, $die, $alloy) {
	
	$ci = get_instance();
	
	$ci->db->select($column.'min');
	$ci->db->where('delete', 0);
	
	if($die != '') {
		$ci->db->where('die', $die);
	}
	
	if($alloy != '') {
		$ci->db->where('realalloy', $alloy);
	}
	
	$query = $ci->db->get($table.'_values');
	if($query->num_rows() > 0) {
		$result = $query->result_array();
		return $result[0][$column.'min'];
	} else {
		return FALSE;
	}
	
	
	/*
	if (isset($die) && !empty($die)) {
		$ci->db->where('die', $die);
	} else {
		$ci->db->where('realalloy', $alloy);
	}
	
	$query = $ci->db->get($table.'_values');
	
	if($query->num_rows() > 0) {
		$result = $ci->db->get($table.'_values')->result_array();
		return $result[0][$column.'min'];
	} else {
		return FALSE;
	}
	 * 
	 */
}

function getMax($table, $column, $die, $alloy) {
	
	$ci = get_instance();
	
	$ci->db->select($column.'max');
	$ci->db->where('delete', 0);
	
	if($die != '') {
		$ci->db->where('die', $die);
	}
	
	if($alloy != '') {
		$ci->db->where('realalloy', $alloy);
	}
	
	$query = $ci->db->get($table.'_values');
	if($query->num_rows() > 0) {
		$result = $query->result_array();
		return $result[0][$column.'max'];
	} else {
		return FALSE;
	}
	
	
	/*
	if (isset($die) && !empty($die)) {
		$ci->db->where('die', $die);
	} else {
		$ci->db->where('realalloy', $alloy);
	}
	
	$query = $ci->db->get($table.'_values');
	
	if($query->num_rows() > 0) {
		$result = $ci->db->get($table.'_values')->result_array();
		return $result[0][$column.'max'];
	} else {
		return FALSE;
	}
	 * 
	 */
}

function checkValue($value, $table, $column, $die = '', $alloy = '') {
	
	$min = getMin($table, $column, $die, $alloy);
	$max = getMax($table, $column, $die, $alloy);
	
	$max = ($max == 0) ? 99999999 : $max;
	
	if($min == FALSE || $max == FALSE) {
		return FALSE;
	} else {
		if($value >= $min && $value <= $max) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
}

function listAlloy() {
	$ci = get_instance();
	$ci->db->select('realalloy');
	$ci->db->where('delete', 0);
	$query = $ci->db->get('chemical_values');
	
	if($query->num_rows() > 0) {
		return $query->result_array();
	} else {
		return FALSE;
	}
}

function getOverrule($pack) {
	$ci = get_instance();
	$ci->db->select('realalloy');
	$ci->db->where('pack', $pack);
	$ci->db->order_by('date', 'desc');
	$query = $ci->db->get('overrule');
	
	if($query->num_rows() > 0) {
		$alloy = $query->result_array();
		return $alloy[0]['realalloy'];
	} else {
		return FALSE;
	}
}

function getCustomercredits($customernumber) {
	$ci = get_instance();
	$contacts_db = $ci->load->database('contact', TRUE);
	$contacts_db->select('name, fax, email');
	$contacts_db->where('customernumber', $customernumber);
	$contacts_db->where('type', 'transport');
	$result = $contacts_db->get('contactlist')->result_array();
	
	return $result[0];
}

function approvedDate($pack) {
	$ci = get_instance();
	$ci->db->select('date');
	$ci->db->where('pack', $pack);
	$ci->db->where('state', 2);
	$ci->db->order_by('date', 'desc');
	$query = $ci->db->get('pack_states');
	
	if($query->num_rows() > 0) {
		$result = $query->result_array();
		return $result[0]['date'];
	} else {
		return FALSE;
	}

}

function state($pack) {
	$ci = get_instance();
	$ci->db->select('state');
	$ci->db->where('pack', $pack);
	$ci->db->order_by('date', 'desc');
	$query = $ci->db->get('pack_states');
	
	if($query->num_rows() > 0) {
		$result = $query->result_array();
		$state_id = $result[0]['state'];
		
		$ci->db->select('short');
		$ci->db->where('id', $state_id);
		$state = $ci->db->get('states')->result_array();
		
		return $state[0]['short'];
		
	} else {
		return FALSE;
	}

}

function makeXML($pack) {
	$ci = get_instance();
	$ci->load->model('measurements_model');
	$measurements = $ci->measurements_model->getMeasurements($pack);
	$measurements = $measurements[0];
	$data = array(
		'min_max_si' => getMinMax('chemical', 'si', '', getAlloy($pack)),
		'min_max_fe' => getMinMax('chemical', 'fe', '', getAlloy($pack)),
		'min_max_cu' => getMinMax('chemical', 'cu', '', getAlloy($pack)),
		'min_max_mn' => getMinMax('chemical', 'mn', '', getAlloy($pack)),
		'min_max_mg' => getMinMax('chemical', 'mg', '', getAlloy($pack)),
		'min_max_zn' => getMinMax('chemical', 'zn', '', getAlloy($pack)),
		'min_max_ti' => getMinMax('chemical', 'ti', '', getAlloy($pack)),
		'si' => getAlloyValues($pack, 'si'),
		'fe' => getAlloyValues($pack, 'fe'),
		'cu' => getAlloyValues($pack, 'cu'),
		'mn' => getAlloyValues($pack, 'mn'),
		'mg' => getAlloyValues($pack, 'mg'),
		'zn' => getAlloyValues($pack, 'zn'),
		'ti' => getAlloyValues($pack, 'ti'),
		'min_max_thickness' => getMinMax('mechanical', 'thickness', getExtrusionValue($pack, 'param_asw_database_column_ext_dienumber'), ''),
		'min_max_rp' => getMinMax('mechanical', 'rp', getExtrusionValue($pack, 'param_asw_database_column_ext_dienumber'), ''),
		'min_max_rm' => getMinMax('mechanical', 'rm', getExtrusionValue($pack, 'param_asw_database_column_ext_dienumber'), ''),
		'min_max_a' => getMinMax('mechanical', 'a', getExtrusionValue($pack, 'param_asw_database_column_ext_dienumber'), ''),
		'thickness' => $measurements['thickness'],
		'rp' => $measurements['rp'],
		'rm' => $measurements['rm'],
		'a' => $measurements['a'],
	);
	
	$ci->load->library('array2xml');
	$ci->array2xml->init($version /* ='1.0' */, $encoding /* ='UTF-8' */);
	$xml = $ci->array2xml->createXML('cert', $data);
	echo $xml->saveXML();
	
}

function saveXML($pack, $id) {
	$ci = get_instance();
	$ci->load->model('measurements_model');
	$measurements = $ci->measurements_model->getMeasurements($pack, $id);
	$measurements = $measurements[0];
	$lang = strtoupper(getCustomerValue($pack, 'param_asw_database_column_customerlang'));
	
	$data = array(
		
		'companyname' => param('param_credits_companyname'),
		'companyaddress' => param('param_credits_companyaddress') . ' - ' . param('param_credits_companypostalcode') . ' ' . param('param_credits_companycity') . ' - ' . param('param_credits_companycountry') . ' - E: ' . param('param_credits_companymail') . ' - T: ' . param('param_credits_companyphone') . ' - F:' . param('param_credits_companyfax'),
		'title_responsable' => strtoupper((lang('responsable', $lang))),
		'name_production' => param('param_credits_name_prodcutionmanager'),
		'name_quality' => param('param_credits_name_quality'),
	
		'title' => (lang('certificate', $lang).' EN 10204-3.1'),
		'date' => getPrint($id, 'date'),
		'title_customer' => strtoupper(lang('customer', $lang)),
		'content_customer' => utf8_encode(getCustomerValue($pack, 'param_asw_database_column_customername')),
		'title_supplier' => strtoupper(lang('supplier', $lang)),
		'content_supplier' => param('param_credits_companyname'),
		'title_order' => strtoupper(lang('ordernumber', $lang)),
		'content_order_customer' => utf8_encode(getSalesValue($pack, 'param_asw_database_column_soh_salesordernumbercostumer')),
		'content_order_supplier' => utf8_encode(getSalesValue($pack, 'param_asw_database_column_soh_salesordernumber')),
		'content_orderline_supplier' => utf8_encode(getManufacturingValue($pack, 'param_asw_database_column_manuf_salesorderline')),
		'title_profile' => strtoupper(lang('profile', $lang)),
		'content_profile_customer' => utf8_encode(getProduct($pack, 'param_asw_database_column_product_custref')),
		'content_profile_supplier' => utf8_encode(getProduct($pack, 'param_asw_database_column_product_ourref')),
		'title_alloy' => strtoupper(lang('alloy', $lang) . ' - cfr. NEN 12020'),
		'content_alloy' => utf8_encode(getRealAlloy($pack)),
		'title_deliverydate' => strtoupper(lang('delivery_date', $lang)),
		'title_deliverynumber' => strtoupper(lang('delivery_number', $lang)),
		'title_heatnumber' => strtoupper(lang('heatnumber', $lang)),
		'content_heatnumber' => utf8_encode(getExtrusionValue($pack, 'param_asw_database_column_ext_gietnummer')),
		'title_fao' => strtoupper(lang('fao', $lang)),
		'title_email' => strtoupper('Email'),
		'title_fax' => strtoupper('Fax'),
		'title_minimal_values' => strtoupper(lang('minimal_values', $lang)),
		'title_real_values' => strtoupper(lang('real_values', $lang)),
		'min_max_si' => getMinMax('chemical', 'si', '', getAlloy($pack)),
		'min_max_fe' => getMinMax('chemical', 'fe', '', getAlloy($pack)),
		'min_max_cu' => getMinMax('chemical', 'cu', '', getAlloy($pack)),
		'min_max_mn' => getMinMax('chemical', 'mn', '', getAlloy($pack)),
		'min_max_mg' => getMinMax('chemical', 'mg', '', getAlloy($pack)),
		'min_max_zn' => getMinMax('chemical', 'zn', '', getAlloy($pack)),
		'min_max_ti' => getMinMax('chemical', 'ti', '', getAlloy($pack)),
		'si' => getAlloyValues($pack, 'si'),
		'fe' => getAlloyValues($pack, 'fe'),
		'cu' => getAlloyValues($pack, 'cu'),
		'mn' => getAlloyValues($pack, 'mn'),
		'mg' => getAlloyValues($pack, 'mg'),
		'zn' => getAlloyValues($pack, 'zn'),
		'ti' => getAlloyValues($pack, 'ti'),
		'min_max_thickness' => getMinMax('mechanical', 'thickness', getExtrusionValue($pack, 'param_asw_database_column_ext_dienumber'), ''),
		'min_max_rp' => getMinMax('mechanical', 'rp', getExtrusionValue($pack, 'param_asw_database_column_ext_dienumber'), ''),
		'min_max_rm' => getMinMax('mechanical', 'rm', getExtrusionValue($pack, 'param_asw_database_column_ext_dienumber'), ''),
		'min_max_a' => getMinMax('mechanical', 'a', getExtrusionValue($pack, 'param_asw_database_column_ext_dienumber'), ''),
		'thickness' => $measurements['thickness'],
		'rp' => $measurements['rp'],
		'rm' => $measurements['rm'],
		'a' => $measurements['a'],
	);
	
	$string = 
	'<?xml version="1.0" encoding="UTF-8"?>
	<cert>
		<image_logo value="\\\\aliweb\VP\certapp\public\img\logo_aliplast_axtrusion.jpg" />
		<image_ce value="\\\\aliweb\VP\certapp\public\img\ce.jpg" />
		<image_signature_productionmanager value="\\\\aliweb\VP\certapp\public\img\signature_productionmanager.jpg" />
		<image_signature_quality value="\\\\aliweb\VP\certapp\public\img\signature_quality.jpg" />

		<header>
			<company title="'.$data['companyname'].'" value="'.$data['companyaddress'].'" />
			<title title="'.$data['title'].'" value="'.$data['date'].'" />
			<customer_supplier title="'.$data['title_customer'].' / '.$data['title_supplier'].'" customervalue="'.$data['content_customer'].'" suppliervalue="'.$data['content_supplier'].'" />
			<fao title="'.$data['title_fao'].'" />
			<email title="'.$data['title_email'].'" />
			<fax title="'.$data['title_fax'].'" />
			<order title="'.$data['title_order'].'" customervalue="'.$data['content_order_customer'].'" suppliervalue="'.$data['content_order_supplier'].'" />
			<profile title="'.$data['title_profile'].'" customervalue="'.$data['content_profile_customer'].'" suppliervalue="'.$data['content_profile_supplier'].'" />
			<deliverydate title="'.$data['title_deliverydate'].'" />
			<deliverynumber title="'.$data['title_deliverynumber'].'" />
			<alloy title="'.$data['title_alloy'].'" value="'.$data['content_alloy'].'" />
			<heatnumber title="'.$data['title_heatnumber'].'" value="'.$data['content_heatnumber'].'" />
		</header>
			
		<values>
			<minimal_values title="'.$data['title_minimal_values'].'" />
			<real_values title="'.$data['title_real_values'].'" />
			
			<chemical title="Chemical composition (following 573-3)" />
			<si title="Si" minvalue="'.$data['min_max_si'].'" realvalue="'.$data['si'].'" />
			<fe title="Fe" minvalue="'.$data['min_max_fe'].'" realvalue="'.$data['fe'].'" />
			<cu title="Cu" minvalue="'.$data['min_max_cu'].'" realvalue="'.$data['cu'].'" />
			<mn title="Mn" minvalue="'.$data['min_max_mn'].'" realvalue="'.$data['mn'].'" />
			<mg title="Mg" minvalue="'.$data['min_max_mg'].'" realvalue="'.$data['mg'].'" />
			<zn title="Zn" minvalue="'.$data['min_max_zn'].'" realvalue="'.$data['zn'].'" />
			<ti title="Ti" minvalue="'.$data['min_max_ti'].'" realvalue="'.$data['ti'].'" />
			
			<mechanical title="Mechanical Properties (following EN755-2)" />
			<thickness title="Thickness mm" minvalue="'.$data['min_max_thickness'].'" realvalue="'.$data['thickness'].'" />
			<rp title="Rp N/mm2" minvalue="'.$data['min_max_rp'].'" realvalue="'.$data['rp'].'" />
			<rm title="Rm N/mm2" minvalue="'.$data['min_max_rm'].'" realvalue="'.$data['rm'].'" />
			<a title="A %" minvalue="'.$data['min_max_a'].'" realvalue="'.$data['a'].'" />
		</values>
		<footer>
			<responsable title="'.$data['title_responsable'].'" />
			<production title="Production Manager" value="'.$data['name_production'].'" />
			<quality title="Quality Manager" value="'.$data['name_quality'].'" />
		</footer>
	</cert>';

	if(file_put_contents('./public/certxml/c_'.$data['content_order_supplier'].'.'.str_pad($data['content_orderline_supplier'], 3, "0", STR_PAD_LEFT).'_'. str_pad($id, 6, "0", STR_PAD_LEFT).'.cert', $string)) {
		return TRUE;
	} else {
		return FALSE;
	}
	
}

?>