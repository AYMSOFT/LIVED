<?php # **************************** AYMCORE V: 1.0 ********************
# DASHBOARD TOTALES DEPENDENCIAS
# AYMSOFT SAS
# ANDRES CASTRO 09/08/2023

    #INCLUSIÓN --> PROCEDIMIENTO QUE TOTALIZA DEPENDECIAS
    include_once $_SERVER[ 'DOCUMENT_ROOT' ].'/admin/aym_sql/aym_dashboard/aym_division/aym_sql_dashboard_total_division.php';

?>
<div class="aym_content_dashboard">
    <h4><?=$row_dashboard['das_nam']?></h4>
    <div class="aym_wrap_count">
        <div class="alone">
            <span><?=$row_total_division['aym_total_division'];?></span>
        </div>
    </div>
</div>