<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA MOSTRAR UNA IMAGEN
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	session_start(); 
	
	if ($aym_num_rows > 0 ) {
		
		# DECODIFICAMOS LA IMÁGEN PARA MOSTRARLA
		header('Content-type: image/jpeg');
		print base64_decode($imagenBase64);
	} else {
	
		# VARIABLES	
		$ReturnStatus = 1;	
		$aym_url = '/admin';
		$Msg= 'No se pudo obtener el contenido del archivo';
		
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	}  
?>