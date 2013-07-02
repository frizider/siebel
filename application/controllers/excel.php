<?php

/*
 * Development and design by Jens De Schrijver
 * Test controller
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Excel extends CI_Controller {

	public function __construct() {
		// load Controller constructor
		parent::__construct();
	}

	public function index() {
		
		// Include PHPExcel
		require_once APPPATH.'third_party/PHPExcel.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		$objPHPExcel	->getProperties()->setCreator(param('param_company_name'))
						->setTitle("Overview Price Contracts");
		
		// Add some data
		$objPHPExcel	->setActiveSheetIndex(0)
						->setCellValue('A1', 'Hello')
						->setCellValue('B2', 'world!')
						->setCellValue('C1', 'Hello')
						->setCellValue('D2', 'world!');
		
		//$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);
		
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Simple');
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Save Excel 2007 file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('public/test.xlsx');
		
	}

	public function toExcel($customernumber) {
		// Colors
		$black = "FF000000";
		$grey = "FF999999";
		$white = "FFFFFFFF";
		$blue = "FF5698c4";
		$green = "FF74c493";
		
		// Define basic data
		$items = $this->pricecontract_model->addSalesOrders($this->model->get($customernumber));
		$lang = strtolower($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customerlang')));
		$title = ucfirst(utf8_decode($this->siebel->getLang('pricecontract', $lang)));
		$date = mdate("%d/%m/%Y", time());
		$customername = (isset($customernumber) && !empty($customernumber)) ?  trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername'))) : '';	
		
		
		// Company Logo
		$logo_image = './assets/img/logo_aliplast_extrusion.png';
		
		// Include PHPExcel
		require_once APPPATH.'third_party/PHPExcel.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		$objPHPExcel	->getProperties()->setCreator(param('param_company_name'))
						->setTitle("Overview Price Contracts");
		
		// Add some data
		$objPHPExcel	->setActiveSheetIndex(0);
		$objPHPExcel	->getActiveSheet()->getStyle('A5')
						->getFont()->getColor()->setARGB($grey)
						->setCellValue('A5', 
								param('param_company_address') . ' - ' . 
								param('param_company_location') . ' - T: ' . 
								param('param_company_phone') . ' - F:' . 
								param('param_company_fax'));
		$objPHPExcel->setCellValue('B1', $title);
		$objPHPExcel->setCellValue('B5', $date);
		//$objPHPExcel->setCellValue('A5', );
		
		//$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);
		
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Simple');
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Save Excel 2007 file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('public/test.xlsx');
		

	}
	
}

