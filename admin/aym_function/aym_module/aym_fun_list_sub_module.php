<?php # **************************** AYMCORE V: 14.0 ********************
# FUNCION PARA TRAER SUB MODULOS DE MODULO PRINCIPAL
# © 2023, AYMSOFT SAS
# DIEGO SUAZA AGO/08/23

function aym_fun_list_sub_module($aym_fun_id, $aym_fun_acc, $aym_lev, $aym_fun_act = '') {

    $_POST['fun_id'] = $aym_fun_id;

    # INCLUSIÓN --> PROCEDIMIENTO QUE LISTA SUB MODULOS DE MODULO PRINCIPAL
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_list_sub_menu.php';

    $con = 0;
	while($row_sub_function = mysqli_fetch_array($aym_sql_list_sub_menu)){$con++;

        $url_array = explode('/', $row_sub_function['fun_url']); # CAPTURAMOS LA URL PARA TOMAR EL NOMBRE DEL MODULO
        $module_array = explode('_', $url_array[3]); # TOMAMOS EL NOMBRE DEL MODULO
        
        if($aym_lev == 0 && $con == 1){$_SESSION['fun_acc_fir_mod'] = $module_array[1];} # CARGAMOS MODULO POR DEFECTO

        # MODULO ACTIVO
        $aym_class = '';
        if($aym_fun_act == $module_array[1]){$aym_class = 'active';}
        if($aym_fun_act == '' && $con == 1){$aym_class = 'active';}

        // VERIFICAMOS EXISTENCIA ICONO CON ID DE FUNCION
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/admin/aym_image/aym_icon/aym_function/aym_ico_fun_'.$row_sub_function['fun_id'].'.png')){
            $aym_img = '/admin/aym_image/aym_icon/aym_function/aym_ico_fun_'.$row_sub_function['fun_id'].'.png';
        }else{
            $aym_img = '/admin/aym_image/aym_icon/aym_function/aym_ico_management.png';
        }

        echo '<li><a href="/aymhuman/'.$aym_fun_acc.'/'.$module_array[1].'" class="'.$aym_class.'"><figure><img src="'.$aym_img.'"></figure>'.$row_sub_function['fun_nam'].'</a></li>';


    } mysqli_free_result($aym_sql_list_sub_menu);
}

?>