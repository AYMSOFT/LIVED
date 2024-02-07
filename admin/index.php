<?php # **************************** AYMCORE V: 14.0 ********************
# PAGINA PRINCIPAL
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# PAGINA PRINCIPAL 
 	session_start(); 

	# PROCEDIMIENTO QUE TRAE LA CONFIGURACIÓN DEL APLICATIVO 
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_about.php'; 
	
	# VARIABLES DE SESION
	$_SESSION['abo_nam']=$row_get_about['abo_nam'];
	$_SESSION['abo_bel']=$row_get_about['abo_bel'];
	$_SESSION['abo_ver']=$row_get_about['abo_ver'];

	if (!isset($_GET['option'])) { $_GET['option']="login";}
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?= $row_get_about['abo_bel'],' - ',$row_get_about['abo_nam'],' V',$row_get_about['abo_ver']?> </title>
	<meta name="description" content="<?= strip_tags($row_get_about['abo_des']) ?>">
	<link rel="icon" href="/admin/aym_image/favicon.png">
	<link rel="stylesheet" href="/admin/aym_css/aym_login/aym_style_login.css?20230812">
	<link rel="stylesheet" href="/admin/aym_css/aym_validate/aym_style_validate.css">
	<link rel="stylesheet" href="/admin/aym_css/aym_window/aym_window.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="/admin/aym_js/aym_datetimepicker/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="/admin/aym_js/aym_window/aym_window.min.js"></script>
	<script type="text/javascript" src="/admin/aym_js/aym_common/aym_common.js"></script>
	<script type="text/javascript" src="/admin/aym_js/aym_validate/aym_security/aym_validate_security.js"></script>
</head>
<body>
	<?php	
	
		if($_GET['option']=="aym_request_password") {
			
			# VALIDACIÓN --> SI HA INICIADO SESIÓN 
			if(isset($_SESSION['use_id'])){ unset($_SESSION['use_id']);}
			
			# FORMULARIO --> LOGIN
			require $_SERVER['DOCUMENT_ROOT'].'/admin/aym_module/aym_security/aym_request_password.php';
			
		} else if($_GET['option']=="aym_change_request_password") {		
			
			# FORMULARIO --> CAMBIAR CONTRASEÑA RECUPERADA 
			require $_SERVER['DOCUMENT_ROOT'].'/admin/aym_module/aym_security/aym_change_request_password.php';
			
		} else if($_GET['option']=="aym_reset_password") {			
			
				# FORMULARIO --> CAMBIAR CONTRASEÑA RECUPERADA					
				require $_SERVER['DOCUMENT_ROOT'].'/admin/aym_module/aym_security/aym_reset_password.php';
			
		} else {	
			
			# VALIDACIÓN --> SI HA INICIADO SESIÓN 
			if (isset($_SESSION['use_id'])){ unset($_SESSION['use_id']);}
			if (isset($_SESSION['user_log_in'])) { unset($_SESSION['user_log_in']);}
		
			# FORMULARIO --> LOGIN
			require $_SERVER['DOCUMENT_ROOT'].'/admin/aym_module/aym_security/aym_login.php';

		}
		#  PAGINA --> FOOTER
		require $_SERVER['DOCUMENT_ROOT'].'/admin/aym_page/aym_footer.php';
	?>
</body>
</html>