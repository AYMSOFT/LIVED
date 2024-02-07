<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA EDITAR UNA GALERIA / CATEGORIA
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_UPDATE_GALLERY_CATEGORY`('".$_POST['gal_cat_id']."', '".$_POST['gal_cat_nam']."', '".$_POST['gal_cat_des']."', '".$_POST['lan_id']."', '".$use_ip."', '".$_SESSION['use_id']."');";

	if (!$aym_sql_update_gallery_category=mysqli_query($link, $aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_get_gallery_category=mysqli_fetch_assoc($aym_sql_update_gallery_category); 
		$ReturnStatus=$row_get_gallery_category['ReturnStatus'];
		$Msg=$row_get_gallery_category['Msg'];
		mysqli_free_result($aym_sql_update_gallery_category);
	}
	mysqli_close($link); 
?>