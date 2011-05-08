<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C extends MYController {


	public function index()
	{
		$d['parados']   = $this->dato->get_parados_ahora();
		$d['contratos'] = $this->dato->get_contratos_anho();
		$d['ofertas'] 	= $this->ofertas->get_num_ofertas(null, null, 'España', DATO_OFERTAS_ESPANHA);
		
		$this->data['content_body'] = $this->load->view('index', $d, true);
	}


	public function detail($id) {

		$l = $this->localidad->get_localidad($id);
		$data['localidad'] = $l[0];

		$data['ofertas'] = $this->ofertas->get_ofertas($l[0]->nombre);

		
		$data['datos_paro'] = $this->dato->get_datos($id, DATO_PARO);
		$data['datos_contratos'] = $this->dato->get_datos($id, DATO_CONTRATOS);
		
		
		
		$this->data['content_body'] = $this->load->view('detail', $data, true);
	}
}

/* End of file c.php */
/* Location: ./application/controllers/c.php */