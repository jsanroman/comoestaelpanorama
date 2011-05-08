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

	<div style="text-align:center;">
		<form action="<?php echo base_url();?>/json/search" method="post" id="search">
			<input type="text" id="text_search" name="text_search" value="<?php echo $user_pos['geoplugin_city']?>"/>
			<input type="submit" value="Buscar"/> 
		</form>
	</div> 
	<div style="font-size:11px;margin-left:140px;">Escribe el nombre de un municipio</div>
</div>

	<table width="900">
		<tr>
			<td widht="435">
			<div class="block yellow" style="margin-top:30px;height:250px;widht:430px">
				<div class="title">Han bajado su tasa de paro...</div>
			<?php foreach ($ranking['paro'] as $index=>$value){ ?>
				En <a href="c/detail/<?=$index?>"><?=$value['nombre']?></a><br/>
			<?php }?>
			</div>
			</td>
			<td width="30"></td>
			<td widht="435">
			<div class="block yellow" style="margin-top:30px;height:250px;widht:430px">
			<div class="title">...y hay m&aacute;s ofertas por demandante</div>			
			<?php foreach ($ranking['oferta'] as $index=>$value){ ?>
				en <a href="c/detail/<?=$index?>"><?=$value['ofertas_parados']?></a><br/>
			<?php }?>
			</div>
			</td>
		</tr>		
	</table>

<div style="margin-top:40px;font-size:12px;">
<div class="title">Es importante que sepas...</div>
<p>Este proyecto ha sido desarrollado en solo 48 horas para participar en el desafio <a href="http://www.abredatos.es" target="_blank">abredatos 2011</a> celebrado los días 7 y 8 de mayo.</p>
<p>La valoración que ves en los colores del mapa se basa en la relación del número de parados y ofertas de empleo en cada sitio.</p>
<p>El número de ofertas es orientativo. Lo hemos obtenido de <a href="http://opcionempleo.com" target="_blank">opcionempleo.com</a> puesto que ningún organismo oficial tenía un número de ofertas suficiente como para poder desarrollar este proyecto.</p>
<p>El número de parados y nuevos contratos lo obtenemos de <a href="https://www.redtrabaja.es/es/redtrabaja/static/Redirect.do?page=statsMunicipios" target="_blank">https://www.redtrabaja.es/es/redtrabaja/static/Redirect.do?page=statsMunicipios</a>.</p>
<p>Mas info de este proyecto en <a href="<?php echo base_url()?>c/sobre">Sobre el proyecto</a></p>

<p><a href="http://www.twitter.com/comostapanorama"><img src="http://twitter-badges.s3.amazonaws.com/t_logo-a.png" alt="Follow comostapanorama on Twitter"/></a></p>
<p><a href="http://www.facebook.com/pages/Como-est%C3%A1-el-panorama-Abredatos-2011/200848863284374" target="_TOP" title="Como está el panorama - Abredatos 2011"><img src="http://badge.facebook.com/badge/200848863284374.1639.2076605815.png" width="126" height="84" style="border: 0px;" /></a><!-- Facebook Badge END --></p>

</div>
	</div>
</div>

	<br/><br/><br/><br/>
	
</div>