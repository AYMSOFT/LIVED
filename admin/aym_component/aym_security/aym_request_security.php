<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA ACTIVAR LA SEGURIDAD DE LOS FORMULARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACIÓN
	if (isset($_SESSION['user_log_in'])) { unset($_SESSION['user_log_in']);}
	if (isset($_SESSION['usu_id'])) { unset($_SESSION['usu_id']);}

	# VARIABLE
	$_SESSION['alr'] = md5(session_id());

	#VARIABLES DE SEGURIDAD 
	$aym_private_key=md5($row_get_about['abo_pro_num']);
	$aym_private_user= md5($_SESSION['abo_nam']);
	$aym_public_key=time();
	$aym_public_string=md5("$aym_private_key~$aym_private_user~$aym_public_key");
?>