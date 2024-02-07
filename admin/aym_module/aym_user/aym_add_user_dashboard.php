<?php # ****************************  AYMCORE V: 14.0  ********************
# FORMULARIO PARA AGREGAR DASHBOARD A LOS USUARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_get_user.php';

	# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_list_user_dashboard.php'; 
?>
<div class="aym_wrap_form">
	<h3>Asignación de Dashboard a <?= $row_get_user['use_nam']; ?></h3> 
    <br>
	<form action="/admin/actionuser" method="post"  name="frm_add_user_dashboard" id="frm_add_user_dashboard">
		<fieldset>
			<table width="100%" border="0" cellspacing="0" cellpadding="1" class="aym_table">
				<tr>
					<th>Categoría</th>
					<th>Dashboard</th>
					<th>Asignar/Quitar</th>
				</tr>
				<?php while ($row_list_user_dashboard=mysqli_fetch_array($aym_sql_list_user_dashboard)) { ?>
				<tr>
				  <td class="aym_td_text"><?= $row_list_user_dashboard['das_cat_nam'] ?></td>
				  <td class="aym_td_text"><?= $row_list_user_dashboard['das_nam'] ?></td>
				  <td class="aym_align_center"><input name="das_on[<?= $row_list_user_dashboard['das_id']; ?>]" type="checkbox" id="<?= $row_list_user_dashboard['das_id']; ?>" value="<?= $row_list_user_dashboard['das_id']; ?>" <?=$row_list_user_dashboard['das_chk'] > 0 ? 'checked="checked"' : '';?>></td>
				</tr>
				<?php } mysqli_free_result($aym_sql_list_user_dashboard); ?>
			</table>
            <br>
            <div class="aym_frm_submit">
				<input type="submit" value="Asignar / Quitar"> 
				<input name="use_id" type="hidden" id="use_id" value="<?= $row_get_user['use_id'] ?>" >
				<input name="use_log" type="hidden" id="use_log" value="<?= $row_get_user['use_log'] ?>" >
				<input name="action" type="hidden" id="action" value="AD" >
			</div>
			<hr>
			<span class="aym_text_required">Selecione uno o varios dashboard que necesite <strong>Asignar/Quitar</strong> al usuario</span>
		</fieldset>
	</form>
</div>