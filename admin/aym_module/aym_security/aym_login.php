<?php # **************************** AYMCORE V: 14.0 ********************
# MÓDULO PARA INICIAR SESIÓN
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

# INCLUSIÓN --> SEGURIDAD DE LA APLICACIÓN
include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_request_security.php'; 

# VALIDACIÓN CONTROL DE ERRORES 
if (isset($_GET['aym_error'])) { $_SERVER['HTTP_REFERER'] = ""; }

?>
<main>
	<figure>
		<img src="/admin/aym_image/aym_logo_white.png" alt="Aymsoft SAS" longdesc="Aymsoft SAS">
	</figure>
	<section>
		<h1>Iniciar sesión</h1>
		<form name="aym_frm_login" id="aym_frm_login" method="post"  action="/admin/send-login" enctype="multipart/form-data">
			<fieldset>					  
				<div class="aym_frm_row" id="aym_use_log">
					<label for="use_log">E-mail:</label>
					<input type="email" name="use_log" id="use_log" placeholder="Digite su correo electrónico">
				</div>
				<div class="aym_frm_row" id="aym_use_pwd">
					<label for="use_pwd">Contraseña:</label> 
					<input type="password" name="use_pwd" id="use_pwd" placeholder="Digite su contraseña">
					<input class="sho_pwd" type="checkbox">						
				</div>
				<div class="aym_frm_row">
					<button type="submit">Iniciar sesión</button>
				</div>
					
				<input type="hidden" name="aym_pk" id="aym_pk" value="<?=$aym_public_key?>">							
				<input type="hidden" name="aym_ps" id="aym_ps" value="<?=$aym_public_string?>">
				<input type="hidden" name="aym_referer" value="">
			</fieldset>
		</form>	
		<div class="aym_frm_row aym_small_font">
			<a href="/admin/request-password">¿Olvidó su contraseña?</a>
		</div>

		<div class="aym_login_other_account">
			<center>Or</center>
			<a href="/admin/login-microsoft"><span class="windows"></span>Iniciar sesión con Windows</a>
		</div>
	</section>
</main>