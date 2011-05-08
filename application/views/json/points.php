{points:[
<?php
$data_json = '';

$max = 0;
foreach ($points as $p) {
	$rel = (($p->ofertas*100)/$p->paro);
	if( $max<$rel ) {
		$max = $rel;
	}
}

$interval = $max/5;

foreach ($points as $p) {

	$color = 'pto_1';
	
	if(!$p->paro) $p->paro = 0;
	if(!$p->ofertas) $p->ofertas = 0;

	log_message('debug',(($p->ofertas*100)/$p->paro).','.$p->nombre);

	$styleClass = 'pto_3';

	$rango = ((($p->ofertas*100)/$p->paro));
	
	if( $rango<($interval) ) {
		$styleClass = 'pto_5';
	} else if( $rango<($interval*2) ) {
		$styleClass = 'pto_4';
	} else if( $rango<($interval*3) ) {
		$styleClass = 'pto_3';
	} else if( $rango<($interval*4) ) {
		$styleClass = 'pto_2';
	} else {
		$styleClass = 'pto_1';
	}
	
//	$p->paro<100) {
//		$styleClass = 'pto_1';
//	} else if ($p->paro<500) {
//		$styleClass = 'pto_2';
//	}

	$href='#';
	if($entity=='localidad') $href=base_url().'c/detail/'.$p->id;
	else if($entity=='ccaa') $href=base_url().'c/locations/'.$p->id;

	$data_json .= '{nombre: "'.$p->nombre.'",
				 lat:'.$p->lat.',
				 lng:'.$p->lng.',
				 paro:'.$p->paro.',
				 ofertas:'.$p->ofertas.',
				 styleClass:"'.$styleClass.'",
				 href:"'.$href.'"
				},';
}

$data_json = substr($data_json, 0, strlen($data_json)-1);
echo $data_json;
?>
]}