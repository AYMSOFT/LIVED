<?php # **************************** AYMCORE V: 1.0 ********************
# DASHBOARD QUE TOTALIZA EVALUACIONES
# AYMSOFT SAS
# ANDRES CASTRO 09/08/2023

    #INCLUSIÓN --> PROCEDIMIENTO QUE TOTALIZA EVALUACIONES
    $_POST['emp_per_typ'] = 4;
    include $_SERVER[ 'DOCUMENT_ROOT' ].'/admin/aym_sql/aym_dashboard/aym_employee_performance/aym_sql_dashboard_total_employee_performance.php';

?>
<div class="aym_content_dashboard">
    <h4><?=$row_dashboard['das_nam']?></h4>
    <div class="aym_wrap_count">
        <div class="alone">
            <span><?=$row_total_employee_performance['aym_total'];?></span>
        </div>
    </div>
</div>