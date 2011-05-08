

<h3>El empleo en <?php echo $localidad->nombre;?></h3>

<div id="detail">

<div id="map_canvas"></div>

<?php 
$linea_paro = '';
$eje_x_paro 	= '';
$eje_y_paro		= '';
$max_paro=0;
$min_paro=null;
foreach ($datos_paro as $d) {

	$linea_paro .= $d->dato.',';
	if($d->dato>$max_paro) {
		$max_paro = $d->dato;
	}

	if($d->dato<$min_paro || $min_paro==null) {
		$min_paro = $d->dato;
	}

	$eje_x_paro .= '|'.$d->mes.'('.$d->anho.')|';
	
	$paro_hoy = $d->dato;
}
$eje_y_paro = "|{$min_paro}|{$max_paro}";
$linea_paro = substr($linea_paro,0,strlen($linea_paro)-1);


$linea_contr = '';
$eje_x_contr 	= '';
$eje_y_contr		= '';
$max_contr=0;
$min_contr=null;
foreach ($datos_contratos as $d) {

	$linea_contr .= $d->dato.',';
	if($d->dato>$max_contr) {
		$max_contr = $d->dato;
	}

	if($d->dato<$min_contr || $min_contr==null) {
		$min_contr = $d->dato;
	}

	$eje_x_contr .= '|'.$d->mes.'('.$d->anho.')|';
	$contratos_hoy = $d->dato;
}
$eje_y_contr = "|{$min_contr}|{$max_contr}";
$linea_contr = substr($linea_contr,0,strlen($linea_contr)-1);
?>


<div class="block red">
	<div class="title">El Paro</div>

<div class="subtitle">Actualmente <span class="redtext"><?php echo number_format($paro_hoy,0,'','.');?></span> personas sin trabajo en <strong><?php echo $localidad->nombre;?></strong></div>

<img src="http://chart.apis.google.com/chart?chxl=
0:<?php echo $eje_x_paro;?>
1:%7C%7C
2:<?php echo $eje_y_paro;?>&
chxr=1,0,83.333&chxs=0,00AA00,14,0.5,l,676767&chxt=x,r,y&chs=880x250&cht=lc&chco=c43240&
chd=t:<?php echo $linea_paro;?>&
chg=20,25&chls=4
&chds=<?php echo $min_paro;?>,<?php echo $max_paro;?>"/>
</div>

<div class="block green">
	<div class="title">La creación de empleo</div>

<div class="subtitle"><span class="greentext"><?php echo number_format($contratos_hoy,0,'','.');?></span> nuevos contratos en <strong><?php echo $localidad->nombre;?></strong></div>
<img src="http://chart.apis.google.com/chart?chxl=
0:<?php echo $eje_x_contr;?>
1:%7C%7C
2:<?php echo $eje_y_contr;?>&
chxr=1,0,83.333&chxs=0,00AA00,14,0.5,l,676767&chxt=x,r,y&chs=880x250&cht=lc&chco=009444&
chd=t:<?php echo $linea_contr;?>&
chg=20,25&chls=4
&chds=<?php echo $min_contr;?>,<?php echo $max_contr;?>"/>

</div>


<div class="block yellow">
	<div class="title">Las Ofertas de empleo</div>

	<div class="subtitle">Actualmente <span class="yellowtext"><?php echo number_format($ofertas->hits,0,'','.');?></span> ofertas en <strong><?php echo $localidad->nombre;?></strong></div>
	
	<?php 
	
	echo 'Actualmente '.$ofertas->hits.' ofertas en '.$localidad->nombre;
	
	foreach ($ofertas->jobs as $job) {
		echo '<a href="'.$job->url.'" class="link_oferta">'.$job->title.'</a>';
	}
	?>
	</div>
</div>

<div class="block morao">
	<div class="title">y cerca de <strong><?php echo $localidad->nombre;?></strong>?</div>

	<table>
	<tr><th>Municipio</th><th>Ofertas</th><th>Paro</th></tr>
	<?php 
	
	foreach ($proximas as $l) {
		echo '<tr><td><a href="'.$l->id.'" class="link_proxima">'.$l->nombre.'</a></td><td>'.number_format($l->ofertas,0,'','.').'</td><td>'.number_format($l->paro,0,'','.').'</td></tr>';
	}
	?>
	</table>
	</div>
</div>

<script>
function center_detail(){

<?php 
if($localidad->lat && $localidad->lng) {
	
?>
	map.map.setCenter(new google.maps.LatLng('<?php echo $localidad->lat;?>','<?php echo $localidad->lng;?>'));
	map.map.setZoom(9);

<?php 	
}
?>
};
</script>

