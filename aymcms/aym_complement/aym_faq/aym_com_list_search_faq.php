<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA BUSCAR LAS PREGUNTAS FRECUENTES
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start();

    # MODIFICO EL TIPO DE ENTRADA DE DATOS
    $_GET['faq_cat_id'] = $_POST['faq_cat_id'];
    $_GET['lan_id'] = $_POST['lan_id'];
    $_GET['aym_tex_sea'] = $_POST['aym_tex_sea'];
    $_GET['aym_order'] = $_POST['aym_order'];
    $_GET['aym_order_type'] = $_POST['aym_order_type'];
    $aym_show_page = 0;
    $_GET['aym_page_size'] = 5;

	#INCLUSIÓN---> SQL PARA BUSCAR LAS PAGINAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_list_faq.php';
	
	$faqs  ='';
	while($faq = mysqli_fetch_assoc($aym_sql_list_faq)){
		$faqs = $faqs."<div class='aym_faq_result' id='".$faq["faq_id"]."'><span>".$faq["faq_que"]."</span><span>".$faq["faq_ans"]."</span></div>"; 
	}mysqli_free_result($aym_sql_list_faq);
	echo $faqs;
?>