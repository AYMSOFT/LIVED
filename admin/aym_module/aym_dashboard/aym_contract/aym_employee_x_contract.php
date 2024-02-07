<?php # **************************** AYMCORE V: 1.0 ********************
# DASHBOARD NUMERO DE TRABAJADORES POR TIPO DE CONTRATO
# AYMSOFT SAS
# ADRIAN LOPEZ 09/08/2023

    #INCLUSIÓN --> PROCEDIMIENTO QUE TOTALIZA EMPLEADOS
    include_once $_SERVER[ 'DOCUMENT_ROOT' ].'/admin/aym_sql/aym_dashboard/aym_contract/aym_sql_dashboard_list_employee_x_contract.php';

	$aym_tot_emp_con = 0; 

?>
<div class="aym_content_dashboard aym_total">	
    <div><?=$row_dashboard['das_nam']?></div>
    <table>
        <thead>      
            <tr>
                <th>Tipo de Contrato</th> 
                <th>Cant.</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row_dashboard_employee_x_contract = mysqli_fetch_assoc($aym_sql_dashboard_employee_x_contract)) {  ?>
                <tr>
                    <td><?= $row_dashboard_employee_x_contract['con_typ_nam']?></td>
                    <td class="aym_align_right"><?=number_format($row_dashboard_employee_x_contract['aym_num_emp_con'],0,',','.');?></td>
                </tr>

            <?php $aym_tot_emp_con = $aym_tot_emp_con + $row_dashboard_employee_x_contract['aym_num_emp_con']; } mysqli_free_result($aym_sql_dashboard_employee_x_contract);?>
        </tbody>
        <tfoot>
            <tr>
                <td>Totales</td>
                <td class="aym_align_right"><?= number_format($aym_tot_emp_con, 0, ',','.')?></td>
            </tr>
        </tfoot>
    </table>
</div>





