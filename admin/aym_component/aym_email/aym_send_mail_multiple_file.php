<?php # **************************** AYMCORE V: 1.0 ********************
# COMPONENTE PARA ENVIAR CORREOS CON MULTIPLES ARCHIVOS ADJUNTOS
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ 07/FEB/23

	# NOTA --- > PARA HACER USO DE ESTE COMPONENTE ES OBLIGATORIO QUE SE CARGUE EL ARCHIVO AL FORMULARIO

	# VARIABLES
	$aym_from = $aym_mail_from; //ORIGEN DEL CORREO
	$aym_to = $aym_mail_to; // DESTINO DEL CORREO
	
	//Load POST data from HTML form
	$subject = $aym_subject; // ASUNTO
	$message = $aym_message; // CUERPO DEL CORREO

	$boundary = md5("random"); // define boundary with a md5 hashed value

	//header
	$headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
	$headers .= "From:".$aym_from."\r\n"; // Sender Email
	$headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
	$headers .= "boundary = $boundary\r\n"; //Defining the Boundary
		
	//plain text
	$body = "--$boundary\r\n";
	$body .= "Content-Type: text/html; charset=UTF-8\r\n";
	$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
	$body .= chunk_split(base64_encode($message));
		

	$aym_dir = $aym_dir_fol;
	if(is_dir($aym_dir)){
		if(count(scandir($aym_dir))>2){
			// Abre un directorio conocido, y procede a leer el contenido
			if (is_dir($aym_dir)) {
				if ($dh = opendir($aym_dir)) {
					while (($file = readdir($dh)) !== false) {
						if($file!='.' && $file!='..'){ 
							# VARIABLES DEL ARCHIVO
							$filedir = $aym_dir.'/'.$file; # DIRECCION
							$size = filesize($filedir); # TAMAÑO
							$type = mime_content_type($filedir); # TIPO APLICATION/PDF...
							$name = substr($filedir, strrpos($filedir, "/") + 1); # NOMBRE DEL ARCHIVO
						
							# ABRIMOS EL ARCHIVO Y TRAEMOS EL CONTENIDO
							$handle = fopen($filedir, "r");
							$content = fread($handle, $size);
							fclose($handle);
							$encoded_content = chunk_split(base64_encode($content)); # LO DECODIFICAMOS PARA ENVIAR POR MAIL

							// ADJUNTAMOS EL ARCHIVO AL CORREO
							$body .= "--$boundary\r\n";
							$body .="Content-Type: $type; name=".$name."\r\n";
							$body .="Content-Disposition: attachments; filename=".$name."\r\n";
							$body .="Content-Transfer-Encoding: base64\r\n";
							$body .="X-Attachment-Id: ".rand(1000+time(), 99999+time())."\r\n\r\n";
							$body .= $encoded_content; // Attaching the encoded file with email

						}
					}
					closedir($dh);
				}
			}
		}
	}


	
	if(mail($aym_to, $subject, $body, $headers)){
		$ReturnStatus=0;
		$Msg='Registro procesado satisfactoriamente.';
	} else {
		$ReturnStatus=1;
		$Msg='Error al intentar enviar el mensaje.';
	}


?>