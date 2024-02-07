<?php # **************************** AYMCORE V: 1.0 ********************
# DASHBOARD TOTALES EMPLEADOS
# AYMSOFT SAS
# DIEGO SUAZA 28/10/2020

    #INCLUSIÓN --> PROCEDIMIENTO QUE TOTALIZA EMPLEADOS
    include_once $_SERVER[ 'DOCUMENT_ROOT' ].'/admin/aym_sql/aym_dashboard/aym_employee/aym_sql_dashboard_total_employee.php';

?>
<div class="aym_content_dashboard">
    <h4><?=$row_dashboard['das_nam']?></h4>
    <div class="aym_wrap_count">
        <div class="alone">
            <span><?=$row_total_employee['aym_total_employee'];?></span>
        </div>
    </div>
</div>