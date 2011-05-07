{points:[
<?php
$data_json = '';
foreach ($points as $p) {

	
	if(!$p->paro) $p->paro = 0;
	if(!$p->ofertas) $p->ofertas = 0;
	
	
	$data_json .= '{nombre: "'.$p->nombre.'sdlkjfhskjdfhlsjdh",
				 lat:'.$p->lat.',
				 lng:'.$p->lng.',
				 paro:'.$p->paro.',
				 ofertas:'.$p->ofertas.'
				},';

}

$data_json = substr($data_json, 0, strlen($data_json)-1);
echo $data_json;
?>
]}