<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diemaintance extends CI_Controller {
		
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
		$this->load->model('diemaintance_model');
	}
	
	public function index() 
	{
		
		// Load the general view
		//$data['view'] = 'test';
		//$this->load->view('DomainView', $data);
	}

	public function readDieSheet($customernumber) {
		echo form_open_multipart(current_url());
		echo form_upload('userfile');
		echo form_submit();
		echo form_close();
		
		$data['customernumber'] = $customernumber;
		$data['module'] = $this->module;

		
		if(isset($_FILES) && !empty($_FILES)) {
			
			// Set the path
			$path = 'public/diesheets/upload/';
			
			// Re-format filename
			$name = $_FILES['userfile']['name'];
			$name = strtr($name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			$name = preg_replace('/([^.a-z0-9]+)/i', '_', $name);
			$name = explode('.xls', $name);
			$name[0] .= '_'.$customernumber.'_'.md5(now());
			$name = $name[0].'.xls'.$name[1];
			
			// set upload config
			$config['file_name'] = $name;
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xls|xlsx';
			$config['max_size']	= '1000';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload()){
				$error = array('error' => $this->upload->display_errors());
				dev($error);
			} else {
				$file = $path.$name;

				// Include PHPExcel
				require_once APPPATH.'third_party/PHPExcel.php';

				// Create new PHPExcel object
				$objReader = new PHPExcel_Reader_Excel2007();

				// Read the file
				$objReader->setLoadSheetsOnly( array('DieSheet', 'SelectBoxData') );
				$objPHPExcel = $objReader->load($file);

				$objWorksheet = $objPHPExcel->getSheetByName('DieSheet');
				
				$dienumber = $objWorksheet->getCell('E6')->getValue();
				
				$indexes = array(
					'representative' => $objWorksheet->getCell('E12')->getValue(),
					'reference' => $objWorksheet->getCell('E15')->getValue(),
					'alloy' => $objWorksheet->getCell('E17')->getValue(),
					'condition' => $objWorksheet->getCell('E18')->getValue(),
					'sample' => $objWorksheet->getCell('E20')->getValue(),
					'sample_comment' => $objWorksheet->getCell('E21')->getValue(),
					'certificate' => $objWorksheet->getCell('E23')->getValue(),
					'measurement' => $objWorksheet->getCell('E25')->getValue(),
					'invoice' => $objWorksheet->getCell('E27')->getValue(),
					'invoice_ammount' => $objWorksheet->getCell('E28')->getValue()
				);
				
				dev($indexes['invoice_ammount']);
				$invoice_ammount = '';
				foreach(str_split ($indexes['invoice_ammount']) as $num) {
					if( $num == ',' ) {
						$num = '.';
					} elseif( $num == '.' ) {
						$num = '';
					}
					$invoice_ammount .= $num;
				}
				$indexes['invoice_ammount'] = floatval($invoice_ammount);
				dev($indexes['invoice_ammount']);
				
				$objWorksheet = $objPHPExcel->getSheetByName('SelectBoxData');
				
				$saveData = array(
					param('param_asw_database_column_dm_representative') => ( $indexes['representative'] > 1 || !empty($indexes['representative']) ) ? $objWorksheet->getCell('A'.$indexes['representative'])->getValue() : '',
					param('param_asw_database_column_dm_reference') => $indexes['reference'],
					param('param_asw_database_column_dm_alloy') => (( $indexes['alloy'] > 1 || !empty($indexes['alloy']) ) ? $objWorksheet->getCell('B'.$indexes['alloy'])->getValue() : '')
								.(( $indexes['condition'] > 1 || !empty($indexes['condition']) ) ? ' '.$objWorksheet->getCell('G'.$indexes['condition'])->getValue() : ''),
					param('param_asw_database_column_dm_sample') => ( $indexes['sample'] > 1 || !empty($indexes['sample']) ) ? $objWorksheet->getCell('C'.$indexes['sample'])->getValue() : '',
					param('param_asw_database_column_dm_sample_comment') => $indexes['sample_comment'],
					param('param_asw_database_column_dm_tensile') => ( $indexes['certificate'] > 1 || !empty($indexes['certificate']) ) ? $objWorksheet->getCell('D'.$indexes['certificate'])->getValue() : '',
					param('param_asw_database_column_dm_measurement_report') => ( $indexes['measurement'] > 1 || !empty($indexes['measurement']) ) ? $objWorksheet->getCell('E'.$indexes['measurement'])->getValue() : '',
					param('param_asw_database_column_dm_invoice') => ( $indexes['measurement'] > 1 || !empty($indexes['measurement']) ) ? $objWorksheet->getCell('F'.$indexes['measurement'])->getValue() : '',
					param('param_asw_database_column_dm_invoice_amount') => $indexes['invoice_ammount']
				);
				
				
				if($this->diemaintance_model->saveDieSheet($dienumber, $saveData)) {
					dev($saveData);
					//redirect(site_url('dashboard/customer/'.$customernumber), 'refresh');
				 };
				 
			}
		}
		
		// Load the general view
		//$data['view'] = 'prices/upload';
		//$this->load->view('DomainView', $data);
		
		
	}
	
}

