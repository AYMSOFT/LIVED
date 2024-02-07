<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LAS PAGINAS DE CONTENIDOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start(); 
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['option'])) { $_GET['option'] = "admcms"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER
	if (!isset($_GET['pag_cat_id'])) { $_GET['pag_cat_id'] = 1; }
	if (!isset($_GET['lan_id'])) { $_GET['lan_id'] = 1;} # 1 --> IDIOMA ESPAÑOL 
	#VARIABLES
	$aym_show_page = ($_GET['aym_page']*$_GET['aym_page_size']);

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LOS PERFILES
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_page.php'; 
	

	# INCLUSIÓN --> PROCEDIMIENTO QUE CUANTA LOS PERFILES
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_count_page.php';	
	
?>
<meta charset="utf-8">
<div class="aym_overflow">
	<table width="100%" border="0" cellspacing="0" cellpadding="1" class="aym_table" id="aym_delete">
	<tr>
		<th>Del</th>
		<th>ID</th>
		<th>Fecha</th>
		<th>Titulo</th>
		<th>Descripción</th>
		<th>Orden</th>
		<th>Publicado</th>
		<th>Bloqueado</th>
		<th>Editar</th> 
	</tr>
    <?php while ($row_list_page=mysqli_fetch_array($aym_sql_list_page)) { $rows_for_page++; ?>
		<tr id="<?= $row_list_page['pag_id'] ?>" class="rows-move" data-id="<?=$row_list_page['pag_id']?>">
			<td><?php if ($row_list_page['pag_hol'] > 0) { ?><figure class="aym_list_icon"><img src="/admin/aym_image/aym_icon/aym_ico_lock.png" alt="Bloqueado"></figure><?php  } else {  ?><figure class="aym_list_icon"><a href="#" class="aym_ico_delete" id="<?= $row_list_page['pag_id']?>" url="/aymcms/actioncms/<?= $row_list_page['pag_id']?>"><img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar"></a></figure><?php } ?></td>
			<td class="aym_align_center"><?=$row_list_page['pag_id']?></td>
			<td class="aym_align_center"><?=$row_list_page['pag_dat']?></td>
			<td class="aym_write" data-name="pag_tit"><?=$row_list_page['pag_tit']?></td>
			<td class="aym_write" data-name="pag_des"><?=$row_list_page['pag_des']?></td>
			<td class="aym_align_center" data-name="pag_pos"><img class="field-drag aym_ico_drag" src="/admin/aym_image/aym_icon/aym_funcion_no_hover.png"></td>			
			<td><figure class="aym_list_icon"><input class="aym_checkbox_publish" data-id="<?= $row_list_page['pag_id'] ?>" id="pag_pub_<?= $row_list_page['pag_id'] ?>" type="checkbox" value="1" <?php if ($row_list_page['pag_pub'] == '1') echo 'checked'; ?>></figure></td>
			<td><figure class="aym_list_icon"><input class="aym_checkbox_block" data-id="<?= $row_list_page['pag_id'] ?>" id="pag_hol_<?= $row_list_page['pag_id'] ?>" type="checkbox" value="1" <?php if ($row_list_page['pag_hol'] == '1') echo 'checked'; ?>></figure></td>
			<td><figure class="aym_list_icon"><a href="/aymcms/<?= $_GET['option']?>/aym_edit_cms/<?= $row_list_page['pag_id'].'/'.$_GET['pag_cat_id'].'/'.$_GET['lan_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page']?>"><img src="/admin/aym_image/aym_icon/aym_ico_view.png" alt="Editar" title="Editar" name="edit_<?=$row_list_page['pag_id'] ?>" border="0" id="edit_<?=$row_list_page['pag_id'] ?>"  onMouseOver="document.edit_<?=$row_list_page['pag_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_view_on.png';" onMouseOut="document.edit_<?=$row_list_page['pag_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_view.png	';"></a></figure></td>     
		</tr>
    <?php } mysqli_free_result($aym_sql_list_page); ?> 
  </table>
</div>
<p>&nbsp;</p>
<?php 
	//INCLUSION DE LA PAGINACION
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>
<form action="/aymcms/actioncms" class="aym_form_write" method="POST">
	<input id="pag_tit" name="pag_tit" minlength="3" maxlength="100">
	<input id="pag_des" name="pag_des" minlength="3" maxlength="255">
	<input type="hidden" id="data-id" name="pag_id">
	<input id="action" name="action" type="hidden" value="UT">
</form>
<script src="/aymcms/aym_js/aym_cms/aym_cms_drag.js"></script>


