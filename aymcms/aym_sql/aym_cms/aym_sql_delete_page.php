<?php # **************************** AYMCMS V: 7.0 ****************************
# PROCEDIMIENTO PARA ELIMINAR UNA PAGINA
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';
	
	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_DELETE_PAGE`(".$_POST['pag_id'].")";
	
	if (!$aym_sql_delete_page=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_delete_page=mysqli_fetch_assoc($aym_sql_delete_page); 
		$ReturnStatus=$row_delete_page['ReturnStatus'];
		$Msg=$row_delete_page['Msg'];
		mysqli_free_result($aym_sql_delete_page);
	} 
	
	mysqli_close($link);
?>