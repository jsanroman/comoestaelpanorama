<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C extends MYController {


	public function index()
	{
		$this->data['content_body'] = $this->load->view('index', null, true);
	}
}

/* End of file c.php */
/* Location: ./application/controllers/c.php */