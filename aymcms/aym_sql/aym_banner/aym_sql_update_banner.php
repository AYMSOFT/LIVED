<?php # **************************** AYMCMS V: 7.0 ****************************
# PROCEDIMIENTO PARA ACTUALIZAR BANNER
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_UPDATE_BANNER` (
		  '".$_POST['ban_id']."'
		, '".$_POST['ban_dat_tim_ini']."'
		, '".$_POST['ban_dat_tim_fin']."'
		, '".$_POST['ban_des']."'
		, '".$_POST['ban_url']."'
		, '".$_POST['ban_tar']."'
		, '".$_POST['ban_cap']."'
		, '".$_POST['ban_pos']."'
		, '".$_POST['ban_sta']."'
		, '".$_POST['ban_cat_id']."'
		, '".$_POST['lan_id']."'
		, '".$use_ip."'
		, '".$_SESSION['use_id']."'
	);";

	if (!$aym_sql_update_banner=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
	} else {
		$row_upd_banner=mysqli_fetch_assoc($aym_sql_update_banner); 
		$ReturnStatus=$row_upd_banner['ReturnStatus'];
		$Msg=$row_upd_banner['Msg'];
		mysqli_free_result($aym_sql_update_banner);
	}
	mysqli_close($link);
?>	