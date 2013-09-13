<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Lme_model extends CI_Model {

	// Constructor
	public function __construct() {
		parent::__construct();
	}

	/*	 * ********************************************************************
	 * Other function below this section
	 */

	public function getLme($search) {
		$dbDefault = $this->load->database('default', TRUE);

		if (isset($search['date']) && !empty($search['date'])) {
			$dbDefault->where('date', $search['date']);
			unset($search['date']);
		}

		foreach ($search as $key => $value) {

			if (!empty($value)) {
				$dbDefault->like($key, $value, 'none');
			}
		}

		$dbDefault->order_by('date', 'desc');
		$dbDefault->limit(30);
		$results = $dbDefault->get('lme')->result();
		return $results;
	}

	public function getAllLme() {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->order_by('date', 'desc');
		$results = $dbDefault->get('lme')->result();
		return $results;
	}

	public function getLmeMail($search = array()) {
		$dbDefault = $this->load->database('default', TRUE);

		foreach ($search as $key => $value) {

			if (!empty($value)) {
				$dbDefault->where($key, $value);
			}
		}

		$dbDefault->where('delete', 0);

		$results = $dbDefault->get('lme_mail')->result();
		return $results;
	}

	public function save($id) {
		$dbDefault = $this->load->database('default', TRUE);

		$data = $_POST;
		$data['date'] = $this->siebel->date_to_mysql_human($data['date']);

		if ($id == 'new') {
			if ($dbDefault->insert('lme', $data)) {
				$id = $dbDefault->insert_id();
				if ($this->mailLme($data)) {
					return $id;
				}
			}
		} else {
			$dbDefault->where('id', $id);
			if ($dbDefault->update('lme', $data)) {
				return TRUE;
			}
		}
	}

	public function saveMail($id) {
		$dbDefault = $this->load->database('default', TRUE);

		$data = $_POST;

		if ($id == 'new') {
			if ($dbDefault->insert('lme_mail', $data)) {
				return $dbDefault->insert_id();
			}
		} else {
			$dbDefault->where('id', $id);
			if ($dbDefault->update('lme_mail', $data)) {
				return $id;
			}
		}
	}

	public function deleteMail($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		if ($dbDefault->delete('lme_mail')) {
			return TRUE;
		}
	}

	public function getLmeByDate($date) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('date', $date);
		$dbDefault->order_by('date', 'desc');
		$results = $dbDefault->get('lme')->row();
		return $results;
	}

	public function getColumns($table) {
		$dbDefault = $this->load->database('default', TRUE);

		foreach ($dbDefault->list_fields($table) as $key => $value) {
			$return->$value = '';
		}

		return $return;
	}

	public function mailLme($lme) {
		$this->load->model('messenger_model');

		$data['lme'] = $lme;
		$data['lang'] = 'en';

		$mails = $this->getLmeMail();
		$date = date('d/m/Y', mysql_to_unix($lme['date']));

		// Prepaire To Excel file
		$file = $this->toExcel(false);

		$this->load->library('email');
		$this->email->set_crlf("\r\n");

		$config['protocol'] = 'SMTP';
		$config['mailtype'] = 'html';
		$config['newline'] = '\n';
		$this->email->initialize($config);

		$to = array();
		foreach ($mails as $mail) {
			$to[] = $mail->email;
		}

		$this->email->clear();
		$data['id'] = $mail->id;

		//$message = 'test';
		$message = '';
		$message .= $this->load->view('mail/htmlheader', $data, TRUE);
		$message .= $this->load->view('lme/mailtxt', $data, TRUE);
		$message .= $this->load->view('mail/htmlfooter', $data, TRUE);

		$this->load->library('email');

		$this->email->from(param('param_mailhost'), $this->ion_auth->getUserdata('first_name') . ' ' . $this->ion_auth->getUserdata('last_name') . ' @ ' . param('param_company_name'));
		$this->email->to($to);
		//$this->email->to($mail->email); 

		$this->email->subject('Update LME for ' . $date);
		$this->email->message($message);

		// Attach Excel file
		$this->email->attach('public/lme.xlsx');

		$this->email->send();

		return TRUE;
	}

	public function toExcel($download = true) {
		// Colors
		$black = "FF000000";
		$grey = "FF999999";
		$greyLight = "FFCCCCCC";
		$white = "FFFFFFFF";
		$blue = "FF5698c4";
		$green = "FF74c493";

		$lang = 'en';

		$lmes = $this->getAllLme();
		$lmeSet = array();

		foreach ($lmes as $lme) {
			$year = substr($lme->date, 0, 4);
			$month = substr($lme->date, 5, 2);
			if (!array_key_exists($year, $lmeSet)) {
				$lmeSet[$year] = array();
			}

			if (!array_key_exists($month, $lmeSet[$year])) {
				$lmeSet[$year][$month] = array();
			}

			$lmeSet[$year][$month][] = $lme;
		}

		//	dev($lmeSet);

		$average = array();

		foreach ($lmeSet as $year => $lmeMonths) {

			$average[$year]['exchange'] = 0;
			$average[$year]['cash'] = 0;
			$average[$year]['mth'] = 0;
			$average[$year]['count'] = 0;


			foreach ($lmeMonths as $month => $lmeDays) {

				$average[$year]['count']++;

				$average[$year][$month] = array(
					"exchange" => 0,
					"cash" => 0,
					"mth" => 0,
					"count" => 0
				);

				foreach ($lmeDays as $lmeItem) {
					$average[$year][$month]['exchange'] += $lmeItem->exchange;
					$average[$year][$month]['cash'] += $lmeItem->cash;
					$average[$year][$month]['mth'] += $lmeItem->mth;
					$average[$year][$month]['count']++;
				}

				$average[$year][$month]['exchange'] /= $average[$year][$month]['count'];
				$average[$year][$month]['cash'] /= $average[$year][$month]['count'];
				$average[$year][$month]['mth'] /= $average[$year][$month]['count'];

				$average[$year]['exchange'] += $average[$year][$month]['exchange'];
				$average[$year]['cash'] += $average[$year][$month]['cash'];
				$average[$year]['mth'] += $average[$year][$month]['mth'];
			}

			$average[$year]['exchange'] /= $average[$year]['count'];
			$average[$year]['cash'] /= $average[$year]['count'];
			$average[$year]['mth'] /= $average[$year]['count'];
		}

		$years = array_keys($lmeSet);

		// Include PHPExcel
		require_once APPPATH . 'third_party/PHPExcel.php';

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator(param('param_company_name'))
				->setTitle("Overview LME");

		// Set defauilt styles
		$objPHPExcel->getDefaultStyle()
				->getFont()
				->setName('Helvetica');
		$objPHPExcel->getDefaultStyle()
				->getFont()
				->setSize(9);
		$objPHPExcel->getDefaultStyle()
				->getFont()
				->getColor()
				->setARGB($black);

		foreach ($lmeSet as $year => $lmeMonths) {

			// Create a new worksheet called "My Data"
			$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'LME ' . $year);

			// Attach the "My Data" worksheet as the first worksheet in the PHPExcel object
			$objPHPExcel->addSheet($myWorkSheet);

			// Set active sheet
			$objPHPExcel->setActiveSheetIndexByName('LME ' . $year);
			$objWorksheet = $objPHPExcel->getActiveSheet();

			// Rename worksheet
			//$objWorksheet	->setTitle('test');
			// Sheet proporties
			$objWorksheet->getPageSetup()
					->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);

			$objWorksheet->getPageSetup()
					->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

			$objWorksheet->getPageSetup()->setFitToPage(TRUE);
			$objWorksheet->getPageSetup()->setFitToWidth(1);
			$objWorksheet->getPageSetup()->setFitToHeight(0);

			$objWorksheet->getDefaultColumnDimension()->setWidth(15);

			$row = 1;
			// titles font bold left white background green
			$cell = 'A' . $row . ':F' . $row;
			$objWorksheet->getStyle($cell)
					->getFont()
					->setBold(TRUE);

			$objWorksheet->getStyle($cell)
					->getFont()
					->setSize(9);

			$objWorksheet->getStyle($cell)
					->getAlignment()
					->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

			$objWorksheet->getStyle($cell)
					->getFont()
					->getColor()
					->setARGB($white);

			$objWorksheet->getStyle($cell)
					->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

			$objWorksheet->getStyle($cell)
					->getFill()
					->getStartColor()
					->setARGB($blue);

			$objWorksheet->setCellValue('A' . $row, 'Date');
			$objWorksheet->setCellValue('B' . $row, 'Exchange');
			$objWorksheet->setCellValue('C' . $row, '$ Cash');
			$objWorksheet->setCellValue('D' . $row, '€ Cash');
			$objWorksheet->setCellValue('E' . $row, '$ 3 Month');
			$objWorksheet->setCellValue('F' . $row, '€ 3 Month');


			$row += 1;
			$objWorksheet->getStyle('A' . $row . ':F' . $row)
					->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

			$objWorksheet->getStyle('A' . $row . ':F' . $row)
					->getFill()
					->getStartColor()
					->setARGB($grey);

			$objWorksheet->getStyle('A' . $row . ':F' . $row)
					->getFont()
					->setBold(true);

			$objWorksheet->setCellValue('A' . $row, 'Avg ' . $year);

			$objWorksheet->getStyle('B' . $row)
					->getNumberFormat()
					->setFormatCode('# ##0.0000');

			$objWorksheet->setCellValue('B' . $row, $average[$year]['exchange']);

			$objWorksheet->getStyle('C' . $row . ':F' . $row)
					->getNumberFormat()
					->setFormatCode('# ##0.00');

			$objWorksheet->setCellValue('C' . $row, $average[$year]['cash']);
			$objWorksheet->setCellValue('D' . $row, round($average[$year]['cash'] / $average[$year]['exchange'], 2));
			$objWorksheet->setCellValue('E' . $row, $average[$year]['mth']);
			$objWorksheet->setCellValue('F' . $row, round($average[$year]['mth'] / $average[$year]['exchange'], 2));

			unset($average[$year]['exchange']);
			unset($average[$year]['cash']);
			unset($average[$year]['mth']);

			$months = array_keys($lmeMonths);

			foreach ($months as $month) {
				$row += 1;
				$objWorksheet->getStyle('A' . $row . ':F' . $row)
						->getFill()
						->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

				$objWorksheet->getStyle('A' . $row . ':F' . $row)
						->getFill()
						->getStartColor()
						->setARGB($greyLight);

				$objWorksheet->getStyle('A' . $row . ':F' . $row)
						->getFont()
						->setBold(true);

				$objWorksheet->setCellValue('A' . $row, 'Avg ' . $year . ' / ' . $month);

				$objWorksheet->getStyle('B' . $row)
						->getNumberFormat()
						->setFormatCode('# ##0.0000');

				$objWorksheet->setCellValue('B' . $row, $average[$year][$month]['exchange']);

				$objWorksheet->getStyle('C' . $row . ':F' . $row)
						->getNumberFormat()
						->setFormatCode('# ##0.00');

				$objWorksheet->setCellValue('C' . $row, $average[$year][$month]['cash']);
				$objWorksheet->setCellValue('D' . $row, round($average[$year][$month]['cash'] / $average[$year][$month]['exchange'], 2));
				$objWorksheet->setCellValue('E' . $row, $average[$year][$month]['mth']);
				$objWorksheet->setCellValue('F' . $row, round($average[$year][$month]['mth'] / $average[$year][$month]['exchange'], 2));
			}

			foreach ($lmeMonths as $lmeDays) {
				foreach ($lmeDays as $lme) {

					$row += 1;

					$date = mysql_to_unix($lme->date);
					$date = mdate("%d/%m/%Y", $date);
					$objWorksheet->setCellValue('A' . $row, $date);

					$objWorksheet->getStyle('B' . $row)
							->getNumberFormat()
							->setFormatCode('# ##0.0000');

					$objWorksheet->setCellValue('B' . $row, $lme->exchange);

					$objWorksheet->getStyle('C' . $row . ':F' . $row)
							->getNumberFormat()
							->setFormatCode('# ##0.00');

					$objWorksheet->setCellValue('C' . $row, $lme->cash);
					$objWorksheet->setCellValue('D' . $row, round($lme->cash / $lme->exchange, 2));
					$objWorksheet->setCellValue('E' . $row, $lme->mth);
					$objWorksheet->setCellValue('F' . $row, round($lme->mth / $lme->exchange, 2));
				}
			}
		}

		// Remove "Workbook" sheet
		$objPHPExcel->removeSheetByIndex(0);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Save Excel 2007 file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$filename = 'lme.xlsx';
		$file = 'public/' . $filename;
		$objWriter->save($file);
		if (file_exists($file) && $download) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . basename($filename));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}

		return $file;
	}

}

/* End of file */