<?php # **************************** aymcms V: 5.7 ********************
# COMPLEMENTO PARA LISTAR LAS CATEGORIA DE FAQ
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017 

	session_start(); 
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['option'])) { $_GET['option'] = "admfaq"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER
	if (!isset($_GET['faq_cat_id'])) { $_GET['faq_cat_id'] = 0; } # 0 --> TIPO ORDER

	#VARIABLES
	$aym_show_page = ($_GET['aym_page']*$_GET['aym_page_size']);

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LA CATEGORIA DE FAQ
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_list_faq_category.php';
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE  CUENTA LA CATEGORIA DE FAQ
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_count_faq_category.php';	
	
?>
<div id="aym_wrap_table">
	<table width="100%" border="0" cellspacing="0" cellpadding="1" class="aym_table" id="aym_delete">
	<tr>
		<th>Del</th>
		<th id="1"><span class="filter_field <?=$_GET['aym_order'] == '1'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">ID</span></th>
		<th id="2"><span class="filter_field <?=$_GET['aym_order'] == '2'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Fecha</span></th>
		<th id="3"><span class="filter_field <?=$_GET['aym_order'] == '3'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Nombre</span></th>
		<th id="4"><span class="filter_field <?=$_GET['aym_order'] == '4'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Descripción</span></th>
	</tr>
    <?php while ($row_list_faq_category=mysqli_fetch_array($aym_sql_list_faq_category)) { $rows_for_page++; ?>
		
		<tr data-id="<?=$row_list_faq_category['faq_cat_id']?>">
			<td><?php if ($row_list_faq_category['aym_num_faq'] > 0) { ?><figure class="aym_list_icon"><img src="/admin/aym_image/aym_icon/aym_ico_lock.png" alt="Bloqueado"></figure><?php  } else {  ?><figure class="aym_list_icon"><a class="aym_ico_delete" id="<?= $row_list_faq_category['faq_cat_id']?>"><img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar"></a></figure><?php } ?></td>
			<td class="aym_align_center"><?=$row_list_faq_category['faq_cat_id']?></td>
			<td class="aym_align_center"><?=$row_list_faq_category['faq_cat_dat']?></td>
			<td class="aym_write" data-name="faq_cat_nam"><?=$row_list_faq_category['faq_cat_nam']?></td>
			<td class="aym_write" data-name="faq_cat_des"><?=$row_list_faq_category['faq_cat_des']?></td>
		</tr>
    <?php } mysqli_free_result($aym_sql_list_faq_category); ?> 
  </table>
</div>
<p>&nbsp;</p>
<?php 
	//INCLUSION DE LA PAGINACION
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>
<form action="/aymcms/actionfaq" class="aym_form_write" method="POST">
	<input id="faq_cat_nam" name="faq_cat_nam" minlength="2" maxlength="150">
	<input id="faq_cat_des" name="faq_cat_des" minlength="3" maxlength="255">
	<input type="hidden" id="data-id" name="faq_cat_id">
	<input id="action" name="action" type="hidden" value="UTC">
</form>