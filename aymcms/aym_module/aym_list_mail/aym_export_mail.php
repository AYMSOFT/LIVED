<?php # **************************** AYMCMS V: 7.0 ********************
# PROCEDIMIENTO PARA EXPORTAR UN LISTADO DE CORREOS ELECTRONICOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start();

 	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=aym_list_mail_".date('Y-m-d').".xls");
 	
	# COMPONENTE --> PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_list_mail/aym_sql_export_list_mail.php'; 
	
?>
<table border="1" cellspacing="1" cellpadding="1">
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Nombre</th>
        <th>E-mail</th>
        <th>IP</th>
    </tr>
    <?php while($row_export_list_mail=mysqli_fetch_array($aym_sql_export_list_mail)) { ?>
        <tr>
            <td><?= $row_export_list_mail['lis_id'] ?></td>
            <td><?= $row_export_list_mail['lis_dat'] ?></td>
            <td><?= $row_export_list_mail['lis_nam'] ?></td>
            <td><?= $row_export_list_mail['lis_ema'] ?></td>
            <td style="text-align: right;"><?= $row_export_list_mail['use_ip'] ?></td>
        </tr>
    <?php } mysqli_free_result($aym_sql_export_list_mail); ?>
</table>