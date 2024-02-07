<?php # **************************** AYMSHOP V: 6.0 ********************
# COMPLEMENTO PARA EXPORTAR LA PRODUCCIÓN
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017 

    session_start();
    setlocale(LC_ALL,"es_ES");

    ob_start();//funcion necesaria para la correcta lecrua del PDF


    $_GET['use_id'] = $_SESSION['use_id'];
    $_POST['aym_dat_fil'] = $_SESSION['aym_dat_fil'];
    $_POST['das_cat_id'] = $_SESSION['das_cat_id'];


    #INCLUSIÓN --> PROCEDIMIENTO QUE LISTA TODOS LOS DASHBOARD DE UN USUARIO
    include_once $_SERVER[ 'DOCUMENT_ROOT' ].'/admin/aym_sql/aym_dashboard/aym_sql_list_dashboard_to_user.php';
    $num_row = round($aym_num_rows/2);
?>
<style>
    /*========== FUENTE ==========*/
    @page {margin: 70px 11px 11px 11px;padding: 0px;}
    * {font-family: Arial, Helvetica, sans-serif;}
    #header { position: fixed; left: 0px; top: -60px; right: 0px;width:100%}

    /*#aym_response_dashboard {display: grid;grid-template-columns: repeat(2, 1fr);grid-column-gap: 10px;grid-row-gap: 10px;}*/
    .aym_content_dashboard {border-radius: 10px;margin: 25px auto;width: 65%;padding: 15px;border: 1px solid #868686;}
    .aym_content_dashboard > div{box-sizing: border-box;justify-content: space-between;padding: 5px;color:#424240;}
    .aym_content_dashboard > div:nth-child(even){background-color: #fff;}
    .aym_content_dashboard > div:nth-child(odd){background-color: rgba(0,0,0,0.05);}
    .aym_content_dashboard > div:nth-child(1) {background-color: #0b556c;padding: 7px;color: #fff;}
    .aym_content_dashboard > h4 {color: #0b556c;font-size: 1.5em;font-weight: bold;text-align: center;margin-top:-7px}
    .aym_content_dashboard .aym_wrap_count{align-items: center;justify-content: space-between;flex-flow:wrap;margin-top:-25px;position:relative}
    .aym_content_dashboard .aym_wrap_count h3{width: 100%;text-align: center;font-size: 1.5em;color: #0A556D;}
    .aym_content_dashboard .aym_wrap_count div{align-items: center;box-sizing: border-box;flex-flow: column;width: 100%;}
    .aym_content_dashboard .aym_wrap_count div span {display: block;text-align: center;width: 100%;}
    .aym_content_dashboard .aym_wrap_count div span:first-child {font-size: 3em;}
    .aym_content_dashboard .aym_wrap_count div.alone{width: 100%;border: 0;}
    .aym_content_dashboard .aym_wrap_count div.alone span{font-size: 2.5em;}
    .aym_content_dashboard .aym_wrap_count div.alone.two_line span:first-child{font-size: 2em;}
    .aym_content_dashboard .aym_wrap_count div.alone.two_line span:last-child{font-size: 1.7em;}
    .aym_content_dashboard .aym_wrap_count .tot_mon{width: 100%;border-right: 0 !important;} 
    .aym_content_dashboard.aym_total{padding:0;}
    .aym_content_dashboard.aym_total > div:last-child,.aym_content_dashboard.aym_total > div:first-child {background-color: #0b556c;padding: 7px;color: #fff;}
    .aym_content_dashboard.aym_total > div span:first-child {min-width: 280px;}
    .aym_content_dashboard.aym_total * {font-size: .9em;}
    .aym_content_dashboard.aym_total .tot_d{ background-color: #48b5d3;color: white;font-size: 1em;}
    .aym_content_dashboard table{border-spacing: 0;width:100%;}
    .aym_content_dashboard table thead th{background-color: #48b5d3 !important;color: white;font-weight: 100;padding:5px;}
    .aym_content_dashboard table tbody td, .aym_content_dashboard table thead th, .aym_content_dashboard table tfoot td{border-bottom: 0;padding:5px;font-family: Arial, Helvetica, sans-serif;}
    .aym_content_dashboard table tbody tr:nth-child(even){background-color: #fff;}
    .aym_content_dashboard table tbody tr:nth-child(odd){background-color: rgba(0,0,0,0.05);}
    .aym_content_dashboard table tfoot, .aym_content_dashboard table tfoot tr:hover{background-color: #0b556c;}
    .aym_content_dashboard table tfoot td{color: white;}
    .aym_align_right {text-align: right;}
    .aym_align_center {text-align: center !important;}
    table th,table td{font-size:1.3em !important;}
</style> 
<head>
    <title>Reporte Dashboard</title>
</head> 
<div id="header">
    <table width="100%" cellspacing="0" cellpadding="3">
        <tr>
            <th><img src="<?= $_SERVER["DOCUMENT_ROOT"].'/aym_image/logo_206_x_63.png'?>" alt="Logo" style="height: auto;width: 150px;"></th>
        </tr>
    </table>
</div>
<h2 style="text-align:center;color: #0A556D;margin-bottom:0">Reporte Dashboard</h2>
<div id="aym_wrap_dashboard">
	<div class="aym_inner_dashboard">
		<div class="aym_welcome_dash">	
			<div id="aym_response_dashboard">
                <?php
                    # PAGINA --> PRINCIPAL 
                    while($row_dashboard = mysqli_fetch_array($aym_sql_list_dashboard_to_user)){
                        include_once $_SERVER[ 'DOCUMENT_ROOT' ].'/admin/aym_module/aym_dashboard'.$row_dashboard['das_acc'];
                    } mysqli_free_result($aym_sql_list_dashboard_to_user);
                ?>
            </div>
		</div>
	</div>
</div>


<?php
	
	
$aym_dashboard = ob_get_clean();

#============================================================================================================================
#======================================================= LIBRERIA DOMPDF ====================================================
#============================================================================================================================
# INCLUSIÓN --> LIBRERIA QUE GENERAR EL PDF
require_once $_SERVER['DOCUMENT_ROOT'].'/dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($aym_dashboard);


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', '');
ini_set('memory_limit','125M'); // Limite de memoria permitida.
// Render the HTML as PDF
$dompdf->render();
$dompdf->stream('dashboard_'.date('Y-m-d').'pdf', array("Attachment" => false) );
#=============================================================================================================================
#=============================================================================================================================
#=============================================================================================================================	
?>