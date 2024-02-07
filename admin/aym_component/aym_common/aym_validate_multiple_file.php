<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA VALIDAS ARCHIVOS NATES DE CARGAR AL SERVIDOR 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022  

#===================================================================================================
#========================================== VALIDAR ARCHIVO  =======================================
#===================================================================================================

#DATOS DEL ARCHIVO
$nombre_archivo_ori = $_FILES['aym_fil']['name'][$i];

$tipo_archivo = $_FILES['aym_fil']['type'][$i];
$tamano_archivo = $_FILES['aym_fil']['size'][$i];
$extension = pathinfo($_FILES["aym_fil"]['name'][$i], PATHINFO_EXTENSION);
	
$tipos_validos=array(
		//"application/pdf",
		//"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
		//"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
		//"application/vnd.openxmlformats-officedocument.presentationml.presentation",
		//IMÁGENES
		"image/jpeg",
		"image/jpeg",
		"image/png",
		"image/gif"
	);

#VALIDACION SI LA RUTA DEL ARCHIVO ES VALIDA
if (strlen($nombre_archivo_ori) < 4){
	#RESPUESTA EN JSON
	$ReturnStatus = 1;
	$Msg = 'Debe especificar una ruta válida para el archivo <br><br> <strong>Sugerencia:</strong> <br> Verifique los datos introducidos en el formulario.';

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
}

#VALIDACION DE LA IMAGEN ES DE FORMATO ADECUADO
if (!in_array($tipo_archivo, $tipos_validos)){
	$ReturnStatus = 1;
	$Msg = 'El archivo <strong>'.$nombre_archivo_ori.'</strong> tiene una extensión NO válida. Únicamente se admiten archivos en formato .jpg, .gif, png';

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
}

#VALIDACION DEL TAMAÑO DEL ARCHIVO
if ($tamano_archivo > 10240000){
	$ReturnStatus = 1;
	$Msg = 'El archivo <strong>'.$nombre_archivo_ori.'</strong> No puede tener mas de 10MB de tamaño !!!. <br><br> <strong>Sugerencia:</strong> <br> Guarde el archivo en formato de menor calidad.';

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
}
#==================================================================================================
?>