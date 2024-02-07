<?php # **************************** AYMCORE V: 14.0 ********************
# COMPLEMENTO PARA BUSCAR USUARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	session_start();

	#INCLUSIÓN ---> PROCEDIMIENTO QUE LISTA LOS USUARIOS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_list_search_user.php';

	$aym_users = '';

	while($aym_user = mysqli_fetch_assoc($aym_list_serch_user)){
		$aym_users = $aym_users."<div class='aym_user_result' id='".$aym_user["use_id"]."'><span>".$aym_user["use_nam"]."</span><span>".$aym_user["use_log"]."</span><input type='hidden' value='".$aym_user["use_nam"]."'></div>"; 
	}	
	mysqli_free_result($aym_list_serch_user);
	
	echo $aym_users;
?>