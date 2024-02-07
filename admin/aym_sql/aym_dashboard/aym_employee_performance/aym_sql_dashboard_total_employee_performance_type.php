<?php # **************************** AYMHUMA V: 1.0 ********************
# PROCEDIMIENTO PARA TOTALIZA EVALUACIONES POR TIPO
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';
	
	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymhuman/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_human();
	mysqli_set_charset($link, "utf8");
        
    # hago un decode de la fecha
    $fecha = json_decode($_POST['aym_dat_fil']);
    
	# QUERY
    $aym_sql = "CALL `AYM_SP_DASHBOARD_TOTAL_EMPLOYEE_PERFORMANCE_TYPE`('".$fecha->{'start'}." 00:00:00', '".$fecha->{'end'}." 23:59:59');"; 
    
	# QUERY --> LISTADO LOS REGISTROS 	
	if (!$aym_sql_dashboard_total_employee_performance_type=mysqli_query($link,$aym_sql)) {
        $aym_sp = 'AYM_SP_DASHBOARD_TOTAL_EMPLOYEE_PERFORMANCE_TYPE';
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {	
        $row_total_employee_performance_type = mysqli_fetch_array($aym_sql_dashboard_total_employee_performance_type);
        mysqli_free_result($aym_sql_dashboard_total_employee_performance_type);
 	}
	mysqli_close($link);
?>       