<?php # **************************** AYM SITE V: 6.0 ********************
# MODULO PARA LISTAR LOS DASHBOARD ASIGNADOS
# AYMSOFT SAS
# DIEGO SUAZA 28/10/2020
    session_start();

    $_GET['use_id'] = $_SESSION['use_id'];
    
    # ASIGNAMOS SESSIÓN A LA FECHA PARA EXPORTAR
    $_SESSION['aym_dat_fil'] = $_POST['aym_dat_fil'];
    $_SESSION['das_cat_id'] = $_POST['das_cat_id'];

    #INCLUSIÓN --> PROCEDIMIENTO QUE LISTA TODOS LOS DASHBOARD DE UN USUARIO
    include_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/admin/aym_sql/aym_dashboard/aym_sql_list_dashboard_to_user.php';

    # PAGINA --> PRINCIPAL 
    while($row_dashboard = mysqli_fetch_array($aym_sql_list_dashboard_to_user)){

        #INCLUSIÓN --> MODULOS DE CADA DASHBOARD
        include_once $_SERVER[ 'DOCUMENT_ROOT' ].'/admin/aym_module/aym_dashboard'.$row_dashboard['das_acc'];

    } mysqli_free_result($aym_sql_list_dashboard_to_user);

?>
