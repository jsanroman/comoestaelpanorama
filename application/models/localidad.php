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

	public function get_localidades($lat_ne, $lng_ne, $lat_sw, $lng_sw) {

		$month = $this->dato->get_month_last();
		$year  = $this->dato->get_year_last();

		$query = '
		SELECT distinct l.* 
		FROM localidad l 
		LEFT JOIN dato d ON d.localidad_id=l.id 
		WHERE 	lat <= '.$lat_ne.' AND 
				lat >= '.$lat_sw.' AND 
				lng <= '.$lng_ne.' AND 
				lng >= '.$lng_sw.' AND 
				d.mes="'.$month.'" AND 
				d.anho="'.$year.'" 
		LIMIT 30
		';

		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');
		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');
		log_message('debug',$query);
		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');
		log_message('debug','MES: '.$month);
		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');



		$Q = $this->db->query($query);

		$data = $Q->result();

		$Q->free_result();

		$retval = null;

		foreach ($data as $p) {

//			print_r($p);
			
			$datos = $this->dato->get_dato($month, $year, $p->id, null);

			foreach ($datos as $d) {
				
//				print_r($d);
				
				switch ($d->tipo_dato) {
					case DATO_PARO:
						$p->paro = $d->dato;
						break;
					case DATO_OFERTAS:
						$p->ofertas = $d->dato;
						break;
				}
			}

			$retval[] = $p;
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
}
