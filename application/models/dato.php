<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class dato extends CI_Model {
	
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


	public function get_month_last () {
		
		$query = ' SELECT MAX(mes) as mes FROM dato';

		$Q = $this->db->query($query);

		$data = $Q->result();

		$Q->free_result();
		
		if($data && count($data)>0) {
			return $data[0]->mes;
		}
	}
	
	public function get_year_last () {
		
		$query = ' SELECT MAX(anho) as anho FROM dato';

		$Q = $this->db->query($query);

		$data = $Q->result();

		$Q->free_result();
		
		if($data && count($data)>0) {
			return $data[0]->anho;
		}
	}

	public function get_dato($month, $year, $localidad_id, $ccaa_id, $tipo_dato) {
		
		$query = '
		SELECT SUM(dato) as dato, tipo_dato  
		FROM dato  
		WHERE 	1=1 ';
		
		if($month) {
			$query .= 'AND mes="'.$month.'"';
		}
		
		if($year) {
			$query .= 'AND anho="'.$year.'"';
		}
		
		if($localidad_id) {
			$query .= 'AND localidad_id="'.$localidad_id.'"';
		}
		
		if($ccaa_id) {
			$query .= 'AND ccaa_id="'.$ccaa_id.'"';
		}

		if($tipo_dato) {
			$query .= 'AND tipo_dato="'.$tipo_dato.'"';
		}

		$query .= ' GROUP BY tipo_dato ';


		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');
		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');
		log_message('debug',$query);
		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');
		log_message('debug','-------------------------------------------------------------------------------------------------------------------------');


		$Q = $this->db->query($query);

		$data = $Q->result();

		$Q->free_result();

		return $data;
	}
}
