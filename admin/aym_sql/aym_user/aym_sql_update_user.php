<?php # **************************** AYMCORE V: 14.0 ****************************
# PROCEDIMIENTO PARA EDITAR USUARIOS
# � 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_security/aym_validate_security.php");

	# FUNCION --> CONENCION A LA BD
	include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_function/aym_connection/aym_connection.php");
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_UPDATE_USER`(
		'".$_POST['use_id']."',
		'".$_POST['use_dat_exp']."', 
		'".$_POST['use_nam']."', 
		'".$_POST['use_log']."', 
		'".$_POST['use_typ_id']."', 
		'".$_POST['sta_id']."', 
		'".$_POST['cli_id']."',
		'".$_POST['off_id']."'
	);";
	
	if (!$aym_sql_update_user=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_get_project=mysqli_fetch_assoc($aym_sql_update_user); 
		$ReturnStatus=$row_get_project['ReturnStatus'];
		$Msg=$row_get_project['Msg'];
		$aym_push=$row_get_project['aym_push'];
		$aym_title=$row_get_project['aym_title'];
		mysqli_free_result($aym_sql_update_user);
	}
	mysqli_close($link);
?>