<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA VALIDAR EL USUARIO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	session_start();

	# ZONA HORARIA 
	date_default_timezone_set('America/Bogota');

	$_SESSION['alr'] = md5(session_id());

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';	

	# VALIDACION 
	if (!isset($_GET['option'])){ $_GET['option']="login";}
	
	if (!isset($_SESSION['abo_ver'])){

		# PROCEDIMIENTO QUE TRAE LA CONFIGURACIÓN DEL APLICATIVO 
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_about.php'; 
		$_SESSION['abo_nam']=$row_get_about['abo_nam'];
		$_SESSION['abo_ver']= $row_get_about['abo_ver'];
		$_SESSION['abo_bel']=$row_get_about['abo_bel'];
		$_SESSION['abo_url']=$row_get_about['abo_url'];
		$_SESSION['abo_ema']=$row_get_about['abo_ema'];
		$_SESSION['abo_des']=$row_get_about['abo_des'];
		$_SESSION['abo_pro_num']=$row_get_about['abo_pro_num'];
	}

	if(isset($_SESSION['abo_des'])) { strip_tags($_SESSION['abo_des']);} else { $_SESSION['abo_des'] = $_SESSION['abo_nam'].' - '.$_SESSION['abo_ver'];}
	
	if ($_GET['option']=="login"){ 
		if (isset($_SESSION['user_log_in'])) { unset($_SESSION['user_log_in']);}
		if (isset($_SESSION['usu_id'])) { unset($_SESSION['usu_id']);}
	}

	# INCLUSION
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_option.php';

	# VARIABLES
	$aym_url_pag = $row_get_option['fun_url'];
?>