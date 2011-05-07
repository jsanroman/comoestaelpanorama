<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data extends MYController {

	public function parser_xls_paro() {
	
		ini_set('max_execution_time', 0);

		$parser = new ParserXlsParadosContratos();
		$parser->parser();

		
		$this->data['content_body'] = null;
	}
	
	public function parser_xls_padron() {
	
		ini_set('max_execution_time', 0);

		$parser = new ParserXLSpadron();
		$parser->parser();

		
		$this->data['content_body'] = null;
	}
	
}