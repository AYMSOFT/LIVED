<?php # **************************** AYMCMS V: 7.0 ********************
# PROCEDIMIENTO PARA INSERTAR CATEGORIAS DE NOTICIAS
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';
	
	# FUNCION --> CONENCION A LA BD
	include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_ADD_NEWS_CATEGORY`('".$_POST['new_cat_nam']."','".$_POST['new_cat_des']."',".$_POST['new_cat_ord'].",".$_POST['lan_id'].",".$_SESSION['use_id']." );";

	if (!$aym_sql_add_news_category=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_get_news_category=mysqli_fetch_assoc($aym_sql_add_news_category); 
		$ReturnStatus=$row_get_news_category['ReturnStatus'];
		$Msg=$row_get_news_category['Msg'];
		$_POST['new_cat_id'] = $row_get_news_category['new_cat_id'];
		mysqli_free_result($aym_sql_add_news_category);
	}
	mysqli_close($link);
?>