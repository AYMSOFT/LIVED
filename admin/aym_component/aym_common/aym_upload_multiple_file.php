<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA CARGAR ARCHIVOS AL SERVIDOR 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 


# VALIDACION --> CARPETA RAIZ 
if (!is_dir($aym_dir_parent)) {	
	if (!mkdir($aym_dir_parent,0775)) {

		$ReturnStatus = 1;
		$Msg = 'No se pudo crear el directorio raíz 1-'.$i.'<br><br> <strong>Motivo:</strong> La carpeta raiz no ha sido creada. <br><br> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.';

		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	}
}

#VALIDACION --> EXISTENCIA DEL DIRECTORIO
if (!is_dir($aym_dir)) {
	if (!mkdir($aym_dir,0775)) {

		$ReturnStatus = 1;
		$Msg = 'No se pudo crear el directorio del archivo 2-'.$i.'<br><br> <strong>Motivo:</strong> La carpeta raiz no ha sido creada. <br><br> <strong>Sugerencia:</strong> Intente nuevamente.';

		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	}
}

#VALIDACION --> CARGA DEL ARCHIVO AL SERVIDOR
if (!move_uploaded_file($_FILES['aym_fil']['tmp_name'][$i],$aym_dir."/".$nombre_archivo)){
	
	$ReturnStatus = 1;
	$Msg = "No se pudo cargar el archivo al servidor 3-'.$i.'<br><br> <strong> Motivo:</strong> La carpeta raiz no ha sido creada. <br><br> <strong>Sugerencia:</strong> Intente nuevamente.";

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';

}

?>