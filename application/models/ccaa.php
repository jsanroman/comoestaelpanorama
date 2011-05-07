<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class ccaa extends CI_Model {
	
	var $id = 0;
	var $nombre = '';
	var $puntuacion = 0;


	public function __construct()
	{
		parent::__construct();
	}


	public function get_ccaa() {

		$query = 'SELECT id, nombre, puntuacion, lat, lng FROM ccaa';

		$Q = $this->db->query($query);

		$data = $Q->result();

		$Q->free_result();

		return $data;
	}
}
