<?php # **************************** AYMCORE V: 14.0 ********************
# FUNCIÓN PARA SUBMENU RECURSIVO
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2023


function aym_fun_page_sub_menu($pag_id) { 

    # INCLUSION --> QUE LISTA LAS PAGINAS DEL MENU
    $_GET['pag_id'] = $pag_id;
	include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_subpage_out.php';

?>
    <i class="fa-solid fa-chevron-down"></i>
    <ul class="aym_sub_ul">
		<div class="triangulo" class="shape"></div>
        <?php while($row_list_page_subpage = mysqli_fetch_array($aym_sql_list_subpage)){
            $aym_url = $row_list_page_subpage['pag_url']   ? $row_list_page_subpage['pag_url'] : '/'.aym_friendly_url($row_list_page_subpage['pag_cat_nam']).'/'.aym_friendly_url($row_list_page_subpage['pag_tit']).'/'.$row_list_page_subpage['pag_id'];
        ?>
            <li><a target="<?=$row_list_page_subpage['pag_tar'];?>" href="<?=$aym_url;?>"><?=$row_list_page_subpage['pag_tit'];?></a></li>
        <?php }mysqli_free_result($aym_sql_list_subpage); ?>

    </ul>

<?php }?>