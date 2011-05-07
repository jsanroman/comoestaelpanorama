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


	public function get_month_last ($year) {
		
		$query = ' SELECT MAX(mes) as mes FROM dato WHERE anho='.$year;

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

	public function get_dato($month, $year, $localidad_id, $ccaa_id, $tipo_dato=null) {
		
		$query = '
		SELECT SUM(dato) as dato, tipo_dato, timestamp 
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
	
	public function insert_dato_auto($name, $mes, $anho, $dato, $tipo_dato){		
		$array_name = split(' ',$name);//por si es nombre compuesto...
		if (isset($array_name[1])){			
			$best_name = '';			
			foreach ($array_name as $index=>$biggest) {											
				$len1 = strlen($best_name);
				$len2 = strlen($biggest);
				$best_name = ($len1 < $len2) ? $biggest : $best_name;									
			}
			log_message('DEBUG',"Best name for '$name' is $best_name");
		}
		
		
		$localidad_id = $this->localidad->search_location(strtolower($name));	
		if (isset($localidad_id[0])){
			$localidad_id = $localidad_id[0]->id;
		} else if (isset($best_name)){			
			$name = $best_name;
			unset($best_name);
			$localidad_id = $this->localidad->search_generic(strtolower($name));				
			$localidad_id = $localidad_id[0]->id;
		}
		
		if (!$localidad_id) return false;
		
		$provincia_id = $this->localidad->get_parent_id($localidad_id);
		$provincia_id = $provincia_id[0]->provincia_id;
		$ccaa_id = $this->provincia->get_parent_id($provincia_id);
		$ccaa_id = $ccaa_id[0]->ccaa_id;
		
		if (!($localidad_id && $provincia_id && $ccaa_id)){
			log_message('DEBUG',"Error in $name : id->$localidad_id provincia_id->$provincia_id cca_id->$ccaa_id"); 
			return false;
		}

		$timestamp = date('U');
		$query = "INSERT INTO dato (localidad_id, provincia_id, ccaa_id, mes, anho, dato, tipo_dato, timestamp) VALUES ('$localidad_id','$provincia_id','$ccaa_id', '$mes', '$anho', '$dato', '$tipo_dato', '$timestamp')";
//		log_message('DEBUG',"inserting dato $query");		
		return $this->db->query($query);
	}


	public function insert_dato_oferta($localidad_id, $ccaa_id, $dato, $tipo_dato) {

		$timestamp = date('U');
		$query = "INSERT INTO dato (localidad_id, provincia_id, ccaa_id, mes, anho, dato, tipo_dato, timestamp) 
		VALUES ('$localidad_id','','$ccaa_id', '', '', '$dato', '$tipo_dato', '$timestamp')";
//		log_message('DEBUG',"inserting dato $query");		
		return $this->db->query($query);
	}
	
	public function get_parados_ahora() {
		log_message('debug','++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++');
		$year = $this->get_year_last();
		$month = $this->get_month_last($year);
		$dato = $this->get_dato($month, $year, null, null, DATO_PARO);
		return $dato;
	}

	public function get_contratos_anho() {
		$dato = $this->get_dato(null, $this->get_year_last(), null, null, DATO_CONTRATOS);
		return $dato;
	}
}
