<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class generic_model extends CI_Model {		
	var $type = '';	

	public function __construct($type = '')
	{
		parent::__construct();
		$this->type = $type;
	}
	
	public function insert_generic($nombre, $lat, $lng, $id_parent = false, $poblacion = false){
		if (false !== $poblacion) {
			$field = ',poblacion';
			$value = ",'$poblacion'";	
		}
		if (false !== $id_parent){
			$field .= ",".$id_parent['id'];
			$value .= ",".$id_parent['value'];
		}  
		
		$query = "INSERT INTO {$this->type} (nombre, lat, lng $field) VALUES ('$nombre','$lat','$lng' $value)";
		$Q = $this->db->query($query);
		return $Q;
	}

	public function modify_generic($array_info){
		
		foreach ($array_info as $index=>$value) {
			if ($index == 'id') continue;
			$fields .= "$index='$value',"; 
		}
		$fields = substr($fields,0,-1);		
		
		$query = "UPDATE {$this->type} SET $fields WHERE id='{$array_info['id']}'";		
		$Q = $this->db->query($query);
		return $Q;
	}

	public function get_generic($id, $limit = 50) {
		$puntuacion = ($type=='localidad') ? 'puntuacion,' : '';
		$where = ($id=='all') ? '' : "WHERE id='$id'";
		$query = "SELECT id, nombre, $puntuacion lat, lng FROM {$this->type} $where LIMIT $limit";
		$Q = $this->db->query($query);
		$data = $Q->result();
		$Q->free_result();
		return $data;
	}
	
	public function search_generic($name) {
		
		$query = "SELECT id FROM {$this->type} WHERE nombre LIKE '%$name%'";
		$Q = $this->db->query($query);
		$data = $Q->result();
		$Q->free_result();
		return $data;
	}	

	public function get_generic_parent($id, $parent = 'provincia') {
		
		$query = "SELECT {$parent}_id FROM {$this->type} WHERE id = $id";
		$Q = $this->db->query($query);
		$data = $Q->result();
		$Q->free_result();
		return $data;
	}
}