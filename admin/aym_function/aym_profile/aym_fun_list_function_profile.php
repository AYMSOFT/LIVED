<?php # **************************** AYMCORE V: 14.0 ********************
# FUNCION PARA TRAER FUNCION HIJA DE FUNCIONA Y CHECK USUARIO
# © 2023, AYMSOFT SAS
# DIEGO SUAZA AGO/08/23

function aym_fun_list_function_profile($aym_pro_id, $aym_fun_id, $aym_fun_par) {

    $_GET['pro_id'] = $aym_pro_id;
    $_POST['fun_id'] = $aym_fun_id;

    # INCLUSIÓN --> PROCEDIMIENTO QUE LISTA SUB MODULOS DE MODULO PRINCIPAL
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_function/aym_sql_list_function_sub_function.php';

	while($row_function_profile = mysqli_fetch_array($aym_sql_list_function_sub_function)){
    
        echo '<tr>
                <td class="aym_td_text">'.$aym_fun_par.' '.$row_function_profile['fun_nam'].'</td>
                <td class="aym_align_center">';

                    # VARIABLES
                    $aym_num_rows = 0;
                    $_GET['fun_id'] = $row_function_profile['fun_id'];
                    # COMPONENTE QUE PROCESA LOS DATOS EN LA BD
                    include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_get_profile_function.php'; 

                    $checked = '';
                    if ($aym_num_rows > 0) { $checked = 'checked';} 

                    echo '<input name="aym_fun_on_off['.$row_function_profile['fun_id'].']" id="aym_fun_on_off_'.$row_function_profile['fun_id'].'" type="checkbox" value="'.$row_function_profile['fun_id'].'" '.$checked.'>
                </td>
            </tr>';
            # if($row_function_profile['num_sub_fun']>0){aym_fun_list_function_profile($aym_pro_id, $row_function_profile['fun_id'], $aym_fun_par.'----');}
    } mysqli_free_result($aym_sql_list_function_sub_function);
}

?>