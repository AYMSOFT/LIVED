<?php
	# INCLUSION --> QUE LISTA LAS PAGINAS DEL MENU
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_page_menu_top.php';

    # INCLUSION --> FUNCIÓN RECURSIVA TRAE SUB MENU
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_menu/aym_fun_sub_menu.php';

    while($row_list_page_menu_top = mysqli_fetch_array($aym_sql_list_menu_top)){

        $aym_url = $row_list_page_menu_top['pag_url']   ? $row_list_page_menu_top['pag_url'] : '/'.aym_friendly_url($row_list_page_menu_top['pag_cat_nam']).'/'.aym_friendly_url($row_list_page_menu_top['pag_tit']).'/'.$row_list_page_menu_top['pag_id']; 
        $aym_menu = "";
        if($row_list_page_menu_top['num_sub_pag']>0){$aym_menu = "aym_down_general";}

        if($aym_menu)
            $aym_menu = "class='".$aym_menu."'";
?>
    <li <?=$aym_menu?>>
        <?php if($row_list_page_menu_top['num_sub_pag']>0){?>
            <span><?=$row_list_page_menu_top['pag_tit'];?></span>
        <?php }else{?>
            <a href="<?=$aym_url;?>" target="<?=$row_list_page_menu_top['pag_tar'];?>"  title="<?=$row_list_page_menu_top['pag_tit'];?>"><?=$row_list_page_menu_top['pag_tit'];?></a>
        <?php }?>
        <?php if($row_list_page_menu_top['num_sub_pag']>0){ aym_fun_page_sub_menu($row_list_page_menu_top['pag_id']);}?>
    </li>

<?php } mysqli_free_result($aym_sql_list_menu_top); 
    # REGRESAMOS ID DE PAGINA ORIGINAL
    $_GET['pag_id'] = $aym_pag_id;
?>
