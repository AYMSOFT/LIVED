<?php 
#DATOS DEL ARCHIVO
$tipo_archivo = $_FILES['gal_ima']['type'][$i];
$tamano_archivo = $_FILES['gal_ima']['size'][$i];

#VALIDACION SI EL ARCHIVO ES UNA IMAGEN
$valida_extension = preg_match("/.png$|.jpg$|.gif$|.jpeg$/i", $_FILES["gal_ima"]['name'][$i]);
$extension = substr(strrchr($_FILES["gal_ima"]['name'][$i], '.'), 1);

#VALIDACION SI LA RUTA DEL ARCHIVO ES VALIDA
if ($nombre_archivo_ori <> "" && (strlen($nombre_archivo_ori) < 4 )){
	$ReturnStatus =1;
	$Msg = 'Debe especificar una ruta válida para la imagen No '.($i+1).' <br /><br /> <strong>Sugerencia:</strong> <br /> Verifique los datos introducidos en el formulario.';
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
}

#VALIDACION DE LA IMAGEN ES DE FORMATO ADECUADO
if ($valida_extension == '0') {
	$ReturnStatus =1;
	$Msg = 'El archivo <strong>'.$nombre_archivo_ori.'</strong> correspondiente a la imagen No '.($i+1).', tiene una extensión NO válida. <br /><br /> <strong>Sugerencia:</strong> <br /> Guarde el archivo en formato. <br /><br /> *.png; *.jpg *.jpeg o *.gif';
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
}

#VALIDACION DEL TAMANO DEL ARCHIVO
if ($tamano_archivo > 1048576) {
	$ReturnStatus =1;
	$Msg = 'El archivo <strong>'.$nombre_archivo_ori.'</strong> correspondiente a la imagen No '.($i+1).', No puede tener mas de 1 MB de tamaño !!!. <br /><br /> <strong>Sugerencia:</strong> <br /> Guarde el archivo en formato de menor calidad.';
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
}

?>