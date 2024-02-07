<?php # **************************** AYMCORE V: 14.0 ********************
# MÓDULO DE TERMINOS Y CONDICIONES
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

# INCLUSIÓN --> PROCEDIMIENTO QUE TRAE TRAE LOS DATOS DE LA APLICACIÓN 
include_once $_SERVER['DOCUMENT_ROOT'].'/aymsite/aym_sql/aym_security/aym_sql_get_about.php';
?>
<section id="aym_wrap_menu_footer">
	<h2>Términos y condiciones <?=$_SESSION['abo_bel'],' - ',$_SESSION['abo_nam'],' V ',$_SESSION['abo_ver']?></h2>
	<hr>
	<figure>
		<img src="/admin/aym_image/aym_icon/aym_terms_and_conditions.png">
	</figure>
	<article>
		<p>En desarrollo.</p>
	</article>
</section>