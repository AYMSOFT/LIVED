<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA RECORTAR UN ARCHIVO 
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	#VARIABLES  
	$thumb_width = 300; # NUEVO TAMAÑO (MINIATURA)
	$thumb_height = 220; 
	
	if ($handle = opendir($aym_directory."/")) { 
	
		// Obtener nuevos tamaños
		//list($width, $height) = getimagesize($aym_directory."/".$aym_file);
		 
		/* ================== CAPTURA LA IMAGEN REAL ======================= */
		if($extension == "jpg" || $extension == "jpeg" || $extension == "JPG"){
		  $tmp_image=imagecreatefromjpeg($aym_directory."/".$_POST['gal_sub_cat_id']."/".$aym_file.".jpg");
		} 
		
		/* ================ DIMENSIONES DE LA IMAGEN REAL ================== */
		$width = imagesx($tmp_image); 
		$height = imagesy($tmp_image);
		
		/* =================== CARGA LA IMAGEN MINIATURA =================== */
		$thumb = imagecreatetruecolor($thumb_width, $thumb_height);
		imagecopyresized($thumb, $tmp_image, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
		imagejpeg($thumb, $aym_directory."/aym_thumb/".$_POST['gal_sub_cat_id']."/".$aym_file.".jpg");
				
		/* =================== GRABA LA IMAGEN MINIATURA =================== */
		$image_buffer = ob_get_contents(); 	 
		imagedestroy($thumb);
		
		echo str_pad('',4096)."\n";  
		ob_flush(); 
		flush(); 
	}

closedir($handle); 
?> 