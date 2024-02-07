<?php # **************************** AYMCORE V: 1.0 ****************************
# COMPONENTE ELIMINAR DASH A LOS USUARIOS 
# � 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
					
	# QUERY
	$aym_sql = "CALL `AYM_SP_DELETE_USER_DASHBOARD`(".$_POST['use_id'].", ".$das_id.");";
	# VALIDACION --> SINTAXIS
	if (!$aym_sql_del_user_dashboard=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_message/aym_show_message_error.php");			
	} else{
		$row_del_user_dashboard=mysqli_fetch_assoc($aym_sql_del_user_dashboard); 
		$ReturnStatus=$row_del_user_dashboard['ReturnStatus'];
        $Msg=$row_del_user_dashboard['Msg'];	
        mysqli_free_result($aym_sql_del_user_dashboard);	
	} 
		
	mysqli_close($link); 	 
?>
