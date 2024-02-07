<?php # **************************** AYMCORE V: 1.0 ********************
# DASHBOARD QUE TOTALIZA EVALUACIONES POR TIPO
# AYMSOFT SAS
# ANDRES CASTRO 09/08/2023

    #INCLUSIÓN --> PROCEDIMIENTO QUE TOTALIZA EVALUACIONES POR TIPO
    include $_SERVER[ 'DOCUMENT_ROOT' ].'/admin/aym_sql/aym_dashboard/aym_employee_performance/aym_sql_dashboard_total_employee_performance_type.php';

?>

<div class="aym_content_dashboard">
    <h4><?=$row_dashboard['das_nam']?></h4>
    <canvas id="aym_total_employee_performance_type"></canvas>
</div>


<script>
    $(function() { 

        var color = Chart.helpers.color;
        var aym_bar_employee_performance_type = {
            labels: ['Autoevaluación', 'Jefes', 'Pares', 'Personal'],
            datasets: [{
                label: '<?=$row_dashboard['das_nam']?>',
                backgroundColor: [
                    color(window.chartColors.red).alpha(0.5).rgbString(),
                    color(window.chartColors.green).alpha(0.5).rgbString(),
                    color(window.chartColors.blue).alpha(0.5).rgbString(),
                    color(window.chartColors.yellow).alpha(0.5).rgbString(),
                ],
                borderColor: [
                    window.chartColors.red,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.yellow,
                ],
                borderWidth: 1,
                data: [
                    <?=$row_total_employee_performance_type['aym_total_self'].",".$row_total_employee_performance_type['aym_total_boss'].",".$row_total_employee_performance_type['aym_total_pair'].",".$row_total_employee_performance_type['aym_total_personnel'];?>
                ]
            }]

        };

        var aym_total_employee_performance_type = document.getElementById('aym_total_employee_performance_type').getContext('2d');
        window.myBar = new Chart(aym_total_employee_performance_type, {
            type: 'bar',
            data: aym_bar_employee_performance_type,
            options: {
                responsive: true,
                scales: {yAxes: [{display: true,ticks: {beginAtZero: true}}]},// INICIALIZARLO EN 0 Y NO DESDE EL VALOR MINIMO
                legend: {position: 'top',}
            }
        });

    });
</script>