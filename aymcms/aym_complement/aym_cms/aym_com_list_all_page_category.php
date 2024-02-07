<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LAS CATEGORIAS DE PAGINAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start(); 
	
	if(!isset($_GET['pag_cat_id'])){$_GET['pag_cat_id']=1;}
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LAS CATEGORIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_all_page_category.php';

	if ($aym_num_rows < 1) {echo '<option value="0">[ SELECCIONE ]</option>';}else{
		while ($row_get_all_page_category =  mysqli_fetch_assoc($aym_sql_list_all_page_category)){
			if($row_get_all_page_category['pag_cat_id'] == $_GET['pag_cat_id']){
				echo '<option value="'.$row_get_all_page_category['pag_cat_id'].'" selected>'.$row_get_all_page_category['pag_cat_nam'].'</option>';
			}else{
				echo '<option value="'.$row_get_all_page_category['pag_cat_id'].'">'.$row_get_all_page_category['pag_cat_nam'].'</option>';
			}
		}mysqli_free_result($aym_sql_list_all_page_category);
	}

?>