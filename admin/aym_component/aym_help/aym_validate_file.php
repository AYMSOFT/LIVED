<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA VALIDAR TAMAÑO Y EXTENSIÓN DE LAS IMAGEN
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

# DATOS DEL ARCHIVO
$aym_typ_fil = $_FILES['aym_fil']['type'][$i];
$aym_fil_siz = $_FILES['aym_fil']['size'][$i];
$aym_nam_fil = aym_friendly_url(substr($_FILES['aym_fil']['name'][$i], 0, strrpos($_FILES['aym_fil']['name'][$i], '.')));

# VALIDACION SI EL ARCHIVO ES UNA IMAGEN
$aym_val_ext = preg_match("/.png$|.jpg$|.gif$|.jpeg$/i", $_FILES["aym_fil"]['name'][$i]);
$aym_ext = substr(strrchr($_FILES["aym_fil"]['name'][$i], '.'), 1);

# VALIDACION SI LA RUTA DEL ARCHIVO ES VALIDA
if ($aym_nam_fil_ori <> "" && (strlen($aym_nam_fil_ori) < 4 )){
	$ReturnStatus =1;
	$Msg = 'Debe especificar una ruta válida para el archivo No '.($i+1).' <br><br> <strong>Sugerencia:</strong> <br> Verifique los datos introducidos en el formulario.';
	
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
}

# VALIDACIÓN DEL TAMANO DEL ARCHIVO
if ($aym_fil_siz > 2000001) {
	$ReturnStatus =1;
	$Msg = 'El archivo <strong>'.$aym_nam_fil_ori.'</strong> correspondiente al archivo No '.($i).', No puede tener mas de 2 MB de tamaño !!!. <br><br> <strong>Sugerencia:</strong> <br> Guarde el archivo en formato de menor calidad.';
	
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
}

# VALIDACIÓN --> EXISTENCIA DEL DIRECTORIO
if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/admin/aym_document/aym_document_temp/')) {

	# VALIDACIÓN --> CREACIÓN DEL DIRECTORIO
	if (!mkdir($_SERVER['DOCUMENT_ROOT'].'/admin/aym_document/aym_document_temp/',0755)) {
		$ReturnStatus =1;
		$Msg = 'No se pudo crear el directorio <br><br> <strong>Motivo:</strong> La carpeta raiz (aym_document_temp) no ha sido creada. <br><br> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.';

		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';

	}
}# --> FIN DEL PROCESO
?>