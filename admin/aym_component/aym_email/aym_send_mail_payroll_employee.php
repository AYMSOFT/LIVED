<?php # **************************** AYM EASY SITE V: 5.0  ********************
# COMPONENTE PARA ENVIAR CORREO CON DESPRENDIBLE DE NOMINA
# AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ABR/26/2013

	# INCLUSION -> FUNCION QUE ENVIA EL CORREO Y LOS ARCHIVOS ADJUTOS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_mail/aym_fun_mail_attached.php';

    $to = $_POST['sen_ema'];
	$from = 'no-reply@aymhuman.com';
	$from_name = 'AYM HUMAN';

	# =================================================================================================
	# ======================== GENERAR ENTRADA DE CORREO SALUDO Y EXPLICACIÓN =========================
	# =================================================================================================

    $files = $content;
    $subject = 'Desprendible de Nómina'; 
    $html_content = 'Hola, A continuación encontraras tu desprendible de nómina';

    if (!multi_attach_mail_base($to, $subject, $html_content, $from, $from_name, $files, $namefile)){
        $Msg = 'No fue posible enviar el correo';$ReturnStatus = 1;
    }else{
        $Msg = 'Correo envíado satisfactoriamente';$ReturnStatus = 0;
    }
?>
