<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR TODAS  LAS SUBCATEGORIA/GALERIAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023
	session_start(); 
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LAS CATEGORIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_list_all_gallery_subcategory.php';

	if ($aym_num_rows < 1){
		echo '<option value="0">[ SELECCIONE ]</option>';
	}else{
		while ($row_get_gallery_subcategory =  mysqli_fetch_assoc($aym_sql_list_all_gallery_subcategory)){
			echo '<option value="'.$row_get_gallery_subcategory['gal_sub_cat_id'].'">'.$row_get_gallery_subcategory['gal_sub_cat_nam'].'</option>';
		} mysqli_free_result($aym_sql_list_all_gallery_subcategory);
	}
?>