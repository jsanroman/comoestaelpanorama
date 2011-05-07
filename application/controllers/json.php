<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class json extends MYController {

	var $layout = 'layouts/json.php';

	public function ccaa()
	{
		$ccaa = $this->ccaa->get_ccaa('all');
		
		$this->data['content_body'] = $this->load->view('json/ccaa', array('ccaa'=>$ccaa), true);
	}


	public function locations() {
		$this->data['content_body'] = $this->load->view('json/locations', null, true);
	}
}

/* End of file json.php */
/* Location: ./application/controllers/json.php */