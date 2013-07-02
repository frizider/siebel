<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricecontract_model extends CI_Model
{
	private $table = 'pricecontract';
	private $dbDefault;

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->dbDefault = $this->load->database('default', TRUE);
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function addSalesOrders($contracts) {
		
		foreach($contracts as $contract) {
			$contract->salesorders = $this->getSalesOrders($contract->id);
			
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
	
	public function getSalesOrders($contractnumber) {
		
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_soh_contractnumber'), $contractnumber);
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
		 * 
SELECT SRBSOL.OLSTAT, SRBSOL.OLORDS, SRBSOL.OLORNO, SRBSOL.OLLINE, SRBSOL.OLORLI, SRBSOL.OLROLI, SRBSOL.OLORDT,     
SRBSOL.OLPRDC, SRBSOL.OLOQTY, SRBSOL.OLPQTY, SRBSOL.OLCQTY, SRBSOL.OLROCO , SRBSOL.pgprcl
		 * FROM srbsol 
		 * join srbprg on olprdc = pgprdc 
		 * join srbpru on pgprdc = pjprdc and pjunit = pgstun                                          
		 * 
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
		$weight = $this->getWeight($so, $soline);
		$weight_piece = ($item_class == 3) ? $weight*$length : $weight;
		
		// Get quantities
		if($status >= 45) {
			//$delivered_quantity = $ordered_quantity; // in $unit
			
			if($original_line == 0 || $original_line == $soline) {
				if($backorder_line == 0 || $backorder_line == $soline) {
	/* Set OK !! */
					$ordered_quantity =  $this->getManufacturingQuantity($so, $soline, $product);
				} else {
	/* Set OK !! */
					$ordered_quantity =  $this->getManufacturingQuantity($so, $backorder_line, $product);
				}
			} else {
				$ordered_quantity = 0;
			}
			//$ordered_quantity =  ($original_line == 0 || $original_line == $soline) ? $this->getManufacturingQuantity($so, $soline, $product) : $this->getManufacturingQuantity($so, $backorder_line, $product); // in pieces
			//$ordered_quantity =  ($backorder_line == 0 || $backorder_line == $soline) ? $this->getManufacturingQuantity($so, $soline, $product) : $this->getManufacturingQuantity($so, $backorder_line, $product); // in pieces
			
			// Convert to weight
			$ordered_quantity *= $weight_piece;
			$delivered_quantity = $delivered_quantity * $weight_piece;			
			//$delivered_quantity *= ($unit == 'KG') ? 1 : $weight_piece;
		} else {
			$ordered_quantity = ($original_line == 0 || $original_line == $soline) ? $ordered_quantity : 0; // in $unit
			$delivered_quantity = $delivered_quantity;
			// Convert to weight
			$ordered_quantity *= ($unit == 'KG') ? 1 : $weight_piece;
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
		return array(
			"ordered" => $ordered_ton, 
			"delivered" => $delivered_ton,
			"length" => $length,
			"finish" => $color_inside . ' ' . $color_outside,
			"invoice" => $invoice,
			"invoicedate" => $invoicedate,
			"transport" => $transport,
			"transportdate" => $transportdate
		);
		
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

			return $weight;
		} else {
			return 1;
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

}

/* End of file */