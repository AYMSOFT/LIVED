<?php # **************************** AYMCORE V: 14.0 ********************
# MODULO PARA CAMBIAR LA CONTRASEÑA, DESPUES DE HABERLA OLVIDADO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

session_start(); 


#VARIABLES DE SEGURIDAD 
$aym_private_key=md5($row_get_about['abo_pro_num']);
$aym_private_user= md5($_SESSION['abo_nam']);
$aym_public_key=time();
$aym_public_string=md5("$aym_private_key~$aym_private_user~$aym_public_key");


# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';	

# VALIDACIÓN ---> EXISTENCIA DE LA CONTRASEÑA ACTUAL 
if (!isset($_SESSION['use_pwd'])) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
?> 
<main>
	<figure>
		<img src="/admin/aym_image/aym_logo_white.png" alt="Aymsoft SAS" longdesc="Aymsoft SAS">
	</figure>
	<section>
			<h1>Cambiar Mi Contraseña</h1>		
			<form name="aym_form_change_pass" id="aym_form_change_pass" method="post"  action="/admin/send-change-request-password" enctype="multipart/form-data" autocomplete="off">
				<fieldset>					  
					<div class="aym_frm_row" id="aym_use_log">
						<label for="use_log">E-mail:</label>
						<input type="email" name="use_log" id="use_log" value="<?= $_SESSION['use_log']?>" placeholder="Digite su correo electrónico">
					</div>

					<div class="aym_frm_row" id="aym_use_pwd">
						<label for="use_pwd1">Contraseña nueva:</label>
						<input type="password" name="use_pwd1" id="use_pwd1" placeholder="Digite su nueva contraseña">
						<input type="checkbox" class="sho_pwd">
					</div>
					
					<div class="aym_frm_row" id="aym_use_pwd">
						<label for="use_pwd2">Repita la contraseña:</label>
						<input type="password" name="use_pwd2" id="use_pwd2" placeholder="Digite nuevamente la contraseña">
						<input type="checkbox" class="sho_pwd">
					</div>
					
					<div class="aym_frm_row">
						<button type="submit">Aceptar</button>
					</div>
					<input type="hidden" name="aym_pk" id="aym_pk" value="<?=$aym_public_key?>">							
					<input type="hidden" name="aym_ps" id="aym_ps" value="<?=$aym_public_string?>">
					<input type="hidden" name="use_pwd" id="use_pwd" value="<?= $_SESSION['use_pwd']?>">
					<input type="hidden" name="aym_rec" id="aym_rec" value="1">
                    <input type="hidden" name="action" id="action" value="C">
				</fieldset>
			</form>				
	</section>
</main>
<?php unset($_SESSION['use_pwd']); ?>

