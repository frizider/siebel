<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Prices_model extends CI_Model {

	// Constructor
	public function __construct() {
		parent::__construct();
	}

	/*	 * ********************************************************************
	 * Other function below this section
	 */

	public function getPrices($cuno, $id = FALSE, $search = FALSE) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('customernumber', $cuno);
		$dbDefault->where('delete', 0);
		if ($id) {
			$dbDefault->where('id', $id);
		}

		// Search
		if ($search) {

			if (!empty($search['search_reference'])) {
				$reference = $this->getDieMaintance(FALSE, $search['search_reference']);
				$search['search_profile'] = trim($reference[param('param_asw_database_column_dm_number')]);
				$length = count($search['search_profile']);
				if (!is_numeric($search['search_profile'][$length - 1])) {
					$search['search_profile'] = substr($search['search_profile'], 0, $length - 2);
				}
			}
			if (!empty($search['search_profile'])) {
				$dbDefault->like('profile', $search['search_profile']);
			}
			if (!empty($search['search_price'])) {
				$dbDefault->like('price', $search['search_price']);
			}
			if (!empty($search['search_length'])) {
				$dbDefault->like('length', $search['search_length']);
			}
			if (!empty($search['search_priceunit'])) {
				$dbDefault->where('priceunit_id', $search['search_priceunit']);
			}
			if (!empty($search['search_prefer_priceunit'])) {
				$dbDefault->where('prefer_priceunit_id', $search['search_prefer_priceunit']);
			}
			if (!empty($search['search_anodprice'])) {
				$dbDefault->like('anodprice', $search['search_anodprice']);
			}
			if (!empty($search['search_anodtype'])) {
				$dbDefault->like('anodtype', $search['search_anodtype']);
			}
			if (!empty($search['search_coatprice'])) {
				$dbDefault->like('coatprice', $search['search_coatprice']);
			}
			if (!empty($search['search_coatcolor'])) {
				$dbDefault->like('coatcolor', $search['search_coatcolor']);
			}
		}

		$dbDefault->order_by('date', 'desc');
		$results = $dbDefault->get('prices')->result();


		foreach ($results as $result) {
			if (isset($result->priceunit_id) && !empty($result->priceunit_id)) {
				$result->priceunit = $this->getPriceUnit($result->priceunit_id)->short;
				if (isset($result->prefer_priceunit_id) && !empty($result->prefer_priceunit_id)) {
					$result->prefer_priceunit = $this->getPriceUnit($result->prefer_priceunit_id)->short;
				} else {
					$result->prefer_priceunit = '';
				}

				$dieMaintance = $this->getDieMaintance($result->profile);
				if (!empty($dieMaintance)) {
					$result->reference = trim($dieMaintance[param('param_asw_database_column_dm_reference')]);
					$result->weight = trim($dieMaintance[param('param_asw_database_column_dm_weight')]) / 1000;
					$result->perim = trim($dieMaintance[param('param_asw_database_column_dm_perimeter')]) / 1000;
				} else {
					$result->reference = '';
					$result->weight = '';
					$result->perim = '';
				}
			}
		}

		foreach ($results as $result) {
			// Adding total price tot result
			if ($result->price != 0) {

				$price_kg = 0;
				if (isset($result->priceunit_id) && !empty($result->priceunit_id)) {
					// if Kilo price
					if ($result->priceunit_id == '1') {
						$price_kg = $result->price + $result->added_value;

						// if Meter price
					} elseif ($result->priceunit_id == '2') {
						$price_kg = $result->price / $result->weight;

						// if Piece price	
					} elseif ($result->priceunit_id == '3' || $result->priceunit_id == '5') {
						$price_kg = ( $result->price / $result->length ) / $result->weight;

						// if m2 - square meter price
					} elseif ($result->priceunit_id == '4') {
						$price_kg = ( $result->price * $result->perim ) / $result->weight;
					}
				}

				if ($result->anodprice != 0 && !empty($result->profile)) {
					$anodprice_kg = ( $result->anodprice * $result->perim ) / $result->weight;
				}

				$cuttingprice_kg = 0;
				if ($result->cuttingprice_kg != 0) {
					$cuttingprice_kg = $result->cuttingprice_kg;
				} elseif ($result->cuttingprice_pc != 0 && !empty($result->profile)) {
					$cuttingprice_kg = $result->cuttingprice_pc / $result->length / $result->weight;
				}

				$anodprice_kg = 0;
				if ($result->anodprice != 0 && !empty($result->profile)) {
					$anodprice_kg = ( $result->anodprice * $result->perim ) / $result->weight;
				}

				$coatprice_kg = 0;
				if ($result->coatprice != 0 && !empty($result->profile)) {
					$coatprice_kg = ( $result->coatprice * $result->perim ) / $result->weight;
				}

				$foilprice_kg = 0;
				if ($result->foilprice != 0 && !empty($result->profile)) {
					$foilprice_kg = $result->foilprice / $result->weight;
				}

				$brushprice_kg = 0;
				if ($result->brushprice != 0 && !empty($result->profile)) {
					$brushprice_kg = $result->brushprice / $result->weight;
				}

				$punchprice_kg = 0;
				if ($result->punchprice != 0 && !empty($result->profile)) {
					$punchprice_kg = $result->punchprice / $result->weight;
				}

				$insulateprice_kg = 0;
				if ($result->insulate_price != 0 && !empty($result->profile)) {
					$insulateprice_kg = $result->insulate_price / $result->weight;
				}

				$finalprice_kg = $price_kg + $cuttingprice_kg + $anodprice_kg + $coatprice_kg + $foilprice_kg + $brushprice_kg + $punchprice_kg + $insulateprice_kg;
				$finalprice = $finalprice_kg;


				// if Kilo price
				if ($result->prefer_priceunit_id == '1') {
					$finalprice = $finalprice_kg;

					// if Meter price
				} elseif ($result->prefer_priceunit_id == '2') {
					$finalprice = $finalprice_kg * $result->weight;

					// if Piece price	
				} elseif ($result->prefer_priceunit_id == '3' || $result->prefer_priceunit_id == '5') {
					$finalprice = $finalprice_kg * $result->weight * $result->length;

					// if m2 - square meter price
				} elseif ($result->prefer_priceunit_id == '4') {
					$finalprice = ( $finalprice_kg * $result->weight ) / $result->perim;
				}
			} else {
				$finalprice = $result->price + $result->added_value + $result->cuttingprice_kg + $result->anodprice + $result->coatprice + $result->foilprice + $result->brushprice + $result->punchprice + $result->insulate_price;
			}

			$result->totalprice = $finalprice;

			// Adding finish to result
			$result->finish = '';
			$result->finish .= (!empty($result->length)) ? number_format($result->length, 3) . ' m' : '';
			$result->finish .= (!empty($result->length) && !empty($result->anodtype) || !empty($result->length) && !empty($result->coatcolor)) ? ' - ' : '';
			$result->finish .= (!empty($result->anodtype)) ? $result->anodtype : '';
			$result->finish .= (!empty($result->coatcolor)) ? $result->coatcolor : '';
		}

		return $results;
	}

	public function save($data, $cuno, $id, $copy) {
		$dbDefault = $this->load->database('default', TRUE);

		$data['price'] = round($this->siebel->math($this->siebel->formula_to_plain($data['formula_data'], 0)), 2);
		$data['date'] = $this->siebel->date_to_mysql_human($data['date']);
		if (!isset($data['prefer_priceunit_id']) || empty($data['prefer_priceunit_id']) || $data['prefer_priceunit_id'] == 0) {
			$data['prefer_priceunit_id'] = $data['priceunit_id'];
		}
		//$data['markup'] = ($data['price'] > 0) ? $this->calculateMarkup($data['length'], $data['weight'], $data['priceunit_id'], $data['price'], $data['lme'], $data['premium']) : 0;

		unset($data['weight']);
		unset($data['perim']);

		if ($copy) {
			$id = 'new';
		}

		if ($id == 'new') {
			$data['formula_string'] = $this->siebel->getFormula($data['formula_id'])->formula;
			$data['customernumber'] = $cuno;
			if ($dbDefault->insert('prices', $data)) {
				return $dbDefault->insert_id();
			}
		} else {
			$dbDefault->where('id', $id);
			if ($dbDefault->update('prices', $data)) {
				return $id;
			}
		}
	}

	public function delete($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		if ($dbDefault->update('prices', array('delete' => 1))) {
			return TRUE;
		};
	}

	public function unDelete($id) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', $id);
		if ($dbDefault->update('prices', array('delete' => 0))) {
			return TRUE;
		};
	}

	public function deletepricesheet($customernumber) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('customernumber', $customernumber);
		$dbDefault->where('pricesheet_upload_time', $_POST['pricesheet_time']);
		if ($dbDefault->update('prices', array('delete' => 1))) {
			return TRUE;
		};
	}

	public function savePremium() {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', 1);
		if ($dbDefault->update('default_premium', $_POST)) {
			return TRUE;
		};
	}

	public function getPremium() {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->where('id', 1);
		return $dbDefault->get('default_premium')->row();
	}

	public function getPriceUnit($id) {
		if (isset($id) && !empty($id)) {
			$dbDefault = $this->load->database('default', TRUE);
			$dbDefault->where('id', $id);
			$result = $dbDefault->get('priceunits')->result();
			if (!empty($result)) {
				return $result[0];
			} else {
				$result->short = '';
				return $result;
			}
		}
	}

	public function getDropdownValues($table, $key = 'id', $value = 'short') {
		$dbDefault = $this->load->database('default', TRUE);
		$results = $dbDefault->get($table)->result();
		foreach ($results as $result) {
			$group[$result->$key] = $result->$value;
		}
		return $group;
	}

	public function getDieMaintance($profile = FALSE, $reference = FALSE) {
		if ($profile == FALSE && $reference == FALSE) {
			return '';
		} else {
			$dbAsw = $this->load->database('asw', TRUE);
			if ($profile) {
				$dbAsw->where(param('param_asw_database_column_dm_number'), $profile);
			}
			if ($reference) {
				$dbAsw->like(param('param_asw_database_column_dm_reference'), $reference);
			}
			$dbAsw->order_by(param('param_asw_database_column_dm_version'), 'desc');
			$results = $dbAsw->get(param('param_asw_database_table_diemaintance'))->result_array();

			if (!empty($results)) {
				return $results[0];
			} else {
				return '';
			}
		}
	}

	public function calculateMarkup($length, $weight, $priceunit_id, $price, $lme, $premium) {
		$markup = 0;
		$priceunit = $this->getPriceUnit($priceunit_id)->short;
		if (strtolower($priceunit == 'kg')) {
			$markup = $price - $lme - $premium;
		} elseif (strtolower($priceunit == 'm') && $weight != 0) {
			$markup = ($price / $weight) - $lme - $premium;
		} elseif (strtolower($priceunit == 'piece') && $weight != 0 && $length != 0) {
			$markup = ($price / $length / $weight) - $lme - $premium;
		};

		return $markup;
	}
	
	public function getCustomernumbers() {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->select('customernumber');
		$dbDefault->where('delete', 0);
		$results = $dbDefault->get('prices')->result_array();
		foreach($results as $result) {
			$customernumbers[] = $result['customernumber'];
		}
		return array_values(array_unique($customernumbers));
	}

	public function toExcel($customernumber = FALSE) {
		
		if(isset($customernumber) && !empty($customernumber)) {
			$customernumbers = array($customernumber);
		} else {
			$customernumbers = $this->getCustomernumbers();
		}
		
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
				->setTitle("Overview Prices");

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
		
		for($i = 0; $i < count($customernumbers); $i++) {
			
			$customernumber = $customernumbers[$i];
			$prices = $this->getPrices($customernumber);
			// Customername
			$customername = ($customernumber) ? trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername'))) : '';
			$customername = utf8_encode($customername);

			// Print date
			$date = mdate("%d/%m/%Y", time());

			if($i != 0) {$objPHPExcel->createSheet();}

			// Set active sheet
			$objPHPExcel	->setActiveSheetIndex($i);
			$objWorksheet = $objPHPExcel->getActiveSheet();
			
			$objPHPExcel->getActiveSheet()->freezePane('A5');
			$objPHPExcel->getActiveSheet()->setAutoFilter('A4:U4');

			// Rename worksheet
			$objWorksheet->setTitle($customername);

			// Sheet proporties
			$objWorksheet->getPageSetup()
					->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

			$objWorksheet->getPageSetup()
					->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

			$objWorksheet->getPageSetup()->setFitToPage(TRUE);
			$objWorksheet->getPageSetup()->setFitToWidth(1);
			$objWorksheet->getPageSetup()->setFitToHeight(0);


			// Column's width
			$objWorksheet->getDefaultColumnDimension()->setWidth(7);
			$objWorksheet->getColumnDimension('A')->setWidth(11);
			$objWorksheet->getColumnDimension('B')->setWidth(10);


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

			$objWorksheet->setCellValue($cell, 'Prices');

			$cell = 'E1';
			$objWorksheet->getStyle($cell)
					->getFont()
					->getColor()
					->setARGB($grey);

			$objWorksheet->setCellValue($cell, 'Printed: ' . $date);

			$cell = 'A2';
			$objWorksheet->getStyle($cell)
					->getFont()
					->setSize(13);

			$objWorksheet->getStyle($cell)
					->getFont()
					->getColor()
					->setARGB($grey);

			$objWorksheet->setCellValue($cell, $customername . ' | ' . $customernumber);

			$row = 4;
			// titles font bold left white background green
			$cell = 'A' . $row . ':U' . $row;
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
			$objWorksheet->setCellValue('B' . $row, 'Profile');
			$objWorksheet->setCellValue('C' . $row, 'Length');
			$objWorksheet->setCellValue('D' . $row, 'Anod type');
			$objWorksheet->setCellValue('E' . $row, 'Coat color');
			$objWorksheet->setCellValue('F' . $row, 'Price');
			$objWorksheet->setCellValue('G' . $row, 'Price unit');

			$objWorksheet->setCellValue('H' . $row, 'Anod € / m2');
			$objWorksheet->setCellValue('I' . $row, 'Coat € / m2');

			$objWorksheet->setCellValue('J' . $row, 'Total price');
			$objWorksheet->setCellValue('K' . $row, 'Total price unit');

			$objWorksheet->setCellValue('L' . $row, 'LME');
			$objWorksheet->setCellValue('M' . $row, 'Premium');
			$objWorksheet->setCellValue('N' . $row, 'Markup');

			$objWorksheet->setCellValue('O' . $row, 'Added Value / kg');
			$objWorksheet->setCellValue('P' . $row, 'Cutting € / kg');
			$objWorksheet->setCellValue('Q' . $row, 'Cutting € / pc');
			$objWorksheet->setCellValue('R' . $row, 'Foil € / m');
			$objWorksheet->setCellValue('S' . $row, 'Brush € / m');
			$objWorksheet->setCellValue('T' . $row, 'Punch € / m');
			$objWorksheet->setCellValue('U' . $row, 'Insulating / m');

			foreach ($prices as $price) {
				
				$row += 1;

				// Change text color to green if price is from contract
				if(isset($price->pricecontract_id) && !empty($price->pricecontract_id) && $price->pricecontract_id != 0) {
					$objWorksheet->getStyle('A' . $row.':U' . $row)
							->getFont()
							->getColor()
							->setARGB($green);
				$price->totalprice = '';
				$price->prefer_priceunit = '';
					
				}

				// Cell styles
				// Date
				$objWorksheet->getStyle('A' . $row)
						->getNumberFormat()
						->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);

				// Length
				$objWorksheet->getStyle('C' . $row)
						->getNumberFormat()
						->setFormatCode('# ##0.000');

				// Price
				$objWorksheet->getStyle('F' . $row)
						->getNumberFormat()
						->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

				// Anod price
				$objWorksheet->getStyle('H' . $row)
						->getNumberFormat()
						->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

				// Coat price
				$objWorksheet->getStyle('I' . $row)
						->getNumberFormat()
						->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

				// Total price
				$objWorksheet->getStyle('J' . $row)
						->getNumberFormat()
						->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

				// LME
				$objWorksheet->getStyle('L' . $row)
						->getNumberFormat()
						->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

				// Premium
				$objWorksheet->getStyle('M' . $row)
						->getNumberFormat()
						->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

				// Markup
				$objWorksheet->getStyle('N' . $row)
						->getNumberFormat()
						->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

				// Other cells
				$objWorksheet->getStyle('O' . $row . ':U' . $row)
						->getNumberFormat()
						->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);


				$date = mysql_to_unix($price->date);

				if (!empty($price->profile)) {
					$dieMaintance = $this->getDieMaintance($price->profile);
					$reference = utf8_encode( $dieMaintance[param('param_asw_database_column_dm_reference')] );
				} else {
					$reference = FALSE;
				}

				// Cell values
				$objWorksheet->setCellValue('A' . $row, PHPExcel_Shared_Date::PHPToExcel($date));
				$objWorksheet->setCellValue('B' . $row, $price->profile);
				$objWorksheet->setCellValue('C' . $row, $price->length ? $price->length : '');
				$objWorksheet->setCellValue('D' . $row, $price->anodtype);
				$objWorksheet->setCellValue('E' . $row, $price->coatcolor);
				$objWorksheet->setCellValue('F' . $row, $price->price ? $price->price : '');
				$objWorksheet->setCellValue('G' . $row, $price->priceunit ? $price->priceunit : '');

				$objWorksheet->setCellValue('H' . $row, $price->anodprice ? $price->anodprice : '');
				$objWorksheet->setCellValue('I' . $row, $price->coatprice ? $price->coatprice : '');

				$objWorksheet->setCellValue('J' . $row, $price->totalprice ? $price->totalprice : '');
				$objWorksheet->setCellValue('K' . $row, $price->prefer_priceunit ? $price->prefer_priceunit : '');

				$objWorksheet->setCellValue('L' . $row, $price->lme ? $price->lme : '');
				$objWorksheet->setCellValue('M' . $row, $price->premium ? $price->premium : '');
				$objWorksheet->setCellValue('N' . $row, $price->markup ? $price->markup : '');

				$objWorksheet->setCellValue('O' . $row, $price->added_value ? $price->added_value : '');
				$objWorksheet->setCellValue('P' . $row, $price->cuttingprice_kg ? $price->cuttingprice_kg : '');
				$objWorksheet->setCellValue('Q' . $row, $price->cuttingprice_pc ? $price->cuttingprice_pc : '');
				$objWorksheet->setCellValue('R' . $row, $price->foilprice ? $price->foilprice : '');
				$objWorksheet->setCellValue('S' . $row, $price->brushprice ? $price->brushprice : '');
				$objWorksheet->setCellValue('T' . $row, $price->punchprice ? $price->punchprice : '');
				$objWorksheet->setCellValue('U' . $row, $price->insulate_price ? $price->insulate_price : '');

				if ($reference) {
					$objWorksheet
							->getComment('B' . $row)
							->setAuthor('Siebel');
					$objCommentRichText = $objPHPExcel->getActiveSheet()
									->getComment('B' . $row)
									->getText()->createTextRun('Reference:');
					$objCommentRichText->getFont()->setBold(true);
					$objWorksheet
							->getComment('B' . $row)
							->getText()->createTextRun("\r\n");
					$objWorksheet
							->getComment('B' . $row)
							->getText()->createTextRun($reference);

				}
				if (isset($price->comment) && !empty($price->comment)) {
					$objWorksheet
							->getComment('A' . $row)
							->setAuthor('Siebel');
					$objCommentRichText = $objPHPExcel->getActiveSheet()
									->getComment('A' . $row)
									->getText()->createTextRun('Comment:');
					$objCommentRichText->getFont()->setBold(true);
					$objWorksheet
							->getComment('A' . $row)
							->getText()->createTextRun("\r\n");
					$objWorksheet
							->getComment('A' . $row)
							->getText()->createTextRun($price->comment);
				}
			}

		} // end for

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Save Excel 2007 file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$filename .= 'prices.xlsx';
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

	public function convertKgToMeter($kiloPrice, $weight) {
		if (!empty($kiloPrice) || !empty($weight)) {

			return $kiloPrice * $weight;
		} else {
			return 0;
		}
	}

	public function convertMeterToPiece($meterPrice, $length) {
		if (!empty($meterPrice) || !empty($length)) {

			return $meterPrice * $length;
		} else {
			return 0;
		}
	}

	public function convertCuttingPrices($cutting_kg, $cutting_pc, $weight, $length) {

		$weight = (!empty($weight)) ? $weight : 0;
		$length = (!empty($length)) ? $length : 0;

		if ($cutting_kg > 0 || $cutting_pc > 0) {

			if (!empty($cutting_kg) && $cutting_kg > 0) {

				$cutting_kg = $cutting_kg;
				$cutting_m = $cutting_kg * $weight;
				$cutting_pc = $cutting_m * $length;
			} elseif (!empty($cutting_pc) && $cutting_pc > 0) {

				$cutting_pc = $cutting_pc;
				$cutting_m = ($length != 0) ? $cutting_pc / $length : 0;
				$cutting_kg = ($weight != 0) ? $cutting_m / $weight : 0;
			} else {
				$cutting_kg = 0;
				$cutting_m = 0;
				$cutting_pc = 0;
			}
		} else {
			$cutting_kg = 0;
			$cutting_m = 0;
			$cutting_pc = 0;
		};

		return array(
			'cutting_kg' => $cutting_kg,
			'cutting_m' => $cutting_m,
			'cutting_pc' => $cutting_pc
		);
	}

	public function convertSqureMeterToKg($squareMeterPrice, $weight) {
		if (!empty($squareMeterPrice) || !empty($weight)) {

			return $squareMeterPrice / $weight;
		} else {
			return 0;
		}
	}

	public function convertSqureMeterToMeter($squareMeterPrice, $perim) {
		if (!empty($squareMeterPrice) || !empty($perim)) {

			return $squareMeterPrice * $perim;
		} else {
			return 0;
		}
	}

	public function convertMeterToKg($meterPrice, $weight) {
		if (!empty($meterPrice) || !empty($weight)) {

			return $meterPrice / $weight;
		} else {
			return 0;
		}
	}
	
	public function getPricesheetUploadTimes($cuno) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->select('pricesheet_upload_time');
		$dbDefault->where('customernumber', $cuno);
		$dbDefault->where('pricesheet_upload_time !=', 0);
		$dbDefault->where('delete', 0);
		$dbDefault->order_by('pricesheet_upload_time', 'desc');
		$results = $dbDefault->get('prices')->result();
		foreach($results as $result) {
			$times[] = $result->pricesheet_upload_time;
		}
		
		return array_values(array_unique($times));
		
	}

}

/* End of file */