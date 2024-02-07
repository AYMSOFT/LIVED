<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR USUARIOS DE LISTA DE CORREOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start(); 
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['option'])) { $_GET['option'] = "admlistmail"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER

	#VARIABLES
	$aym_show_page = ($_GET['aym_page']*$_GET['aym_page_size']);

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LOS PERFILES
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_list_mail/aym_sql_list_mail.php'; 
	

	# INCLUSIÓN --> PROCEDIMIENTO QUE CUANTA LOS PERFILES
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_list_mail/aym_sql_count_list_mail.php';	
	
?>
<meta charset="utf-8">
<div class="aym_overflow">
	<table width="100%" border="0" cellspacing="0" cellpadding="1" class="aym_table" id="aym_delete">
	<tr>
		<th>Del</th>
		<th id="1"><span class="filter_field <?=$_GET['aym_order'] == '1'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">ID</span></th>
		<th id="2"><span class="filter_field <?=$_GET['aym_order'] == '2'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Fecha</span></th>
		<th id="3"><span class="filter_field <?=$_GET['aym_order'] == '3'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Nombre</span></th>
		<th id="4"><span class="filter_field <?=$_GET['aym_order'] == '4'?'active':''; $_GET['aym_order_type']==0?' asc':'';?>">Correo</span></th>
		<th>IP</th>
	</tr>
    <?php while ($row_list_mail=mysqli_fetch_array($aym_sql_list_mail)) { $rows_for_page++; ?>
		<tr data-id="<?=$row_list_mail['lis_id']?>">
			<td><figure class="aym_list_icon"><a class="aym_ico_delete" id="<?= $row_list_mail['lis_id']?>"><img src="/admin/aym_image/aym_icon/aym_ico_delete.png" alt="Eliminar"></a></figure></td>
			<td class="aym_align_center"><?=$row_list_mail['lis_id']?></td>     
			<td class="aym_align_center"><?=$row_list_mail['lis_dat']?></td>     
			<td class="aym_align_left"><?=$row_list_mail['lis_nam']?></td>     
			<td class="aym_align_left"><?=$row_list_mail['lis_ema']?></td>     
			<td class="aym_align_left"><?=$row_list_mail['use_ip']?></td>     
		</tr>
    <?php } mysqli_free_result($aym_sql_list_mail); ?> 
  </table>
</div>
<p>&nbsp;</p>
<?php 
	//INCLUSION DE LA PAGINACION
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_paginator.php';
?>