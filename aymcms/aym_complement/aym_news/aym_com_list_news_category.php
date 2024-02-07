<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LAS CATEGORIAS DE NOTICIAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start(); 
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['option'])) { $_GET['option'] = "admnews"; } 
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA

	if (!isset($_GET['lan_id'])) { $_GET['lan_id'] = 1;} # 1 --> IDIOMA ESPANOL 

	#VARIABLES
	$aym_show_page = ($_GET['aym_page']*$_GET['aym_page_size']);

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LAS CATEGORIAS DE NOTICIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_list_news_category.php'; 
	

	# INCLUSIÓN --> PROCEDIMIENTO QUE CUANTA LAS CATEGORIAS DE NOTICIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_count_news_category.php';	
	
?>
<meta charset="utf-8">
<div class="aym_overflow">
	<table width="100%" border="0" cellspacing="0" cellpadding="1" id="aym_delete" class="aym_table">
	<tr>
		<th>Del</th>
		<th id="1"><span class="filter_field <?php if($_GET['aym_order'] == '1'){ echo 'active'; if($_GET['aym_order_type']==0){ echo ' asc';}}?> <?=$aym_class_fil?>">Id</span></th>
		<th id="2"><span class="filter_field <?php if($_GET['aym_order'] == '2'){ echo 'active'; if($_GET['aym_order_type']==0){ echo ' asc';}}?>">Nombre</span></th>
		<th id="3"><span class="filter_field <?php if($_GET['aym_order'] == '3'){ echo 'active'; if($_GET['aym_order_type']==0){ echo ' asc';}}?>">Descripción</span></th>
	</tr>
    <?php while ($row_list_news_category=mysqli_fetch_array($aym_sql_list_news_category)) { $rows_for_page++; ?>
		<tr data-id="<?=$row_list_news_category['new_cat_id']?>">
			<td><?php if ($row_list_news_category['aym_num_new'] > 0) { ?><figure class="aym_list_icon"><img src="/admin/aym_image/aym_icon/aym_ico_lock.png" alt="Bloqueado"></figure><?php  } else {  ?><figure class="aym_list_icon"><a href="#" class="aym_ico_delete" id="<?= $row_list_news_category['new_cat_id']?>" url="/aymcms/actionnews/<?= $row_list_news_category['new_cat_id']?>"><img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar"></a></figure><?php } ?></td>
			<td  class="aym_align_center"><?=$row_list_news_category['new_cat_id']?></td>
			<td class="aym_write aym_align_left" data-name="new_cat_nam"><?=$row_list_news_category['new_cat_nam']?></td>   
			<td class="aym_write aym_align_left" data-name="new_cat_des"><?=$row_list_news_category['new_cat_des']?></td>   
		</tr>
    <?php } mysqli_free_result($aym_sql_list_news_category); ?> 
  </table>
</div>
<?php 
    //INCLUSION DE LA PAGINACION
    include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>
<form action="/aymcms/actionnews" class="aym_form_write" method="POST">
	<input id="new_cat_nam" name="new_cat_nam"  minlength="3" maxlength="50">
	<input id="new_cat_des" name="new_cat_des"  minlength="3" maxlength="100">
	<input type="hidden" id="data-id" name="new_cat_id">
	<input id="action" name="action" type="hidden" value="UCT">
</form>