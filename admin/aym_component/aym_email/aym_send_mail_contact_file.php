<?php # **************************** AYMCORE V: 1.0 ********************
# COMPONENTE PARA ENVIAR CORREO DE CONTACTO AL ADMINISTRADOR
# � 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ JUN/07/2019


function multi_attach_mail($to, $subject, $message, $senderMail, $senderName, $files){

    $from = $senderName." <".$senderMail.">"; 
    $headers = "From: $from";

    // boundary 
    $semi_rand = md5(time()); 
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

    // headers for attachment PHP 7.4
    #$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
    
    // headers for attachment PHP > 8.0 ---  SE DEBEN INCLUIR LOS SALTOS DE LINEA CON \r\n PARA QUE IDENTIFIQUE Y PROCESE EL TIPO DE CORREO CON ARCHIVOS
    $headers .= "\r\nMIME-Version: 1.0\r\n" . "Content-Type: multipart/mixed; " . " boundary=\"{$mime_boundary}\"\r\n"; 

    // multipart boundary 
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 

    // preparing attachments
    if(count($files) > 0){
        for($i=0;$i<count($files);$i++){
            if(is_file($files[$i])){
                $message .= "--{$mime_boundary}\n";
                $fp =    @fopen($files[$i],"rb");
                $data =  @fread($fp,filesize($files[$i]));

                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\n" . 
                "Content-Description: ".basename($files[$i])."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }
    }

    $message .= "--{$mime_boundary}--";
    $returnpath = "-f" . $senderMail;

    //send email
    $mail = @mail($to, $subject, $message, $headers, $returnpath); 

    //function return true, if email sent, otherwise return fasle
    if($mail){ return TRUE; } else { return FALSE; }

}

$aym_root = $_SERVER['DOCUMENT_ROOT'].'/admin/aym_file_tmp/'.md5(session_id());

if(count(scandir($aym_root))>2){
	// Abre un directorio conocido, y procede a leer el contenido
	if (is_dir($aym_root)) {
		if ($dh = opendir($aym_root)) {
			while (($file = readdir($dh)) !== false) {
				if($file!='.' && $file!='..'){ 
					$info = new SplFileInfo($aym_root."/".$file); 
					$array_name[]= $aym_root.'/'.$file;
				}
			}
			closedir($dh);
		}
	}
}

$destinatario = "centrodesoluciones@prosciencelab.com";
#$destinatario = "msanchez@aymsoft.com.co";
#$destinatario = "dsuaza@aymsoft.us";
$from = 'info@proscience.com.mx'; 
$from_name = 'PROSCIENCE';
$subject = "Contacto - www.proscience.com.mx";
//attachment files path array
$files = $array_name;
$html_content='
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

//call multi_attach_mail() function and pass the required arguments
$send_email = multi_attach_mail($to, $subject, $html_content, $from, $from_name, $files);
if (!$send_email) {
    $ReturnStatus = 1;
    $Msg = 'Ha ocurrido un error durante la ejecuci&oacute;n de la operaci&oacute;n <br /><br />  No se pudo enviar el correo <br /><br /> Sugerencia: verifique os datos introducidos en el formulario e intente nuevamente.';
}else{
    $ReturnStatus = 0;
    $Msg = 'Su contacto ha sido enviado correctamente. Pronto lo estaremos contactando';
}

?>
