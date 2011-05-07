<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C extends MYController {


	public function index()
	{
		$this->data['content_body'] = $this->load->view('index', null, true);
	}


	public function detail($id) {

		$l = $this->localidad->get_localidad($id);
		$data['localidad'] = $l[0];
		
		$ofertas = $this->ofertas->get_num_ofertas($l->id, $l->nombre);

		echo $ofertas;

		$this->data['content_body'] = $this->load->view('detail', $data, true);
	}
}

/* End of file c.php */
/* Location: ./application/controllers/c.php */