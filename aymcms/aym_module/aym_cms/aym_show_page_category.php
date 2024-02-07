<?php # **************************** AYMCMS V: 7.0 ********************
# MODULO PARA MOSTRAR LAS CATEGORÍAS DE LAS PAGINAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# INCLUSION -> LISTAR LAS CATEGORÍAS DE LAS PAGINAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_page_category_out.php';
	while($row_page_category = mysqli_fetch_array($aym_sql_list_page_category_out)){ 
?>

	<div class="aym_item">
		<h2><?=$row_page_category['pag_tit'];?></h2>
		<figcaption>
			<?=$row_page_category['pag_des'];?>
		</figcaption>
	</div>

	

<?php }mysqli_free_result($aym_sql_list_page_category_out);?>