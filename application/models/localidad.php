<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class localidad extends CI_Model {
	
	var $id = 0;
	var $nombre = '';
	var $ccaa_id = 0;
	var $puntuacion = 0;
	var $poblacion = 0;


	public function __construct()
	{
		parent::__construct();
	}



}
