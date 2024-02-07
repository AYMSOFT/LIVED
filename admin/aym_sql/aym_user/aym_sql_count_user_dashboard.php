<?php # ****************************  AYMCORE V: 14.0 ****************************
# COMPONENTE ASIGNAR PERFILES A LOS USUARIOS 
# � 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
					
	# QUERY
	$aym_sql = "CALL `AYM_SP_COUNT_USER_DASHBOARD`(".$_SESSION['use_id'].");";
    
	# VALIDACION --> SINTAXIS
	if (!$aym_sql_count_user_dashboard=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_message/aym_show_message_error.php");			
	} else{
		$row_count_user_dashboard=mysqli_fetch_assoc($aym_sql_count_user_dashboard); 
		mysqli_free_result($aym_sql_count_user_dashboard);	
	} 
		
	mysqli_close($link); 	 
?>
