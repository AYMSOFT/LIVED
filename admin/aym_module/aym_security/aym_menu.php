<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA CARGAR EL MENU DINAMICO DE OPCIONES
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 
	

	# ARRAY ---> OPCIONES EXCLUIDAS
	#$row_function = array('welcome','my_account','help','logout', 'feedback', 'admcompany' );
	$row_function = [];

	# PROCEDIMIENTO QUE LISTA EL MENÚ DEPENDIENDO DE CATEGORIA
	$_GET['fun_cat_id'] = 1;
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_list_menu_category.php'; 
	while($row_function_menu = mysqli_fetch_array($aym_sql_list_menu_category)){
		array_push($row_function, $row_function_menu['fun_acc']);
	}mysqli_free_result($aym_sql_list_menu_category);


	# PROCEDIMIENTO QUE LUSTA EL MENÚ DEPENDIENDO DEL PERFIL
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_list_menu.php'; 

?>
<aside>
    <h3>MENÚ DE OPCIONES</h3>
	<nav>
		<ul>
	    	<?php

			while ($row_fun_men=mysqli_fetch_array($aym_sql_list_menu)) { 
				# ARRAY ---> SUPERCARGAR 
				$row_function[] = $row_fun_men['fun_acc'];
				$row_uri = explode("/",$_SERVER["REQUEST_URI"]);
				# VALIDACIÓN 
				if($row_uri[2] == $row_fun_men['fun_acc']){$activo = "class='active'";} else {$activo = "";}
			
				echo '<li><a '.$activo.' href="/'.$row_fun_men['fun_sys'].'/'.$row_fun_men['fun_acc'].'">'.$row_fun_men['fun_nam'].'</a></li>'; 
			
			} mysqli_free_result($aym_sql_list_menu); 
			
			?>
		</ul>
	</nav>
</aside>