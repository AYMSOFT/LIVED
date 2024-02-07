<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LAS CABINAS
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
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_list_gallery_image.php';
	
	# INCLUSIÓN --> PROCEDIMIENTO CONTAR DE GALERIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_count_gallery_image.php';		
	
?>
<div id="aym_wrap_table">
	<table width="100%" border="0" cellspacing="0" cellpadding="1" id="aym_delete" class="aym_table">
	<tr>
		<th>Del</th>
		<th id="1"><span class="filter_field <?=$_GET['aym_order'] == '1'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Id</span></th>
		<th id="2"><span class="filter_field <?=$_GET['aym_order'] == '2'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Fecha</span></th>
		<th id="3"><span class="filter_field <?=$_GET['aym_order'] == '3'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Nombre</span></th>
		<th id="4"><span class="filter_field <?=$_GET['aym_order'] == '4'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Descripción</span></th>
		<th>Portada</th>
		<th>Imagen</th>
		<th>Editar</th>
	</tr>
    <?php while ($row_list_gallery_image=mysqli_fetch_array($aym_sql_list_gallery_image)) { $rows_for_page++; ?>
		<tr data-id="<?=$row_list_gallery_image['gal_id']?>">
			<td><figure class="aym_list_icon"><a href="#" class="aym_ico_delete" id="<?= $row_list_gallery_image['gal_id']?>" ><img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar"></a></figure></td>
			<td><?=$row_list_gallery_image['gal_id']?></td>
			<td class="aym_write aym_input_date"><?=$row_list_gallery_image['gal_dat']?></td>
			<td class="aym_write" data-name="gal_nam"><?=$row_list_gallery_image['gal_nam']?></td>
			<td class="aym_write" data-name="gal_des"><?=$row_list_gallery_image['gal_des']?></td>
			<td class="aym_align_center"><input class="aym_checkbox_status" data-id="<?= $row_list_gallery_image['gal_id'] ?>" id="gal_fea_<?= $row_list_gallery_image['gal_id'] ?>" type="checkbox" value="1" <?php if ($row_list_gallery_image['gal_fea'] == '1') echo 'checked'; ?>><label for="gal_fea_<?= $row_list_gallery_image['gal_id'] ?>"></label></td>
			<td><figure class="aym_list_icon"><a class="aym_ico_img" id="<?= $row_list_gallery_image['gal_id']?>" url="/aym_image/aym_gallery/<?= $row_list_gallery_image['gal_id'] ?>.jpg?<?= time()?>"><img src="/admin/aym_image/aym_icon/aym_ico_search.png" border="0" align="Ver Imágen" ></a></figure></td>      
			<td><figure class="aym_list_icon"><a href="/aymcms/<?=$_GET['option']?>/aym_edit_gallery_image/<?=$row_list_gallery_image['gal_id'].'/'.$_GET['lan_id'].'/'.$_GET['gal_cat_id'].'/'.$_GET['gal_sub_cat_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page']?>"><img src="/admin/aym_image/aym_icon/aym_ico_view.png" alt="Editar" ></a></figure></td>
		</tr>
    <?php } mysqli_free_result($aym_sql_list_gallery_image); ?> 
  </table>
</div>
<p>&nbsp;</p>
<?php 
	//INCLUSION DE LA PAGINACION
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>
<form action="/aymcms/actiongallery" class="aym_form_write" method="POST">
	<input id="gal_nam" name="gal_nam"  minlength="2" maxlength="150">
	<input id="gal_des" name="gal_des"  minlength="3" maxlength="255">
	<input type="hidden" id="data-id" name="gal_id">
	<input id="action" name="action" type="hidden" value="UTI">
</form>