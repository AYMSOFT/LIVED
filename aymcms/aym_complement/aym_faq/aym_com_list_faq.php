<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LAS FAQ
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

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

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LA FAQ
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_list_faq.php';
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE  CUENTA LA FAQ
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_count_faq.php';	
	
?>
<div id="aym_wrap_table">
	<table width="100%" border="0" cellspacing="0" cellpadding="1" class="aym_table" id="aym_delete">
	<tr>
		<th>Del</th>
		<th id="1"><span class="filter_field <?=$_GET['aym_order'] == '1'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">ID</span></th>
		<th id="3"><span class="filter_field <?=$_GET['aym_order'] == '3'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Fecha</span></th>
		<th id="2"><span class="filter_field <?=$_GET['aym_order'] == '2'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Pregunta</span></th>
		<th>Editar</th>
	</tr>
    <?php while ($row_list_faq=mysqli_fetch_array($aym_sql_list_faq)) { $rows_for_page++; ?>
		<tr data-id="<?=$row_list_faq['faq_id']?>">
			<td><figure class="aym_list_icon"><a class="aym_ico_delete" id="<?= $row_list_faq['faq_id']?>"><img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar"></a></figure></td>
			<td class="aym_align_center"><?=$row_list_faq['faq_id']?></td>
			<td class="aym_align_center"><?=$row_list_faq['faq_dat']?></td>
			<td class="aym_write aym_align_left" data-name="faq_que"><?=$row_list_faq['faq_que']?></td>
			<td><figure class="aym_list_icon"><a href="/aymcms/<?=$_GET['option'];?>/aym_edit_faq/<?=$row_list_faq['faq_id'].'/'.$_GET['faq_cat_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>"><img src="/admin/aym_image/aym_icon/aym_ico_view.png" alt="faq" name="edit_<?= $row_list_faq['faq_id'] ?>" border="0" id="edit_<?= $row_list_faq['faq_id'] ?>"  onMouseOver="document.edit_<?= $row_list_faq['faq_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_view_on.png';" onMouseOut="document.edit_<?= $row_list_faq['faq_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_view.png';"></a></figure></td>
		</tr>
    <?php } mysqli_free_result($aym_sql_list_faq); ?> 
  </table>
</div>
<p>&nbsp;</p>
<?php 
	//INCLUSION DE LA PAGINACION
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>
<form action="/aymcms/actionfaq" class="aym_form_write" method="POST">
	<input id="faq_que" name="faq_que" minlength="2" maxlength="255">
	<input type="hidden" id="data-id" name="faq_id">
	<input id="action" name="action" type="hidden" value="UT">
</form>