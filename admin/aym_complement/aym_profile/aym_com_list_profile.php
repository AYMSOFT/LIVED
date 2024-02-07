<?php # **************************** AYMCORE V: 14.0 ********************
# COMPLEMENTO PARA LISTAR LOS PERFILES
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	session_start(); 
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['option'])) { $_GET['option'] = "admprofile"; } 
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 1; } # CAMPO POR DEFECTO PARA FILTRAR
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 0; } # ORDEN: 0=DESCENDENTE; 1=ASCENDETE
	
	#VARIABLES
	$aym_show_page = ($_GET['aym_page']*$_GET['aym_page_size']);
	
	# INCLUSI脫N --> PROCEDIMIENTO QUE LISTA LOS PERFILES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_list_profile.php'; 
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE CUANTA LOS PERFILES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_count_profile.php';	
	
?>
<meta charset="utf-8">
<div class="aym_overflow">
	<table width="100%" border="0" cellspacing="0" cellpadding="1" class="aym_table" id="aym_delete">
	<tr>
		<th>Del</th>
		<th id="1"><span class="filter_field <?php if($_GET['aym_order'] == '1'){ echo 'active'; if($_GET['aym_order_type']==0){ echo ' asc';}}?>">Id</span></th>
		<th id="2"><span class="filter_field <?php if($_GET['aym_order'] == '2'){ echo 'active'; if($_GET['aym_order_type']==0){ echo ' asc';}}?>">Nombre</span></th>
		<th>Editar</th>
		<th>Función</th> 
	</tr>
    <?php while ($row_list_profile=mysqli_fetch_array($aym_sql_list_profile)) { $rows_for_page++; ?>
	<tr data-id="<?=$row_list_profile['pro_id']?>">
		<td><?php if ($row_list_profile['num_pro_fun']>0){ ?>
			<figure class="aym_list_icon">
			<img src="/admin/aym_image/aym_icon/aym_ico_lock.png" alt="Bloqueado">
			</figure>
		<?php } else { ?>
			<figure class="aym_list_icon">
			<a href="#" class="aym_ico_delete" id="<?=$row_list_profile['pro_id']?>">
				<img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar">
			</a>
			</figure>
		<?php } ?>
		<td><?= $row_list_profile['pro_id'] ?></td>
		<td class="aym_write" data-name="pro_nam"><?=$row_list_profile['pro_nam']?></td>
		<td>
			<figure class="aym_list_icon">
				<a href="/admin/<?= $_GET['option']?>/aym_edit_profile/<?= $row_list_profile['pro_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>">
					<img src="/admin/aym_image/aym_icon/aym_ico_edit.png" alt="Editar" name="edit_profile_<?= $row_list_profile['pro_id'] ?>" onMouseOver="document.edit_profile_<?=$row_list_profile['pro_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_view_on.png';" onMouseOut="document.edit_profile_<?=$row_list_profile['pro_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_edit.png';">
				</a>
			</figure>
		</td>     
		<td>
			<figure class="aym_list_icon">
				<a href="/admin/admprofilefunction/aym_add_function_profile/<?= $row_list_profile['pro_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>">
					<img src="/admin/aym_image/aym_icon/aym_funcion_no_hover.png" alt="Función" name="profile_<?= $row_list_profile['pro_id'] ?>" border="0" id="profile_<?= $row_list_profile['pro_id'] ?>"  onMouseOver="document.profile_<?= $row_list_profile['pro_id'] ?>.src='/admin/aym_image/aym_icon/aym_funcion_hover.png';" onMouseOut="document.profile_<?= $row_list_profile['pro_id'] ?>.src='/admin/aym_image/aym_icon/aym_funcion_no_hover.png';">
				</a>
			</figure>
		</td>      
	</tr>
    <?php } mysqli_free_result($aym_sql_list_profile); ?> 
  </table>
</div>
<p>&nbsp;</p>
<?php
 	//INCLUSION DE LA PAGINACION
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>
<form action="/admin/actionprofile" class="aym_form_write" method="POST">
	<textarea id="pro_nam" name="pro_nam" cols="30" rows="10"></textarea>
	<input type="hidden" id="data-id" name="pro_id">
	<input id="action" name="action" type="hidden" value="UT">
</form>
<input name="aym_return" type="hidden" id="aym_return" value="0">
