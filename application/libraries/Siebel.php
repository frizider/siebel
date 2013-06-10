<?php

class Siebel {

	// Pull customerdata from customers-database.
	// => this function remains in Siabel library because there is no related model
	public function getCustomerdata($customernumber, $column) {
		$ci = get_instance();
		$dbAsw = $ci->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_customernumber'), $customernumber);
		$return = $dbAsw->get(param('param_asw_database_table_customer'))->row();
		return $return->$column;
	}
	
	
	
	/*
	 * Languages from database
	 */
	public function getLang($short = FALSE, $language = FALSE, $id = FALSE) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		if ($language) {
			$dbDefault->select($language);
		} else {
			$language = $ci->ion_auth->getUserdata('lang');
		};
		
		if ($id == FALSE && $short != FALSE) {
			$dbDefault->where('short', $short);
		} elseif ($id != FALSE) {
			$dbDefault->where('id', $id);
		};
		
		$result = $dbDefault->get('language')->row();
		
		return $result->$language;
	}

	public function getDepartmentLang($department, $state) {
		if ($state != 0) {
			$return = $this->getLang($department);
		} else {
			$return = FALSE;
		}

		return $return;
	}
	
	
	
	/*
	 * Prices
	 */
	public function getPriceUnit($id) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		$result = $dbDefault->get('priceunits')->result();
		return $result[0];
	}

	public function getPriceType($id) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		$result = $dbDefault->get('pricetypes')->result();
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

	public function math($expression) {
		eval('$math = ' . preg_replace('/[^0-9\+\-\*\/\(\)\.]/', '', $expression) . ';');
		return $result;
	}

	
	
	/*
	 * Date transformations
	 */
	public function date_to_mysql($date) {
		$date = explode('/', $date);
		return $date[2] . $date[1] . $date[0] . '000000';
	}

	public function date_to_mysql_human($date) {
		$date = explode('/', $date);
		return $date[2] . '-' . $date[1] . '-' . $date[0] . ' 00:00:00';
	}

	
	
	/*
	 * Price formulas transformations
	 */
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

	// Used in holidays + lme, but moved to its model
	public function getColumns($table) {
		$ci = get_instance();
		$dbDefault = $ci->load->database('default', TRUE);

		foreach ($dbDefault->list_fields($table) as $key => $value) {
			$return->$value = '';
		}

		return $return;
	}
	
}

?>
