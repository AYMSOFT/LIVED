<?php # **************************** AYMCORE V: 14.0 ********************
# FORMULARIO PARA AGREGAR PERFILES A LOS USUARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022


	# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_get_user.php';

	# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_list_user_profile.php'; 
?>
<div class="aym_wrap_form">
	<h3><?= $row_get_user['use_nam']; ?></h3> 
	<div><strong><?= $row_get_user['use_log']; ?></strong></div>
	<form action="/admin/actionuser" class="aym_frm_100" method="post"  name="frm_per_on_off" id="frm_per_on_off">
		<fieldset>
			<table width="100%" border="0" cellspacing="0" cellpadding="1" class="aym_table">
				<tr>
				  <th>Perfil</th>
				  <th>Asignar/Quitar</th>
				</tr>
				<?php while ($row_list_user_profile=mysqli_fetch_array($aym_sql_list_user_profile)) { ?>
				<tr>
				  <td class="aym_td_text"><?= $row_list_user_profile['pro_nam'] ?></td>
				  <td class="aym_align_center"><input name="aym_per_on_off[<?= $row_list_user_profile['pro_id']; ?>]" type="checkbox" id="<?= $row_list_user_profile['pro_id']; ?>" value="<?= $row_list_user_profile['pro_id']; ?>" <?php if ($row_list_user_profile['pro_chk'] > 0) { echo 'checked="checked"';} ?>></td>
				</tr>
				<?php } mysqli_free_result($aym_sql_list_user_profile); ?>
			</table>
			<div class="aym_frm_submit">
				<button type="button">Asignar / Quitar perfiles al usuario</button>
				<input name="use_id" type="hidden" id="use_id" value="<?= $row_get_user['use_id'] ?>" >
				<input name="use_log" type="hidden" id="use_log" value="<?= $row_get_user['use_log'] ?>" >
				<input name="action" type="hidden" id="action" value="A" >
			</div>
			<hr>
			<span class="aym_text_required">Selecione uno o varios perfiles que necesite <strong>Asignar/Quitar</strong> al usuario</span>
		</fieldset>
	</form>
</div>