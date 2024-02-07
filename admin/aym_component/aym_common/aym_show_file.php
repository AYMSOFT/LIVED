<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA MOSTRAR UN DOCUMENTO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 
	
	session_start(); 

	# VALIDACIÓN ---> TIPO DE ARCHIVO
	if ($_GET['fil_typ_id'] =='1'){ # ARCHIVO DE CONTACTO

		$_GET['con_log_nam_cry']=$_GET['fil_id'];
		include_once $_SERVER['DOCUMENT_ROOT']."/admin/aym_sql/aym_contact/aym_sql_get_contact_file.php";
		
		$nombre = $row_get_contact_file['con_log_nam_cry'].".pdf";
		$contenido = $row_get_contact_file['con_log_fil'];
	
	}

	# VALIDACIÓN ---> TIPO DE ARCHIVO
	if ($_GET['fil_typ_id'] =='2'){ # ARCHIVO DE CARTIFICADO BANCARIO EMPLEADO

		# INCLUSIÓN -> DATOS DE LEGALES EMPLEADOS
		$_GET['emp_id']=$_GET['fil_id'];
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymhuman/aym_sql/aym_employee/aym_sql_get_employee_legal_information.php';
		
		$nombre = "Certificado_bancario_".$_GET['emp_id'].".pdf";
		$contenido = $row_get_employee_legal_information['emp_leg_ban_cer'];
	
	}

	# VALIDACIÓN ---> TIPO DE ARCHIVO
	if ($_GET['fil_typ_id'] =='3'){ # ARCHIVO DEL CONTRATO

		# INCLUSIÓN -> DATOS DE ULTIMO CONTRATO
		$_GET['emp_id']=$_GET['fil_id'];
		$_GET['con_id']=$_GET['fil_dat_id'];
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymhuman/aym_sql/aym_contract/aym_sql_get_employee_contract.php';
		
		$nombre = "contrato_".$_GET['emp_id'].".pdf";
		$contenido = $row_get_employee_contract['con_fil'];
	
	}

    # VALIDACIÓN ---> TIPO DE ARCHIVO
    if ($_GET['fil_typ_id'] =='4'){ # ARCHIVO DEL CONTRATO

        # INCLUSIÓN -> DATOS DE ULTIMO CONTRATO
        $_GET['abs_rec_id']=$_GET['fil_id'];

        # INCLUSION -> SQL PARA TRAER DATOS DE AUSENCIA
        include_once $_SERVER['DOCUMENT_ROOT'].'/aymhuman/aym_sql/aym_absence_record/aym_sql_get_absence_record.php';
        $nombre = "absence_".$_GET['abs_rec_id'].".pdf";
        $contenido = $row_get_absence_record['abs_rea_fil'];

    }

	if ($_GET['fil_typ_id'] =='5'){ # ARCHIVO CONTRATO PROVEEDOR

		$_GET['pro_con_id']=$_GET['fil_id'];
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymhuman/aym_sql/aym_provider/aym_sql_get_provider_contract.php'; 
		$nombre = $row_get_provider_contract['pro_con_nam'].'.pdf';
		$contenido = $row_get_provider_contract['pro_con_fil'];
	
	}



	if ($aym_num_rows>0){
		// Muestra la imagen
		header("Content-Type: application/pdf");
		header("Content-Disposition: inline; filename=".$nombre);
		print("$contenido");
	}else{
		# VARIABLES	
		$ReturnStatus = 1;	
		$aym_url = '/admin';
		$Msg= 'No se pudo obtener el contenido del archivo';
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	}   
?>