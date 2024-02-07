<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA MOSTRAR TODAS LAS CATEGORIAS DE LAS NOTICIAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start();
	
	# INCLUSIÓN --> COMPONENTE QUE CARGA CATEGORIAS DE LAS NOTICIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_list_all_news_category.php';

	if ($aym_num_rows < 1) {  echo '<option value="0"> ---- </option>'; }
	while ($row_list_news_category = mysqli_fetch_array($aym_sql_list_all_news_category)) {
		 echo '<option value="'.$row_list_news_category['new_cat_id'].'">'.$row_list_news_category['new_cat_nam'].'</option>';
	} 
	mysqli_free_result($aym_sql_list_all_news_category);

?>