<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA CARGAR CERRAR LA SESION
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	if(session_id()){
		session_destroy();
	}
	unset($_SESSION['use_ava']);

	session_start(); 

	# PROCEDIMIENTO QUE TRAE LA CONFIGURACIÓN DEL APLICATIVO 
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_about.php'; 
	$_SESSION['abo_nam']=$row_get_about['abo_nam'];
	
	$_SESSION["use_log"]="";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?= $row_get_about['abo_nam'],' - ',$row_get_about['abo_nam']?> </title>
	<meta name="description" content="<?= strip_tags($row_get_about['abo_ver']) ?>">
	<link rel="icon" href="/admin/aym_image/favicon.png">
	<link rel="stylesheet" href="/admin/aym_css/aym_login/aym_style_login.css">
</head>
<body>
	<main>
		<figure>
			<img src="/admin/aym_image/aym_logo_white.png" alt="Aymsoft SAS" longdesc="Aymsoft SAS">
		</figure>
		<section>
			<div class="aym_wrap_exit">
				<center>Su sesión en <strong><?=$_SESSION['abo_nam']?></strong> ha sido cerrada satisfactoriamente!</center>
				<a href="/admin"><button>Salir</button></a>
			</div>
		</section>
	</main>
	<?php
		#  PAGINA --> FOOTER
		require $_SERVER['DOCUMENT_ROOT'].'/admin/aym_page/aym_footer.php';
	?>
</body>
</html>