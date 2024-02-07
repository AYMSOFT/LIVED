<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA CARGAR ARCHIVOS AL SERVIDOR 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACIÓN QUE ENTRE POR EL APLICATIVO
	if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}


	
#================================================================================================
#========================================== ARCHIVO ADJUNTO =====================================
#================================================================================================

if ($_POST['action']=='I' || $_POST['action']=='U' || $_POST['action']=='T' || $_POST['action']=='R' || $_POST['action']=='A' || $_POST['action']=='IB' || $_POST['action']=='IS' || $_POST['action']=='IR' || $_POST['action']=='ICR' || $_POST['action']=='ITRV' || $_POST['action']=='IAR'|| isset($aym_upload_file)) {
		
		#DATOS DEL ARCHIVO
		$nombre_archivo_ori = $_FILES['aym_fil']['name'];
		$tipo_archivo = $_FILES['aym_fil']['type'];
		$tamano_archivo = $_FILES['aym_fil']['size'];	

        #VALIDACION SI EL ARCHIVO ES UNA IMAGEN
		$extension = substr(strrchr($_FILES['aym_fil']['name'],'.'), 1);
			
		#VALIDACION SI LA RUTA DEL ARCHIVO ES VALIDA
		if (strlen($nombre_archivo_ori) < 4) {
			$ReturnStatus =1;
			$Msg = 'Debe especificar una ruta válida para el archivo <br><br> <strong>Sugerencia:</strong> <br> Verifique los datos introducidos en el formulario.';

			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		}
			
		#VALIDACION DE LA IMAGEN ES DE FORMATO ADECUADO
        if ($tipo_archivo <> 'application/pdf') {
			$ReturnStatus =1;
			$Msg = 'El archivo <strong>'.$nombre_archivo_ori.'</strong> tiene una extensión NO válida. <br><br> <strong>Sugerencia:</strong> <br> Guarde el archivo en formato. <br><br> .pdf ';

			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		}
		
		#VALIDACION DEL TAMAÑO DEL ARCHIVO
		if ($tamano_archivo > 10240000) {
			$ReturnStatus =1;
			$Msg = 'El archivo <strong>'.$nombre_archivo_ori.'</strong>  No puede tener mas de 10MB de tamaño !!!. <br><br> <strong>Sugerencia:</strong> <br> Guarde el archivo en formato de menor calidad.';

			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		}
			
		# VALIDACION --> CARPETA RAIZ 
		if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/aym_document')) {	
			if (!mkdir($_SERVER['DOCUMENT_ROOT'].'/aym_document/',0755)) {
				
				$ReturnStatus =1;
				$Msg = 'No se pudo crear el directorio raíz<br><br> <strong>Motivo:</strong> La carpeta raiz no ha sido creada. <br><br> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.';

				# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
				include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
			}
		}
					
		#VALIDACION --> EXISTENCIA DEL DIRECTORIO
		if (!is_dir($aym_dir)) {
			if (!mkdir($aym_dir,0755)) {
				
				$ReturnStatus =1;
				$Msg = 'No se pudo crear el directorio del archivo<br><br> <strong>Motivo:</strong> La carpeta raiz no ha sido creada. <br><br> <strong>Sugerencia:</strong> Intente nuevamente.';

				# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
				include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
			}
		}
			
		#VALIDACION --> CARGA DEL ARCHIVO AL SERVIDOR
		if (!move_uploaded_file($_FILES['aym_fil']['tmp_name'],$aym_dir."".$fil_nam.".".$extension)) {
			$ReturnStatus =1;
			$Msg = "No se pudo establecer la carpeta de destino <br><br> <strong> Motivo:</strong> La carpeta raiz no ha sido creada. <br><br> <strong>Sugerencia:</strong> Intente nuevamente.";
			
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';

		} else {
			
			#VALIDACION --> APERTURA DEL ARCHIVO
			if ($handle = opendir($aym_dir)) {
				
				//este es el archivo temporal
				$aym_tem_file= $aym_dir."".$fil_nam.".".$extension;
				
				//leer el archivo temporal en binario
				$fp = fopen($aym_tem_file, 'r+b');
				$fil_tex = fread($fp,filesize($aym_tem_file));
				unlink ($aym_tem_file);
				fclose($fp);
			}
			
		}

} # FIN SI VIENE UN ARCHIVO PARA SUBIR

#==================================================================================================
#===================================================================================================
#===================================================================================================

	
	
	# VALIDACIÓN --> SI ES ELMINAR
	if ($_GET['action']=='D') { 
	
		if(!unlink($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_news/'.$_GET['new_id'].'.png')){
			$ReturnStatus =1;
			$Msg = "No se pudo establecer la carpeta de destino <br><br> <strong> Motivo:</strong> La carpeta raiz no contiene la imagen. <br><br> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.";
		}
	
	}
	# VALIDACIÓN --> SI ES ELMINAR UNA IMAGEN DESDE EDITAR
	if ($_GET['action']=='DI') { 
	
		if(!unlink($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_news/'.$_GET['new_id'].'.png')){
			$ReturnStatus =1;
			$Msg = "No se pudo eliminar la imáge <br><br> <strong>Sugerencia:</strong> Intente nuevamente.";
		}  else {
			$ReturnStatus =0;
			$Msg = "Registro procesado satisfactoriamente";
		}
		
		#VARIABLE --> REDIRECION
		$aym_url="/admin/admnews/aym_edit_news/".$_GET['new_id']."/".$_GET['aym_ord']."/".$_GET['aym_ord_tip']."/".$_GET['aym_tamano_pagina']."/".$_GET['aym_pagina']."/".$_GET['lan_id']."/".$_GET['new_cat_id']."";
	
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	
	
	}
?>