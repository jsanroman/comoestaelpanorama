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
		
		$data['proximas']= $this->localidad->localidades_proximas($data['localidad']->lat, $data['localidad']->lng);
		
		$this->data['content_body'] = $this->load->view('detail', $data, true);
	}
	
	
	public function sobre() {
	
		$this->data['content_body'] = $this->load->view('sobre', null, true);
	}
	
	public function locations($ccaa_id) {

		$d['localidades'] = $this->localidad->get_localidades_ccaa($ccaa_id);
		
		$d['ccaa'] = $this->ccaa->get_ccaa_by_id($ccaa_id);
		
		$this->data['content_body'] = $this->load->view('locations', $d, true);
	}
}

/* End of file c.php */
/* Location: ./application/controllers/c.php */