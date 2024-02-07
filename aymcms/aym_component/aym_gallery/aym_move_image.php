<?php 

# VALIDACIÓN --> SI ES AGREGAR O ELIMINAR
if($_POST['action']=='II' || $_POST['action']=='UI'){
	
	#VALIDACION --> EXISTENCIA DEL DIRECTORIO
	if (!is_dir($aym_dir_parent)) {

		//VALIDACION --> CREACIÓN DEL DIRECTORIO
		if (!mkdir($aym_dir_parent,0755)) {
			$ReturnStatus =1;
			$Msg = 'No se pudo crear el directorio <br /><br /> <strong>Motivo:</strong> La carpeta raiz (aym_image) no ha sido creada. <br /><br /> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.';
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		}
	}

	#VALIDACION --> EXISTENCIA DEL DIRECTORIO SUB-CARPETA
	if (!is_dir($aym_dir)) {

		//VALIDACION --> CREACIÓN DEL DIRECTORIO
		if (!mkdir($aym_dir,0755)) {
			$ReturnStatus =1;
			$Msg = 'No se pudo crear el directorio Subcategoría <br /><br /> <strong>Motivo:</strong> La carpeta raiz (aym_image) no ha sido creada. <br /><br /> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.';
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		}
	}
	
	#VALIDACION --> CARGA DE LA IMAGEN AL SERVIDOR
	if (move_uploaded_file($_FILES['aym_fil']["tmp_name"][$i], $aym_dir."/".$nombre_archivo) || rename($_SERVER['DOCUMENT_ROOT'].$_FILES['aym_fil']["tmp_name"][$i], $aym_dir."/".$nombre_archivo)){   
		
		# VALIDACION --> FORMATO DE LA IMAGEN 
		if($extension == "jpeg" || $extension == "JPG"){ 
			$tmp_img=imagecreatefromjpeg($aym_dir."/".$nombre_archivo); 
			imagejpeg($tmp_img, $aym_dir."/".$gal_id.".jpg");
			unlink($aym_dir."/".$nombre_archivo);
		} else 
		
		if($extension == "png" || $extension == "PNG") { 
			$tmp_img=imagecreatefrompng($aym_dir."/".$nombre_archivo); 
			imagejpeg($tmp_img, $aym_dir."/".$gal_id.".jpg");
			unlink($aym_dir."/".$nombre_archivo);
		} else

		if($extension == "gif" || $extension == "GIF") { 
			$tmp_img=imagecreatefromgif($aym_dir."/".$nombre_archivo); 
			imagejpeg($tmp_img, $aym_dir."/".$gal_id.".jpg");
			unlink($aym_dir."/".$nombre_archivo);
		} 

	} else {
		$ReturnStatus =1;
		$Msg = "No se pudo establecer la carpeta de destino <br /><br /> <strong> Motivo:</strong> La carpeta raiz no ha sido creada. <br /><br /> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.";
	}
	

}


# VALIDACIÓN --> SI ES ELMINAR
if ($_POST['action']=='DI') { 

	# VALIDACIÓN --> SI EXISTE LA IMAGEN 
	if (file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_gallery/'.$_POST['gal_id'].'.jpg')) {
		if(!unlink($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_gallery/'.$_POST['gal_id'].'.jpg')){
			$ReturnStatus =1;
			$Msg = "No se pudo eliminar la imagen <br />";
		}
	}
	
	# VALIDACIÓN --> SI EXISTE LA MINIATURA 
	if (file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_gallery/aym_thumb/'.$_POST['gal_id'].'.jpg')) {
		if(!unlink($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_gallery/aym_thumb/'.$_POST['gal_id'].'.jpg')){
			$ReturnStatus =1;
			$Msg = "No se pudo eliminar la miniatura de la imagen <br />";		
		}
	}

}


?>