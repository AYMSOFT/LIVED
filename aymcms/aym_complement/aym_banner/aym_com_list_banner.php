<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR BANNER
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start(); 

	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['option'])) { $_GET['option'] = "admbanner"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER
	if (!isset($_GET['ban_cat_id'])) { $_GET['ban_cat_id'] = 1; }
	if (!isset($_GET['lan_id'])) { $_GET['lan_id'] = 1;} # 1 --> IDIOMA ESPAÑOL 
		
	#VARIABLES
	$aym_show_page = ($_GET['aym_page']*$_GET['aym_page_size']);

		
	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LOS BANNERS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_list_banner.php';
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE CUANTA LOS BANNERS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_count_banner.php';		
	
?>
<div id="aym_wrap_table">
	<table width="100%" border="0" cellspacing="0" cellpadding="1" class="aym_table" id="aym_delete">
		<tr>
			<th>Del </th>
			<th>ID</th>
			<th>Fecha inicial</th>
			<th>Fecha final</th>
			<th>Descripción</th>
			<th>Posición</th>
			<th>Estado</th>
			<th>Ver</th>
			<th>Editar</th>
		</tr>

    <?php while ($row_list_banner=mysqli_fetch_array($aym_sql_list_banner)) { $rows_for_page++; ?>
		
		<tr id="<?=$row_list_banner['ban_id']?>" class="rows-move" data-id="<?=$row_list_banner['ban_id']?>">
			<td><figure class="aym_list_icon"><?=$row_list_banner['ban_sta'] == '1' ? '<img src="/admin/aym_image/aym_icon/aym_ico_lock.png" alt="Bloqueado">':'<a class="aym_ico_delete" id="'.$row_list_banner['ban_id'].'"><img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar"></a>';?></figure></td>
			<td class="aym_align_center"><?=$row_list_banner['ban_id']?></td>
			<td class="aym_write aym_input_date aym_ak aym_align_center" data-name="ban_dat_tim_ini"><?=$row_list_banner['ban_dat_ini']?></td>
			<td class="aym_write aym_input_date aym_align_center" data-name="ban_dat_tim_fin"><?=$row_list_banner['ban_dat_fin']?></td>
			<td class="aym_write" data-name="ban_des"><?=$row_list_banner['ban_des']?></td>
			<td class="aym_align_center" data-name="ban_pos"><img class="field-drag aym_ico_drag" src="/admin/aym_image/aym_icon/aym_funcion_no_hover.png"></td>			
			<td class="aym_align_center"><input class="aym_checkbox_status" data-id="<?= $row_list_banner['ban_id'] ?>" id="ban_sta_<?= $row_list_banner['ban_id'] ?>" type="checkbox" value="1" <?php if ($row_list_banner['ban_sta'] == '1') echo 'checked'; ?>><label for="ban_sta_<?= $row_list_banner['ban_id'] ?>"></label></td>
			<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$row_list_banner['ban_id'].'.jpg')) {?>
				<td><figure class="aym_list_icon"><a id="aym_load_image" id="<?= $row_list_banner['ban_id']?>" url="/aym_image/aym_banner/<?=$row_list_banner['ban_id'].'.jpg?'.time();?>"><img class="aym_img_load_image" src="/admin/aym_image/aym_icon/aym_ico_pic.png" alt="Ver"></a></figure></td>      
			<?php } else if (file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$row_list_banner['ban_id'].'.png')) {?>
				<td><figure class="aym_list_icon"><a id="aym_load_image" id="<?= $row_list_banner['ban_id']?>" url="/aym_image/aym_banner/<?=$row_list_banner['ban_id'].'.png?'.time();?>"><img class="aym_img_load_image" src="/admin/aym_image/aym_icon/aym_ico_pic.png" alt="Ver"></a></figure></td>      
			<?php }else{?>
				<td><figure class="aym_list_icon" style="cursor:auto"><img src="/admin/aym_image/aym_icon/aym_ico_pic.png" style="filter: grayscale(100%);" alt="Ver"></figure></td>      
			<?php } ?>

			<td><figure class="aym_list_icon"><a href="/aymcms/<?=$_GET['option'];?>/aym_edit_banner/<?=$row_list_banner['ban_id'].'/'.$_GET['ban_cat_id'].'/'.$_GET['lan_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page']?>"><img src="/admin/aym_image/aym_icon/aym_ico_view.png" alt="Banner" name="edit_<?= $row_list_banner['ban_id'] ?>" border="0" id="edit_<?= $row_list_banner['ban_id'] ?>"  onMouseOver="document.edit_<?= $row_list_banner['ban_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_view_on.png';" onMouseOut="document.edit_<?= $row_list_banner['ban_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_view.png';"></a></figure></td>
		</tr>
    <?php } mysqli_free_result($aym_sql_list_banner); ?> 
  </table>
</div>
<p>&nbsp;</p>
<?php 
	//INCLUSION DE LA PAGINACION
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>
<form action="/aymcms/actionbanner" class="aym_form_write" method="POST">
	<input type="text" class="aym_input_date aym_date_time" id="ban_dat_tim_ini" name="ban_dat_tim_ini">
	<input type="text" class="aym_input_date aym_date_time" id="ban_dat_tim_fin" name="ban_dat_tim_fin">
	<input id="ban_des" name="ban_des"  minlength="3" maxlength="255">
	<input type="hidden" id="data-id" name="ban_id">
	<input id="action" name="action" type="hidden" value="UT">
</form>
<script>	
	$('.aym_date_time').datetimepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss',
		onClose: sendData
	});
</script>
<script src="/aymcms/aym_js/aym_banner/aym_banner_drag.js"></script>