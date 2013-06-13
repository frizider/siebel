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
			
			$tonnage = 0;
			foreach ($contract->salesorders as $order) {
				$tonnage += $order->ordertonnage;
			}
			$contract->ordertonnage = $tonnage;

		}
		return $contracts;
		
	}
	
	public function getSalesOrders($contractnumber) {
		
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_soh_contractnumber'), $contractnumber);
		$dbAsw->order_by(param('param_asw_database_column_soh_salesordernumber'), 'desc');
		$salesorders = $dbAsw->get(param('param_asw_database_table_salesorderheader'))->result();
		
		$sonumber = param('param_asw_database_column_soh_salesordernumber');
		
		foreach($salesorders as $salesorder) {
			$salesorder->orderlines = $this->getOrderLines($salesorder->$sonumber);
			
			$tonnage = 0;
			foreach ($salesorder->orderlines as $orderline) {
				$tonnage += $orderline->ordertonnage;
			}
			$salesorder->ordertonnage = $tonnage;
		}
				
		return $salesorders;
		
	}
	
	public function getOrderLines($salesorder) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_soline_order'), $salesorder);
		$dbAsw->order_by(param('param_asw_database_column_soline_line'), 'asc');
		$lines = $dbAsw->get(param('param_asw_database_table_salesorderline'))->result();
		
		foreach($lines as $line) {
			$line->ordertonnage = $this->getOrderedTonnages($line);
		}
		
		return $lines;
		
	}
	
	public function getOrderedTonnages($salesorder) {
		/*
		 * If		olunit =’KG’					=> in salesorder line
		 *			- then OLCQTS
		 * 
		 * Elseif	pgprcl = '3'				=> in SROPRG where pgprdc = enditem
		 *			- then Olcqty * pjgwnt		=> in SRBPRU where pjprdc = item and pjunit = pgstun
		 *					* length			=> nav03 in Z2OOCFGF where F0ERNC = salesorder and f0a2nb = salesorderline
		 * 
		 * Else		Olcqty * pjgwnt
		 */
		$unit = param('param_asw_database_column_soline_unit');
		$unit = trim($salesorder->$unit);
		$linequantity = param('param_asw_database_column_soline_quantity_order');
		$linequantity = trim(strtoupper($salesorder->$linequantity));
		$product = param('param_asw_database_column_soline_product');
		$product = trim($salesorder->$product);
		
		if($unit == 'KG') {
			$tonnage = $linequantity;
		}
		elseif($this->getPalUnit($product) == '3') {
			$weight = $this->getProductWeight($product, $unit);

			$salesordernumber = param('param_asw_database_column_soline_order');
			$salesordernumber = trim($salesorder->$salesordernumber);
			$salesorderline = param('param_asw_database_column_soline_line');
			$salesorderline = trim($salesorder->$salesorderline);
			$length = $this->getProductLenght($salesordernumber, $salesorderline);
			
			$tonnage = $linequantity * $weight * $length;
		}
		else {
			$weight = $this->getProductWeight($product, $unit);
			$tonnage = $linequantity * $weight;
		}
		
		$kiloToTon = round($tonnage / 1000, 2);
		
		return $kiloToTon;
		
	}
	
	public function getPalUnit($product) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_pal_item'), $product);
		$result = $dbAsw->get(param('param_asw_database_table_pal'))->result_array();
		
		return trim($result[0][param('param_asw_database_column_pal_unit')]);
	}
	
	public function getProductWeight($product, $unit) {
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_pal_details_item'), $product);
		$dbAsw->where(param('param_asw_database_column_pal_details_unit'), $unit);
		$result = $dbAsw->get(param('param_asw_database_table_pal_details'))->result_array();
		
		return trim($result[0][param('param_asw_database_column_pal_details_weight')]);
	}
	
	public function getProductLenght($salesordernumber, $salesorderline) {
		// nav03 in Z2OOCFGF where F0ERNC = salesorder and f0a2nb = salesorderline
		
		$dbAsw = $this->load->database('asw', TRUE);
		$dbAsw->where(param('param_asw_database_column_sol_details_order'), $salesordernumber);
		$dbAsw->where(param('param_asw_database_column_sol_details_line'), $salesorderline);
		$result = $dbAsw->get(param('param_asw_database_table_salesorderline_details'))->result_array();
		
		return trim($result[0][param('param_asw_database_column_sol_details_lenght')]);
	}
	
}

/* End of file */