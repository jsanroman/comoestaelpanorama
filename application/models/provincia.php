<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class provincia extends generic_model {
	
	var $id = 0;
	var $nombre = '';
	var $puntuacion = 0;


	public function __construct()
	{
		parent::__construct('provincia');
	}

	public function insert_provincia($nombre, $lat, $lng){
		return $this->insert_generic($nombre, $lat, $lng);		
	}

	public function modify_provincia($array_info){
		return $this->modify_generic($array_info);		
	}

	public function get_provincia($id) {
		return $this->get_generic($id);
	}
	
	public function get_id($name){
		return $this->search_generic($name);
	}
	
	public function get_parent_id($name){
		return $this->get_generic_parent($name,'ccaa');
	}
	
	
	public function update_geolocation() {

		$query = 'SELECT * FROM provincia';

		$Q = $this->db->query($query);

		$provincias = $Q->result();

		$Q->free_result();

		if($provincias[0]->lat=='') {
			foreach ($provincias as $p) {

				$lat = $p->lat;			
				if ('' == $lat){				
					require_once 'application/libraries/JSON.php';
					
					$nombre = $p->nombre;
					$location = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".urlencode($nombre).",ES&sensor=false");			
					$location_decode = json_decode($location);
											
					if (isset($location_decode->results[0])){
						$p->lat = $location_decode->results[0]->geometry->location->lat;
						$p->lng = $location_decode->results[0]->geometry->location->lng;
						
						$info = array('id'=>$p->id,
										'lat'=>$p->lat,
										'lng'=>$p->lng);
						$this->modify_provincia($info);
					} 							
				}
			}
		}
	}
	
	public function get_provicias($lat_ne, $lng_ne, $lat_sw, $lng_sw) {

		$query = '
		SELECT p.* 
		FROM provincia p';
		if($lat_ne!=null) {
			$query.='  
			WHERE 	p.lat <= "'.$lat_ne.'" AND 
					p.lat >= "'.$lat_sw.'" AND 
					p.lng <= "'.$lng_ne.'" AND 
					p.lng >= "'.$lng_sw.'" 
			';
		}

		log_message('debug', $query);

		$Q = $this->db->query($query);

		$provincias = $Q->result();

		$Q->free_result();
		return $provincias;
	}
}
