<?php # **************************** AYMCORE V: 1.0 ********************
# PROCEDIMIENTO PARA TOTAL EMPLEADOS
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';
	
	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymhuman/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_human();
	mysqli_set_charset($link, "utf8");
        
    # hago un decode de la fecha
    #$fecha = json_decode($_POST['aym_dat_fil']);
    #'".$fecha->{'start'}." 00:00:00','".$fecha->{'end'}." 23:59:59'
    
	# QUERY
    $aym_sql = "CALL `AYM_SP_DASHBOARD_LIST_EMPLOYEE_X_CONTRACT`('".$_POST['com_id']."');"; 
    
	# QUERY --> LISTADO LOS REGISTROS 	
	if (!$aym_sql_dashboard_employee_x_contract=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {	
		$aym_num_rows = mysqli_num_rows($aym_sql_dashboard_employee_x_contract);
 	}
	mysqli_close($link);
?>       