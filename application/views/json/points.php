{points:[
<?php
$data_json = '';
foreach ($points as $p) {

	$data_json .= '{nombre: "'.$p->nombre.'sdlkjfhskjdfhlsjdh",
				 lat:'.$p->lat.',
				 lng:'.$p->lng.'
				},';

}

$data_json = substr($data_json, 0, strlen($data_json)-1);
echo $data_json;
?>
]}