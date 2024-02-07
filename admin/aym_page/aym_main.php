<?php # **************************** AYMCORE V: 14.0 ********************
# CONTENEDOR PRINCIPAL
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
?>
<main>
	<?php
		# PAGINA --> PRINCIPAL 
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_module/aym_security/aym_menu.php';
		
		# VALIDACIÓN ---> PERMISOS PARA INGRESAR AL MÓDULO
		if(in_array($_GET['option'],$row_function)){
			# PAGINA --> ADMINISTRADOR 
			#ECHO $_SERVER['DOCUMENT_ROOT'].$aym_url_pag;
			include_once $_SERVER['DOCUMENT_ROOT'].$aym_url_pag;
		}else{
			# PAGINA --> BINVENIDA 
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_module/aym_security/aym_welcome.php'; 
		}

	?>
</main>