<?php # **************************** AYMCORE V: 14.0 ********************
# COMPLEMENTO PARA LISTAR LOS USUARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	session_start();


	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['option'])) { $_GET['option'] = "admuser"; } # ADMINISTRADOR DE USUARIOS
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; }
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 1; } # CAMPO POR DEFECTO PARA FILTRAR
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 0; } # ORDEN: 0=DESCENDENTE; 1=ASCENDETE
	if (!isset($_GET['use_typ_id'])) { $_GET['use_typ_id'] = 0; } # todos
	if (!isset($_GET['sta_id'])) { $_GET['sta_id'] = 2; } # todos
	
	#VARIABLES
	$aym_show_page = ($_GET['aym_page']*$_GET['aym_page_size']);
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LOS USUARIOS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_list_user.php';
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE CUANTA LOS USUARIOS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_count_user.php';	

	# INCLUSIÓN --> COMPONENTE LISTA LAS DEPENDENCIAS / OCICINAS 
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_office.php';
	
?>
<div id="aym_wrap_table">
<table border="0" cellspacing="0" cellpadding="1" class="aym_table" id="aym_delete">
    <tr>
      <th>Eliminar</th>
	  <th id="1"><span class="filter_field <?= $_GET['aym_order'] == '1'?'active':''; $_GET['aym_order_type']==0?' asc':'';?> ">Id</span></th>
	  <th id="2"><span class="filter_field <?= $_GET['aym_order'] == '2'?'active':''; $_GET['aym_order_type']==0?' asc':'';?> ">Fecha</span></th>
      <th id="3"><span class="filter_field <?= $_GET['aym_order'] == '3'?'active':''; $_GET['aym_order_type']==0?' asc':'';?> ">Nombre</span></th>
      <th id="4"><span class="filter_field <?= $_GET['aym_order'] == '4'?'active':''; $_GET['aym_order_type']==0?' asc':'';?> ">Cuenta</span></th>
      <th id="5"><span class="filter_field <?= $_GET['aym_order'] == '5'?'active':''; $_GET['aym_order_type']==0?' asc':'';?> ">Oficina</span></th>
      <th id="6"><span class="filter_field <?= $_GET['aym_order'] == '6'?'active':''; $_GET['aym_order_type']==0?' asc':'';?> ">Entradas</span></th>
      <th id="7"><span class="filter_field <?= $_GET['aym_order'] == '7'?'active':''; $_GET['aym_order_type']==0?' asc':'';?> ">Estado</span></th>
      <th>Editar</th>
      <th>Perfil</th>
	  <th>Dashboard</th>
    </tr>
    <?php while ($row_list_user=mysqli_fetch_array($aym_sql_list_user)) { $rows_for_page++;  ?>
		<tr data-id="<?=$row_list_user['use_id']?>">
			<td><?php if ($row_list_user['use_num_log']>0){ ?><figure class="aym_list_icon"><img src="/admin/aym_image/aym_icon/aym_ico_lock.png" alt="Bloqueado"></figure><?php } else { ?><figure class="aym_list_icon"><a class="aym_ico_delete" id="<?= $row_list_user['use_id']?>"><img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar"></a></figure><?php } ?></td>
			<td><?= $row_list_user['use_id'] ?></td>
			<td><?= $row_list_user['use_dat'] ?></td>
			<td class="aym_write" data-name="use_nam"><?= $row_list_user['use_nam'] ?></td>
			<td><?= $row_list_user['use_log'] ?></td>
			<td class="aym_write" data-name="off_id" data-value="<?=$row_list_user['off_id']?>"><?= $row_list_user['off_nam'] ?></td>
			<td><?= $row_list_user['use_num_log'] ?></td>
			<td class="aym_align_center"><input class="aym_checkbox_status" data-id="<?= $row_list_user['use_id'] ?>" id="ban_sta_<?= $row_list_user['use_id'] ?>" type="checkbox" value="1" <?php if ($row_list_user['sta_id'] == '1') echo 'checked'; ?>></td> 
			<td><figure class="aym_list_icon"><a href="/admin/<?= $_GET['option']?>/aym_edit_user/<?=$row_list_user['use_id'].'/'.$_GET['sta_id'].'/'.$_GET['use_typ_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>"><img src="/admin/aym_image/aym_icon/aym_ico_view.png" alt="Editar" name="edit_<? echo $row_list_user['use_id'] ?>" border="0" id="edit_<? echo $row_list_user['use_id'] ?>"  onMouseOver="document.edit_<? echo $row_list_user['use_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_view_on.png';" onMouseOut="document.edit_<? echo $row_list_user['use_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_view.png';"></a></figure></td>      
			<td><figure class="aym_list_icon"><a href="/admin/admuserprofile/aym_add_profile_user/<?=$row_list_user['use_id'].'/'.$_GET['sta_id'].'/'.$_GET['use_typ_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>"><img src="/admin/aym_image/aym_icon/aym_ico_add_profile.png" alt="Perfil" name="profile_<? echo $row_list_user['use_id'] ?>" border="0" id="profile_<? echo $row_list_user['use_id'] ?>"  onMouseOver="document.profile_<? echo $row_list_user['use_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_add_profile_on.png';" onMouseOut="document.profile_<? echo $row_list_user['use_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_add_profile.png';"></a></figure></td>
			<td><figure class="aym_list_icon"><a href="/admin/admuserdashboard/aym_add_user_dashboard/<?= $row_list_user['use_id'] ?>"><img src="/admin/aym_image/aym_icon/aym_ico_dashboard.png" alt="Perfil" name="dashboard_<? echo $row_list_user['use_id'] ?>" border="0" id="dashboard_<? echo $row_list_user['use_id'] ?>"  onMouseOver="document.dashboard_<? echo $row_list_user['use_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_dashboard_on.png';" onMouseOut="document.dashboard_<? echo $row_list_user['use_id'] ?>.src='/admin/aym_image/aym_icon/aym_ico_dashboard.png';"></a></figure></td>
		</tr>
    <?php } mysqli_free_result($aym_sql_list_user); ?>
</table>
</div>
<p>&nbsp;</p>
<input name="aym_return" type="hidden" id="aym_return" value="0">
<?php # INCLUSION DE LA PAGINACION?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';?>
<form action="/admin/actionuser" class="aym_form_write" method="POST">
	<textarea id="use_nam" name="use_nam" cols="30" rows="10"></textarea>
	<select name="off_id" id="off_id"><?php while ($row_list_office = mysqli_fetch_array($aym_sql_list_office)){ echo'<option value="'.$row_list_office['off_id'].'">'.$row_list_office['off_nam'].'</option>';} mysqli_free_result($aym_sql_list_office); ?></select> 
	<input type="hidden" id="data-id" name="use_id">
	<input id="action" name="action" type="hidden" value="UT">
</form>
