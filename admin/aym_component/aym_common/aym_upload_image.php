<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA CARGAR IMAGENES AL SERVIDOR 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	# VALIDACIÓN QUE ENTRE POR EL APLICATIVO
	if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}



	#==================================================================================================
	#========================================== ADJUNTAR IMAGEN =======================================
	#==================================================================================================


if ($_POST['action']=='I' || $_POST['action']=='U') { 
	
	//echo "<pre>"; print_r($_FILES); echo "</pre>"; exit;
	
	#DATOS DEL ARCHIVO
	$nombre_archivo_ori = $_FILES['doc_nom']['name'];
	$tipo_archivo = $_FILES['doc_nom']['type'];
	$tamano_archivo = $_FILES['doc_nom']['size'];

	
	#VALIDACION SI EL ARCHIVO ES UNA IMAGEN
	$valida_extension = preg_match("/.png$|.jpg$|.gif$|.jpeg$/i", $_FILES["doc_nom"]['name']);
	$extension = substr(strrchr($_FILES["doc_nom"]['name'], '.'), 1);

	#VALIDACION SI LA RUTA DEL ARCHIVO ES VALIDA
	if ($nombre_archivo_ori <> "" && (strlen($nombre_archivo_ori) < 4 )) {
		$ReturnStatus =1;
		$Msg = 'Debe especificar una ruta válida para el archivo <br><br> <strong>Sugerencia:</strong> <br> Verifique los datos introducidos en el formulario.';
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	}
	 #VALIDACION DE LA IMAGEN ES DE FORMATO ADECUADO
	if ($valida_extension == '0') {
		$ReturnStatus =1;
		$Msg = 'El archivo <strong>'.$nombre_archivo_ori.'</strong> tiene una extensión NO válida. <br><br> <strong>Sugerencia:</strong> <br> Guarde el archivo en formato. <br><br> *.png; *.jpg *.jpeg o *.gif';
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	}

	#VALIDACION DEL TAMANO DEL ARCHIVO
	if ($tamano_archivo > 10240000) {
		$ReturnStatus =1;
		$Msg = 'El archivo <strong>'.$nombre_archivo_ori.'</strong>  No puede tener mas de 10MB de tamaño !!!. <br><br> <strong>Sugerencia:</strong> <br> Guarde el archivo en formato de menor calidad.';
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	}

	#VALIDACION --> EXISTENCIA DEL DIRECTORIO
	if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/')) {

		//VALIDACION --> CREACIÓN DEL DIRECTORIO
		if (!mkdir($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/',0755)) {
			$ReturnStatus =1;
			$Msg = 'No se pudo crear el directorio <br><br> <strong>Motivo:</strong> La carpeta raiz (aym_image) no ha sido creada. <br><br> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.';
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		}
	}

}		
?>