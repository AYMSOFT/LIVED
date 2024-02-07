<?php # **************************** AYMCORE V: 14.0 ********************
# ACERCA DE AYMCORE
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
	
# INCLUSIÓN --> PROCEDIMIENTO QUE TRAE TRAE LOS DATOS DE LA APLICACIÓN 
include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_about.php';

?>
<section id="aym_wrap_menu_footer">
	<h2>Acerca de <?=$row_get_about["abo_nam"]?></h2>
	<hr>
	<figure>
		<img src="/admin/aym_image/aym_icon/aym_core.png">
	</figure>
	<article>
		<div>
			<span>Versión: </span>
			<span><?=$row_get_about["abo_ver"]?></span>
		</div>
		<div>
			<span>Numero del Producto: </span>
			<span><?=$row_get_about["abo_pro_num"]?></span>
		</div>
		<div>
			<span>Tipo de Licencia: </span>
			<span><?=$row_get_about["abo_lic"]?></span>
		</div>
		<div>	
			<span>Licenciado a: </span>
			<span><?=$row_get_about["abo_bel"]?></span>
		</div>
		
		<div>	
			<span>Fecha de Inicio: </span>
			<span><?=$row_get_about["abo_dat_ini"]?></span>
		</div>
		<div>	
			<span>Fecha de Vencimiento: </span>
			<span><?=$row_get_about["abo_dat_exp"]?></span>
		</div>
		<div>
			<span>ID: </span>
			<span><?=strtoupper(md5($row_get_about["abo_id"]))?></span>
		</div>
		<div class="aym_copy">
			<span>&copy; <?=date("Y")?> AyMsoft. Todos los derechos reservados.</span>
		</div>
		<p><?= strip_tags($row_get_about["abo_des"])?></p>
	</article>
</section>