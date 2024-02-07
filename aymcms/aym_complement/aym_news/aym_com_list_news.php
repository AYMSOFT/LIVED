<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LAS NOTICIAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start(); 
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['option'])) { $_GET['option'] = "admnews"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER
	if (!isset($_GET['new_cat_id'])) { $_GET['new_cat_id'] = 1; }
	if (!isset($_GET['lan_id'])) { $_GET['lan_id'] = 1;} # 1 --> IDIOMA ESPAÑOL 

	#VARIABLES
	$aym_show_page = ($_GET['aym_page']*$_GET['aym_page_size']);

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LAS NOTICIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_list_news.php'; 
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE CUANTA LAS NOTICIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_count_news.php';
	
?>
<meta charset="utf-8">
<div class="aym_overflow">
	<table width="100%" border="0" cellspacing="0" cellpadding="1" id="aym_delete" class="aym_table">
	<tr>
		<th>Del</th>
		<th id="1"><span class="filter_field <?php if($_GET['aym_order'] == '1'){ echo 'active'; if($_GET['aym_order_type']==0){ echo ' asc';}}?>">ID</span></th>
		<th id="2"><span class="filter_field <?php if($_GET['aym_order'] == '2'){ echo 'active'; if($_GET['aym_order_type']==0){ echo ' asc';}}?>">Fecha</span></th>
		<th id="3"><span class="filter_field <?php if($_GET['aym_order'] == '3'){ echo 'active'; if($_GET['aym_order_type']==0){ echo ' asc';}}?>">Titulo</span></th>
		<th id="4"><span class="filter_field <?php if($_GET['aym_order'] == '4'){ echo 'active'; if($_GET['aym_order_type']==0){ echo ' asc';}}?>">Lead</span></th>
		<th id="5"><span class="filter_field <?php if($_GET['aym_order'] == '5'){ echo 'active'; if($_GET['aym_order_type']==0){ echo ' asc';}}?>">Estado</span></th>
		<th id="6"><span class="filter_field <?php if($_GET['aym_order'] == '6'){ echo 'active'; if($_GET['aym_order_type']==0){ echo ' asc';}}?>">Cover</span></th>
		<th>Editar</th>
	</tr>
    <?php while ($row_list_news=mysqli_fetch_array($aym_sql_list_news)) { $rows_for_page++; ?>
		<tr data-id="<?=$row_list_news['new_id']?>">
			<td><?php if ($row_list_news['new_sta'] > 0) { ?><figure class="aym_list_icon"><img src="/admin/aym_image/aym_icon/aym_ico_lock.png" alt="Bloqueado"></figure><?php  } else {  ?><figure class="aym_list_icon"><a class="aym_ico_delete" id="<?= $row_list_news['new_id']?>"><img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar"></a></figure><?php } ?></td>
			<td class="aym_align_center"><?=$row_list_news['new_id']?></td>
			<td class="aym_align_center"><?=$row_list_news['new_dat']?></td>
			<td class="aym_write" data-name="new_tit"><?=$row_list_news['new_tit']?></td>   
			<td class="aym_write" data-name="new_lea"><?=$row_list_news['new_lea']?></td>   
			<td class="aym_align_center"><input class="aym_checkbox_status" data-id="<?= $row_list_news['new_id'] ?>" id="new_sta_<?= $row_list_news['new_id'] ?>" type="checkbox" value="1" <?= $row_list_news['new_sta'] == '1' ? 'checked' : '' ?>><label for="new_sta_<?= $row_list_news['new_id'] ?>"></label></td>
			<td class="aym_align_center"><input class="aym_checkbox_cover" data-id="<?= $row_list_news['new_id'] ?>" id="new_cov_<?= $row_list_news['new_id'] ?>" type="checkbox" value="1" <?= $row_list_news['new_cov'] == '1' ? 'checked' : '' ?>><label for="new_cov_<?= $row_list_news['new_id'] ?>"></label></td>
			<td><figure class="aym_list_icon"><a href="/aymcms/<?=$_GET['option']?>/aym_edit_news/<?=$row_list_news['new_id'].'/'.$_GET['new_cat_id'].'/'.$_GET['lan_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page']?>"><img src="/admin/aym_image/aym_icon/aym_ico_view.png" alt="Perfil" name="edit_<?= $row_list_news['new_id'] ?>" border="0" id="edit_<?= $row_list_news['new_id'] ?>"  nMouseOver="document.edit_<?=$row_list_news['new_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_view_on.png';" onMouseOut="document.edit_<?=$row_list_news['new_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_view.png	';"></a></figure></td>     
		</tr>
    <?php } mysqli_free_result($aym_sql_list_news); ?> 
  </table>
</div>
<p>&nbsp;</p>
<?php 
	//INCLUSION DE LA PAGINACION
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>
<form action="/aymcms/actionnews" class="aym_form_write" method="POST">
	<input id="new_tit" name="new_tit"  minlength="3" maxlength="100">
	<input id="new_lea" name="new_lea"  minlength="3" maxlength="300">
	<input type="hidden" id="data-id" name="new_id">
	<input id="action" name="action" type="hidden" value="UT">
</form>
