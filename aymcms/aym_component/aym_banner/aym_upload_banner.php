<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA CARGAR UN BANNER
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

# VALIDACIÓN --> SI ES AGEREGAR O EDITAR

if ($_POST['action'] == 'I' || $_POST['action']=='U' || $_POST['action']=='II') {  

	#VALIDACION --> CARGA DE LA IMAGEN AL SERVIDOR
	if (move_uploaded_file($_FILES['doc_nom']["tmp_name"], $_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$aym_nombre_archivo.".".$extension) || rename($_SERVER['DOCUMENT_ROOT'].$_FILES['doc_nom']["tmp_name"], $_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$aym_nombre_archivo.".".$extension)) {
		
		# VALIDACION --> FORMATO DE LA IMAGEN 
		if($extension == "jpeg" || $extension == "JPG"){ 
			$tmp_img=imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$aym_nombre_archivo.".".$extension); 
			imagejpeg($tmp_img, $_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$aym_nombre_archivo.".jpg");
			unlink($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$aym_nombre_archivo.".".$extension);
		} else 
		if($extension == "png" || $extension == "PNG"){ 
			$tmp_img=imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$aym_nombre_archivo.".".$extension); 
			imagejpeg($tmp_img, $_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$aym_nombre_archivo.".jpg");
			unlink($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$aym_nombre_archivo.".".$extension);
		} else 
		if($extension == "gif" || $extension == "GIF") { 
			$tmp_img=imagecreatefromgif($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$aym_nombre_archivo.".".$extension); 
			imagejpeg($tmp_img, $_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$aym_nombre_archivo.".jpg");
			unlink($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$aym_nombre_archivo.".".$extension);
		} 

		# VALIDACION --> FORMATO DE LA IMAGEN 
		
			
	} else {
		$ReturnStatus =1;
		$Msg = "No se pudo establecer la carpeta de destino <br /><br /> <strong> Motivo:</strong> La carpeta raiz no ha sido creada. <br /><br /> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.";
	}
}


# VALIDACIÓN --> SI ES ELMINAR
if ($_POST['action']=='D') { 

	if(!unlink($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$_POST['ban_id'].".jpg")){
		$ReturnStatus =1;
		$Msg = "No se pudo establecer la carpeta de destino <br /><br /> <strong> Motivo:</strong> La carpeta raiz no contiene la imagen. <br /><br /> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.";
	}

}
?>