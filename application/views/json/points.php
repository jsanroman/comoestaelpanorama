{points:[
<?php
$data_json = '';
foreach ($points as $p) {

	$color = 'pto_1';
	
	if(!$p->paro) $p->paro = 0;
	if(!$p->ofertas) $p->ofertas = 0;

	$styleClass = 'pto_3';

	if($p->paro<100) {
		$styleClass = 'pto_1';
	} else if ($p->paro<500) {
		$styleClass = 'pto_2';
	}


	$data_json .= '{nombre: "'.$p->nombre.'",
				 lat:'.$p->lat.',
				 lng:'.$p->lng.',
				 paro:'.$p->paro.',
				 ofertas:'.$p->ofertas.',
				 styleClass:"'.$styleClass.'"
				},';
}

$data_json = substr($data_json, 0, strlen($data_json)-1);
echo $data_json;
?>
]}