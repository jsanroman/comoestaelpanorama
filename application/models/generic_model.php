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
		$fields = "(";
		$values = "(";
		foreach ($array_info as $index=>$value) {
			if ($index == 'id') continue;
			$fields = "'$index',"; 
			$values ="'$value',"; 
		}
		
		$fields = substr($fields,-1).")";
		$values = substr($fields,-1).")";
		
		$query = "UPDATE {$this->type} $fields VALUES $values WHERE id='{$array_info['id']}'";		
		$Q = $this->db->query($query);
		return $Q;
	}

	public function get_generic($id) {
		$puntuacion = ($type=='localidad') ? 'puntuacion,' : '';
		$where = ($id=='all') ? '' : "WHERE id='$id'";
		$query = "SELECT id, nombre, $puntuacion lat, lng FROM {$this->type} $where";
		$Q = $this->db->query($query);
		$data = $Q->result();
		$Q->free_result();
		return $data;
	}
	
	public function search_generic($name) {
		
		$query = "SELECT id FROM {$this->type} WHERE name LIKE '%$name%'";
		$Q = $this->db->query($query);
		$data = $Q->result();
		$Q->free_result();
		return $data;
	}	
}