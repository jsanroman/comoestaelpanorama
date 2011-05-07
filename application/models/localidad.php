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

	public function insert_localidad($nombre, $lat, $lng){
		return $this->insert_generic($nombre, $lat, $lng);		
	}

	public function modify_localidad($array_info){
		return $this->modify_generic($array_info);		
	}

	public function get_localidad($id) {
		return $this->get_generic($id);
	}	

}
