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
			<input type="text" id="text_search" name="text_search" value="<?php echo $user_pos['geoplugin_city']?>"/>
			<input type="submit" value="Buscar"/> 
		</form>
	</div> 
	<div style="font-size:11px;">inserta y busca tu municipio</div>
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
	</div>
</div>

	<br/><br/><br/><br/>
	
</div>