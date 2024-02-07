<?php # **************************** AYMFLY V: 1.0 ********************
# PROCEDIMIENTO PARA PARA BUSCAR USUARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

session_start();

if(isset($_POST["aym_tex_sea"])){
	
	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");	
	
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_LIST_SEARCH_USER`('".$_POST["aym_tex_sea"]."','".$_POST["use_typ_id"]."');";
	$aym_list_serch_user = mysqli_query($link, $aym_sql);
	
	mysqli_close($link); 
}
?>