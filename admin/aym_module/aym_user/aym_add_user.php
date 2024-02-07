<?php # **************************** AYMCORE V: 14.0 ********************
# MODULO PARA AGREGAR USUARIOS 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LOS TIPOS DE USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_list_all_user_type.php';
	

	# INCLUSIÓN --> COMPONENTE LISTA LAS DEPENDENCIAS / OCICINAS 
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_office.php';

?>

<div class="aym_wrap_form">
	<form action="/admin/actionuser" method="post" name="frm_add_user" id="frm_add_user" autocomplete="off" >
		<fieldset>
			<div>
				<label for="use_typ_id">Tipo de Usuario:</label>
				<select name="use_typ_id" id="use_typ_id">
					<?php while($row_list_user_type = mysqli_fetch_array($aym_sql_list_user_type)){?>
						<option value="<?= $row_list_user_type['use_typ_id']?>"><?= $row_list_user_type['use_typ_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_user_type);?>
				</select>  
			</div>
			<div class="aym_search_employee aym_hidden">
				<label>Empleado:</label>
				<input type="text" name="emp_tex" id="emp_tex" >
				<div id="aym_search_results"></div>            
			</div>
			<div>
				<label for="use_nam">Nombre de Usuario:</label>
				<input name="use_nam" type="text" id="use_nam">
				<p>Juan Perez</p>
			</div>
			<div class="aym_office">
				<label>Dependencia:</label>
				<select name="off_id" id="off_id"><?php while ($row_list_office = mysqli_fetch_array($aym_sql_list_office)){ echo'<option value="'.$row_list_office['off_id'].'">'.$row_list_office['off_nam'].'</option>';} mysqli_free_result($aym_sql_list_office); ?></select>    		
			</div>
			<div>
				<label for="use_log">Cuenta de Usuario:</label>
				<input name="use_log" type="email" id="use_log" autocomplete="new-password">
				<p>ejemplo@correo.com</p>
			</div>
			<div>
				<label for="use_pwd">Contraseña:</label>
				<input name="use_pwd" type="password" id="use_pwd" autocomplete="new-password">
				<input type="checkbox" class="sho_pwd">
			</div>
			<div>
				<label for="use_pwd2">Repita la Contraseña:</label>
				<input name="use_pwd2" type="password" id="use_pwd2" autocomplete="new-password">
				<input type="checkbox" class="sho_pwd">
			</div>
			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar"> 
				<input name="action" type="hidden" id="action" value="I">
				<input name="cli_id" type="hidden" id="cli_id" value="0">
			</div>
			<hr>
			<span class="aym_text_required">*Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
<script>$(function(){$('#frm_add_user #use_typ_id').val('1').change();});</script>



