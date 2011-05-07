<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/JSON.php';
require_once "Services_Careerjet.php" ;

class Ofertas {
	/**
	 * CodeIgniter global
	 *
	 * @var string
	 **/
	protected $ci;


	/**
	 * __construct
	 *
	 * @return void
	 * @author
	 **/
	public function __construct() {
		$this->ci =& get_instance();
	}


	public function get_num_ofertas($localidad_id, $ccaa_id, $location, $tipo_dato=DATO_OFERTAS) {

		$ofertas = $this->ci->dato->get_dato(null, null, $localidad_id, $ccaa_id, $tipo_dato);

		if($ofertas!=null && count($ofertas)>0) {
			if( (time()-$ofertas[0]->timestamp)  < MILISECONDS_REGENERATE_JOBS) {
				return $ofertas[0]->dato;
			}
		}

		$api = new Services_Careerjet('es_ES');
		$page = 1 ; # Or from parameters.


		$result = $api->search(array( 'keywords' => '',
                              'location' => $location,
                              'page' => $page ,
                              'pagesize' => 0)
		);

		if ( $result->type == 'JOBS' ){

			// TODO Insertar/Actualizar bbdd

			return $result->hits;
		}
	}
	

	public function get_ofertas($location) {
		
		$api = new Services_Careerjet('es_ES');
		$page = 1 ; # Or from parameters.

		$result = $api->search(array( 'keywords' => '',
                              'location' => $location,
                              'page' => $page ,
                              'pagesize' => 20)
		);

		if ( $result->type == 'JOBS' ){

			// TODO Insertar/Actualizar bbdd

			return $result;
		}
	}
}