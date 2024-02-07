<?php # **************************** AYMCMS V: 7.0 ********************
# MODULO PARA MOSTRAR LAS NOTICIAS DEL HOME
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# VARIABLES
	$_GET['new_cat_id'] = 1; # CATEGORIA DE NOTICIAS
	$_GET['num_news'] = 20; # NUMERO DE NOTICIAS A MOSTRAR

	# ZONA HORARIA
	setlocale(LC_ALL, 'es_CO.UTF-8');
	date_default_timezone_set('America/Bogota');

	# INCLUSION -> QUE TRAE LAS NOTICIAS DEL HOME
	include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_head_news_home.php';

	while ($row_list_news_home = mysqli_fetch_assoc($aym_sql_list_news)) { 
?>
	<div class="aym_item">
		<h2></h2>
		<i class="fa-solid fa-star"></i>
		<i class="fa-solid fa-star"></i>
		<i class="fa-solid fa-star"></i>
		<i class="fa-solid fa-star"></i>
		<i class="fa-solid fa-star"></i>
		
		<p><?= $row_list_news_home['new_des'];?></p>

		<p class="aym_client_say"><strong><?=$row_list_news_home['new_tit'];?></strong> / <?=$row_list_news_home['new_lea'];?></p>
	</div>
<?php } mysqli_free_result($aym_sql_list_news);?>


