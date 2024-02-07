<?php # **************************** AYMCMS V: 7.0 ********************
# PROCEDIMIENTO PARA ELIMINAR IMAGEN DE UNA PAGINA
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
 	$aym_sql = "CALL `AYM_SP_DELETE_PAGE_IMAGE`(
	'".$_POST['pag_ima_id']."')";
	
	if (!$aym_sql_delete_page_image=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php´';	
	} else {
		$row_delete_page_image=mysqli_fetch_assoc($aym_sql_delete_page_image); 
		$ReturnStatus=$row_delete_page_image['ReturnStatus'];
		$Msg=$row_delete_page_image['Msg'];
		mysqli_free_result($aym_sql_delete_page_image);
	} 
	
	mysqli_close($link);
?>