<div id="index">


<div id="map_canvas"></div>

<div style="height:160px;">
<div class="block red floatleft" style="margin:0px;">

	<div class="title">... en España</div>

	<div style="text-align:center;">
		<div class="text_right floatleft">
			<div class="cifra"><spam class="red"><?php echo number_format($parados[0]->dato,0,'','.');?></spam></div>
			parados&nbsp;&nbsp;&nbsp;
		</div> 
		<span class="floatleft sep_cifra"></span>
		<div class="text_right floatleft">
			<div class="cifra"><spam class="green"><?php echo number_format($contratos[0]->dato,0,'','.');?></spam></div>
			nuevos contratos&nbsp;&nbsp;&nbsp;
		</div> 
		<span class="floatleft sep_cifra"></span>
		<div class="text_right floatleft">
			<div class="cifra"><spam class="green"><?php echo number_format($ofertas,0,'','.');?></spam></div>
			ofertas&nbsp;&nbsp;&nbsp;
		</div>
	</div> 
</div>


<div class="block blue floatleft" style="margin-left:5px;height:110px;">

	<div class="title">...y en tu zona?</div>

	<div class="text_right">
		<form action="<?php echo base_url();?>/json/search" method="post" id="search">
			<input type="text" id="text_search" name="text_search" /><br/>
			<input type="submit" value="Buscar"/> 
		</form>
	</div> 
</div>
</div>

<div style="margin-top:20px;">
	<div class="block green">
	
		<div class="title">¿Dudas entre 2 sitios?</div>
	
		<div class="text_right">
			<form action="" method="post">
				<input type="text" /><br/>
				<input type="submit" value="Buscar"/> 
			</form>
		</div> 
	</div>
	
	
	
	<div class="block blue">
	
		<div class="title">... y en tu zona?</div>
	
		<div class="text_right">
			<form action="" method="post">
				<input type="text" /><br/>
				<input type="submit" value="Buscar"/> 
			</form>
		</div> 
	</div>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>