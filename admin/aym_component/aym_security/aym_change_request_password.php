<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA CAMBIAR LA CONTRASEÑA DESDE EL ENLACE DE RECUPERACION 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
 
	session_start(); 

	# ZONA HORARIA 
	date_default_timezone_set('America/Bogota');

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	if($_SESSION['aym_public_string'] <> $aym_public_string) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }	
	if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }
	if ($_SESSION['aym_action'] <> $row_get_option['fun_acc']) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }

	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = "/admin/request-password";

	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['aym_rec'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_log'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd1'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd2'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (strlen($_POST['use_log'])< 3){ $Msg = "Usuario NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd'])< 8){ $Msg = "Contraseña actual NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd1'])< 8){ $Msg = "Contraseña nueva NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd2'])< 8){ $Msg = "Contraseña nueva NOválida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['use_log']=aym_clean_string($_POST['use_log']);	
	$_POST['use_pwd']=aym_clean_string($_POST['use_pwd']);
	$_POST['use_pwd1']=aym_clean_string($_POST['use_pwd1']);
	
	# VARIABLES 
	$_POST['use_pwd1']=md5($_POST['use_pwd1']);
	$_POST['use_pwd2']=md5($_POST['use_pwd2']);

	# VALIDACIÓN --- CONTRASEÑAS 
	if ($_POST['use_pwd1'] <> $_POST['use_pwd2'] ){ $Msg = "Las Contraseñas nuevas NO coinciden"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	# PROCEDIMIENTO QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_change_user_pass.php'; 

	if ($ReturnStatus == '0' ){ 
		$_SESSION['user_log_in'] = md5(session_id());
		$_SESSION['aym_menu'] = md5(session_id());
		
		# VARIABLE --> REDIRECCIÓN
		$aym_url = "/admin/welcome";
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
        include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php'; } 

	if ($ReturnStatus == '1'){ 
		
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
        include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php'; 
	} 
?>