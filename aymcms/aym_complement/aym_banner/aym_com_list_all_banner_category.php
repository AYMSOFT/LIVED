<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LAS CATEGORIAS/GALERIAS, DEPENDIENDO DEL IDIOMA
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start(); 
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LAS CATEGORIAS DE LOS BANNERS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_list_all_banner_category.php';

	if ($aym_num_rows < 1) {echo '<option value="0">[ SELECCIONE ]</option>';}
	while ($row_list_banner_category_language =  mysqli_fetch_assoc($aym_sql_list_banner_category)){
		echo '<option value="'.$row_list_banner_category_language['ban_cat_id'].'">'.$row_list_banner_category_language['ban_cat_nam'].'</option>';
	}mysqli_free_result($aym_sql_list_banner_category);

?>