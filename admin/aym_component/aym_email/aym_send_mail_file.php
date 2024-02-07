<?php # **************************** AYMCORE V: 1.0 ********************
# COMPONENTE PARA ENVIAR CORREOS CON UN ARCHIVO ADJUNTO
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ 07/FEB/23

	# NOTA --- > PARA HACER USO DE ESTE COMPONENTE ES OBLIGATORIO QUE SE CARGUE EL ARCHIVO AL FORMULARIO

	# VARIABLES
	$aym_from = $aym_mail_from; //ORIGEN DEL CORREO
	$aym_to = $aym_mail_to; // DESTINO DEL CORREO
	
	//Load POST data from HTML form
	$subject = $aym_subject; // ASUNTO
	$message = $aym_message; // CUERPO DEL CORREO

	//Get uploaded file data using $_FILES array
	# $_FILES['aym_fil'] --- $_FILES['doc_nom'] --< NOMBRE DEL INPUT TIPO FILE
	$tmp_name = $_FILES['aym_fil']['tmp_name']; // get the temporary file name of the file on the server
	$name = $_FILES['aym_fil']['name']; // get the name of the file
	$size = $_FILES['aym_fil']['size']; // get size of the file for size validation
	$type = $_FILES['aym_fil']['type']; // get type of the file

	//read from the uploaded file & base64_encode content
	$handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
	$content = fread($handle, $size); // reading the file
	fclose($handle);				 // close upon completion

	$encoded_content = chunk_split(base64_encode($content));
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
		
	//attachment
	$body .= "--$boundary\r\n";
	$body .="Content-Type: $type; name=".$name."\r\n";
	$body .="Content-Disposition: attachment; filename=".$name."\r\n";
	$body .="Content-Transfer-Encoding: base64\r\n";
	$body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
	$body .= $encoded_content; // Attaching the encoded file with email
	
	if(mail($aym_to, $subject, $body, $headers)){
		$ReturnStatus=0;
		$Msg='Registro procesado satisfactoriamente.';
	} else {
		$ReturnStatus=1;
		$Msg='Error al intentar enviar el mensaje.';
	}


?>