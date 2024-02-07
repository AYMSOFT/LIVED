<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LAS CATEGORIA DE BANNER
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start(); 
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['option'])) { $_GET['option'] = "admbanner"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER
	if (!isset($_GET['lan_id'])) { $_GET['lan_id'] = 1;} # 1 --> IDIOMA ESPAÑOL 

	#VARIABLES
	$aym_show_page = ($_GET['aym_page']*$_GET['aym_page_size']);

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LA CATEGORIA DE BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_list_banner_category.php';
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE  CUENTA LA CATEGORIA DE BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_count_banner_category.php';	
	
?>
<div id="aym_wrap_table">
	<table width="100%" border="0" cellspacing="0" cellpadding="1" class="aym_table" id="aym_delete">
	<tr>
		<th>Del</th>
		<th id="1"><span class="filter_field <?=$_GET['aym_order'] == '1'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Id</span></th>
		<th id="2"><span class="filter_field <?=$_GET['aym_order'] == '2'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Nombre</span></th>
		<th id="3"><span class="filter_field <?=$_GET['aym_order'] == '3'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Descripción</span></th>
		<th id="4"><span class="filter_field <?=$_GET['aym_order'] == '4'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Alto (px)</span></th>
		<th id="5"><span class="filter_field <?=$_GET['aym_order'] == '5'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Ancho (px)</span></th>
	</tr>
    <?php while ($row_list_banner_category=mysqli_fetch_array($aym_sql_list_banner_category)) { $rows_for_page++; ?>
		
		<tr data-id="<?=$row_list_banner_category['ban_cat_id']?>">
			<td><?php if ($row_list_banner_category['aym_num_ban_cat'] > 0) { ?><figure class="aym_list_icon"><img src="/admin/aym_image/aym_icon/aym_ico_lock.png" alt="Bloqueado"></figure><?php  } else {  ?><figure class="aym_list_icon"><a href="#" class="aym_ico_delete" id="<?= $row_list_banner_category['ban_cat_id']?>"><img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar"></a></figure><?php } ?></td>
			<td  class="aym_align_center"><?=$row_list_banner_category['ban_cat_id']?></td>
			<td class="aym_write" data-name="ban_cat_nam"><?=$row_list_banner_category['ban_cat_nam']?></td>
			<td class="aym_write" data-name="ban_cat_des"><?=$row_list_banner_category['ban_cat_des']?></td>
			<td class="aym_write aym_align_center" data-name="ban_cat_hei" data-value="<?=$row_list_banner_category['ban_cat_hei']?>"><?=$row_list_banner_category['ban_cat_hei']?></td>
			<td class="aym_write aym_align_center" data-name="ban_cat_wid" data-value="<?=$row_list_banner_category['ban_cat_wid']?>"><?=$row_list_banner_category['ban_cat_wid']?></td>
		</tr>
    <?php } mysqli_free_result($aym_sql_list_banner_category); ?> 
  </table>
</div>
<p>&nbsp;</p>
<?php 
	//INCLUSION DE LA PAGINACION
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>
<form action="/aymcms/actionbanner" class="aym_form_write" method="POST">
	<input id="ban_cat_nam" name="ban_cat_nam" minlength="2" maxlength="150">
	<input id="ban_cat_des" name="ban_cat_des" minlength="3" maxlength="255">
	<input id="ban_cat_hei" name="ban_cat_hei" minlength="1" maxlength="4">
	<input id="ban_cat_wid" name="ban_cat_wid" minlength="1"  maxlength="4">
	<input type="hidden" id="data-id" name="ban_cat_id">
	<input id="action" name="action" type="hidden" value="UCT">
</form>