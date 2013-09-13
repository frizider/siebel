<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class holidays_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function get($cuno = FALSE, $id = FALSE, $post = FALSE) {
		$dbDefault = $this->load->database('default', TRUE);
		if($cuno) {
			$dbDefault->where('customernumber', $cuno);
		}
		$dbDefault->where('delete', 0);
		if($id) {
			$dbDefault->where('id', $id);
		}
		
		if(isset($post['from']) && !empty($post['from'])) {
			$dbDefault->where('from >= ', $this->siebel->date_to_mysql($post['from']));
		}
		
		if(isset($post['until']) && !empty($post['until'])) {
			$dbDefault->where('until <= ', $this->siebel->date_to_mysql($post['until']));
		}
		
		$dbDefault->order_by('customernumber', 'asc');
		$dbDefault->order_by('from', 'desc');
		$results = $dbDefault->get('holidays')->result();
		return $results;
	}
	
	public function save($cuno, $id) 
	{
		$dbDefault = $this->load->database('default', TRUE);
		
		$data = $_POST;
		$data['from'] = $this->siebel->date_to_mysql_human($data['from']);
		$data['until'] = $this->siebel->date_to_mysql_human($data['until']);
		
		if($id == 'new')
		{
			$data['customernumber'] = $cuno;
			if($dbDefault->insert('holidays', $data))
			{
				return $dbDefault->insert_id();
			}
		}
		else
		{
			$dbDefault->where('id', $id);
			if($dbDefault->update('holidays', $data))
			{
				return $id;
			}

		}
	}
	

	public function delete($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		if($dbDefault->update('holidays', array('delete' => 1)))
		{
			return TRUE;
		};
	}
	
	public function unDelete($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		if($dbDefault->update('holidays', array('delete' => 0)))
		{
			return TRUE;
		};
	}
	public function getColumns() {
		$dbDefault = $this->load->database('default', TRUE);

		foreach ($dbDefault->list_fields('holidays') as $key => $value) {
			$return->$value = '';
		}

		return $return;
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
				->setTitle("Overview Holidays");

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
		
		$cuno = (isset($_POST['customernumber']) && !empty($_POST['customernumber'])) ? $_POST['customernumber'] : FALSE;
		$post = (isset($_POST) && !empty($_POST)) ? $_POST : FALSE;
		$holidays = $this->get($cuno, FALSE, $post);
		
		// Set active sheet
		$objPHPExcel	->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet();

		$objPHPExcel->getActiveSheet()->freezePane('A3');
		$objPHPExcel->getActiveSheet()->setAutoFilter('A2:E2');

		// Rename worksheet
		$objWorksheet->setTitle('Holidays');

		// Sheet proporties
		$objWorksheet->getPageSetup()
				->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		$objWorksheet->getPageSetup()
				->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

		$objWorksheet->getPageSetup()->setFitToPage(TRUE);
		$objWorksheet->getPageSetup()->setFitToWidth(1);
		$objWorksheet->getPageSetup()->setFitToHeight(0);


		// Column's width
		$objWorksheet->getDefaultColumnDimension()->setWidth(10);
		$objWorksheet->getColumnDimension('B')->setWidth(30);
		$objWorksheet->getColumnDimension('E')->setWidth(100);


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

		$objWorksheet->setCellValue($cell, 'Holidays');

		$row = 2;
		// titles font bold left white background green
		$cell = 'A' . $row . ':E' . $row;
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
		$objWorksheet->setCellValue('C' . $row, 'From');
		$objWorksheet->setCellValue('D' . $row, 'Until');
		$objWorksheet->setCellValue('E' . $row, 'Comment');

		foreach ($holidays as $holiday) {

			$row += 1;

			$customername = ($holiday->customernumber) ? trim($this->siebel->getCustomerdata($holiday->customernumber, param('param_asw_database_column_customername'))) : '';
			$customername = utf8_encode($customername);
			
			$date_from = mysql_to_unix($holiday->from);
			$date_from = mdate("%d/%m/%Y", $date_from);				

			$date_until = mysql_to_unix($holiday->until);
			$date_until = mdate("%d/%m/%Y", $date_until);				

			// Cell values
			$objWorksheet->setCellValue('A' . $row, $holiday->customernumber);
			$objWorksheet->setCellValue('B' . $row, $customername);
			$objWorksheet->setCellValue('C' . $row, $date_from);
			$objWorksheet->setCellValue('D' . $row, $date_until);
			$objWorksheet->setCellValue('E' . $row, $holiday->comment);

		}


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Save Excel 2007 file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$filename .= 'holidays.xlsx';
		$file = 'public/' . $filename;
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