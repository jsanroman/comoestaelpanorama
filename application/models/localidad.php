<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class localidad extends generic_model {	
	var $id = 0;
	var $nombre = '';
	var $ccaa_id = 0;
	var $puntuacion = 0;
	var $poblacion = 0;


	public function __construct()
	{
		parent::__construct('localidad');
	}

	public function insert_localidad($nombre, $lat, $lng, $id_provincia ,$poblacion){
		return $this->insert_generic($nombre, $lat, $lng, $id_provincia ,$poblacion);		
	}

	public function modify_localidad($array_info){
		return $this->modify_generic($array_info);		
	}

	public function get_localidad($id) {
		return $this->get_generic($id);
	}	

	public function update_geolocation($provincias) {
	
			
			$query = '
			SELECT l.* 
			FROM localidad l 
			WHERE 	l.lat="" 
			ORDER BY l.poblacion DESC 
			LIMIT 100
			';

			log_message('debug',$query);
			
			$Q = $this->db->query($query);
			$locations = $Q->result();
			$Q->free_result();
	
			foreach ($locations as $l) {
	
					require_once 'application/libraries/JSON.php';
	
					$nombre = $l->nombre;
					$location = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".urlencode($nombre).",ES&sensor=false");			
					$location_decode = json_decode($location);
	
					if (isset($location_decode->results[0])){
						$l->lat = $location_decode->results[0]->geometry->location->lat;
						$l->lng = $location_decode->results[0]->geometry->location->lng;
						
						$info = array('id'=>$l->id,
										'lat'=>$l->lat,
										'lng'=>$l->lng);
						$this->modify_localidad($info);
					}
			}
//		}
	}
	
	
	public function get_localidades_ccaa($ccaa_id) {

			$query = '
			SELECT l.* 
			FROM localidad l 
			LEFT JOIN provincia p ON p.id=l.provincia_id
			WHERE p.ccaa_id='.$ccaa_id.' 
			ORDER BY l.poblacion DESC 
			';

//			log_message('debug',$query);

			$Q = $this->db->query($query);
			$locations = $Q->result();
			$Q->free_result();
			return $locations;
	}
	
	
	public function get_localidades($lat_ne, $lng_ne, $lat_sw, $lng_sw) {


//		$this->provincia->update_geolocation();

		
		$year  = $this->dato->get_year_last();
		$month = $this->dato->get_month_last($year);

//		$provincias = $this->provincia->get_provicias($lat_ne, $lng_ne, $lat_sw, $lng_sw);
//		$provincias = $this->provincia->get_provicias(null, null, null, null);
//		$this->update_geolocation($provincias);
		
		
		
		$query = '
		SELECT distinct l.* 
		FROM localidad l 
		LEFT JOIN dato d ON d.localidad_id=l.id 
		WHERE 	l.lat <= '.$lat_ne.' AND 
				l.lat >= '.$lat_sw.' AND 
				l.lng <= '.$lng_ne.' AND 
				l.lng >= '.$lng_sw.' AND 
				d.mes="'.$month.'" AND 
				d.anho="'.$year.'" 
		ORDER BY l.poblacion DESC 
		LIMIT 30
		';

		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');
		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');
		log_message('debug',$query);
		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');
		log_message('debug','MES: '.$month);
		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');



		$Q = $this->db->query($query);

		$locations = $Q->result();

		$Q->free_result();

		$retval = null;

		foreach ($locations as $l) {

			$datos = $this->dato->get_dato($month, $year, $l->id, null);

			foreach ($datos as $d) {
				
//				print_r($d);
				
				switch ($d->tipo_dato) {
					case DATO_PARO:
						$l->paro = $d->dato;
						break;
//					case DATO_OFERTAS:
//						$p->ofertas = $d->dato;
//						break;
				}
			}

			$l->ofertas = $this->ofertas->get_num_ofertas($l->id, null, $l->nombre);

			$retval[] = $l;
		}

		return $retval;
	}

	
	public function search_location($location) {

		$query = '
		SELECT id 
		FROM localidad 
		WHERE nombre = "'.$location.'"';

		
		log_message('debug',$query);
		
		
		$Q = $this->db->query($query);

		$data = $Q->result();

		$Q->free_result();

		return $data;
	}
	public function get_parent_id($name){
		return $this->get_generic_parent($name,'provincia');
	}
	
	
	public function localidades_proximas($lat, $lng) {
		
		$year  = $this->dato->get_year_last();
		$month = $this->dato->get_month_last($year);
		
		$query = '
		SELECT distinct l.*  
		FROM localidad l 
		ORDER BY (
				 acos(sin(radians('.$lat.')) * sin(radians(l.lat)) +
				 cos(radians('.$lat.')) * cos(radians(l.lat)) *
				 cos(radians('.$lng.') - radians(l.lng))) * 6378
				 )  asc 
		LIMIT 10
		';
		
		
		$Q = $this->db->query($query);

		$data = $Q->result();

		$Q->free_result();

		$retval = null;
		
		foreach ($data as $l) {
			
			$datos = $this->dato->get_dato($month, $year, $l->id, null);

			foreach ($datos as $d) {
				switch ($d->tipo_dato) {
					case DATO_PARO:
						$l->paro = $d->dato;
						break;
				}
			}
			
			$l->ofertas = $this->ofertas->get_num_ofertas($l->id, null, $l->nombre);

			$retval[] = $l;
		}
		
		return $retval;
		
		
	}
}
