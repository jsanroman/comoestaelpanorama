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
}
