<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rank {
	/**
	 * CodeIgniter global
	 *
	 * @var string
	 **/
	protected $ci;
	public $localidad = '';
	public $puntuacion = 0;
	private $peso_a = 20;
	private $peso_b = 20;
	private $peso_c = 60;	
	
	public function __construct() {
		$this->ci =& get_instance();				
	}				
	
	public function get_rank(){
		$max_paro=$this->ci->dato->get_max(1);
		$max_ofertas=$this->ci->dato->get_max(3);
		//$max_contratos=$this->ci->dato->get_max(2);						
		
		foreach ($max_paro as $index=>$value){
				$datos = $this->ci->dato->get_paro_max($value->localidad_id);
				$datos=$datos[0];						
				$media = intval($datos->dato);	
				echo $value->dato." < ".$media."<br/>";												
				if (intval($value->dato) < $media) {
					$d['paro'][$value->localidad_id]['paro'] = intval($value->dato);
				}							
		}				
		
		foreach ($max_ofertas as $index=>$value){
			$datos = $this->ci->dato->get_paro_avg($value->localidad_id);
			$datos=$datos[0];
			$media = intval($datos->media);
			$d['oferta'][$value->localidad_id]['ofertas_parados'] = $value->dato / $media;			
		}
		
		return $d;
				
	}
	
	
}