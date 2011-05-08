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

	public function get_datos($localidad_id, $tipo_dato) {

		$query = '
		SELECT dato, mes, anho
		FROM dato  
		WHERE localidad_id='.$localidad_id.' and tipo_dato='.$tipo_dato.' and anho in (2010,2011) 
		ORDER BY anho asc, mes asc';

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
	
	public function get_paro_avg($localidad_id){
		
		$info = "(";
		for ($i=1; $i<4;$i++){
			$info .="d.mes=".date('n',date('U')-($i*30*24*60*60))." AND d.anho=".date('Y',date('U')-($i*30*24*60*60))." OR ";
		}
		$info = substr($info,0,-4).")";
			
		$query = "select d.localidad_id,  avg(d.dato) as media, tipo_dato from dato d  
		where $info AND tipo_dato=1 AND localidad_id=$localidad_id";
		$Q = $this->db->query($query);		

		$data = $Q->result();

		$Q->free_result();

		return $data;
	}
	
	public function get_paro_max($localidad_id){		
			
		$query = "select d.localidad_id, d.dato, tipo_dato from dato d  
		where d.mes=".(date('n')-2)." AND d.anho=".(date('Y')-1)." AND tipo_dato=1 AND localidad_id=$localidad_id";
		$Q = $this->db->query($query);		

		$data = $Q->result();

		$Q->free_result();

		return $data;
	}
	
	public function get_max($tipo){
		$info = "AND (";
		for ($i=1; $i<4;$i++){
			$info .="d.mes=".date('n',date('U')-($i*30*24*60*60))." AND d.anho=".date('Y',date('U')-($i*30*24*60*60))." OR ";
		}
		$info = substr($info,0,-4).")";
		$sum_avg='avg';
		if ($tipo!=1 && $tipo!=2) {
			$info='';
			$sum_avg='sum';	
		}
		
		$query = "select d.localidad_id, $sum_avg(d.dato) as dato,l.poblacion  from dato d,localidad l  
		where l.id=d.localidad_id  
		$info AND tipo_dato=$tipo AND ".date('U')."-d.timestamp < ".MILISECONDS_REGENERATE_JOBS."
		group by localidad_id order by l.poblacion DESC LIMIT 10";
		$Q = $this->db->query($query);		

		$data = $Q->result();

		$Q->free_result();

		return $data;
	}
}
