<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class json extends MYController {

	var $layout = 'layouts/json.php';

	public function points($lat_ne=null, $lng_ne=null, $lat_sw=null, $lng_sw=null, $zoom=null)
	{
		if(!$zoom || !$lat_ne || !$lng_ne || !$lat_sw || !$lng_sw || $zoom<8) {
			$d['points'] = $this->ccaa->get_ccaa('all');
			$d['entity'] = 'ccaa';
		} else {
			$d['points'] = $this->localidad->get_localidades($lat_ne, $lng_ne, $lat_sw, $lng_sw);
			$d['entity'] = 'localidad';
		}

		$this->data['content_body'] = $this->load->view('json/points', $d, true);
	}


	public function locations() {
		$this->data['content_body'] = $this->load->view('json/locations', null, true);
	}
	
	
	public function search() {
		
//			$conds['collection_id'] = $this->input->post('collection');
		
		log_message('debug',$this->input->post('text_search'));
		
		$d['localidades'] = $this->localidad->search_location($this->input->post('text_search'));
		
		$this->data['content_body'] = $this->load->view('json/search', $d, true);
	}
	
}

/* End of file json.php */
/* Location: ./application/controllers/json.php */