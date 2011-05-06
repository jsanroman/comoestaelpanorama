<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class ccaa extends CI_Model {
	
	var $id = 0;
	var $localidad_id = '';
	var $provincia_id = 0;
	var $ccaa_id = 0;
	var $mes = 0;
	var $anho = 0;
	var $dato = 0;
	var $tipo_dato = 0;
	var $timestamp = 0;


	public function __construct()
	{
		parent::__construct();
	}



}
