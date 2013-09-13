<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tonnagelist_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getTonnages($array, $toexcel = TRUE) {
		$return->salesorders = $this->getSalesOrders($array);
		
		$tonnage_ordered = 0;
		$tonnage_delivered = 0;
		foreach ($return->salesorders as $order) {
			$tonnage_ordered += $order->ordertonnage;
			$tonnage_delivered += $order->deliveredtonnage;
		}
		$return->ordertonnage = $tonnage_ordered;
		$return->deliveredtonnage = $tonnage_delivered;
		
		if (isset($array['lang']) && !empty($array['lang'])) {
			$lang = $array['lang'];
		} elseif (isset($array['customernumber']) && !empty($array['customernumber'])) {
			$lang = strtolower($this->siebel->getCustomerdata($array['customernumber'], param('param_asw_database_column_customerlang')));
		} else {
			$lang = '';
		}
		//$toexcel = FALSE;
		if($toexcel) {
			$toExcel = array(
				'items' => array($return),
				'customernumber' => (isset($array['customernumber']) && !empty($array['customernumber'])) ? $array['customernumber'] : '', 
				'lang' => $lang, 
			);
			$this->toExcel($toExcel, $array);
		}
		
		return $return;
	
	}
	
	public function getSalesOrders($array) {
		
		$dbAsw = $this->load->database('asw', TRUE);
		
		if(isset($array['contractnumber']) && !empty($array['contractnumber'])) {
			$dbAsw->where(param('param_asw_database_column_soh_contractnumber'), strtoupper($array['contractnumber']));
		}
		
		if(isset($array['customernumber']) && !empty($array['customernumber'])) {
			$dbAsw->where(param('param_asw_database_column_soh_customernumber'), strtoupper($array['customernumber']));
		}
		
		if(isset($array['salesorder']) && !empty($array['salesorder'])) {
			$dbAsw->where(param('param_asw_database_column_soh_salesordernumber'), $array['salesorder']);
		}
		
		if( isset($array['from']) && !empty($array['from']) ) {
			$dbAsw->where(param('param_asw_database_column_soh_date') . ' >= ', $array['from']);
		}
		
		if( isset($array['until']) && !empty($array['until']) ) {
			$dbAsw->where(param('param_asw_database_column_soh_date') . ' <= ', $array['until']);
		}
		
		$dbAsw->where(param('param_asw_database_column_soh_type'), param('param_asw_database_column_soh_type_order'));
		$dbAsw->order_by(param('param_asw_database_column_soh_salesordernumber'), 'desc');
		$salesorders = $dbAsw->get(param('param_asw_database_table_salesorderheader'))->result();
		
		$sonumber = param('param_asw_database_column_soh_salesordernumber');
		
		foreach($salesorders as $salesorder) {
			$salesorder->orderlines = $this->getOrderLines($salesorder->$sonumber);
			
			$tonnage_ordered = 0;
			$tonnage_delivered = 0;
			foreach ($salesorder->orderlines as $orderline) {
				$tonnage_ordered += $orderline->ordertonnage;
				$tonnage_delivered += $orderline->deliveredtonnage;
			}
			$salesorder->ordertonnage = $tonnage_ordered;
			$salesorder->deliveredtonnage = $tonnage_delivered;
		}
		
		return $salesorders;
		
	}
	
	public function getOrderLines($salesorder) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_soline_state').' !=', param('param_asw_database_column_soline_state_deleted'));
		$dbAsw->where(param('param_asw_database_column_soline_order'), $salesorder);
		$dbAsw->order_by(param('param_asw_database_column_soline_line'), 'asc');
		$lines = $dbAsw->get(param('param_asw_database_table_salesorderline'))->result();
		
		foreach($lines as $line) {
			$lineInfo = $this->getLineInfo($line);
			$line->ordertonnage = $lineInfo['ordered'];
			$line->deliveredtonnage = $lineInfo['delivered'];
			$line->length = $lineInfo['length'];
			$line->finish = $lineInfo['finish'];
			$line->invoice = $lineInfo['invoice'];
			$line->invoicedate = $lineInfo['invoicedate'];
			$line->transport = $lineInfo['transport'];
			$line->transportdate = $lineInfo['transportdate'];
		}
		
		return $lines;
		
	}
	
	public function getLineInfo($salesorder) {

		/*
		SELECT SRBSOL.OLSTAT, SRBSOL.OLORDS, SRBSOL.OLORNO, SRBSOL.OLLINE, SRBSOL.OLORLI, SRBSOL.OLROLI, SRBSOL.OLORDT,     
		SRBSOL.OLPRDC, SRBSOL.OLOQTY, SRBSOL.OLPQTY, SRBSOL.OLCQTY, SRBSOL.OLROCO , SRBSOL.pgprcl
		FROM srbsol 
		join srbprg on olprdc = pgprdc 
		join srbpru on pgprdc = pjprdc and pjunit = pgstun                                          
		*/
		
		// Some variables
		$so = param('param_asw_database_column_soline_order');
		$so = trim($salesorder->$so);
		$soline = param('param_asw_database_column_soline_line');
		$soline = trim($salesorder->$soline);
		$original_line = param('param_asw_database_column_soline_originalline');
		$original_line = trim($salesorder->$original_line);
		$backorder_line = param('param_asw_database_column_soline_backorderline');
		$backorder_line = trim($salesorder->$backorder_line);
		$product = param('param_asw_database_column_soline_product');
		$product = trim($salesorder->$product);
		$unit = param('param_asw_database_column_soline_unit');
		$unit = strtoupper(trim($salesorder->$unit));
		$ordered_quantity = param('param_asw_database_column_soline_quantity_order_primary');
		$ordered_quantity = trim($salesorder->$ordered_quantity);
		$delivered_quantity = param('param_asw_database_column_soline_quantity_confirmed');
		$delivered_quantity = trim($salesorder->$delivered_quantity); // in pieces
		$status = param('param_asw_database_column_soline_status');
		$status = trim($salesorder->$status);

		// get length and color
		$length_color = $this->getLengthAndColor($so, $soline);
		$length = $length_color['length'];
		$color_inside = $length_color['color_inside'];
		$color_outside = $length_color['color_outside'];
		
		// get item class and unit
		$item = $this->getItem($product);
		$item_pgstun = trim($item['PGSTUN']);
		$item_class = trim($item['PGPRCL']);

		// get weight
			// reg ex for S, P or C products	=>	/.+\/.+\/.+/
		if(preg_match('/.+\/.+\/.+/', $product)) {
			$weight_piece = $this->getItemWeight($product);
		} elseif(preg_match('/^PAL/', strtoupper($product))) {
			$weight = $this->getWeight($so, $soline);
			$weight_piece = ($item_class == 3) ? $weight['weight']*$length : $weight['weight'];
		} else {
			$weight = array(
				'weight' => 1,
				'totalweight' => 1
			);
			$weight_piece = 1;
		}
		
		// Get quantities
		if($status >= 45) {
			//$delivered_quantity = $ordered_quantity; // in $unit
			
			if($original_line == 0 || $original_line == $soline) {
				if($backorder_line == 0 || $backorder_line == $soline) {
	/* Set OK !! */
					$ordered_quantity =  $this->getQuantity($so, $soline);
				} else {
	/* Set OK !! */
					$ordered_quantity =  $this->getQuantity($so, $backorder_line);
				}
			} else {
				$ordered_quantity = 0;
			}
			//$ordered_quantity =  ($original_line == 0 || $original_line == $soline) ? $this->getManufacturingQuantity($so, $soline, $product) : $this->getManufacturingQuantity($so, $backorder_line, $product); // in pieces
			//$ordered_quantity =  ($backorder_line == 0 || $backorder_line == $soline) ? $this->getManufacturingQuantity($so, $soline, $product) : $this->getManufacturingQuantity($so, $backorder_line, $product); // in pieces
			
			// Convert to weight
			//$ordered_quantity *= $weight_piece;
			$delivered_quantity = $delivered_quantity * $weight_piece;			
			//$delivered_quantity *= ($unit == 'KG') ? 1 : $weight_piece;
		} else {
			$ordered_quantity = ($original_line == 0 || $original_line == $soline) ? $ordered_quantity : 0; // in $unit
			$delivered_quantity = $delivered_quantity;
			// Convert to weight
			if(preg_match('/.+\/.+\/.+/', $product)) {
				$ordered_quantity *= ($unit == 'KG') ? 1 : $weight_piece;
				//$ordered_quantity = ($unit == 'LGT') ? $weight['totalweight'] : $ordered_quantity;
			} else {
				$ordered_quantity *= ($unit == 'KG') ? 1 : $weight_piece;
				$ordered_quantity = ($unit == 'LGT') ? $weight['totalweight'] : $ordered_quantity;
			}
			$ordered_quantity = ($original_line == 0 || $original_line == $soline) ? $ordered_quantity : 0; // in $unit
			$delivered_quantity *= $weight_piece;
		}
		
		
		// final calculation: convert from kilo to ton and round the output
		$ordered_ton = round($ordered_quantity / 1000, 3);
		$delivered_ton = round($delivered_quantity / 1000, 3);
		
		// Reset very small ammounts to 0.
		$ordered_ton = ($ordered_ton <= 0.001) ? 0 : $ordered_ton;
		$delivered_ton = ($delivered_ton <= 0.001) ? 0 : $delivered_ton;
		
		// Invoice info
		$invoiceData = $this->getInvoice($so, $soline);
		if(!empty($invoiceData)) {
			$invoice = $invoiceData[param('param_asw_database_column_invoice_number')];
			$invoicedate = $invoiceData[param('param_asw_database_column_invoice_date')];
			$invoicedate =  date('d/m/Y', mysql_to_unix($invoicedate));
		} else {
			$invoice = '';
			$invoicedate = '';
			$invoicedate =  '';
		}
		
		// Transport info
		$transport = param('param_asw_database_column_soline_transport');
		$transport = trim($salesorder->$transport);
		$transport = ($transport == 0) ? '' : $transport;
		$transportdate = param('param_asw_database_column_soline_transportdate');
		$transportdate = trim($salesorder->$transportdate);
		$transportdate =  date('d/m/Y', mysql_to_unix($transportdate));
		$transportdate = ($transport == 0) ? '' : $transportdate;
		
		// return array of quantities ant lenght
		if(preg_match('/.+\/.+\/.+/', $product) || preg_match('/^PAL/', strtoupper($product))) {
			$return = array(
				"ordered" => $ordered_ton, 
				"delivered" => $delivered_ton,
				"length" => $length,
				"finish" => $color_inside . ' ' . $color_outside,
				"invoice" => $invoice,
				"invoicedate" => $invoicedate,
				"transport" => $transport,
				"transportdate" => $transportdate
			);
		} else {
			$return = array(
				"ordered" => 0, 
				"delivered" => 0,
				"length" => $length,
				"finish" => $color_inside . ' ' . $color_outside,
				"invoice" => $invoice,
				"invoicedate" => $invoicedate,
				"transport" => $transport,
				"transportdate" => $transportdate
			);
		}
		return $return;
		
	}
	
	public function getLengthAndColor($so, $soline) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_sol_details_order'), $so);
		$dbAsw->where(param('param_asw_database_column_sol_details_line'), $soline);
		$results = $dbAsw->get(param('param_asw_database_table_salesorderline_details'))->result_array();
		if(!empty($results)) {
			$return = array(
				"length" => trim($results[0][param('param_asw_database_column_sol_details_lenght')]),
				"color_inside" => trim($results[0][param('param_asw_database_column_sol_details_color_inside')]),
				"color_outside" => trim($results[0][param('param_asw_database_column_sol_details_color_outside')]),
			);
		} else {
			$return = array(
				"length" => 0,
				"color_inside" => 0,
				"color_outside" => 0,
			);
		}
		
		return $return;
	}
	
	public function getWeight($so, $soline) {
		
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_orderweight_salesorder'), $so);
		$dbAsw->where(param('param_asw_database_column_orderweight_soline'), $soline);
		$results = $dbAsw->get(param('param_asw_database_table_orderweight'))->result_array();
		
		if(!empty($results)) {
			$result = $results[0];

			$totalWeight = $result[param('param_asw_database_column_orderweight_totalweight')];
			$quantity = $result[param('param_asw_database_column_orderweight_quantity')];
			$length = $result[param('param_asw_database_column_orderweight_length')];

			$weight = ($totalWeight == 0) ? 0 : $totalWeight/$quantity/$length;

			return array(
				'weight' => $weight,
				'totalweight' => $totalWeight
				);
		} else {
			return array(
				'weight' => 1,
				'totalweight' => 1
				);
		}
		
	}

	public function getItemWeight($product) {
		
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_pal_details_item'), $product);
		$dbAsw->where(param('param_asw_database_column_pal_details_unit'), 'LGT');
		$results = $dbAsw->get(param('param_asw_database_table_pal_details'))->result_array();
		
		if(!empty($results)) {
			$result = $results[0];
			return $result[param('param_asw_database_column_pal_details_weight')];
		} else {
			return 0;
		}
		
	}

	public function getItem($olprdc) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where('PGPRDC', $olprdc);
		$results = $dbAsw->get('SRBPRG')->result_array();

		$return = $results[0];
		return $return;
	}
	
	public function getInvoice($so, $soline) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_invoice_salesorder'), $so);
		$dbAsw->where(param('param_asw_database_column_invoice_salesorder_line'), $soline);
		$results = $dbAsw->get(param('param_asw_database_table_invoice'))->result_array();

		if(!empty($results)) {
			$return = $results[0];
		} else {
			$return = '';
		}
		return $return;
	}
	
	public function getManufacturingQuantity($so, $soline, $product) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_manuf_salesorder'), $so);
		$dbAsw->where(param('param_asw_database_column_manuf_salesorderline'), $soline);
		$dbAsw->where(param('param_asw_database_column_manuf_product'), $product);
		$results = $dbAsw->get(param('param_asw_database_table_manufacturing'))->result_array();

		if(!empty($results)) {
			$return = $results[0][param('param_asw_database_column_manuf_quantity')];
		} else {
			$return = '';
		}
		return $return;		
	}

	public function getQuantity($so, $soline) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_ext_wght_salesorder'), $so);
		$dbAsw->where(param('param_asw_database_column_ext_wght_salesorderline'), $soline);
		$results = $dbAsw->get(param('param_asw_database_table_extrusion_wght'))->result_array();

		if(!empty($results)) {
			$return = $results[0][param('param_asw_database_column_ext_wght_weight')];
		} else {
			$return = '';
		}
		return $return;		
	}

	public function toExcel($array, $post = FALSE) {
		/*
		 $array = array(
			'items' => '',
			'customernumber' => '', 
			'lang' => '', 
			'contractsActive' => '', 
		 );
		 */
		$customernumber = (isset($array['customernumber']) && !empty($array['customernumber'])) ? $array['customernumber'] : '';
		$items = $array['items'];
		
		// Colors
		$black = "FF000000";
		$grey = "FF999999";
		$white = "FFFFFFFF";
		$blue = "FF5698c4";
		$green = "FF74c493";
		
		/* Define basic data
		 * 
		 */
		
		// Lang
		if(isset($array['lang']) && !empty($array['lang'])) {
			$lang = trim(strtolower($array['lang']));
		} else {
			$user = $this->ion_auth->user()->row();
			$lang = trim(strtolower($user->lang));
		}
		
		// Title
		if(isset($array['contractsActive']) && !empty($array['contractsActive'])) {
			$title = ucfirst(utf8_decode($this->siebel->getLang('pricecontract', $lang)));
		} else {
			$title = ucfirst(utf8_decode($this->siebel->getLang('tonnagelist', $lang)));
		}
		
		// Print date
		$date = mdate("%d/%m/%Y", time());
		
		// Customername
		$customername = ($customernumber) ?  trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername'))) : '';	
		
		// Include PHPExcel
		require_once APPPATH.'third_party/PHPExcel.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		$objPHPExcel	->getProperties()->setCreator(param('param_company_name'))
						->setTitle("Tonnagelist");
		
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

			if(isset($post) && !empty($post)) {
				$dateFromUntil = '';
				if( isset($post['from']) && !each($post['from']) ) {
					$dateFromUntil .= $this->siebel->getLang('from') . ' ' . substr($post['from'], 6, 2) . '/' . substr($post['from'], 4, 2) . '/' . substr($post['from'], 0, 4) . ' ';
				}
				if( isset($post['until']) && !each($post['until']) ) {
					$dateFromUntil .= $this->siebel->getLang('until') . ' ' . substr($post['until'], 6, 2) . '/' . substr($post['until'], 4, 2) . '/' . substr($post['until'], 0, 4) . ' ';
				}
				$cell = 'A2';
				$objWorksheet	->getStyle($cell)
								->getFont()
								->getColor()
								->setARGB($grey);

				$objWorksheet	->setCellValue($cell, $dateFromUntil);
			}

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
				
				if(isset($array['contractsActive']) && !empty($array['contractsActive'])) {
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
									->setFormatCode('0000');

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

					/* Third row
					 * Only if there is a comment
					 */
					if(!empty($item->comment)) {
					$row += 2;
						$objWorksheet	->getStyle('A'.$row)
										->getFont()
										->setBold(TRUE);

						$objWorksheet	->getStyle('A'.$row)
										->getFont()
										->getColor()
										->setARGB($blue);

						$objWorksheet	->mergeCells('C'.$row.':K'.$row);

						$objWorksheet	->getStyle('C'.$row)->getAlignment()->setWrapText(true);

						$objWorksheet	->setCellValue('A'.$row, ucfirst($this->siebel->getLang('comment')));
						$comment = $item->comment;
						$comment = str_replace('<strong>', '&"-,Bold"', $comment);
						$comment = str_replace('</strong>', '', $comment);

						$objWorksheet	->setCellValue('C'.$row, $comment);

					}
				}
				else {
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

					$objWorksheet	->setCellValue('F'.$row, ucfirst($this->siebel->getLang('total')));

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

					$objWorksheet	->setCellValue('C'.$row, ucfirst($this->siebel->getLang('ordered')).' ton:');
					$objWorksheet	->getStyle('F'.$row)
									->getNumberFormat()
									->setFormatCode('0.000');
				$objWorksheet	->setCellValue('F'.$row, $items[0]->ordertonnage);

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

					$objWorksheet	->setCellValue('C'.$row, ucfirst($this->siebel->getLang('delivered')).' ton:');
					$objWorksheet	->getStyle('F'.$row)
									->getNumberFormat()
									->setFormatCode('0.000');
					$objWorksheet	->setCellValue('F'.$row, $items[0]->deliveredtonnage);
					
				}
				
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

						$objWorksheet	->setCellValue('B'.$row, ucfirst($this->siebel->getLang('salesorder', $lang)));
						$objWorksheet	->setCellValue('E'.$row, ucfirst($this->siebel->getLang('date', $lang)));
						$objWorksheet	->setCellValue('H'.$row, ucfirst($this->siebel->getLang('ordered', $lang)));
						$objWorksheet	->setCellValue('J'.$row, ucfirst($this->siebel->getLang('delivered', $lang)));
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

						$objWorksheet	->setCellValue('B'.$row, ucfirst($this->siebel->getLang('reference', $lang)));

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

						$objWorksheet	->setCellValue('B'.$row, ucfirst($this->siebel->getLang('line', $lang)));
						$objWorksheet	->setCellValue('E'.$row, ucfirst($this->siebel->getLang('product', $lang)));
						$objWorksheet	->setCellValue('H'.$row, ucfirst($this->siebel->getLang('length', $lang)));
						$objWorksheet	->setCellValue('J'.$row, ucfirst($this->siebel->getLang('ordered', $lang)));
						$objWorksheet	->setCellValue('K'.$row, ucfirst($this->siebel->getLang('delivered', $lang)));

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

						$objWorksheet	->setCellValue('B'.$row, ucfirst($this->siebel->getLang('bill', $lang) . ' - ' . $this->siebel->getLang('date', $lang)));
						$objWorksheet	->setCellValue('E'.$row, ucfirst($this->siebel->getLang('reference', $lang)));
						$objWorksheet	->setCellValue('H'.$row, ucfirst($this->siebel->getLang('finish', $lang)));

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
						
						$objWorksheet	->setCellValue('B'.$row, ucfirst($this->siebel->getLang('transport', $lang) . ' - ' . $this->siebel->getLang('date', $lang)));
						$objWorksheet	->setCellValue('E'.$row, ucfirst($this->siebel->getLang('promisdate', $lang)));

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
							$objWorksheet	->getStyle('K'.$row)
											->getNumberFormat()
											->setFormatCode('0.000');
							$objWorksheet	->setCellValue('K'.$row, trim($orderline->deliveredtonnage));
							
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
		$filename = $this->siebel->getLang('tonnagelist', $lang);
		$filename .= ($customername) ? '_'.$customername : '';
		$filename .= ($customernumber) ? '_'.$customernumber : '';
		$filename .= '.xlsx';
		$filename = str_replace(" ", "_", $filename);
		$file = 'public/tonnagelist/'.$filename;
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