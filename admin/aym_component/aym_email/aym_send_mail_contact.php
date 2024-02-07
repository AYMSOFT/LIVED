<?php # **************************** AYM EASY SITE V: 5.0  ********************
# COMPONENTE PARA ENVIAR CORREO DE CONTACTO AL ADMINISTRADOR
# AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ABR/26/2013

$destinatario = "centrodesoluciones@prosciencelab.com";
#$destinatario = "msanchez@aymsoft.com.co";
#$destinatario = "dsuaza@aymsoft.us";
$asunto = "Contacto - www.proscience.com.mx";
$cuerpo='
<div id="aym_content_mail_recep">
    <div align="center"><h2>Mensaje de contacto nuevo</h2></div>
    <div id="aym_mail">
        <fieldset class="aym_field_prop">
        <legend>Datos del usuario: </legend>
            <div><b>Nombres: </b>'.$_POST['con_nam'].' </div>
            <div><b>E-mail : </b>'.$_POST['con_ema'].'</div>
			<div><b>Tel&eacute;fono : </b>'.$_POST['con_tel'].'</div>
            <div><b>Mensaje: </b></div>
            <div>'.$_POST['con_com'].'</div>
        </fieldset>
    </div>
</div>';
#METODO PARA ENVIO DE FORMATO HTML
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=utf-8\r\n"; 
#DIRECCION DEL REMITENTE
$headers .= "From: PROSCIENCE <info@proscience.com.mx>\r\n";

if (!mail($destinatario,$asunto,$cuerpo,$headers)) {
  $ReturnStatus = 1;
  $Msg = 'Ha ocurrido un error durante la ejecuci&oacute;n de la operaci&oacute;n <br /><br />  No se pudo enviar el correo <br /><br /> Sugerencia: verifique os datos introducidos en el formulario e intente nuevamente.';
}else{
    $ReturnStatus = 0;
    $Msg = 'Su contacto ha sido enviado correctamente. Pronto lo estaremos contactando';
}
?>
