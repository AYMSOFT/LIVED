<?php # **************************** AYMCORE V: 14.0 ********************
# MÓDAL DE AYUDA PARA INICIAR SESIÓN
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

# INCLUSIÓN --> PROCEDIMIENTO QUE TRAE TRAE LOS DATOS DE LA APLICACIÓN 
include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_about.php';
?>
<section id="aym_wrap_menu_footer">
	<h2>Ayuda Online de <?=$row_get_about["abo_nam"]?></h2>
	<hr>
	<figure>
		<img src="/admin/aym_image/aym_icon/aym_help.png">
	</figure>
	<article class="aym_wrap_form">
	<ol>
		<li>
			<a href="/admin/aym_document/aym_help/manual_de_usuario_para_iniciar_sesion.pdf" target="_blank">Instructivo paso a paso para iniciar sesión</a>
		</li>
		<li>
			<a href="/admin/aym_document/aym_help/manual_paso_a_paso_para_recuperar_contraseña.pdf" target="_blank">
			Instructivo paso a paso para recuperar contraseña
			</a>
		</li>
	</ol>
	</article>
</section>