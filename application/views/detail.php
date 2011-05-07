

<h3>El empleo en <?php echo $localidad->nombre;?></h3>

<div id="detail">

<div id="map_canvas"></div>

<?php 
print_r($localidad);
?>


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