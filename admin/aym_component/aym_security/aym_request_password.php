<?php # **************************** AYMCORE V: 1.0 ********************
# COMPONENTE PARA RECUPERAR LA CONTRASEÑA AL USUARIO
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017
 
	session_start(); 
	
	# ZONA HORARIA
	date_default_timezone_set('America/Bogota');

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	if($_SESSION['aym_public_string'] <> $aym_public_string) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }	
	if ($_SESSION['alr'] <> md5(session_id())) {  include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }
	if ($_SESSION['aym_action'] <> $row_get_option['fun_acc']) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }

	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['use_log'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
	# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['use_log'], FILTER_VALIDATE_EMAIL)){ $Msg = "Email NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}	
	
	# INCLUSION --> COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_recovery_pass.php'; 	

	if ($row_count > 0) {  # 0 --> SI SE PUDO AUTENTICAR
		
		# VARIABLES
		$use_id = $row_recovery_pass['use_id'];
		$use_nam = $row_recovery_pass['use_nam'];
		$use_log = $row_recovery_pass['use_log'];
		$use_pwd = $row_recovery_pass['use_pwd'];
		$_SESSION['use_id'] = $row_recovery_pass['use_id'];
		
		# INCLUSION --> COMPONENTE QUE ENVIA EL MAIL AL USUARIO
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_email/aym_send_mail_pass.php'; 

		
		if ($mail_sent > 0 ) {
			
			# INCLUSION --> COMPONENTE QUE REGISTRA LA SESION
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_update_sesion.php'; 	
			
			$ReturnStatus = 0;
		 	# MENSAJE
			$Msg = 'Sus datos han sido enviados a: <strong>'.$use_log.'</strong><br> Por favor verifique en la bandeja de correo no deseado.<br>';
			# REDIRECCION
			$aym_url="/admin/login";
			
			# INCLUSION --> COMPONENTE QUE MUESTRA LOS MENSAJES 
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		

		} else {
			$ReturnStatus = 1;
			# MENSAJE
			$Msg = 'No hemos podido procesar su solicitud <br><br> <strong>Sugerencia</strong>:<br> Intente nuevamente. Si el problema  persiste, consulte al Administrador del aplicativo';
			
			# INCLUSION --> COMPONENTE QUE MUESTRA LOS MENSAJES 
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		}
			
	} else {  	# VALIDACION ---> CONTRASEÑA MALA O USUARIO NO EXISTE 

		$ReturnStatus = 2;
		# MENSAJE
		$Msg = 'Los datos proporcionados por usted no coinciden con los almacenados en nuestro sistema. <br><br> <strong>Sugerencia</strong>: <br>Verifique los datos intoducidos en el formulario e intente nuevamente. Si el problema  persiste, consulte al Administrador del aplicativo';
		
		# INCLUSION --> COMPONENTE QUE MUESTRA LOS MENSAJES 
        include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	}
?>