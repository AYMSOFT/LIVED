<?php # **************************** AYMCORE V: 14.0 ********************
# FORMULARIO PARA VER MI CUENTA Y CAMBIAR IMAGEN 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VARIABLE
	$_GET['use_id']=$_SESSION['use_id'];

	# COMPONENTE QUE TRAE LOS DATOS DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_get_user.php';

	# COMPONENTE QUE TRAE LA ULTIMA ENTRADA DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_last_login.php';
?>	


<h2>Información Personal</h2>
<div class="aym_wrap_boxes">
	<div>
		<div>
			<label>Cuenta de Usuario:</label>
			<p><?= $row_get_user['use_log']; ?></p>
		</div>
		<div>
			<label>Nombre de Usuario:</label>
			<p><?= $row_get_user['use_nam']; ?></p>
		</div>
		<div class="aym_frm_two_col">
			<label>Tipo de Usuario:</label>
			<p><?= $row_get_user['use_typ_nam']; ?></p>
		</div>
		<div>
			<label>Estado:</label>
			<p><?= $row_get_user['sta_nam']; ?></p>
		</div>
	</div>
	<div>
		<div>
			<label>Fecha de registro:</label>
			<p><?= $row_get_user['use_dat'] ?></p>   
		</div>
		<div>
			<label>Fecha de vencimiento:</label>
			<p><?= ($row_get_user['use_dat_exp'] <> '1900-01-01')? $row_get_user['use_dat_exp'] : 'Indeterminada'; ?></p>
		</div>
		<div>
			<label>Último cambio de contraseña:</label>
			<p><?= $row_get_user['use_pwd_dat'] ?></p>    
		</div>
		<div>
			<label>Número de entradas:</label>
			<p> [ <strong><a class="aym_modal_info" url="/admin/loguser/<?= $row_get_user['use_id']; ?>"><?= $row_get_user['use_num_log'] ?></a></strong> ]</p>    
		</div>
		<div>
			<label>Última entrada:</label>
			<p><?= $row_get_last_login['use_log_dat'] ?></p>    
		</div>
		<div>
			<label>Última IP:</label>
			<p><?= $row_get_last_login['use_log_ip'] ?></p>    
		</div>
	</div>
</div>
<script type="text/javascript" src="/admin/aym_js/aym_user/aym_user_log_pagination.js"></script>


