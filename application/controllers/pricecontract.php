<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricecontract extends CI_Controller {
	
	private $module;
	private $customernumber;
	private $id;
	
	public function __construct()
	{
		// load Controller constructor
		parent::__construct();
		$this->module = get_class();
		$this->customernumber = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';
		$this->id = ($this->uri->segment(4)) ? $this->uri->segment(4) : '';
		
		// Check if the current logged in user is permitted
		/*
		if(!is_permitted('View overview')) {
			redirect('auth/login', 'refresh');
		};
		 */
		
		// load the model we will be using
		$this->load->model('pricecontract_model');
		$this->load->model('domain_model', 'model');
	}
	
	public function index() 
	{
		redirect(base_url());
	}
	
	public function customer() {
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		$data['module'] = $this->module;
		$data['customernumber'] = $this->customernumber;
		$data['id'] = $this->id;
		
		if(isset($this->id) && !empty($this->id)) {
			if($this->id == 'new')
			{
				$data['item'] = $this->model->getColumns();
				$data['item']->startdate = $this->siebel->date_to_mysql(date('d/m/Y', now()));
				$data['item']->enddate = $this->siebel->date_to_mysql(date('d/m/Y', now()));
			}
			else 
			{
				$data['item'] = $this->model->get($this->customernumber, $this->id);
				$data['item'] = $data['item'][0];
				
			}
			
			if(isset($_POST) && !empty($_POST)) {
				
				$saveData = $_POST;
				$saveData['date'] = $this->siebel->date_to_mysql_human($saveData['date']);
				$saveData['startdate'] = $this->siebel->date_to_mysql_human($saveData['startdate']);
				$saveData['enddate'] = $this->siebel->date_to_mysql_human($saveData['enddate']);
				$saveData['customernumber'] = $this->customernumber;
				
				if($newId = $this->model->save($this->customernumber, $this->id, $saveData)) {
					$this->session->set_flashdata('success', 'Contract saved!');
					redirect(site_url($this->module.'/customer/'.$this->customernumber.'/'.$newId), 'refresh');
				}
			}
			
			// Create fields for form
			foreach($data['item'] as $key => $value)
			{
				$data['fields']->$key = array(
					'name'  => $key,
					'id'    => $key,
					'class'    => $key,
					'type'  => 'text',
					'value' => $data['item']->$key,
				);
			}
			
		} else {
			$data['items'] = $this->pricecontract_model->addSalesOrders($this->model->get($this->customernumber));
		}
		
		// Load the general view
		$data['view'] = (isset($this->id) && !empty($this->id)) ? $this->module.'/edit' : $this->module.'/index';
		$this->load->view('DomainView', $data);
		
	}
	
	public function delete()
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$this->module = $this->uri->segment(1);
		$this->customernumber = $this->uri->segment(3);
		$this->id = $this->uri->segment(4);
		if($this->model->delete($this->id))
		{
			$this->session->set_flashdata('error', 'Deleted!');
			redirect(site_url($this->module.'/customer/'.$this->customernumber), 'refresh');
		}
	}
	
	public function toExcel($customernumber) {
		$this->module = $this->uri->segment(1);
		$this->customernumber =$customernumber;
		
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
		
		for($i = 0; $i<2; $i++) {
		
			/* index 0
			 * Simple Tab
			 * Tab with only the ocntract information
			 * -----------------------------------------------------------------
			 * 
			 */

			/* index 1
			 * Detail Tab
			 * Tab with the ocntract information and the sales order lines
			 * -----------------------------------------------------------------
			 * 
			 */

			if($i == 1) {$objPHPExcel->createSheet();}

			// Set active sheet
			$objPHPExcel	->setActiveSheetIndex($i);
			$objWorksheet = $objPHPExcel->getActiveSheet();

			// Rename worksheet
			$sheetTitle = ($i == 0) ? 'Simple' : 'Details';
			$objWorksheet	->setTitle($sheetTitle);

			// Sheet proporties
			$objWorksheet	->getPageSetup()
							->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);

			$objWorksheet	->getPageSetup()
							->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

			$objWorksheet	->getPageSetup()->setFitToPage(TRUE);
			$objWorksheet	->getPageSetup()->setFitToWidth(1);
			$objWorksheet	->getPageSetup()->setFitToHeight(0);

			$objWorksheet	->getDefaultColumnDimension()->setWidth(7.3);

			// Individual cell stypes and data
			$cell = 'A1';
			$objWorksheet	->getStyle($cell)
							->getFont()
							->getColor()
							->setARGB($green);

			$objWorksheet	->getStyle($cell)
							->getFont()
							->setSize(24);

			$objWorksheet	->getStyle($cell)
							->getFont()
							->setBold(true);

			$objWorksheet	->setCellValue($cell, $title);

			$cell = 'K1';
			$objWorksheet	->getStyle($cell)
							->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

			$objWorksheet	->getStyle($cell)
							->getFont()
							->getColor()
							->setARGB($grey);

			$objWorksheet	->setCellValue($cell, $date);

			$cell = 'K2';
			$objWorksheet	->getStyle($cell)
							->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

			$objWorksheet	->getStyle($cell)
							->getFont()
							->setSize(13);

			$objWorksheet	->getStyle($cell)
							->getFont()
							->getColor()
							->setARGB($grey);

			$objWorksheet	->setCellValue($cell, $customername.' | '.$customernumber);

			// Horizontal ruler
			$cell = 'A4:K4';
			$styleArray = array(
				'borders' => array(
					'top' => array(
						'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
						'color' => array('argb' => $grey),
					),
				),
			);

			$objWorksheet	->getStyle($cell)->applyFromArray($styleArray);

			// Set first row under the header information
			$row = 5;

			foreach ($items as $item) {
				$row += 2;

				/* Contract info */
				// First row
				// Contract number font bold 18 left green
				$cell = 'A'.$row;
				$objWorksheet	->getStyle($cell)
								->getFont()
								->setBold(TRUE);

				$objWorksheet	->getStyle($cell)
								->getFont()
								->setSize(18);

				$objWorksheet	->getStyle($cell)
								->getAlignment()
								->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

				$objWorksheet	->getStyle($cell)
								->getFont()
								->getColor()
								->setARGB($green);

				$objWorksheet	->getStyle($cell)
								->getNumberFormat()
								->setFormatCode('0000000000');

				$objWorksheet	->mergeCells('A'.$row.':E'.$row);

				$objWorksheet	->setCellValue($cell, $item->id);

				// price and starttonage font bold 11 right grey
				$cell = 'K'.$row;
				$objWorksheet	->getStyle($cell)
								->getFont()
								->setBold(TRUE);

				$objWorksheet	->getStyle($cell)
								->getFont()
								->setSize(11);

				$objWorksheet	->getStyle($cell)
								->getAlignment()
								->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

				$objWorksheet	->getStyle($cell)
								->getFont()
								->getColor()
								->setARGB($grey);

				$objWorksheet	->setCellValue($cell, $item->price .' euro - '. $item->starttonnage .' ton');

				// Second row
				$row += 1;
				// contract date font 9 left grey
				$cell = 'A'.$row;
				$objWorksheet	->getStyle($cell)
								->getFont()
								->setBold(FALSE);

				$objWorksheet	->getStyle($cell)
								->getFont()
								->setSize(9);

				$objWorksheet	->getStyle($cell)
								->getAlignment()
								->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

				$objWorksheet	->getStyle($cell)
								->getFont()
								->getColor()
								->setARGB($grey);

				$objWorksheet	->setCellValue($cell, date('d/m/Y', mysql_to_unix($item->date)));

				// price details font right grey
				$cell = 'K'.$row;
				$objWorksheet	->getStyle($cell)
								->getFont()
								->setBold(FALSE);

				$objWorksheet	->getStyle($cell)
								->getFont()
								->setSize(9);

				$objWorksheet	->getStyle($cell)
								->getAlignment()
								->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

				$objWorksheet	->getStyle($cell)
								->getFont()
								->getColor()
								->setARGB($grey);

				$objWorksheet	->setCellValue($cell, 'LME: '. $item->lme .' | Pre: '. $item->premium .' | Mup: '. ($item->price - $item->lme - $item->premium));

				/* Table header
				 * 
				 */
				$row += 1;
				// titles font bold left white background green
				$cell = 'A'.$row.':K'.$row;
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
								->setARGB($green);

				$objWorksheet	->setCellValue('A'.$row, $this->siebel->getLang('from') . ' - ' . $this->siebel->getLang('until'));
				$objWorksheet	->setCellValue('C'.$row, '');
				$objWorksheet	->setCellValue('F'.$row, ucfirst($this->siebel->getLang('total')));
				$objWorksheet	->setCellValue('H'.$row, ucfirst($this->siebel->getLang('rest')));
				$objWorksheet	->setCellValue('J'.$row, ucfirst($this->siebel->getLang('correction')));

				/* First row
				 * 
				 */
				$row += 1;
				$objWorksheet	->getStyle('C'.$row)
								->getFont()
								->setBold(TRUE);

				$objWorksheet	->getStyle('C'.$row)
								->getFont()
								->getColor()
								->setARGB($blue);

				$objWorksheet	->setCellValue('A'.$row, date('d/m/Y', mysql_to_unix($item->startdate)));
				$objWorksheet	->setCellValue('C'.$row, ucfirst($this->siebel->getLang('ordered')).' ton:');
				$objWorksheet	->getStyle('F'.$row)
								->getNumberFormat()
								->setFormatCode('0.000');
				$objWorksheet	->setCellValue('F'.$row, $item->ordertonnage);
				$objWorksheet	->getStyle('H'.$row)
								->getNumberFormat()
								->setFormatCode('0.000');
				$objWorksheet	->setCellValue('H'.$row, $item->starttonnage - $item->ordertonnage);
				$objWorksheet	->getStyle('J'.$row)
								->getNumberFormat()
								->setFormatCode('0.000');
				$objWorksheet	->setCellValue('J'.$row, $item->starttonnage - $item->ordertonnage + $item->lurk);

				/* Second row
				 * 
				 */
				$row += 1;
				$objWorksheet	->getStyle('C'.$row)
								->getFont()
								->setBold(TRUE);

				$objWorksheet	->getStyle('C'.$row)
								->getFont()
								->getColor()
								->setARGB($blue);

				$objWorksheet	->setCellValue('A'.$row, date('d/m/Y', mysql_to_unix($item->enddate)));
				$objWorksheet	->setCellValue('C'.$row, ucfirst($this->siebel->getLang('delivered')).' ton:');
				$objWorksheet	->setCellValue('F'.$row, $item->deliveredtonnage);
				$objWorksheet	->getStyle('H'.$row)
								->getNumberFormat()
								->setFormatCode('0.000');
				$objWorksheet	->setCellValue('H'.$row, $item->starttonnage - $item->deliveredtonnage);
				$objWorksheet	->getStyle('J'.$row)
								->getNumberFormat()
								->setFormatCode('0.000');
				$objWorksheet	->setCellValue('J'.$row, $item->starttonnage - $item->deliveredtonnage + $item->lurk);

				
				if($i == 1) {

					/* Sales orders
					 * --------------------------
					 */
					$sonumber = param('param_asw_database_column_soh_salesordernumber');
					$refcustomer = param('param_asw_database_column_soh_salesordernumbercostumer');
					$linenumber = param('param_asw_database_column_soline_line');
					$lineproduct = param('param_asw_database_column_soline_product');
					$lineproductref = param('param_asw_database_column_soline_product_customerreference');
					$sodate = param('param_asw_database_column_soh_date');
					$promisdate = param('param_asw_database_column_soline_promiseddate');

					foreach($item->salesorders as $salesorder) {
						$row +=2;

						/* Table header
						 * 
						 */
						$cell = 'B'.$row.':K'.$row;
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

						$objWorksheet	->setCellValue('B'.$row, ucfirst($this->siebel->getLang('salesorder')));
						$objWorksheet	->setCellValue('E'.$row, ucfirst($this->siebel->getLang('date')));
						$objWorksheet	->setCellValue('H'.$row, ucfirst($this->siebel->getLang('ordered')));
						$objWorksheet	->setCellValue('J'.$row, ucfirst($this->siebel->getLang('delivered')));

						// Second header row
						$row +=1;

						$cell = 'B'.$row.':K'.$row;
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

						$objWorksheet	->setCellValue('B'.$row, ucfirst($this->siebel->getLang('reference')));
						
						// Sales order info
						$row += 1;
						$objWorksheet	->mergeCells('B'.$row.':D'.$row);
						$objWorksheet	->getStyle('B'.$row)
										->getNumberFormat()
										->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
						$objWorksheet	->setCellValue('B'.$row, trim($salesorder->$sonumber));
						$objWorksheet	->getStyle('E'.$row)
										->getNumberFormat()
										->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
						$objWorksheet	->mergeCells('E'.$row.':G'.$row);
						$objWorksheet	->setCellValue('E'.$row, date('d/m/Y', mysql_to_unix(trim($salesorder->$sodate))));
						$objWorksheet	->getStyle('H'.$row)
										->getNumberFormat()
										->setFormatCode('0.000');
						$objWorksheet	->setCellValue('H'.$row, trim($salesorder->ordertonnage));
						$objWorksheet	->getStyle('J'.$row)
										->getNumberFormat()
										->setFormatCode('0.000');
						$objWorksheet	->setCellValue('J'.$row, trim($salesorder->deliveredtonnage));

						// Second row Sales order info
						$row += 1;
						$objWorksheet	->getStyle('B'.$row)
										->getNumberFormat()
										->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
						$objWorksheet	->mergeCells('B'.$row.':D'.$row);
						$objWorksheet	->setCellValue('B'.$row, trim($salesorder->$refcustomer));


						/* Sales order line header
						 * 
						 */
						$row += 2;
						$cell = 'B'.$row.':K'.$row;
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
										->setARGB($grey);

						$objWorksheet	->setCellValue('B'.$row, ucfirst($this->siebel->getLang('line')));
						$objWorksheet	->setCellValue('E'.$row, ucfirst($this->siebel->getLang('product')));
						$objWorksheet	->setCellValue('H'.$row, ucfirst($this->siebel->getLang('length')));
						$objWorksheet	->setCellValue('J'.$row, ucfirst($this->siebel->getLang('ordered')));

						$row += 1;
						$cell = 'B'.$row.':K'.$row;
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
										->setARGB($grey);

						$objWorksheet	->setCellValue('B'.$row, ucfirst($this->siebel->getLang('bill') . ' - ' . $this->siebel->getLang('date')));
						$objWorksheet	->setCellValue('E'.$row, ucfirst($this->siebel->getLang('reference')));
						$objWorksheet	->setCellValue('H'.$row, ucfirst($this->siebel->getLang('finish')));
						$objWorksheet	->setCellValue('J'.$row, ucfirst($this->siebel->getLang('delivered')));

						$row += 1;
						$cell = 'B'.$row.':K'.$row;
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
										->setARGB($grey);
						
						$objWorksheet	->setCellValue('B'.$row, ucfirst($this->siebel->getLang('transport') . ' - ' . $this->siebel->getLang('date')));
						$objWorksheet	->setCellValue('E'.$row, ucfirst($this->siebel->getLang('promisdate')));

						// sales order lines
						foreach($salesorder->orderlines as $orderline) {
							$backorder_line = param('param_asw_database_column_soline_backorderline');
							$backorder_line = trim($orderline->$backorder_line);
							$backorder = $backorder_line ? ' => '.$backorder_line: '';

							$row += 1;
							$objWorksheet	->getStyle('B'.$row)
											->getNumberFormat()
											->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objWorksheet	->mergeCells('B'.$row.':D'.$row);
							$objWorksheet	->setCellValue('B'.$row, trim($orderline->$linenumber).$backorder);
							$objWorksheet	->getStyle('E'.$row)
											->getNumberFormat()
											->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objWorksheet	->mergeCells('E'.$row.':G'.$row);
							$objWorksheet	->setCellValue('E'.$row, trim($orderline->$lineproduct));
							$objWorksheet	->getStyle('H'.$row)
											->getNumberFormat()
											->setFormatCode('0.000');
							$objWorksheet	->setCellValue('H'.$row, trim($orderline->length));
							$objWorksheet	->getStyle('J'.$row)
											->getNumberFormat()
											->setFormatCode('0.000');
							$objWorksheet	->setCellValue('J'.$row, trim($orderline->ordertonnage));
							
							$row += 1;
							$objWorksheet	->getStyle('B'.$row)
											->getNumberFormat()
											->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objWorksheet	->mergeCells('B'.$row.':D'.$row);
							$objWorksheet	->setCellValue('B'.$row, trim($orderline->invoice) .' - '. trim($orderline->invoicedate));
							$objWorksheet	->getStyle('E'.$row)
											->getNumberFormat()
											->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objWorksheet	->mergeCells('E'.$row.':G'.$row);
							$objWorksheet	->setCellValue('E'.$row, trim($orderline->$lineproductref));
							$objWorksheet	->getStyle('H'.$row)
											->getNumberFormat()
											->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objWorksheet	->setCellValue('H'.$row, trim($orderline->finish));
							$objWorksheet	->getStyle('J'.$row)
											->getNumberFormat()
											->setFormatCode('0.000');
							$objWorksheet	->setCellValue('J'.$row, trim($orderline->deliveredtonnage));

							$row += 1;
							$objWorksheet	->getStyle('B'.$row)
											->getNumberFormat()
											->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objWorksheet	->mergeCells('B'.$row.':D'.$row);
							$objWorksheet	->setCellValue('B'.$row, trim($orderline->transport) .' - '. trim($orderline->transportdate));
							$objWorksheet	->getStyle('E'.$row)
											->getNumberFormat()
											->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objWorksheet	->mergeCells('E'.$row.':G'.$row);
							$objWorksheet	->setCellValue('E'.$row, date('d/m/Y', mysql_to_unix(trim($orderline->$promisdate))));
							
							// Horizontal ruler
							$cell = 'B'.$row.':K'.$row;
							$styleArray = array(
								'borders' => array(
									'bottom' => array(
										'style' => PHPExcel_Style_Border::BORDER_DOTTED,
										'color' => array('argb' => $grey),
									),
								),
							);

							$objWorksheet	->getStyle($cell)->applyFromArray($styleArray);
						}

					}
				}

				$row += 2;
				// Horizontal ruler
				$cell = 'A'.$row.':K'.$row;
				$styleArray = array(
					'borders' => array(
						'top' => array(
							'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
							'color' => array('argb' => $grey),
						),
					),
				);

				$objWorksheet	->getStyle($cell)->applyFromArray($styleArray);

			}
		}



		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Save Excel 2007 file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$filename = $this->siebel->getLang('pricecontract', $lang).'_'.$customername.'_'.$customernumber.'.xlsx';
		$filename = str_replace(" ", "_", $filename);
		$file = 'public/pricecontract/'.$filename;
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

		redirect(site_url($this->module.'/customer/'.$this->customernumber), 'refresh');
	}
	
}