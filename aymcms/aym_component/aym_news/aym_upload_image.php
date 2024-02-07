<?php # **************************** AYM EASY SITE V: 5.0 ********************
# COMPONENTE PARA CARGAR UNA IMAGEN
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ JUL/18/2013

	# VALIDACIÓN --> SI ES AGEREGAR O EDITAR
	if ($_POST['action'] == 'I' || $_POST['action']=='U' || $_POST['action']=='II') {  
	
		# VALIDACION --> CARPETA RAIZ 
		if (!is_dir($_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/")) {	
			# CREO LA CARPETA DEL VIGENCIA 
			mkdir($_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/",0777);
		}
	
		#VALIDACION --> CARGA DE LA IMAGEN AL SERVIDOR
		if (move_uploaded_file($_FILES['doc_nom']["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/".$aym_nombre_archivo.".".$extension) || rename($_SERVER['DOCUMENT_ROOT'].$_FILES['doc_nom']["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/".$aym_nombre_archivo.".".$extension)) {
			
			# VALIDACION --> FORMATO DE LA IMAGEN 
			if($extension == "jpg" || $extension == "jpeg" || $extension == "JPG"){ 
			  $tmp_img=imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/".$aym_nombre_archivo.".".$extension); 
			  imagepng($tmp_img, $_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/".$aym_nombre_archivo.".png");
			  unlink($_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/".$aym_nombre_archivo.".".$extension);
			} else 
		
			if($extension == "gif" || $extension == "GIF") { 
			  $tmp_img=imagecreatefromgif($_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/".$aym_nombre_archivo.".".$extension); 
			  imagepng($tmp_img, $_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/".$aym_nombre_archivo.".png");
			  unlink($_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/".$aym_nombre_archivo.".".$extension);
			} 
				
		} else {
			$ReturnStatus =1;
			$Msg = "No se pudo establecer la carpeta de destino <br><br> <strong> Motivo:</strong> La carpeta raiz no ha sido creada. <br /><br /> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.";
		}
	}
	
	
	# VALIDACIÓN --> SI ES ELMINAR
	if ($_POST['action']=='D') { 
	
		if(!unlink($_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/".$_POST['new_id'].".png")){
			$ReturnStatus =1;
			$Msg = "No se pudo establecer la carpeta de destino <br><br> <strong> Motivo:</strong> La carpeta raiz no contiene la imagen. <br /><br /> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.";
		}
	
	}
	
	
	# VALIDACIÓN --> SI ES ELMINAR UNA IMAGEN DESDE EDITAR
	if ($_GET['action']=='DI') { 
	
		if (!isset($_GET['new_id'])){ $Msg = "Noticia NO valida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php'; }
		
		if(!unlink($_SERVER['DOCUMENT_ROOT']."/aym_image/aym_news/".$_GET['new_id'].".png")){
			$ReturnStatus =1;
			$Msg = "No se pudo eliminar la im&aacute;ge <br /><br /> <strong>Sugerencia:</strong> Intente nuevamente.";
		}  else {
			$ReturnStatus =0;
			$Msg = "Registro procesado satisfactoriamente";
		}
		
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	
	
	}
?>