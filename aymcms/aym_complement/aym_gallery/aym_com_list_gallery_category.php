<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LAS PAGINAS DE CATEGORIA
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start(); 
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['option'])) { $_GET['option'] = "admgallery"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER
	if (!isset($_GET['gal_cat_id'])) { $_GET['gal_cat_id'] = 1; }
	if (!isset($_GET['gal_sub_cat_id'])) { $_GET['gal_sub_cat_id'] = 1; }
	if (!isset($_GET['lan_id'])) { $_GET['lan_id'] = 1;} # 1 --> IDIOMA ESPAÑOL 

	#VARIABLES
	$aym_show_page = ($_GET['aym_page']*$_GET['aym_page_size']);

	# INCLUSIÓN --> PROCEDIMIENTO LISTA DE GALERIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_list_gallery_category.php';
	
	# INCLUSIÓN --> PROCEDIMIENTO CUENTA DE GALERIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_count_gallery_category.php';	
	
?>
<div class="aym_overflow">
	<table width="100%" border="0" cellspacing="0" cellpadding="1" id="aym_delete" class="aym_table">
	<tr>
		<th>Del</th>
		<th id="1"><span class="filter_field <?=$_GET['aym_order'] == '1'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">ID</span></th>
		<th id="2"><span class="filter_field <?=$_GET['aym_order'] == '2'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Nombre</span></th>
		<th id="3"><span class="filter_field <?=$_GET['aym_order'] == '3'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Descripción</span></th>
	</tr>
    <?php while ($row_list_gallery_category=mysqli_fetch_array($aym_sql_list_gallery_category)) { $rows_for_page++; ?>
		<tr data-id="<?=$row_list_gallery_category['gal_cat_id']?>">
			<td><?php if ($row_list_gallery_category['aym_num_rows'] > 0) { ?><figure class="aym_list_icon"><img src="/admin/aym_image/aym_icon/aym_ico_lock.png" alt="Bloqueado"></figure><?php  } else {  ?><figure class="aym_list_icon"><a class="aym_ico_delete" id="<?= $row_list_gallery_category['gal_cat_id']?>"><img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar"></a></figure><?php } ?></td>
			<td class="aym_align_center"><?=$row_list_gallery_category['gal_cat_id']?></td>
			<td class="aym_write aym_align_left" data-name="gal_cat_nam"><?=$row_list_gallery_category['gal_cat_nam']?></td>
			<td class="aym_write aym_align_left" data-name="gal_cat_des"><?=$row_list_gallery_category['gal_cat_des']?></td>
		</tr>
    <?php } mysqli_free_result($aym_sql_list_gallery_category); ?> 
  </table>
</div>
<p>&nbsp;</p>
<?php 
	//INCLUSION DE LA PAGINACION
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>
<form action="/aymcms/actiongallery" class="aym_form_write" method="POST">
	<input id="gal_cat_nam" name="gal_cat_nam"  minlength="2" maxlength="150">
	<input id="gal_cat_des" name="gal_cat_des"  minlength="3" maxlength="255">
	<input type="hidden" id="data-id" name="gal_cat_id">
	<input id="action" name="action" type="hidden" value="UT">
</form>

