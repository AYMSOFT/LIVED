<?php # **************************** AYMCMS V: 7.0 ****************************
# PROCEDIMIENTO PARA ACTUALIZAR PAGINAS
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");

	# QUERY 
	$aym_sql = "CALL `AYM_SP_UPDATE_PAGE`(
		".$_POST['pag_id'].", 
		'".$_POST['pag_tit']."', 
		'".$_POST['pag_des']."', 
		'".$_POST['pag_tem']."', 
		'".$_POST['pag_con']."', 
		'".$_POST['pag_url']."', 
		'".$_POST['pag_tar']."', 
		'".$_POST['pag_ima_cap']."', 
		".$_POST['pag_pos'].", 
		'".$_POST['pag_hol']."', 
		'".$_POST['pag_pub']."', 
		'".$_POST['pag_sho_map']."', 
		".$_POST['pag_sub_id'].", 
		".$_POST['pag_cat_id'].", 
		".$_POST['gal_sub_cat_id'].", 
		".$_POST['ban_cat_id'].", 
		".$_POST['lan_id'].",
		'".$use_ip."',
		".$_SESSION['use_id']."
		);";
	if(!$aym_sql_update_page = mysqli_query($link,$aym_sql)){
		$ReturnStatus = 1;
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
	} else {
		$row_update_page=mysqli_fetch_assoc($aym_sql_update_page); 
		$ReturnStatus=$row_update_page['ReturnStatus'];
		$Msg=$row_update_page['Msg'];
		mysqli_free_result($aym_sql_update_page);
	}
	
	mysqli_close($link); 
?>
