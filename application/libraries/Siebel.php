<?php

class Siebel {

	public function getUserdata($column, $id = FALSE) {
		$ci = get_instance();
		$user = $ci->ion_auth->user($id)->row();
		return $user->$column;
	}

	public function getCustomerdata($customernumber, $column) {
		$ci = get_instance();
		$dbAsw = $ci->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_customernumber'), $customernumber);
		$return = $dbAsw->get(param('param_asw_database_table_customer'))->row();
		return $return->$column;
	}

	public function getLang($short = FALSE, $language = FALSE, $id = FALSE) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		if ($language) {
			$dbDefault->select($language);
		} else {
			$language = $this->getUserdata('lang');
		};

		if ($id == FALSE && $short != FALSE) {
			$dbDefault->where('short', $short);
		} elseif ($id != FALSE) {
			$dbDefault->where('id', $id);
		};

		$result = $dbDefault->get('language')->row();

		return $result->$language;
	}

	public function getMailText($short, $language) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$dbDefault->select($language);
		$dbDefault->where('short', $short);
		$result = $dbDefault->get('mailtext')->row();
		return $result->$language;
	}

	public function getUserGroups() {
		$ci = get_instance();
		$groups = $ci->ion_auth->groups()->result();
		foreach ($groups as $group) {
			$return[$group->id] = $group->description;
		}

		return $return;
	}

	public function getUserGroup($id) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$dbDefault->where('user_id', $id);
		$return = $dbDefault->get('users_groups')->result();

		return $return[0];
	}

	public function getPermission($permission_name) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$dbDefault->where('name', $permission_name);
		$return = $dbDefault->get('permissions')->result();

		return $return[0];
	}

	public function getPermissionsGroups($permission_name) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);

		$permission_id = $this->getPermission($permission_name)->id;

		if ($permission_id != FALSE) {
			$groups = $dbDefault->select('group_id')
					->where('permissions_id', $permission_id)
					->get('permissions_groups')
					->result_array();

			if (empty($groups)) {
				$groups_array = array();
			} else {
				foreach ($groups as $group) {
					$groups_array[] = $group['group_id'];
				};
			}
		} else {
			$groups_array = array();
		};

		return $groups_array;
	}

	public function getDepartments($lang = FALSE) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$departments = $dbDefault->get('departments')->result();

		foreach ($departments as $department) {
			$return[$department->asw_field] = $this->getLang('department_' . $department->name, $lang);
		}

		return $return;
	}

	public function getContactypes($name = FALSE) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);

		if ($name) {
			$dbDefault->where('name', $name);
		}

		$results = $dbDefault->get('contacttypes')->result();
		foreach ($results as $result) {
			$return[$result->name] = $result->description;
		}

		return $return;
	}

	public function dbConAsw() {
		$connection = odbc_connect(param('param_asw_database_host'), param('param_asw_database_username'), param('param_asw_database_password')) or die('Connection failed!');
		return $connection;
	}

	public function listDepartments($contact) {
		$departments = array(
			'general' => $this->getDepartmentLang('department_general', $contact[param('param_asw_database_column_contact_general')]),
			'billing' => $this->getDepartmentLang('department_billing', $contact[param('param_asw_database_column_contact_billing')]),
			'order' => $this->getDepartmentLang('department_order', $contact[param('param_asw_database_column_contact_order')]),
			'purchase' => $this->getDepartmentLang('department_purchase', $contact[param('param_asw_database_column_contact_purchase')]),
			'transport' => $this->getDepartmentLang('department_transport', $contact[param('param_asw_database_column_contact_transport')]),
			'packing' => $this->getDepartmentLang('department_packing', $contact[param('param_asw_database_column_contact_packing')]),
			'quality' => $this->getDepartmentLang('department_quality', $contact[param('param_asw_database_column_contact_quality')]),
		);

		return $departments;
	}

	public function getDepartmentLang($department, $state) {
		if ($state != 0) {
			$return = $this->getLang($department);
		} else {
			$return = FALSE;
		}

		return $return;
	}

	public function newId() {
		$ci = get_instance();
		$dbAsw = $ci->load->database('asw', TRUE);

		$dbAsw->select_max(param('param_asw_database_column_contact_id'));
		$query = $dbAsw->get(param('param_asw_database_table_contact'))->result_array();
		$return = $query[0][param('param_asw_database_column_contact_id')] + 1;

		return $return;
	}

	public function sendMail($type, $subject, $content = array('custom' => FALSE, 'short' => FALSE), $lang, $to, $from = FALSE, $extra = FALSE) {
		$ci = & get_instance();

		$ci->load->library('email');
		$ci->email->set_crlf("\r\n");

		$config['protocol'] = 'SMTP';
		$config['mailtype'] = 'html';
		$config['newline'] = '\n';
		$ci->email->initialize($config);

		if ($from) {
			$ci->email->from(param('param_mailhost'), $from);
		} else {
			$ci->email->from(param('param_mailhost'), $this->getUserdata('first_name') . ' ' . $this->getUserdata('last_name') . ' @ ' . param('param_company_name'));
		}
		$ci->email->to($to);
		$ci->email->reply_to($this->getUserdata('email'));
		$ci->email->bcc($this->getUserdata('email'));

		$mail = ($content['custom']) ? $content['custom'] : $this->getMailText($content['short'], $lang);
		$message = $this->mailHead($lang) . '<div id="content">' . $mail . '</div>' . $this->mailFooter($lang);

		$ci->email->subject($subject);
		$ci->email->message($message);

		if ($ci->email->send()) {
			$email = ($from) ? $from : $this->getUserdata('email');
			if ($this->set_return_to_sender($email, $type, $extra)) {
				return TRUE;
			};
		};
	}

	public function mailHead($lang) {
		return '<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html" charset="utf-8"><meta name=Generator content="Siebel for Aliplast"><meta name=Developer content="Jens De Schrijver">
				<style>
					/* Font Definitions */
				   @font-face{font-family: "Century Gothic";panose-1:2 11 5 2 2 2 2 2 2 4;mso-font-charset:0;mso-generic-font-family:swiss;mso-font-pitch:variable;mso-font-signature:647 0 0 0 159 0;}
				   /* Style Definitions */
				   body{padding: 20px;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
				   .normal, p.normal, li.normal, div.normal{mso-style-unhide:no;mso-style-qformat:yes;mso-style-parent:"";margin:0cm;margin-bottom:.0001pt;mso-pagination:widow-orphan;font-size:11.0pt;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;mso-bidi-font-family:"Times New Roman";mso-fareast-language:EN-US;}
				   p{margin: 0 0 15px 0;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
				   hr{color:#BFBFBF; border-bottom:solid #BFBFBF 1.0pt; border-left: none; border-right: none; border-top: none; width: 100%; margin-top: 50px;text-align: left;}
				   .footer, .footer p {color: #7F7F7F;font-size: 10.0pt;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
				   .footer a {color: #7F7F7F;text-decoration: none;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
				   table td{min-height: 12.35pt;border: none;padding: 0 5.4pt 0 5.4pt;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
				   table td.leftcolumn{border-right:solid #BFBFBF 1.0pt;width:121.9pt; font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
				   b{font-weight: bold;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
				</style>
			</head>
			<body class="normal"><div><div id="header"><p><b>' . $this->getMailText('greeting', $lang) . '</b></p></div>';
	}

	public function mailFooter($lang) {
		return '<div id="footer"><hr />
			<table border=0 cellspacing=0 cellpadding=0 width="100%" style="width:100%; border-collapse:collapse;" class="footer">
				<tr>
					<td valign="top" class="leftcolumn"><b>' . $this->getUserdata('first_name') . ' ' . $this->getUserdata('last_name') . '</b></td>
					<td valign="bottom"><b>' . $this->getMailText('thanks', $lang) . '</b> <span style="float:right; font-style: italic; text-align:right;">Think before you <img width=20 height=20 src="http://customer.aliplast.com/vp/public/img/mail_green_print.png" alt="">print</span></td>
				</tr><tr>
					<td valign="top" class="leftcolumn"><img border=0 width=113 height=24 src="http://customer.aliplast.com/vp/public/img/mail_logo_aliplast.jpg" alt="' . param('param_company_name') . '" style="margin-top:5px;"></td>
					<td valign="top">' . $this->getUserdata('company') . ' <br/>' . param('param_company_address') . ' &#124; ' . param('param_company_location') . ' <br /><a href="mailto:' . $this->getUserdata('email') . '">M: ' . $this->getUserdata('email') . '</a> &#124; <a href="tel:' . $this->getUserdata('phone') . '">T: ' . $this->getUserdata('phone') . '</a> &#124; F: ' . param('param_company_fax') . '</td>
				</tr>
			</table></div></div></body></html>';
	}

	public function newContactMail($customerNo, $lang, $md5) {
		$url = 'http://customer.aliplast.com/vp/siebel/index.php/newcustomer/' . $customerNo . '/' . $lang . '/' . $md5;
		$return = $this->getMailText('newcontact', $lang);
		$return .= '<p><a href="' . $url . '">' . $url . '</a></p>';

		return $return;
	}

	/*
	  public function emailTo($state) {
	  $ci =& get_instance();
	  $ci->db->select('user_id');
	  $ci->db->where('state_id', $state);
	  $state_ids = $ci->db->get('email_users')->result_array();

	  $users = '';
	  foreach($state_ids as $user_id) {
	  $user = $ci->ion_auth->user($user_id['user_id'])->row();
	  $users .= $user->email .', ';
	  }

	  return $users;
	  }
	 */

	/*
	 * If a new contact (customer) enterd its contacts, this function will check which types are set and which aren't.
	 */

	public function checkNewContactTypes($contacts) {
		// Basic values
		$columns = array(
			'RETGEN' => 0,
			'RETBIL' => 0,
			'RETORD' => 0,
			'RETPUR' => 0,
			'RETRAN' => 0,
			'RETPAC' => 0,
			'RETQUA' => 0,
		);

		// Check for each contact if the value is set to 1 or not.
		// If is set to 1, then change the basic value to 1.
		foreach ($contacts as $contact) {
			$keys = array('RETGEN', 'RETBIL', 'RETORD', 'RETPUR', 'RETRAN', 'RETPAC', 'RETQUA');
			foreach ($keys as $key) {
				if ($contact[$key] == 1) {
					$columns[$key] = 1;
				}
			}
		}

		// Unset the values which are 0
		foreach ($columns as $key => $value) {
			if ($value == 1) {
				unset($columns[$key]);
			}
		}

		// Reverse values
		foreach ($columns as $key => $value) {
			$columns[$key] = 1;
		}

		return $columns;
	}

	public function firstContact($customerNo) {
		$ci = get_instance();
		$dbContact = $ci->load->database('contact', TRUE);
		$dbContact->where(param('param_asw_database_column_contact_customernumber'), $customerNo);
		$dbContact->where(param('param_asw_database_column_contact_general'), 1);
		$dbContact->order_by(param('param_asw_database_column_contact_id'), 'asc');
		$return = $dbContact->get(param('param_asw_database_table_contact'))->result();

		if (empty($return)) {
			$dbContact->where(param('param_asw_database_column_contact_customernumber'), $customerNo);
			$dbContact->order_by(param('param_asw_database_column_contact_id'), 'asc');
			$return = $dbContact->get(param('param_asw_database_table_contact'))->result();
		}

		return $return[0];
	}

	public function set_return_to_sender($email, $type, $extra = FALSE) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$data = array(
			'email' => $email,
			'type' => $type,
			'extra' => $email
		);
		if ($dbDefault->insert('return_to_sender', $data)) {
			return TRUE;
		};
	}

	public function get_return_to_sender($type, $extra = FALSE) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);

		$dbDefault->where('type', $type);
		if ($extra) {
			$dbDefault->where('extra', $extra);
		}
		$dbDefault->order_by('date', 'desc');
		$return = $dbDefault->get('return_to_sender')->result();

		return $return[0];
	}

	public function getCommentsCategories($id = FALSE) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);

		if ($id) {
			$dbDefault->where('id', $id);
		}

		$dbDefault->order_by('id', 'asc');
		$return = $dbDefault->get('comments_categories')->result();

		return $return;
	}
	
	public function getCategoriesAsWidgetsArray()
	{
		$comments = $this->getCommentsCategories();
		$array = array();
		foreach ($comments as $comment)
		{
			$array['comments__'.$comment->id] = Array('comments', $comment->id);
		}
		
		return $array;
	}

	public function getCommentsCategoriesLang($slug) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$dbDefault->where('short', $slug);
		$return = $dbDefault->get('language')->row();

		return $return;
	}

	// Hourset
	public function hourSet($type) {
		if ($type == 'am') {
			return array(
				'00:00' => '00:00', '00:15' => '00:15', '00:30' => '00:30', '00:45' => '00:45',
				'01:00' => '01:00', '01:15' => '01:15', '01:30' => '01:30', '01:45' => '01:45',
				'02:00' => '02:00', '02:15' => '02:15', '02:30' => '02:30', '02:45' => '02:45',
				'03:00' => '03:00', '03:15' => '03:15', '03:30' => '03:30', '03:45' => '03:45',
				'04:00' => '04:00', '04:15' => '04:15', '04:30' => '04:30', '04:45' => '04:45',
				'05:00' => '05:00', '05:15' => '05:15', '05:30' => '05:30', '05:45' => '05:45',
				'06:00' => '06:00', '06:15' => '06:15', '06:30' => '06:30', '06:45' => '06:45',
				'07:00' => '07:00', '07:15' => '07:15', '07:30' => '07:30', '07:45' => '07:45',
				'08:00' => '08:00', '08:15' => '08:15', '08:30' => '08:30', '08:45' => '08:45',
				'09:00' => '09:00', '09:15' => '09:15', '09:30' => '09:30', '09:45' => '09:45',
				'10:00' => '10:00', '10:15' => '10:15', '10:30' => '10:30', '10:45' => '10:45',
				'11:00' => '11:00', '11:15' => '11:15', '11:30' => '11:30', '11:45' => '11:45',
				'12:00' => '12:00', '12:15' => '12:15', '12:30' => '12:30', '12:45' => '12:45',
				'13:00' => '13:00'
			);
		} elseif ($type == 'pm') {
			return array(
				'11:00' => '11:00', '11:15' => '11:15', '11:30' => '11:30', '11:45' => '11:45',
				'12:00' => '12:00', '12:15' => '12:15', '12:30' => '12:30', '12:45' => '12:45',
				'13:00' => '13:00', '13:15' => '13:15', '13:30' => '13:30', '13:45' => '13:45',
				'14:00' => '14:00', '14:15' => '14:15', '14:30' => '14:30', '14:45' => '14:45',
				'15:00' => '15:00', '15:15' => '15:15', '15:30' => '15:30', '15:45' => '15:45',
				'16:00' => '16:00', '16:15' => '16:15', '16:30' => '16:30', '16:45' => '16:45',
				'17:00' => '17:00', '17:15' => '17:15', '17:30' => '17:30', '17:45' => '17:45',
				'18:00' => '18:00', '18:15' => '18:15', '18:30' => '18:30', '18:45' => '18:45',
				'19:00' => '19:00', '19:15' => '19:15', '19:30' => '19:30', '19:45' => '19:45',
				'20:00' => '20:00', '20:15' => '20:15', '20:30' => '20:30', '20:45' => '20:45',
				'21:00' => '21:00', '21:15' => '21:15', '21:30' => '21:30', '21:45' => '21:45',
				'22:00' => '22:00', '22:15' => '22:15', '22:30' => '22:30', '22:45' => '22:45',
				'23:00' => '23:00', '23:15' => '23:15', '23:30' => '23:30', '23:45' => '23:45',
				'23:59' => '23:59'
			);
		}
	}

	public function getDeliveryCountries() {
		$ci = get_instance();
		$dbAsw = $ci->load->database('asw', TRUE);
		$dbAsw->select(param('param_asw_database_column_deliveryaddress_country'));
		$dbAsw->where(param('param_asw_database_column_deliveryaddress_cuno') . ' Like ', 'MB%');
		$results = $dbAsw->get(param('param_asw_database_table_deliveryaddress'))->result_array();

		$countries = array();
		foreach ($results as $result) {
			foreach ($result as $key => $value) {
				$value = trim(strtoupper($value));
				$countries[$value] = $value;
			}
		}

		return array_unique($countries);
	}

	public function getPriceUnit($id) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		$result = $dbDefault->get('priceunits')->result();
		return $result[0];
	}

	public function getDropdownValues($table, $key = 'id', $value = 'short') {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$results = $dbDefault->get($table)->result();
		foreach ($results as $result) {
			$group[$result->$key] = $result->$value;
		}
		return $group;
	}

	public function getPriceType($id) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		$result = $dbDefault->get('pricetypes')->result();
		return $result[0];
	}

	public function date_to_mysql($date) {
		$date = explode('/', $date);
		return $date[2] . $date[1] . $date[0] . '000000';
	}

	public function date_to_mysql_human($date) {
		$date = explode('/', $date);
		return $date[2] . '-' . $date[1] . '-' . $date[0] . ' 00:00:00';
	}

	public function formula_to_array($formula) {
		$formula = explode('||', $formula);

		foreach ($formula as $field) {
			$field = explode(':', $field);
			$fields[] = $field;
		}

		unset($fields[count($fields) - 1]);

		return $fields;
	}

	public function formula_to_plain($formula, $index = 1) {
		$plainFromula = '';

		$fields = $this->formula_to_array($formula);

		foreach ($fields as $field) {
			$plainFromula .= $field[$index] . ' ';
		}

		return $plainFromula;
	}

	public function getFormula($id) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		$result = $dbDefault->get('formulas')->result();
		return $result[0];
	}

	public function math($expression) {
		eval('$math = ' . preg_replace('/[^0-9\+\-\*\/\(\)\.]/', '', $expression) . ';');
		return $math;
	}

	public function getColumns($table) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);

		foreach ($dbDefault->list_fields($table) as $key => $value) {
			$return->$value = '';
		}

		return $return;
	}

	public function getUserDashboard() {
		
		$userDashboard = $this->getUserdata('userDashboard');
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

?>
