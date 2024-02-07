<?php # **************************** AYMCORE V: 14.0 ********************
# COMPLEMENTO PARA BUSCAR PERFILES
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
	
	session_start();

	#INCLUSIÓN ---> PROCEDIMIENTO BUSCA TODOS LOS PERFILES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_search_profile_list.php';

	$aym_profiles = '';
	while($aym_profile = mysqli_fetch_assoc($aym_sql_list_profile)){
		$aym_profiles = $aym_profiles."<div class='aym_profile_result' id='".$aym_profile["pro_id"]."'><span>".$aym_profile["pro_nam"]."</span></div>"; 
	}	mysqli_free_result($aym_sql_list_profile);

	echo $aym_profiles;
?>