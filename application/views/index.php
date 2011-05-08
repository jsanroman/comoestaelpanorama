<div id="index">


<div id="map_canvas"></div>
<div style="margin-top:-30px;margin-bottom:20px;"><img src="<?php echo base_url();?>/images/leyenda1.png"/></div>

<div class="block red floatleft" style="width:875px;margin:0px;">

	<div class="title">... en España</div>

	<div style="text-align:center;">
		<div class="text_right floatleft" style="width:290px;">
			<div class="cifra"><spam class="red"><?php echo number_format($parados[0]->dato,0,'','.');?></spam></div>
			parados&nbsp;&nbsp;&nbsp;
		</div> 
		<div class="text_right floatleft" style="width:290px;">
			<div class="cifra"><spam class="green"><?php echo number_format($contratos[0]->dato,0,'','.');?></spam></div>
			nuevos contratos en marzo&nbsp;&nbsp;&nbsp;
		</div> 
		<div class="text_right floatleft" style="width:290px;">
			<div class="cifra"><spam class="green"><?php echo number_format($ofertas,0,'','.');?></spam></div>
			ofertas hoy&nbsp;&nbsp;&nbsp;
		</div>
	</div> 
</div>


<div class="block blue" style="height:110px;margin-top:180px;">

	<div class="title">...y en tu zona?</div>

	<div>
		<form action="<?php echo base_url();?>/json/search" method="post" id="search">
			<input type="text" id="text_search" name="text_search" />
			<input type="submit" value="Buscar"/> 
		</form>
	</div> 
	<div style="font-size:11px;">inserta y busca tu municipio</div>
</div>
</div>

<!-- 
	<div class="block yellow" style="margin-top:30px;">
	
		<div class="title">El Ranking de municipios</div>

		<div>
		Aqui los municipios
		</div>	

	</div>
 -->
	<br/><br/><br/><br/>
	
</div>