<?php # **************************** AYMCORE V: 1.0 ********************
# COMPONENTE PARA ENVIAR CORREO DE CONTACTO AL ADMINISTRADOR
# � 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ JUN/07/2019

# VALIDACION QUE ENTRE POR EL APLICATIVO
include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

if(!isset($message)) { $message ='';}
if(!isset($ReturnStatus)) { $ReturnStatus ='';}

function multi_attach_mail($to, $subject, $message, $senderMail, $senderName, $files){

    $from = $senderName." <".$senderMail.">"; 
    $header = "From: $from";

    // boundary 
    $semi_rand = md5(time()); 
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

    // headers for attachment 
    #$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
	
	$header.= "MIME-Version: 1.0\r\n";
	$header.= "Content-Type: text/html; charset=UTF-8\r\n";
	$header.= "X-Priority: 1\r\n";

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
			$row_url = explode('/',$files[$i]);
			if (is_dir($_SERVER['DOCUMENT_ROOT'].'/admin/aym_file_tmp/'.$row_url[6])) {
				if(!unlink($files[$i])){
					$ReturnStatus = 1;
				}
			}
        }
    }

    $message .= "--{$mime_boundary}--";
    $returnpath = "-f" . $senderMail;

    //send email
    $mail = @mail($to, $subject, $message, $header, $returnpath); 

    //function return true, if email sent, otherwise return fasle
    if($mail){ return TRUE; } else { return FALSE; }

}

$aym_root = $_SERVER['DOCUMENT_ROOT'].'/admin/aym_file_tmp/'.$_SESSION['use_id'];
$array_name = [];
if(is_dir($aym_root)){
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
}

//email variables
$to = 'contacto@aymsoft.com';
$from = $_SESSION['use_log']; 
$from_name = $_SESSION['use_nam']; #'----FONTUR-----';

//attachment files path array
$files = $array_name;
$subject = 'Feedback - Servicio de error admin'; 
$subject = utf8_encode($subject); 
$html_content = '<html> 
	<head> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<title>REPORTE DE ERROR</title> 
	</head>
	<body> 
		<div id="aym_content_mail_recep">
			<div style="border-bottom: 1px solid #000000; height: 5px; width: 100%; margin: 10px 0px;"></div>
			
			<div><h2>Reporte de Error</h2></div>
			<div class="aym_email_recep_text"><span><strong>M&oacute;dulo Reportado</strong></span><span>&nbsp;&nbsp;'.$row_get_function['fun_nam'].'</span></div>
			<div class="aym_email_recep_text"><strong>Comentario:</strong></div>
			<div class="aym_email_recep_msg">'.$_POST['fee_des'].'</div>
			<div style="border-bottom: 1px solid #000000; height: 5px; width: 100%; margin: 10px 0px;"></div>
		</div>
	</body> 
</html>';

//call multi_attach_mail() function and pass the required arguments
$send_email = multi_attach_mail($to,$subject,$html_content,$from,$from_name,$files);
?>
