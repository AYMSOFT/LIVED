<?php # **************************** AYMCORE SITE V: 1.0 ********************
# COMPONENTE PARA ENVIAR EL MAIL DE CONFIRMACIÓN AL USUARIO
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017


# -=-=-=- MAIL HEADERS
$header  = "From: PROSCIENCE <info@proscience.com.mx>\n";
$header .= "Reply-To: No Responda AyMsoft <no-reply@aymsoft.com>\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: text/html; charset=UTF-8\r\n";
$header .= "X-Priority: 1\r\n";


if(!mail($to,$subject,$body,$header)) {
	
	$Msg='No se pudo enviar el email al usuario. <br><br> Por favor verifique los datos.';
	
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';
}
?> 
