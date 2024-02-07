<?php # **************************** AYMCORE V: 14.0 ********************
# COMPLEMENTO PARA LISTAR EL REGISTRO DE ENTRADAS DE UN USUARIO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	session_start();	
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 50; } # 50 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 1; } # CAMPO POR DEFECTO PARA FILTRAR
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 0; } # ORDEN: 0=DESCENDENTE; 1=ASCENDETE
	
	#VARIABLES
	$aym_show_page = ($_GET['aym_page']*$_GET['aym_page_size']);

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA EL LOG DE USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_list_user_log.php'; 
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE CUENTA LOS USUARIOS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_count_user_log.php';	
	
?>
<div id="aym_wrap_menu_footer">
	<h3>Registro de Entradas</h3>
	<div class="aym_overflow">
		<table border="0" align="center" cellpadding="1" cellspacing="1">
			<tr align="center" class="box_menu3">
				<th>Fecha Log</th>
				<th>IP</th>
			</tr>
			<?php while ($row_list_user_log=mysqli_fetch_array($aym_sql_list_user_log)) { $rows_for_page++; ?>
				<tr>
					<td align="center" ><?= $row_list_user_log['use_log_dat'] ?></td>
					<td align="center" ><?= $row_list_user_log['use_log_ip'] ?></td>
				</tr>
			<? } mysqli_free_result($aym_sql_list_user_log); ?>
		</table>
	</div>
<?php 
	# INCLUSIÓN --> PAGINADOR
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>
	<input name="aym_return" type="hidden" id="aym_return" value="0">
</div>