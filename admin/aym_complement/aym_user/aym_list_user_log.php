<?php # **************************** AYMCORE V: 14.0 ********************
# MODULO PARA LISTAR TODOS LOS REGISTROS DE LOG DE UN USUARIO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	session_start();	
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['aym_tamano_pagina'])) { $_GET['aym_tamano_pagina'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_pagina'])) { $_GET['aym_pagina'] = 0; } # O --> PAGIA EN LA QUE INICIA
	
	#VARIABLES
	$aym_show_pagina = ($_GET['aym_pagina']*$_GET['aym_tamano_pagina']);

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA EL LOG DE USUARIOS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_list_user_log.php'; 
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE CUANTA LOS USUARIOS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_count_user_log.php';	
	
?>
<div id="aym_wrap_page">
  <table width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
    <tr align="center" class="box_menu3">
      <th>Fecha</th>
      <th>IP</th>
    </tr>
    <?php while ($row_list_user_log=mysqli_fetch_array($aym_sql_list_user_log)) { $rows_for_page++; ?>
    <tr>
      <td align="center" ><? echo $row_list_user_log['use_log_dat'] ?></td>
      <td align="center" ><? echo $row_list_user_log['use_log_ip'] ?></td>
    </tr>
    <? } mysqli_free_result($aym_sql_list_user_log); ?>
  </table>
</div>
<hr>
<? 
	# INCLUSION --> PAGINADOR
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_common/aym_paginator.php';
?>

