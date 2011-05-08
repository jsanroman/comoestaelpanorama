

<h3>El empleo en <?php echo $localidad->nombre;?></h3>

<div id="detail">

<div id="map_canvas"></div>

<?php 
print_r($localidad);

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
}
$eje_y_paro = "|{$min_paro}|{$max_paro}";
$linea_paro = substr($linea_paro,0,strlen($linea_paro)-1);
?>

<img src="http://chart.apis.google.com/chart?chxl=
0:<?php echo $eje_x_paro;?>
1:%7C%7C
2:<?php echo $eje_y_paro;?>&
chxr=1,0,83.333&chxs=0,00AA00,14,0.5,l,676767&chxt=x,r,y&chs=900x250&cht=lc&chco=FF0000&
chd=t:<?php echo $linea_paro;?>&
chg=20,25&chls=4
&chds=<?php echo $min_paro;?>,<?php echo $max_paro;?>"/>


<?php
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
}
$eje_y_contr = "|{$min_contr}|{$max_contr}";
$linea_contr = substr($linea_contr,0,strlen($linea_contr)-1);
?>
<img src="http://chart.apis.google.com/chart?chxl=
0:<?php echo $eje_x_contr;?>
1:%7C%7C
2:<?php echo $eje_y_contr;?>&
chxr=1,0,83.333&chxs=0,00AA00,14,0.5,l,676767&chxt=x,r,y&chs=900x250&cht=lc&chco=FF0000&
chd=t:<?php echo $linea_contr;?>&
chg=20,25&chls=4
&chds=<?php echo $min_contr;?>,<?php echo $max_contr;?>"/>




<?php 

echo 'Actualmente '.$ofertas->hits.' ofertas en '.$localidad->nombre;

foreach ($ofertas->jobs as $job) {


	echo '<a href="'.$job->url.'">'.$job->title.'</a>';

//  	echo "<div style='margin:20px;border:1px solid;'>";
//    echo " <p>URL:     ".$job->url."</p>" ;
//    echo " <p>TITLE:   ".$job->title."</p>" ;
//    echo " <p>LOC:     ".$job->locations."</p>";
//    echo " <p>COMPANY: ".$job->company."</p>" ;
//    echo " <p>SALARY:  ".$job->salary."</p>" ;
//    echo " <p>DATE:    ".$job->date."</p>" ;
//    echo " <p>DESC:    ".$job->description."</p>" ;
//    echo " SITE:   ".$job->site."\n" ;
//    echo "</div>";
	
}

//print_r($ofertas);
?>

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

