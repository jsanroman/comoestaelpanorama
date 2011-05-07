<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class json extends MYController {

	var $layout = 'layouts/json.php';

	public function points($lat_ne=null, $lng_ne=null, $lat_sw=null, $lng_sw=null, $zoom=null)
	{
		if(!$zoom || !$lat_ne || !$lng_ne || !$lat_sw || !$lng_sw || $zoom<8) {
			$points = $this->ccaa->get_ccaa('all');
		} else {

			$points = $this->localidad->get_localidades($lat_ne, $lng_ne, $lat_sw, $lng_sw);
			

		}

		$this->data['content_body'] = $this->load->view('json/points', array('points'=>$points), true);
	}


	public function locations() {
		$this->data['content_body'] = $this->load->view('json/locations', null, true);
	}
}

/* End of file json.php */
/* Location: ./application/controllers/json.php */