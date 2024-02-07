<?php # **************************** AYMCORE V: 1.0 ********************
# COMPONENTE PARA ENVIAR LA CONTRASEÑA AL USUARIO
# AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ JUL/19/2014

session_start();

# VALIDACIÓN QUE ENTRE POR EL APLICATIVO
if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }

# -=-=-=- DATA
$to = $use_log; 
$subject = "Recuperar mi clave, ".$_SESSION['abo_bel']; 
# -=-=-=- MAIL HEADERS
$header  = "From: Servicio al Cliente AyMsoft  <contacto@aymsoft.com>\r\n";
$header .= "Reply-To: No Responda AyMsoft <no-reply@aymsoft.com>\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: text/html; charset=UTF-8\r\n";
$header .= "X-Priority: 1\r\n";
# -=-=-=- HTML EMAIL PART 
$message = '<!doctype html>';
$message .= '<html>';
$message .= '<head>';
$message .= '<meta charset="UTF-8">';
$message .= '<title>AyMcore-Recuperar mi clave</title>';
$message .= '<head>';
$message .= '<body>';	
$message .= '
<style>
	.aym_wrap_content {background: #fff; width: 100%;}
	.aym_wrap_content table {background: #f3f4f5; padding: 0 20px; width: 100%; max-width: 600px;}
	.aym_wrap_content table tr {}
	.aym_wrap_content table tr td {}
	.aym_wrap_content table tr td div {min-width: 320px; max-width: 600px; padding: 10px 0; width: 100%;}
	.aym_wrap_content table tr td div.aym_logo {text-align: center;}
	.aym_wrap_content table tr td div.aym_logo img {display: inline-block; max-width: 200px;}
	.aym_wrap_content table tr td div a {text-decoration: none;}
	.aym_wrap_content table tr td div a.aym_button {display: inline-block; background-color: #30B5E1; border-radius: 5px; color: #ffffff; padding: 10px 20px;}
	.aym_wrap_content table tr td div a.aym_button:hover {opacity: .7;}
	.aym_wrap_content table tr td div .aym_copy {font-size: 0.8em; color: #888888;}
</style>
<div class="aym_wrap_content">
	<table align="center" border="0" cellspacing="0" cellpadding="1">
		<tbody>
			<tr>
				<td>
					<div class="aym_logo">
						<img src="https://www.aymsoft.com/aym_image/aym_logo/aym_logo_blue.png" alt="AyMsoft">
					</div>
					<div>
						<h1>Recuperar contraseña</h1>
						<p>Hola <strong>'.$use_nam.'</strong>,</p>
						<p>Usted ha recibido este correo porque solicitó cambiar su contraseña de administración de '.$_SESSION['abo_bel'].'.</p>
						<p>Para inciar el proceso de recuperación de su contraseña, por favor haga clic en el link de "<strong>Aceptar</strong>" que está justo debajo</p>
						<center><a class="aym_button" href="https://'.$_SERVER['HTTP_HOST'].'/admin/recovery/'.$use_id.'/'.$use_pwd.'/'.md5(session_id()).'/'.$_SESSION['aym_public_key'].'/'.$_SESSION['aym_public_string'].'">ACEPTAR</a></center>
						<p>Si el botón <strong>Aceptar</strong> está bloqueado, por favor copie y pegue el siguiente enlace en la barra de direcciones de su navegador preferido:</p>
						<p>https://'.$_SERVER['HTTP_HOST'].'/admin/recovery/'.$use_id.'/'.$use_pwd.'/'.md5(session_id()).'/'.$_SESSION['aym_public_key'].'/'.$_SESSION['aym_public_string'].'</p>
						<hr>
						<p>Si usted cree que ha recibido este correo por error por favor ignórelo.</p>
						<p class="aym_copy">&copy; '.date('Y').' <a href="https://www.aymsoft.com/">AyMsoft</a></p>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>'; 
$message .= '</body>';
$message .= '</html>'; 

# -=-=-=- SEND MAIL 
$mail_sent = mail($to, $subject, $message, $header); 
?> 