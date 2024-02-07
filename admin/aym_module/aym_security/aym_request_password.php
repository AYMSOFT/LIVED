<?php # **************************** AYMCORE V: 14.0 ********************
# MÓDULO PARA RECUPERAR MI CONTRASEÑA
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

session_start(); 

# INCLUSIÓN --> SEGURIDAD DE LA APLICACIÓN
include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_request_security.php'; 

# VALIDACIÓN CONTROSL DE ERRORES 
if (isset($_GET['aym_error'])) { $_SERVER['HTTP_REFERER'] = ""; }
?>
<main>
	<figure>
		<img src="/admin/aym_image/aym_logo_white.png" alt="Aymsoft SAS" longdesc="Aymsoft SAS">
	</figure>
	<section>
		<h1>Recuperar Contraseña</h1>
		<form action="/admin/send-request-password" name="aym_form_request_pass" id="aym_form_request_pass" method="post"   enctype="multipart/form-data" autocomplete="off">
			<fieldset>
				<div class="aym_frm_row" id="aym_use_log">
					<label for="use_log">E-mail:</label>		
					<input type="email" name="use_log" id="use_log" placeholder="Digite su correo electrónico">
				</div>
				<div class="aym_frm_row">
					<button type="submit">Enviarme instrucciones</button>
				</div>
				<div class="aym_frm_row aym_small_font">
					<a href="/admin">Iniciar sesión</a>
				</div>
				<input type="hidden" name="aym_pk" id="aym_pk" value="<?=$aym_public_key?>">							
				<input type="hidden" name="aym_ps" id="aym_ps" value="<?=$aym_public_string?>">
			</fieldset>
		</form>
	</section>
</main>