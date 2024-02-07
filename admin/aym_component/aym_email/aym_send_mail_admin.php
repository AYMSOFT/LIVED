<?php # **************************** AYMFLY V: 1.0 ********************
# COMPONENTE PARA ENVIAR LA CONFIRMACIÓN DE LA ACTUALIZACIÓN DE LA TRM
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017

# VALIDACIÓN QUE ENTRE POR EL APLICATIVO

if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }

# -=-=-=- DATA
$to = "contacto@aymsoft.com";
$subject = $aym_subjet; 
# -=-=-=- MAIL HEADERS
$header  = "From: Servicio al Cliente AyMsoft  <contacto@aymsoft.com>\r\n";
$header .= "Reply-To: No Responda AyMsoft <no-reply@aymsoft.com>\r\n";
$header .= "Reply-To: Contacto AyMsoft <contacto@aymsoft.com>\r\n";
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
    <div>
        <div style="border-bottom: 1px solid #000000; height: 5px; width: 100%; margin: 10px 0px;"></div>
        <p>&nbsp;</p>
      	'.$aym_message.'
		<p>&nbsp;</p>
        <div style="border-bottom: 1px solid #000000; height: 5px; width: 100%; margin: 10px 0px;"></div>
    </div>
'; 
$message .= "</body>\n";
$message .= "</html>\n"; 

# -=-=-=- SEND MAIL 
$mail_sent = mail($to, $subject, $message, $header);
?> 