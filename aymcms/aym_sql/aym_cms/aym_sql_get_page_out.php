<?php # **************************** AYMCMS V: 7.0 ********************
# PROCEDIMIENTO PARA TRAER DATOS DE UNA PAGINA ESPECIFICA
# © 2023, AYMSOFT SAS 
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023
	  
	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security_out.php';
	
	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");

	# QUERY 
	$aym_sql = "CALL `AYM_SP_GET_PAGE`(".$_GET['pag_id'].")";
	
	if (!$aym_sql_get_page = mysqli_query($link,$aym_sql)) {
		$ReturnStatus = 1;
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
	}else{
		$num_rows = mysqli_num_rows($aym_sql_get_page);
		$row_get_pag = mysqli_fetch_assoc($aym_sql_get_page);
		//echo "<pre>",print_r($row_get_pag),"</pre>";
		mysqli_free_result($aym_sql_get_page);
 	}

	mysqli_close($link); 
?>