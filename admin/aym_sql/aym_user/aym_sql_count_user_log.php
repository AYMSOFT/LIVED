<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA CONTAR LAS ENTRADAS AL SISTEMA DE LOS USUARIOS
# � 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 


	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }	
	
	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql="CALL `AYM_SP_COUNT_USER_LOG`(".$_GET['use_id'].");";
	
	if(!$aym_sql_list_user_log_con = mysqli_query($link,$aym_sql)) {			
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
	} else {
		$rows_for_page = 0;
		$row_list_user_con =  mysqli_fetch_assoc ($aym_sql_list_user_log_con);
		$num_rows = $row_list_user_con['num_rows'];
		$aym_pages = ($row_list_user_con['num_rows'] / $_GET['aym_page_size']);
		$aym_page_ceil = ceil($aym_pages);
		mysqli_free_result($aym_sql_list_user_log_con);
	}
	
	mysqli_close($link); 	
?>