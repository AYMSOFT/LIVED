<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA INSERTAR IMAGEN / GALERÍA
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_ADD_GALLERY_IMAGE`(
		'".$_POST['gal_nam']."',
		'".$_POST['gal_des'][$i]."',
		'".$_POST['gal_sub_cat_id']."',
		'".$_POST['lan_id']."',
		'".$use_ip."',
		'".$_SESSION['use_id']."'
	);";

	if (!$aym_sql_add_gallery_image=mysqli_query($link, $aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_get_gallery_image=mysqli_fetch_assoc($aym_sql_add_gallery_image); 
		$ReturnStatus=$row_get_gallery_image['ReturnStatus'];
		$Msg=$row_get_gallery_image['Msg'];
		$gal_id=$row_get_gallery_image['gal_id'];
		mysqli_free_result($aym_sql_add_gallery_image);
	}

	mysqli_close($link); 
?>