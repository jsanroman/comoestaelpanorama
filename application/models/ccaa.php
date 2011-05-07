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

	public function get_ccaa($id) {
		return $this->get_generic($id);
	}	
}
