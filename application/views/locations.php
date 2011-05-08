<div id="sobre">

<div class="block morao">
	<div class="title">Los municipios de <strong><?php echo $ccaa->nombre;?></strong></div>
<div style="height:500px;overflow-y: scroll;">
<?php 
foreach ($localidades as $l) {
	echo '<a href="'.base_url().'c/detail/'.$l->id.'" class="link_proxima">'.$l->nombre.'</a>';
}
?>
</div>
</div>
</div>