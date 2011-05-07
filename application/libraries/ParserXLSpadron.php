<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/excel_reader2.php';

class ParserXLSpadron {
	protected $ci;
	private $www_ine = "http://www.ine.es/pob_xls/pobmun";
	
	public function __construct() {
		$this->ci =& get_instance();
		
		$this->ci->load->library('Curl');
		
	}
	
	public function get_last_url(){
		return $this->www_ine.date('y',mktime(0, 0, 0,1,1,date("Y")-1)).".xls";
	}
	
	public function parser() {

		$curl = new Curl();					
		$file_name = $curl->open_https_url_file($this->get_last_url());
		$data = new Spreadsheet_Excel_Reader($file_name); 				
		
		echo "ejemplo... Obtenido ".$data->val(4,'B').'/'.$data->val(4,'J').'\r\n';
		
		
	}
	
}