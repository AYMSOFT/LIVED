<?php # **************************** AYMCORE V: 14.0 ****************************
# PROCEDIMIENTO PARA RESTAURAR LA CONTRASEÑA DE UN USUARIO 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_security/aym_validate_security.php");

	# FUNCION --> CONENCION A LA BD
	include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_function/aym_connection/aym_connection.php");
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# VALIDACION  ---> SI NO ES RECUPERAR LA CONTRASEÑA 
	if (!isset($_POST['aym_rec'])){$_POST['aym_rec']=0;}
	
	#QUERY--> 
	$aym_sql = "CALL `AYM_SP_RESTORE_USER_PASS`(".$_POST['use_id'].",'".md5($_POST['use_pwd'])."');";

	# VALIDACION 
	if (!$aym_sql_restore_user_pass = mysqli_query($link,$aym_sql)) {
		
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
			
	} else {
		$row_get_change_user_pass=mysqli_fetch_assoc($aym_sql_restore_user_pass); 
		$ReturnStatus=$row_get_change_user_pass['ReturnStatus'];
		$Msg=$row_get_change_user_pass['Msg'];
		mysqli_free_result($aym_sql_restore_user_pass);
	}	
	
	mysqli_close($link); 
?>