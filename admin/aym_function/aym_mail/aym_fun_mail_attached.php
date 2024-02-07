<?php # **************************** AYM EASY SITE V: 5.0  ********************
# FUNCION PARA EL ENVIO DE CORREOS CON ARCHIVOS ADJUNTOS, ARCHIVOS UBICADOS EN EL SERVIDOR O ARCHIVOS GENERADOS EN BASE64
# AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ABR/26/2013


	# =================================================================================================
	# =================== CORREO ENVIO DE ARCHIVOS GENERADOS EN BASE 64 COMO UN PDF ===================
	# =================================================================================================

		function multi_attach_mail_base($to, $subject, $message, $senderMail, $senderName, $files, $namefile){

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

					if(!empty($files[$i])){
						$file_name = $namefile[$i].'.pdf';

						$message .= "--{$mime_boundary}\n";

						$data = $files[$i];
						$data = chunk_split(base64_encode($data));
						$message .= "Content-Type: application/octet-stream; name=\"".$file_name."\"\n" . 
						"Content-Description: ".$file_name."\n" .
						"Content-Disposition: attachment;\n" . " filename=\"".$file_name."\";size=".filesize($files[$i])."; \n" . 
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

	# =================================================================================================
	# =================== CORREO ENVIO DE ARCHIVOS QUE ESTAN EN UNA URL DEL SERVIDOR ==================
	# =================================================================================================

		function multi_attach_mail_server($to, $subject, $message, $senderMail, $senderName, $files){

			$from = $senderName." <".$senderMail.">"; 
			$headers = "From: $from";

			// boundary 
			$semi_rand = md5(time()); 
			$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

			// headers for attachment 
			$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"\r\n"; 

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
					if (is_dir($_SERVER['DOCUMENT_ROOT'].'/aym_document/aym_help/'.$row_url[6])) {
						if(!unlink($files[$i])){
							$ReturnStatus = 1;
						}
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
?>
