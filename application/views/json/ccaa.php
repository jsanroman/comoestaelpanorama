{"points":[
<?php
$points = '';
foreach ($ccaa as $ca) {

	$points .= '{"lat":'.$ca->lat.',"lng":'.$ca->lng.'},';

}

$points = substr($points, 0, strlen($points)-1);
echo $points;
?>
]}