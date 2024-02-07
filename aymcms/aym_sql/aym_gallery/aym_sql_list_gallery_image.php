<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA LISTAR LAS FOTOS / GALERIA
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	
	# QUERY
	 $aym_sql = "CALL `AYM_SP_LIST_GALLERY_IMAGE`('".$_GET['lan_id']."','".$_GET['gal_cat_id']."','".$_GET['gal_sub_cat_id']."','".$_GET['aym_tex_sea']."','".$_GET['aym_order']."','".$_GET['aym_order_type']."','".$aym_show_page."','".$_GET['aym_page_size']."');";
	
	if (!$aym_sql_list_gallery_image=mysqli_query($link, $aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$aym_num_rows = mysqli_num_rows($aym_sql_list_gallery_image);
	}
	mysqli_close($link);	 	
?>