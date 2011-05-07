<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class ccaa extends generic_model {
	
	var $id = 0;
	var $nombre = '';
	var $puntuacion = 0;


	public function __construct()
	{
		parent::__construct('ccaa');
	}
	
	public function insert_ccaa($nombre, $lat, $lng){
		return $this->insert_generic($nombre, $lat, $lng);		
	}

	public function modify_ccaa($array_info){
		return $this->modify_generic($array_info);		
	}

	public function get_ccaa() {
		$ccaa = $this->get_generic('all');
		$retval = null;
		foreach ($ccaa as $ca) {

			$datos = $this->dato->get_dato($month, $year, null, $ca->id);
			foreach ($datos as $d) {
//				print_r($d);			
				switch ($d->tipo_dato) {
					case DATO_PARO:
						$ca->paro = $d->dato;
						break;
//					case DATO_OFERTAS:
//						$p->ofertas = $d->dato;
//						break;
				}
			}


			$ca->ofertas = $this->ofertas->get_num_ofertas(null, $ca->id, $ca->nombre);
					
			$lat = $ca->lat;			
			if ('' == $lat){				
				require_once 'application/libraries/JSON.php';
				
				$nombre = $ca->nombre;
				$location = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".urlencode($nombre).",ES&sensor=false");			
				$location_decode = json_decode($location);
										
				if (isset($location_decode->results[0])){
					$ca->lat = $location_decode->results[0]->geometry->location->lat;
					$ca->lng = $location_decode->results[0]->geometry->location->lng;
					
					$info = array('id'=>$ca->id,
									'lat'=>$ca->lat,
									'lng'=>$ca->lng);
					$this->ccaa->modify_ccaa($info);
				} 							
			}
			
			$retval[] = $ca;
		}
		return $retval;
	}
			
	public function get_id($name){
		return $this->search_generic($name);
	}
}
