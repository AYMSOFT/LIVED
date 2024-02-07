<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA LISTAR LAS FOTOS / GALERIA
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security_out.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link = aym_connect_cms();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_LIST_GALLERY_IMAGE_OUT`('".$_GET['gal_sub_cat_id']."');";
	
	if (!$aym_sql_list_gallery_image=mysqli_query($link, $aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message_out/aym_show_message_error.php';	
	} else {
		$aym_num_rows = mysqli_num_rows($aym_sql_list_gallery_image);
	}
	mysqli_close($link);	 	
?>