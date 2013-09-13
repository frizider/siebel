<?php

/* 
 * Development and design by Jens De Schrijver
 * Test controller
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prices extends CI_Controller {
	
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
		$this->load->model('domain_model', 'model');
		$this->load->model('prices_model');
	}
	
	public function index() 
	{
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		
		// Load the general view
		$data['view'] = 'prices/index';
		$this->load->view('DomainView', $data);
	}

	
	public function customer() {
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;

		$data['form_attributes'] = array('class' => 'form-horizontal');
		$data['customernumber'] = $this->uri->segment(3);
		$cuno = $data['customernumber'];
		$data['id'] = $this->uri->segment(4);
		$id = $data['id'];
		$data['copy'] = $this->uri->segment(5);
		$copy = $data['copy'];
		
		$data['dropdown_priceunits'] = $this->prices_model->getDropdownValues('priceunits');
		
		if(isset($id) && !empty($id))
		{
			if(isset($_POST) && !empty($_POST))
			{
				$saveDataMultiCust = $_POST['multiCust'];
				unset($_POST['multiCust']);
				
				if($newId = $this->prices_model->save($_POST, $cuno, $id, $copy))
				{
					$this->id = $newId;
					if($this->prices_model->saveMultiCust($saveDataMultiCust, $newId, $this->customernumber)) {
						$this->session->set_flashdata('success', 'Price saved!');
						redirect(site_url('prices/customer/'.$cuno.'/'.$newId), 'refresh');
					}
				}
			}
			
			$this->load->library('ckeditor');
			$this->ckeditor->basePath = base_url().'assets/ckeditor/';
			$this->ckeditor->config['toolbar'] = array(
							array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
																);
			$this->ckeditor->config['language'] = 'en';
			$this->ckeditor->config['height'] = '210px';  

			$data['dropdown_formulas'] = $this->prices_model->getFromulasDropdownValues($this->customernumber);
			
			if($id == 'new')
			{
				$data['price'] = $this->siebel->getColumns('prices');
				$data['price']->date = $this->siebel->date_to_mysql(date('d/m/Y', now()));
				$data['price']->weight = 1;
				$data['price']->perim = 1;
				$default_premium = $this->prices_model->getPremium();
				$data['price']->premium = $default_premium->premium;
			}
			else 
			{
				$data['prices'] = $this->prices_model->getPrices($cuno, $id);
				$data['price'] = $data['prices'][0];
			}
			
		} else {
			
			if(isset($_POST) && !empty($_POST)) {
				$data['search_priceunit_name'] = (isset($_POST['search_priceunit']) && !empty($_POST['search_priceunit'])) ? $this->prices_model->getPriceUnit($_POST['search_priceunit'])->short : '';
				$data['search_prefer_priceunit_name'] = (isset($_POST['search_prefer_priceunit']) && !empty($_POST['search_prefer_priceunit'])) ? $this->prices_model->getPriceUnit($_POST['search_prefer_priceunit'])->short : '';
				$search = $_POST;
			} else{
				$search = FALSE;
			}
			
			$data['prices'] = $this->prices_model->getPrices($cuno, $id, $search);
			
			$data['pricesheet_upload_times'] = $this->prices_model->getPricesheetUploadTimes($cuno);
			
		}
		
		// Load the general view
		$data['view'] = 'prices/index';
		$this->load->view('DomainView', $data);
		
	}
	
	public function delete($customernumber, $id) {
		$this->customernumber = $customernumber;
		$this->id = $id;
		
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
		
		if($this->prices_model->delete($id))
		{
			$this->session->set_flashdata('message', $this->siebel->getLang('success_contactdelete'). ' <a class="btn btn-small" href="'.site_url($this->module.'/undelete/'.$this->customernumber.'/'.$this->id).'"><i class="icon-undo"></i> '.$this->siebel->getLang('undo').'</a>');
			if($data['customernumber'] == 'global')
			{
				redirect(site_url($this->module.'/globalcomments/'), 'refresh');
			}
			else
			{
				redirect(site_url($this->module.'/customer/'.$this->customernumber), 'refresh');
			}
		}
	}
	
	public function undelete($customernumber, $id) {
		$this->customernumber = $customernumber;
		$this->id = $id;
		
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
		
		
		if($this->prices_model->undelete($id))
		{
			$this->session->set_flashdata('success', $this->siebel->getLang('success_contactrecover'));
			if($data['customernumber'] == 'global')
			{
				redirect(site_url($this->module.'/globalcomments/'), 'refresh');
			}
			else
			{
				redirect(site_url($this->module.'/customer/'.$this->customernumber), 'refresh');
			}
		}
	}
	
	public function deletepricesheet($customernumber) {
		$this->customernumber = $customernumber;
		$this->id = '';
		
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
		
		if($this->prices_model->deletepricesheet($customernumber)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

		public function defaultPremium() {
		$data['id'] = $this->id;
		$data['customernumber'] = $this->customernumber;
		$data['module'] = $this->module;
		
		if(isset($_POST) && !empty($_POST)) {
			if($this->prices_model->savePremium()) {
				redirect(current_url(), 'refresh');
			}
		}
		
		$data['premium'] = $this->prices_model->getPremium();
		
		// Load the general view
		$data['view'] = 'prices/defaultpremium';
		$this->load->view('DomainView', $data);
	}

		public function readSheet($customernumber) {
			
		$pricesheet_upload_time = date('Y-m-d H:m:s', now());
		
		$data['customernumber'] = $customernumber;
		$data['module'] = $this->module;

		
		if(isset($_FILES) && !empty($_FILES)) {
			
			// Set the path
			$path = 'public/pricesheets/upload/';
			
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
			
			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				dev($error);
			}
			else
			{
				$file = $path.$name;

				// Include PHPExcel
				require_once APPPATH.'third_party/PHPExcel.php';

				// Create new PHPExcel object
				$objReader = new PHPExcel_Reader_Excel2007();

				// Read the file
				$objReader->setLoadSheetsOnly( array('Prices') );
				$objPHPExcel = $objReader->load($file);

				$objWorksheet = $objPHPExcel->getActiveSheet();

				// Get data in variables
				$date = $objWorksheet->getCell('B4')->getValue();
				$date = mktime(0,0,0,1,$date-1,1900);
				$date = unix_to_human($date, TRUE, 'eu');

				$priceunit = '1';
				$prefer_priceunit = $objWorksheet->getCell('B5')->getValue();
				$pricecontract = $objWorksheet->getCell('B6')->getValue();
				$pricecontract = ($pricecontract === 0) ? NULL : $pricecontract;

				$rows = array();

				for($i = 11; $i <= 999; $i++) {

					$rows[$i] = array(
						'price' => $objWorksheet->getCell('N'.$i)->getValue(),
						'added_value' => $objWorksheet->getCell('O'.$i)->getValue(),
						'lme' => $objWorksheet->getCell('K'.$i)->getValue(),
						'premium' => $objWorksheet->getCell('L'.$i)->getValue(),
						'markup' => $objWorksheet->getCell('M'.$i)->getValue(),
						'profile' => $objWorksheet->getCell('A'.$i)->getValue(),
						'cuttingprice_kg' => $objWorksheet->getCell('P'.$i)->getValue(),
						'cuttingprice_pc' => $objWorksheet->getCell('Q'.$i)->getValue(),
						'anodtype' => utf8_decode($objWorksheet->getCell('R'.$i)->getValue()),
						'anodprice' => $objWorksheet->getCell('S'.$i)->getValue(),
						'coatcolor' => utf8_decode($objWorksheet->getCell('T'.$i)->getValue()),
						'coatprice' => $objWorksheet->getCell('U'.$i)->getValue(),
						'insulate_price' => $objWorksheet->getCell('V'.$i)->getValue(),
						'foilprice' => $objWorksheet->getCell('W'.$i)->getValue(),
						'brushprice' => $objWorksheet->getCell('X'.$i)->getValue(),
						'punchprice' => $objWorksheet->getCell('Y'.$i)->getValue(),
						'length' => $objWorksheet->getCell('J'.$i)->getValue(),
						'comment' => utf8_decode($objWorksheet->getCell('C'.$i)->getValue()),
					);
					
					// Check end of price table in sheet
					if(!array_filter($rows[$i])) {
						unset($rows[$i]);
						break;
					}
				}
				

				foreach($rows as $item) {

					$item['customernumber'] = $customernumber;
					$item['pricecontract_id'] = $pricecontract;
					$item['priceunit_id'] = $priceunit;
					$item['prefer_priceunit_id'] = $prefer_priceunit;
					$item['formula_id'] = '2';
					$item['formula_string'] = 'value:Prijs||';
					$item['formula_data'] = $item['price'].'||';
					$item['date'] = $date;
					$item['pricesheet_upload_time'] = $pricesheet_upload_time;
					$item['delete'] = 0;
					dev($pricesheet_upload_time);
					//dev($data);
					$this->model->save('new', $item);
				}
				
				//redirect(site_url($this->module.'/customer/'.$customernumber), 'refresh');
				
			}
		}
		
		// Load the general view
		$data['view'] = 'prices/upload';
		$this->load->view('DomainView', $data);
		
		
	}

	public function toExcel() {
		$this->prices_model->toExcel($this->customernumber);
	}
	
	public function reloaddb() {
		$dbDefault = $this->load->database('default', TRUE);
		$prices = $dbDefault->get('prices')->result();
		
		foreach ($prices as $price) {
			$savedata = array(
				'price_id' => $price->id,
				'customernumber' => strtoupper($price->customernumber)
			);
			$dbDefault->insert('price_customer', $savedata);
		}
		
	}
}

