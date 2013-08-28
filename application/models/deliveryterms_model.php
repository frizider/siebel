<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deliveryterms_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function getTerms($cuno = FALSE, $id = FALSE) 
	{
		$dbDefault = $this->load->database('default', TRUE);
		if($cuno) {
			$dbDefault->where('customernumber', $cuno);
		}
		if($id)
		{
			$dbDefault->where('id', $id);
		}
		
		$dbDefault->where('delete', 0);
		
		$dbDefault->order_by('date', 'desc');
		$results = $dbDefault->get('deliveryterms')->result();
		return $results;
	}
	
	public function getTermsToExcel() 
	{
		$dbDefault = $this->load->database('default', TRUE);
		
		$dbDefault->where('delete', 0);
		
		$dbDefault->group_by('customernumber');
		$dbDefault->order_by('customernumber', 'asc');
		$dbDefault->order_by('date', 'desc');
		$results = $dbDefault->get('deliveryterms')->result();
		return $results;
	}
	
	public function saveTerms($cuno, $id)
	{
		$dbDefault = $this->load->database('default', TRUE);
		
		$data = $_POST;
		$data['date'] = $this->siebel->date_to_mysql_human($data['date']);
		
		if($id == 'new')
		{
			$data['customernumber'] = $cuno;
			if($dbDefault->insert('deliveryterms', $data))
			{
				return $dbDefault->insert_id();
			}
		}
		else
		{
			$dbDefault->where('id', $id);
			if($dbDefault->update('deliveryterms', $data))
			{
				return $id;
			}
		}
	}

	public function delete($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		if($dbDefault->update('deliveryterms', array('delete' => 1)))
		{
			return TRUE;
		};
	}
	
	public function unDelete($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		if($dbDefault->update('deliveryterms', array('delete' => 0)))
		{
			return TRUE;
		};
	}
	
	public function toExcel() {
		// Colors
		$black = "FF000000";
		$grey = "FF999999";
		$white = "FFFFFFFF";
		$blue = "FF5698c4";
		$green = "FF74c493";
		
		$lang = 'en';
		
		$deliveryterms = $this->getTermsToExcel();
		//dev($deliveryterms);
		
		// Include PHPExcel
		require_once APPPATH.'third_party/PHPExcel.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		$objPHPExcel	->getProperties()->setCreator(param('param_company_name'))
						->setTitle("Delivery Terms");
		
		// Set defauilt styles
		$objPHPExcel	->getDefaultStyle()
						->getFont()
						->setName('Helvetica');
		$objPHPExcel	->getDefaultStyle()
						->getFont()
						->setSize(11);
		$objPHPExcel	->getDefaultStyle()
						->getFont()
						->getColor()
						->setARGB($black);

		// Set active sheet
		$objPHPExcel	->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet();

		// Rename worksheet
		$sheetTitle = 'Delivery Terms';
		$objWorksheet	->setTitle($sheetTitle);

		// Sheet proporties
		$objWorksheet	->getPageSetup()
						->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);

		$objWorksheet	->getPageSetup()
						->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

		$objWorksheet	->getPageSetup()->setFitToPage(TRUE);
		$objWorksheet	->getPageSetup()->setFitToWidth(1);
		$objWorksheet	->getPageSetup()->setFitToHeight(0);

		$objWorksheet	->getDefaultColumnDimension()->setWidth(15);

		$row = 1;
		// titles font bold left white background green
		$cell = 'A'.$row.':E'.$row;
		$objWorksheet	->getStyle($cell)
						->getFont()
						->setBold(TRUE);

		$objWorksheet	->getStyle($cell)
						->getFont()
						->setSize(9);

		$objWorksheet	->getStyle($cell)
						->getAlignment()
						->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$objWorksheet	->getStyle($cell)
						->getFont()
						->getColor()
						->setARGB($white);

		$objWorksheet	->getStyle($cell)
						->getFill()
						->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		$objWorksheet	->getStyle($cell)
						->getFill()
						->getStartColor()
						->setARGB($blue);

		$objWorksheet	->setCellValue('A'.$row, 'Customer name');
		$objWorksheet	->setCellValue('B'.$row, 'Customer number');
		$objWorksheet	->setCellValue('C'.$row, 'Term');
		$objWorksheet	->setCellValue('D'.$row, 'Comment');
		$objWorksheet	->setCellValue('E'.$row, 'Date');

		
		
		foreach($deliveryterms as $term) {

			$row += 1;
			
			$customername = utf8_encode( trim($this->siebel->getCustomerdata($term->customernumber, param('param_asw_database_column_customername'))) );

			$objWorksheet	->setCellValue('A'.$row, $customername);
			$objWorksheet	->setCellValue('B'.$row, $term->customernumber);
			$objWorksheet	->setCellValue('C'.$row, $term->term);
			$objWorksheet	->setCellValue('D'.$row, $term->comment);
			
			$objWorksheet	->getStyle('E'.$row)
							->getNumberFormat()
							->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
			$date = mysql_to_unix($term->date);
			$objWorksheet	->setCellValue('E'.$row, PHPExcel_Shared_Date::PHPToExcel($date));
			
		}

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Save Excel 2007 file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$filename = 'deliveryterms.xlsx';
		$file = 'public/'.$filename;
		$objWriter->save($file);
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($filename));
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