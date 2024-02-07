<?php 
# **************************** AyMfly: 1.0 ********************
# COMPONENTE PARA MOVER Y VALIDAR LAS IMAGENES
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 


	# VARIABLES DEL ARCHIVO
	$aym_dir=$_SERVER['DOCUMENT_ROOT']."/admin/aym_document/aym_document_temp/";

	if ($_FILES["aym_fil"]['name'][$i] <> ""){
		
		# VALIDACION --> CARGA DE LA IMAGEN AL SERVIDOR
		if (!move_uploaded_file($_FILES['aym_fil']["tmp_name"][$i], $aym_dir."".$aym_nam_fil_ori)){
			
			$ReturnStatus =1;
			$Msg = "No se pudo establecer la carpeta de destino <br><br> <strong> Motivo:</strong> La carpeta raiz no ha sido creada. <br><br> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.";
		}
	}
	
	# VALIDACION --> APERTURA DEL ARCHIVO
	if ($handle = opendir($aym_dir)){
		
		//este es el archivo temporal
		$aym_tem_file= $aym_dir."".$aym_nam_fil_ori;
		
		//leer el archivo temporal en binario
		$fp = fopen($aym_tem_file, 'r+b');
		$fil_tex = fread($fp,filesize($aym_tem_file));
		unlink ($aym_tem_file);	
		fclose($fp);
		
	}# --> FIN DEL PROCESO	
?>