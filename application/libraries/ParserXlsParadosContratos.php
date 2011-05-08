<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/excel_reader2.php';


class ParserXlsParadosContratos {
	protected $ci;

	protected $links_xls = array();

	private $www_months = "https://www.redtrabaja.es/es/redtrabaja/static/Redirect.do?page=statsMunicipios";


	/**
	 * __construct
	 *
	 * @return void
	 * @author 
	 **/
	public function __construct() {
		$this->ci =& get_instance();
		
		$this->ci->load->library('Curl');
		
	}
	
	public function normalize ($string){ 
		$replac = array(
    'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 
    'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 
    'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 
    'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 
    'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 
    'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 
    'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f', '.'=>'' , ','=>'',  '('=>'',
	')'=>'',  '"'=>'', "'"=>'');  
		
		//$string = mb_convert_encoding($string,'UTF-8','ISO-8859-1');		
		return strtolower(strtr($string, $replac));
	} 
	 
	public function parser() {

		$curl = new Curl();
		$this->get_links_xls();		

		if(count($this->links_xls)>0) {

			foreach ($this->links_xls as $link) {

				$file_name = $curl->open_https_url_file($link);
				$month = substr($link, -8,2);
				$year = substr($link, -6,2);
				
				$data = new Spreadsheet_Excel_Reader($file_name); 
				for ($i=9;$i < $data->rowcount()-3;$i++){
					$localidad = $this->normalize($data->val($i,'B'));
					$contratos = $this->normalize($data->val($i,'C'));	
					$paro = $this->normalize($data->val($i,'C',1));
					
					if (empty($localidad) || empty($contratos)) continue;
					$this->ci->dato->insert_dato_auto($localidad, $month, '20'.$year, $contratos, DATO_CONTRATOS);						
					$this->ci->dato->insert_dato_auto($localidad, $month, '20'.$year, $paro, DATO_PARO);
				}		
				unset($data);		
			}
		}
	}

	private function get_links_xls() {

		$curl = new Curl();
		$regexp_excell = "<a\s[^>]*href=([\"\']??)([^\" >]*xls)\\1[^>]*>(.*)<\/a>"; 
		$links_months = $this->_get_links_months();


		foreach ($links_months as $link) {

			$html = $curl->open_https_url($link);

			if(preg_match_all("/$regexp_excell/siU", $html, $links, PREG_SET_ORDER)) {
				foreach($links as $link) {

					if(substr($link[2],0,4)!='http') {
						$link[2] = URL_REDTRABAJA.$link[2];
					}

					$this->links_xls[] = $link[2];
				}
			}
		}
	}

	private function _get_links_months() {

		$retval;

		$curl = new Curl();
		$html = $curl->open_https_url($this->www_months);

		$regexp = "<a\s[^>]*href=([\"\']??)([^\" >]*(2009|201[0-9].html|201[0-9]))\\1[^>]*>(.*)<\/a>"; 

		if(preg_match_all("/$regexp/siU", $html, $links, PREG_SET_ORDER)) { 
			foreach($links as $link) { 
		
				if(substr($link[2],0,4)!='http') {
					$link[2] = URL_REDTRABAJA.$link[2];
				}
				$retval[] = $link[2];
			}
		}

		return $retval;
	}
}