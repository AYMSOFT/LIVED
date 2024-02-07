<?php # **************************** AYMCORE V: 1.0 ********************
# COMPONENTE PARA ENVIAR LA CONFIRMACIÓN DEL REQUERIMIENTO
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ JUN/07/2019

# VALIDACIÓN QUE ENTRE POR EL APLICATIVO

if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }

# -=-=-=- DATA
$to = $_SESSION['use_log']; 
$subject = "Confirmación Reporte AyMsoft";
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
    <div id="aym_content_mail_recep">
        <div style="border-bottom: 1px solid #000000; height: 5px; width: 100%; margin: 10px 0px;"></div>
        <p>Hola <strong>'.$_SESSION['use_nam'].'</strong></p>
        <p>Hemos recibido su solicitud, muy pronto uno de nuestros especialistas atenderá su requerimiento.</p>
        <p>Si usted cree que ha recibido este correo por error por favor ign&oacute;relo.</p>
        <p>&nbsp;</p>
        <div style="border-bottom: 1px solid #000000; height: 5px; width: 100%; margin: 10px 0px;"></div>
    </div>
'; 
$message .= "</body>";
$message .= "</html>"; 

if(!mail($to,$subject,$message,$header)) {
	
	$Msg='No se pudo enviar el email al usuario. <br><br> Por favor verifique los datos.';
	
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';
}

?> 