<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pricecontract_model extends CI_Model {

	private $table = 'pricecontract';
	private $dbDefault;

	// Constructor
	public function __construct() {
		parent::__construct();
		$this->dbDefault = $this->load->database('default', TRUE);
	}

	/*	 * ********************************************************************
	 * Other function below this section
	 */

	public function saveMultiCust($data, $id, $customernumber) {
		$dbDefault = $this->load->database('default', TRUE);

		// Delete all old records for this ID
		$dbDefault->where('pricecontract_id', $id);
		$dbDefault->delete('pricecontract_customer');

		// Save new records for the current customer number
		$saveData = array(
			'pricecontract_id' => $id,
			'customernumber' => strtoupper($customernumber)
		);
		$dbDefault->insert('pricecontract_customer', $saveData);

		// Save new records for each object in $data
		foreach ($data as $customer) {
			$saveData = array(
				'pricecontract_id' => $id,
				'customernumber' => strtoupper($customer)
			);
			$dbDefault->insert('pricecontract_customer', $saveData);
		}

		return TRUE;
	}

	public function savePrice($saveData, $customernumber, $newId) {
		$priceId = (isset($saveData['price_id']) && !empty($saveData['price_id'])) ? $saveData['price_id'] : 'new';
		if ($priceId == 0) {
			$priceId = 'new';
		}

		$saveData = array(
			'price' => $saveData['price'],
			'lme' => $saveData['lme'],
			'premium' => $saveData['premium'],
			'markup' => $saveData['price'] - $saveData['lme'] - $saveData['premium'],
			'comment' => $saveData['comment'],
			'priceunit_id' => 1,
			'prefer_priceunit_id' => 1,
			'formula_id' => '2',
			'formula_string' => 'value:Prijs||',
			'formula_data' => $saveData['price'] . '||',
			'date' => $saveData['startdate'],
			'pricecontract_id' => $newId,
			'delete' => 0
		);


		$this->load->model('prices_model');
		$newPriceId = $this->prices_model->save($saveData, $customernumber, $priceId, FALSE);

		if ($priceId == 'new') {
			$dbDefault = $this->load->database('default', TRUE);
			$dbDefault->where('id', $newId);
			$dbDefault->update('pricecontract', array('price_id' => $newPriceId));
		}


		return $newPriceId;
	}

	public function getContractById($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		$pricecontract = $dbDefault->get('pricecontract')->row();
		$pricecontract->multiCust = $this->getPricecontractCustomers($id);
		return $pricecontract;
	}

	public function getPricecontractCustomers($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('pricecontract_id', $id);
		$results = $dbDefault->get('pricecontract_customer')->result();
		$multiCust = array();
		foreach ($results as $customer) {
			$multiCust[] = $customer->customernumber;
		}
		return $multiCust;
	}

	public function listContracts($customernumber) {
		$dbDefault = $this->load->database('default', TRUE);

		// Get all contracts for this customer from the relation table
		$dbDefault->where('customernumber', $customernumber);
		$dbDefault->order_by('pricecontract_id', 'desc');
		$results = $dbDefault->get('pricecontract_customer')->result();
		$contractIds = array();
		foreach ($results as $customer) {
			$contractIds[] = $customer->pricecontract_id;
		}
		$contractIds = array_unique($contractIds);
		$contracts = array();
		foreach ($contractIds as $contractId) {
			$dbDefault->where('id', $contractId);
			$contract = $dbDefault->get('pricecontract')->row();
			if ($contract->delete == 0) {
				$contracts[] = $contract;
			}
		}

		$results = $this->addSalesOrders($contracts);

		return $results;
	}

	public function addSalesOrders($contracts) {

		foreach ($contracts as $contract) {
			$this->load->model('tonnagelist_model');
			$contract->salesorders = $this->tonnagelist_model->getSalesOrders(array(
				'contractnumber' => $contract->id
			));

			$tonnage_ordered = 0;
			$tonnage_delivered = 0;
			foreach ($contract->salesorders as $order) {
				$tonnage_ordered += $order->ordertonnage;
				$tonnage_delivered += $order->deliveredtonnage;
			}
			$contract->ordertonnage = $tonnage_ordered;
			$contract->deliveredtonnage = $tonnage_delivered;
		}
		return $contracts;
	}

	public function getPriceId($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		$result = $dbDefault->get('pricecontract')->row();
		return $result->price_id;
	}

	public function delete($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		if ($dbDefault->update('pricecontract', array('delete' => 1))) {
			$dbDefault->where('id', $this->getPriceId($id));
			if ($dbDefault->update('prices', array('delete' => 1))) {
				return TRUE;
			}
		};
	}

	public function unDelete($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		if ($dbDefault->update('pricecontract', array('delete' => 0))) {
			$dbDefault->where('id', $this->getPriceId($id));
			if ($dbDefault->update('prices', array('delete' => 0))) {
				return TRUE;
			}
		};
	}

	public function toExcel() {

		// Colors
		$black = "FF000000";
		$grey = "FF999999";
		$white = "FFFFFFFF";
		$blue = "FF5698c4";
		$green = "FF74c493";

		// Include PHPExcel
		require_once APPPATH . 'third_party/PHPExcel.php';

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator(param('param_company_name'))
				->setTitle("Overview Pricecontracts");

		// Set defauilt styles
		$objPHPExcel->getDefaultStyle()
				->getFont()
				->setName('Helvetica');
		$objPHPExcel->getDefaultStyle()
				->getFont()
				->setSize(11);
		$objPHPExcel->getDefaultStyle()
				->getFont()
				->getColor()
				->setARGB($black);
		
		
		// Print date
		$date = mdate("%d/%m/%Y", time());

		// Set active sheet
		$objPHPExcel->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet();

		$objPHPExcel->getActiveSheet()->freezePane('A3');
		$objPHPExcel->getActiveSheet()->setAutoFilter('A2:N2');

		// Rename worksheet
		$objWorksheet->setTitle('Pricecontracts');

		// Sheet proporties
		$objWorksheet->getPageSetup()
				->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		$objWorksheet->getPageSetup()
				->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

		$objWorksheet->getPageSetup()->setFitToPage(TRUE);
		$objWorksheet->getPageSetup()->setFitToWidth(1);
		$objWorksheet->getPageSetup()->setFitToHeight(0);


		// Column's width
		$objWorksheet->getDefaultColumnDimension()->setWidth(8);
		$objWorksheet->getColumnDimension('B')->setWidth(25);
		$objWorksheet->getColumnDimension('D')->setWidth(12);
		$objWorksheet->getColumnDimension('E')->setWidth(12);
		$objWorksheet->getColumnDimension('F')->setWidth(12);
		$objWorksheet->getColumnDimension('J')->setWidth(10);
		$objWorksheet->getColumnDimension('K')->setWidth(10);
		$objWorksheet->getColumnDimension('L')->setWidth(10);
		$objWorksheet->getColumnDimension('M')->setWidth(10);
		$objWorksheet->getColumnDimension('N')->setWidth(10);


		// Individual cell stypes and data
		$cell = 'A1';
		$objWorksheet->getStyle($cell)
				->getFont()
				->getColor()
				->setARGB($green);

		$objWorksheet->getStyle($cell)
				->getFont()
				->setSize(24);

		$objWorksheet->getStyle($cell)
				->getFont()
				->setBold(true);

		$objWorksheet->setCellValue($cell, 'Pricecontracts');

		$cell = 'E1';
		$objWorksheet->getStyle($cell)
				->getFont()
				->getColor()
				->setARGB($grey);

		$objWorksheet->setCellValue($cell, 'Printed: ' . $date);

		$row = 2;
		// titles font bold left white background green
		$cell = 'A' . $row . ':N' . $row;
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

		$objWorksheet->setCellValue('A' . $row, 'Customer number');
		$objWorksheet->setCellValue('B' . $row, 'Customer name');
		$objWorksheet->setCellValue('C' . $row, 'ID');
		$objWorksheet->setCellValue('D' . $row, 'Contract date');
		$objWorksheet->setCellValue('E' . $row, 'Start date');
		$objWorksheet->setCellValue('F' . $row, 'End date');
		$objWorksheet->setCellValue('G' . $row, 'Price');
		$objWorksheet->setCellValue('H' . $row, 'LME');
		$objWorksheet->setCellValue('I' . $row, 'Premium');
		$objWorksheet->setCellValue('J' . $row, 'Markup');
		$objWorksheet->setCellValue('K' . $row, 'Start tonnage');
		$objWorksheet->setCellValue('L' . $row, 'Rest (ordered)');
		$objWorksheet->setCellValue('M' . $row, 'Rest (delivered)');
		
		
		// Get contracts
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('delete', 0);
		$dbDefault->order_by('customernumber', 'asc');
		$dbDefault->order_by('id', 'desc');
		$results = $dbDefault->get('pricecontract')->result();
		$contracts = $this->addSalesOrders($results);
		
		
		foreach ($contracts as $contract) {
			
			$row += 1;
			
			$objWorksheet->getStyle('A' . $row.':N' . $row)
					->getFont()
					->getColor()
					->setARGB($black);

			if($contract->active == 1) {
				$objWorksheet->getStyle('A' . $row.':N' . $row)
						->getFont()
						->getColor()
						->setARGB($green);

			}
			if($contract->closed == 1) {
				$objWorksheet->getStyle('A' . $row.':N' . $row)
						->getFont()
						->getColor()
						->setARGB($grey);
			}

			
			$objWorksheet->setCellValue('A' . $row, $contract->customernumber);
			$objWorksheet->setCellValue('B' . $row, utf8_encode(trim($this->siebel->getCustomerdata($contract->customernumber, param('param_asw_database_column_customername')))));
			$objWorksheet->setCellValue('C' . $row, $contract->id);
			
			// Dates
			/*
			$objWorksheet->getStyle('D' . $row.':F' . $row)
					->getNumberFormat()
					->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
			 * 
			 */
			
			$contractdate = mysql_to_unix($contract->date);
			$contractdate = mdate("%d/%m/%Y", $contractdate);				
			$objWorksheet->setCellValue('D' . $row, $contractdate);
			
			$startdatedate = mysql_to_unix($contract->startdate);
			$startdatedate = mdate("%d/%m/%Y", $startdatedate);				
			$objWorksheet->setCellValue('E' . $row, $startdatedate);
			
			$enddate = mysql_to_unix($contract->enddate);
			$enddate = mdate("%d/%m/%Y", $enddate);				
			$objWorksheet->setCellValue('F' . $row, $enddate);
			
			// Prices
			$objWorksheet->getStyle('G' . $row.':J' . $row)
					->getNumberFormat()
					->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);
			
			$objWorksheet->setCellValue('G' . $row, $contract->price);
			$objWorksheet->setCellValue('H' . $row, $contract->lme);
			$objWorksheet->setCellValue('I' . $row, $contract->premium);
			$objWorksheet->setCellValue('J' . $row, ($contract->price - $contract->lme - $contract->premium));
			
			// Tonnages
			$objWorksheet->getStyle('K' . $row.':M' . $row)
					->getNumberFormat()
					->setFormatCode('# ##0.000');
			
			$objWorksheet->setCellValue('K' . $row, $contract->starttonnage);
			
			$objWorksheet->setCellValue('L' . $row, ( $contract->starttonnage - $contract->ordertonnage + $contract->lurk ));
			$objWorksheet->setCellValue('M' . $row, ( $contract->starttonnage - $contract->deliveredtonnage + $contract->lurk ));
			
			// Status
			$status = 'Toekomstig';
			$status = ($contract->active == 1) ? 'Actief' : $status;
			$status = ($contract->closed == 1) ? 'Gesloten' : $status;
			
			$objWorksheet->setCellValue('N' . $row, $status);
			
			// Comment
			if (isset($contract->comment) && !empty($contract->comment)) {
				$objWorksheet
						->getComment('G' . $row)
						->setAuthor('Siebel');
				$objCommentRichText = $objPHPExcel->getActiveSheet()
								->getComment('G' . $row)
								->getText()->createTextRun('Comment:');
				$objCommentRichText->getFont()->setBold(true);
				$objWorksheet
						->getComment('G' . $row)
						->getText()->createTextRun("\r\n");
				$objWorksheet
						->getComment('G' . $row)
						->getText()->createTextRun(strip_tags($contract->comment));
			}

			// Multicust
			$dbDefault = $this->load->database('default', TRUE);
			$dbDefault->select('customernumber');
			$dbDefault->where('pricecontract_id', $contract->id);
			$dbDefault->where('customernumber !=', $contract->customernumber);
			$multicustomers = $dbDefault->get('pricecontract_customer')->result();
			
			if (!empty($multicustomers)) {
				$objWorksheet
						->getComment('A' . $row)
						->setAuthor('Siebel');
				$objCommentRichText = $objPHPExcel->getActiveSheet()
								->getComment('A' . $row)
								->getText()->createTextRun('Multi customers:');
				$objCommentRichText->getFont()->setBold(true);
				foreach($multicustomers as $multicustomer) {
					$multicustomer = $multicustomer->customernumber;
					$objWorksheet
							->getComment('A' . $row)
							->getText()->createTextRun("\r\n");
					$objWorksheet
							->getComment('A' . $row)
							->getText()->createTextRun($multicustomer . ' ' . utf8_encode(trim($this->siebel->getCustomerdata($multicustomer, param('param_asw_database_column_customername')))));
				}
			}
		}


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Save Excel 2007 file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$filename .= 'pricecontracts.xlsx';
		$file = 'public/pricesheets/' . $filename;
		$objWriter->save($file);
		if (file_exists($file)) {
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

		return TRUE;
	}

}

/* End of file */