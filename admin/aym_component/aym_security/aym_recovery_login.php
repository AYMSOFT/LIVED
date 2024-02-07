<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA ADMINISTRAR LAS OPCIONES
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	if($_SESSION['aym_public_string'] <> $aym_public_string) {include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }	
	if ($_SESSION['alr'] <> md5(session_id())) {include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }
	if ($_SESSION['aym_action'] <> $row_get_option['fun_acc']) {include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }

	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = "/admin/login";

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_GET['use_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_GET['use_pwd'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_GET['aym_rec'])) {include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; } 
	if (!isset($_GET['use_pwd_ses'])) {include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }

	
	#MENSAJE 
	$Msg = "Este enlace ya no es váido.";

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_GET['use_id'], FILTER_VALIDATE_INT)){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}			
	if (strlen($_GET['use_pwd'])< 32) {include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_GET['aym_rec'])< 32) {include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_GET['use_pwd_ses'])< 32) {include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	# VARIABLES --> LIMPIEZA DE VARIABLES
	$use_pwd=aym_clean_string($_GET['use_pwd']);
	$aym_rec=aym_clean_string($_GET['aym_rec']);
	$use_pwd_ses=aym_clean_string($_GET['use_pwd_ses']);
	
	# INCLUSION --> COMPONENTE PARA ACTIVAR EL ENLACE DE RECUPERACIÓN
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_update_link.php'; 

	# VALIDACIÓN---> DATOS CORRECTOS
	if($ReturnStatus < 1) {
	
		# INCLUSION --> COMPONENTE QUE TRAE LOS DATOS DEL USUARIO
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_get_user.php'; 
		
		# VARIABLES
		$use_log_ip = aym_get_ip();
		
		# VARIABLES DE SESIÓN
		$_SESSION['user_log_in'] = md5(session_id());
		$_SESSION['use_id'] =$row_get_user['use_id'];
		$_SESSION['use_log'] = $row_get_user['use_log'];
		$_SESSION['use_pwd'] = $row_get_user['use_pwd'];
		$_SESSION['use_nam'] = $row_get_user['use_nam'];
		

		#=======================================  LOG DE AUDITORIA  ========================================
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_add_login.php';
		#================== ===================== CONTADOR DE ENTRADAS ==================================== 
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_update_login.php';	
		#================================================================================================

		# REDIRECION --> CAMBIAR CONTRASEÑA
		echo "<meta http-equiv='Refresh'content='1; URL=/admin/change-request-password'>";		
		exit;
		

	} else {
		
		$ReturnStatus = 2;
	
		# REDIRECCION --> OLVIDÓ CONTRASEÑA
		$aym_url="/admin/";

		# INCLUSIÓN--> COMPONENTE QUE MUESTRA LOS MENSAJES 
        include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	}
?>