<?php # **************************** AYMCORE V: 14.0 ********************
# MODULO PARA EDITAR USUARIOS 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# COMPONENTE QUE TRAE LOS DATOS DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_get_user.php';
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LOS TIPOS DE USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_list_all_user_type.php';

	# COMPONENTE QUE TRAE LA ULTIMA ENTRADA DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_last_login.php';
	$_GET['off_typ_id'] = 1;

	# INCLUSIÓN --> COMPONENTE LISTA LAS DEPENDENCIAS / OFICINAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_office.php';
	
?>
<div class="aym_wrap_form">
	<form action="/admin/actionuser" method="post" enctype="multipart/form-data" name="frm_edit_user" id="frm_edit_user" autocomplete="off">
		<fieldset class="aym_frm_content">
			
			<div>
				<label for="use_typ_id">Tipo de Usuario:</label>
				<select name="use_typ_id" id="use_typ_id">
					<?php while($row_list_user_type = mysqli_fetch_array($aym_sql_list_user_type)){?>
						<option value="<?=$row_list_user_type['use_typ_id'];?>" <?php if($row_get_user['use_typ_id']==$row_list_user_type['use_typ_id']) { echo 'selected="selected"'; } ?>><?=$row_list_user_type['use_typ_nam'];?></option>
					<?php } mysqli_free_result($aym_sql_list_user_type);?>
				</select>
			</div>


			<div class="aym_search_employee <?=$row_get_user['use_typ_id']==2?'':'aym_hidden';?>">
				<label>Empleado:</label>
				<input type="text" name="emp_tex" id="emp_tex" value="<?=$row_get_user['use_nam'];?>">
				<div id="aym_search_results"></div>            
			</div>
			
			
			<div style="<?=$row_get_user['use_typ_id']==2?'display:none':'';?>">
				<label for="use_nam">Nombre de Usuario:</label>
				<input name="use_nam" type="text" id="use_nam" value="<?=$row_get_user['use_nam'];?>">
			</div>



			<div class="aym_office <?=($row_get_user['use_typ_id']==1)?'':'aym_hidden';?>">
				<label>Dependencia:</label>
				<select name="off_id" id="off_id"><?php while ($row_list_office = mysqli_fetch_array($aym_sql_list_office)){ if ($row_get_user['off_id']==$row_list_office['off_id']){echo '<option value="'.$row_list_office['off_id'].'" selected="selected">'.$row_list_office['off_nam'].'</option>';}else{echo'<option value="'.$row_list_office['off_id'].'">'.$row_list_office['off_nam'].'</option>';}} mysqli_free_result($aym_sql_list_office); ?></select>    		
			</div>

			<div class="aym_use_log">
				<label for="use_log">Cuenta de Usuario:</label>
				<input name="use_log" type="text" id="use_log" value="<?=$row_get_user['use_log']; ?>" readonly>
				<p>Email</p>
				<figure id="aym_unlock_uselog"></figure>
			</div>
					
			<div>
				<label for="sta_id">Estado:</label>
				<select name="sta_id" id="sta_id">
					<option value="1" <?php if ($row_get_user['sta_id'] == '1') {echo 'selected="selected"';} ?>>ACTIVO</option>
					<option value="0" <?php if ($row_get_user['sta_id'] == '0') {echo 'selected="selected"';} ?>>INACTIVO</option>
				</select>    
			</div>
			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar" class="val_editar_user">
				<input name="action" type="hidden" id="action" value="U">
				<input name="use_id" type="hidden" id="use_id" value="<?=$row_get_user['use_id'];?>">
				<input name="cli_id" type="hidden" id="cli_id" value="<?=$row_get_user['cli_id'];?>">
			</div>
			
		</fieldset>
	</form>
	<hr>
	<div class="aym_wrap_info">
		<h3>Información Adicional</h3>
		<div>
			<span>Fecha de registro:</span>
			<span><?=$row_get_user['use_dat'];?></span>   
		</div>
		<div>
			<span>Fecha de vencimiento:</span>
			<span><?= ($row_get_user['use_dat_exp'] <> '1900-01-01')? $row_get_user['use_dat_exp'] : 'Indeterminada'; ?></span>    
		</div>
		<div>
			<span>Último cambio de contraseña:</span>
			<span><?=$row_get_user['use_pwd_dat'];?></span>    
		</div>
		<div>
			<span>Número de entradas:</span>
			<span>[ <strong><?php if($row_get_user['use_num_log'] > 0){ ?>  <a class="aym_modal_info"  url="/admin/loguser/<?=$row_get_user['use_id']; ?>"><?=$row_get_user['use_num_log'];?> </a> <?php } else { echo '0'; } ?></strong> ]</span>
		</div>
		<?php if($row_get_user['use_num_log'] > 0){ ?>
			<div>
				<span>Última entrada:</span>
				<span><?=$row_get_last_login['use_log_dat'];?></span>    
			</div>
			<div>
				<span>Última IP:</span>
				<span><?=$row_get_last_login['use_log_ip'];?></span>    
			</div>
		<?php } ?>  
	</div>
</div>
<script src="/admin/aym_js/aym_user/aym_user_log_pagination.js"></script>
<script>$(function(){$('#cli_ide').change();});</script>

