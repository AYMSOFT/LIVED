<?php # **************************** AYMCMS V: 7.0 ****************************
# PROCEDIMIENTO PARA EDITAR EL ESTADO DE UN PEDIDO
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';
	
	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_UPDATE_PAGE_POSITION`(".$_POST['pag_id'].", ".$_POST['pag_pos'].");";
	 
	if (!$aym_sql_update_page_position=mysqli_query($link,$aym_sql)) {
		$ReturnStatus=1;
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_update_page_position=mysqli_fetch_assoc($aym_sql_update_page_position); 
		$ReturnStatus=$row_update_page_position['ReturnStatus'];
		$Msg=$row_update_page_position['Msg'];
		mysqli_free_result($aym_sql_update_page_position);
	}
	mysqli_close($link);
?>	