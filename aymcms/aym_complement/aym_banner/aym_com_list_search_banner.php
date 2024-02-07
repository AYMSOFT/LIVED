<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LOS BANNER 
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start();

    # MODIFICO EL TIPO DE ENTRADA DE DATOS
    $_GET['ban_cat_id'] = $_POST['ban_cat_id'];
    $_GET['lan_id'] = $_POST['lan_id'];
    $_GET['aym_tex_sea'] = $_POST['aym_tex_sea'];
    $_GET['aym_order'] = $_POST['aym_order'];
    $_GET['aym_order_type'] = $_POST['aym_order_type'];
    $aym_show_page = 0;
    $_GET['aym_page_size'] = 5;

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LOS BANNERS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_list_banner.php';
	$banners = '';
	while($banner = mysqli_fetch_assoc($aym_sql_list_banner)){
		$banners = $banners."<div class='aym_banner_result' id='".$banner["ban_id"]."'><span>".$banner["ban_des"]."</span></div>"; 
	} mysqli_free_result($aym_sql_list_banner); 
	echo $banners;
?>