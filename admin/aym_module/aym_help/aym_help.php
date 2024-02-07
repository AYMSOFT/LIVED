<?php # **************************** AYMCORE V: 14.0 ********************
# MODULO QUE LISTA LOS INSTRUCTIVOS DE AYUDA
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	if(!$_SESSION['alr']): $_SESSION['alr']="aymsoft"; endif;

	# INCLUSIÓN --> PROCEDIMIENTO QUE TRAE TRAE LOS DATOS DE LA APLICACIÓN 
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_about.php'; 
?>
<h2>Instructivo paso a paso</h2>
<div class="aym_wrap_form">
	<ol>
		<li><a href="/admin/aym_document/aym_help/manual_de_usuario_para_iniciar_sesion.pdf" target="_blank">Instructivo paso a paso para iniciar sesión</a></li>
		<li><a href="/admin/aym_document/aym_help/manual_paso_a_paso_para_recuperar_contraseña.pdf" target="_blank">Instructivo paso a paso para recuperar contraseña</a></li>
		<li><a href="/admin/aym_document/aym_help/manual_de_usuario_para_la_administracion_de_usuarios.pdf" target="_blank">Instructivo paso a paso para la administrar usuario</a></li>
		<li><a href="/admin/aym_document/aym_help/manual_de_usuario_para_la_administracion_de_perfiles.pdf" target="_blank">Instructivo paso a paso para la administrar perfiles</a></li>
		<?php /*<li><a href="/admin/aym_document/aym_help/instructivo_paso_a_paso_para_administrar_contenidos.pdf" target="_blank">Instructivo paso a paso para la administrar contenido</a></li>
		<li><a href="/admin/aym_document/aym_help/instructivo_paso_a_paso_para_administrar_galerias.pdf" target="_blank">Instructivo paso a paso para la administrar galería</a></li>
		<li><a href="/admin/aym_document/aym_help/instructivo_paso_a_paso_para_administrar_noticias.pdf" target="_blank">Instructivo paso a paso para la administrar noticias</a></li> */?>
	</ol>
</div>

 