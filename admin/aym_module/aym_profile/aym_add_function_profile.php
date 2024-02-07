<?php 
	# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_get_profile.php';

	# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_list_all_function.php'; 

	# INCLUSION --- FUNCION RECURSIVA TRAE FUNCION HIJA DE FUNCIONA Y CHECK USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_profile/aym_fun_list_function_profile.php';
?>
<div class="aym_wrap_form">
	<h3>Funciones de (<strong><?= $row_get_profile['pro_nam']; ?></strong>)</h3>
	<form action="/admin/actionprofilefunction" class="aym_frm_100" method="post" name="frm_add_funcion_profile" id="frm_add_funcion_profile">
	 	<fieldset>
			<table width="100%" border="0" cellspacing="0" cellpadding="1" class="aym_table">
			<tr>
			  <th>Perfil</th>
			  <th>Asignar/Quitar</th>
			</tr>
			<?php while ($row_list_function=mysqli_fetch_array($aym_sql_list_function)) { ?>
				<tr>
					<td class="aym_td_text"><?= $row_list_function['fun_nam'] ?></td>
					<td class="aym_align_center">
						<?php
							# VARIABLES
							$aym_num_rows = 0;
							$_GET['fun_id'] = $row_list_function['fun_id'];
							# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
							include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_get_profile_function.php'; 
						?>          
							<input name="aym_fun_on_off[<?= $row_list_function['fun_id']; ?>]" id="aym_fun_on_off_<?= $row_list_function['fun_id']; ?>" type="checkbox" value="<?= $row_list_function['fun_id']; ?>" <?php if ($aym_num_rows > 0) { echo 'checked="checked"';} ?>>
					</td>
				</tr>
				<?php if($row_list_function['num_sub_fun']>0){aym_fun_list_function_profile($_GET['pro_id'], $row_list_function['fun_id'], '------');} #ACTIVARLO MAS ADELANTE Y VERIFICAR FUNCIONE ?>
			<?php } mysqli_free_result($aym_sql_list_function); ?>
			</table>
			<div class="aym_frm_submit">
				<button type="button">Asignar / Quitar Pefiles al Usuario</button> 
				<input name="pro_id" type="hidden" id="pro_id" value="<?= $row_get_profile['pro_id'] ?>">
				<input name="pro_nam" type="hidden" id="pro_nam" value="<?= $row_get_profile['pro_nam'] ?>">
				<input name="action" type="hidden" id="action" value="A">
			</div>
			<hr>
			<span class="aym_text_required">Selecione una o varias funciones que necesite <strong>Asignar/Quitar</strong> al perfil</span>
		</fieldset>
	</form>
</div>