<?php # **************************** AYMCORE V: 1.0 ********************
# DASHBOARD NUMERO DE TRABAJADORES POR TIPO DE CONTRATO
# AYMSOFT SAS
# ADRIAN LOPEZ 09/08/2023

    #INCLUSIÓN --> PROCEDIMIENTO QUE TOTALIZA EMPLEADOS
    include_once $_SERVER[ 'DOCUMENT_ROOT' ].'/admin/aym_sql/aym_dashboard/aym_contract/aym_sql_dashboard_list_contract_expiration.php';

	$aym_tot_emp_con = 0; 

?>
<div class="aym_content_dashboard aym_total">	
    <div><?=$row_dashboard['das_nam']?></div>
    <table>
        <thead>      
            <tr>
                <th>Numero de Contrato</th> 
                <th>Fec. Vncimiento</th>
                <th>No. Identificación</th>
                <th>Empleado</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row_dashboard_contract_expiration = mysqli_fetch_assoc($aym_sql_dashboard_contract_expiration)) {  ?>
                <tr>
                    <td><?= $row_dashboard_contract_expiration['con_num']?></td>
                    <td><?= $row_dashboard_contract_expiration['con_end_dat']?></td>
                    <td class="aym_align_right">$<?=number_format($row_dashboard_contract_expiration['emp_num_ide'],0,',','.');?></td>
					<td><?= $row_dashboard_contract_expiration['emp_nam'],' ',$row_dashboard_contract_expiration['emp_sur']?></td>
                </tr>

            <?php }; mysqli_free_result($aym_sql_dashboard_contract_expiration);?>
        </tbody>
    </table>
</div>





