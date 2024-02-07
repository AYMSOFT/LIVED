<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA INSERTAR USUARIOS
# � 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }	

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_ADD_USER`('".$_POST['use_nam']."','".$_POST['use_log']."', '".md5($_POST['use_pwd'])."',".$_POST['use_typ_id'].",".$_POST['cli_id'].",".$_POST['off_id'].", '".$use_ip."');";

	if (!$aym_sql_add_user=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
	} else {
		$row_get_user=mysqli_fetch_assoc($aym_sql_add_user); 
		$ReturnStatus=$row_get_user['ReturnStatus'];
		$Msg=$row_get_user['Msg'];
		$use_id=$row_get_user['use_id'];
		$_POST['use_id']=$row_get_user['use_id'];
		mysqli_free_result($aym_sql_add_user);
	}
	mysqli_close($link);
?>