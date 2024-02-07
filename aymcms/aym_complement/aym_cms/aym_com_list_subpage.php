<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LAS SUBPAGINAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start(); 
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LAS CATEGORIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_subpage.php';

	echo '<option value="0">[ PÁGINA PRINCIPAL ]</option>';
	while ($row_get_list_subpage =  mysqli_fetch_assoc($aym_sql_list_subpage)){
		echo '<option value="'.$row_get_list_subpage['pag_id'].'">'.$row_get_list_subpage['pag_tit'].'</option>';
	}mysqli_free_result($aym_sql_list_subpage);

?>