<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA EDITAR LOS PERFILES
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_UPDATE_PROFILE`('".$_POST['pro_id']."','".$_POST['pro_nam']."', '".$use_ip."',".$_SESSION['use_id'].");";
	
	if (!$aym_sql_update_profile=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';		
	} else {
		$row_get_project=mysqli_fetch_assoc($aym_sql_update_profile); 
		$ReturnStatus=$row_get_project['ReturnStatus'];
		$Msg=$row_get_project['Msg'];
		mysqli_free_result($aym_sql_update_profile);
	}
	mysqli_close($link);
?>	