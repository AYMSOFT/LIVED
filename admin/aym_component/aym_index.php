<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA ADMINISTRAR LAS OPCIONES
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	session_start(); 

	# ZONA HORARIA
	date_default_timezone_set('America/Bogota');


	$_SESSION['alr'] = md5(session_id());

	# PRELOADER
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_module/aym_security/aym_preloader.php';
	

	# ARRAY ---> EXCLUIR DE LA VALIDACIÓN 
	$aym_option = array("send-login", "send-request-password", "recovery");
	
	if (!in_array($_GET['option'], $aym_option)) {
		# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';	
	}
	

	# VALIDACION 
	if (!isset($_GET['option'])){ 
		echo "<meta http-equiv='Refresh'content='1; URL=". $_SERVER['HTTP_REFERER']."'>"; exit; 
		
	}  else {

			
		# INCLUSION --> PROCEDIMIENTO QUE TRAE LA OPCION DESEADA
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_option.php';
		
		# INCLUSION --> PROCEDIMIENTO QUE TRAE LA CONFIGURACIÓN DEL APLICATIVO 
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_about.php'; 
		
		echo '
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title> '.$row_get_about['abo_bel'],' - ',$row_get_about['abo_nam'],' V',$row_get_about['abo_ver'].' </title>
		<meta name="description" content="'.strip_tags($row_get_about['abo_des']).'">
		<link rel="icon" href="/admin/aym_image/favicon.png">
		<script type="text/javascript" src="/admin/aym_js/aym_security/aym_security_time_function.js"></script>
		'; 
		
		# VARIABLES
		$aym_url_pag = $row_get_option['fun_com'];
		$_SESSION['aym_action'] = $row_get_option['fun_acc'];

		#VARIABLES DE SEGURIDAD 
		$aym_private_key=md5($row_get_about['abo_pro_num']);
		$aym_private_user=md5($row_get_about['abo_nam']);

		
		if ($_GET['option']=="recovery") { 
			# VARIABLES DE SESIÓN
			$_SESSION['aym_public_key']=$_GET['aym_pk'];
		 	$_SESSION['aym_public_string']=$_GET['aym_ps'];
		
		} else {
			# VARIABLES DE SESIÓN
			$_SESSION['aym_public_key']=$_POST['aym_pk'];
			$_SESSION['aym_public_string']=$_POST['aym_ps'];
		}
		
	
		# VARIABLE CREADA
		$aym_public_string=md5("$aym_private_key~$aym_private_user~".$_SESSION['aym_public_key']."");
		
		require $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component'.$row_get_option['fun_com'];
		
	}
	
?>