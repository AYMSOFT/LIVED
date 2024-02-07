<?php # **************************** AYMSITE V: 5.7 ********************
# COMPLEMENTO PARA LISTAR LAS NOTICIAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/09/2015 
	
	session_start();

	# INCLUSIÓN --> FUNCIÓN URL AMIGABLE
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_url/aym_fun_url.php';

	# VARIABLES
	if(!isset($_GET['num_news'])){$_GET['num_news'] = 10;} # NUMERO DE NOTICIAS A MOSTRAR 
	if(!isset($_GET['aym_page'])){$_GET['aym_page'] = 0;} # O --> PAGIA EN LA QUE INICIA 
	if(!isset($_GET['new_cat_id'])){$_GET['new_cat_id'] = 2;} # CATEGORIA DE NOTICIA	
	if(!isset($_GET['lan_id'])){$_GET['lan_id'] = 1;} # IDIOMA DE NOTICIA

	$aym_show_page = ($_GET['aym_page']*$_GET['num_news']);

	# INCLUSION -> QUE TRAE LAS NOTICIAS DEL HOME
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_head_news_home.php';

	while ($row_head_news = mysqli_fetch_assoc($aym_sql_list_news)) { 
?>
		<article>
			<a href="/prensa/<?=aym_friendly_url($row_head_news['new_cat_nam']).'/'.aym_friendly_url($row_head_news['new_tit']).'/'.$row_head_news['new_id'];?>"><h3><?=$row_head_news['new_tit'] ?></h3></a>
			<figure>
				<?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_news/'.$row_head_news['new_id'].'.png')){?>
					<img src="/aym_image/aym_news/<?=$row_head_news['new_id'];?>.png" alt="<?=$row_head_news['new_tit'];?>"/>
				<?php }else{ ?>
					<img src="/aym_image/aym_logo/aym_logo.png" alt="<?=$row_head_news['new_tit'];?>" class="empty"/>
				<?php }?>
			</figure>
			<p><?=$row_head_news['new_lea']?></p>
			<a href="/prensa/<?=aym_friendly_url($row_head_news['new_cat_nam']).'/'.aym_friendly_url($row_head_news['new_tit']).'/'.$row_head_news['new_id'];?>" class="aym_see_more">Leer más</a>
		</article>
<?php } mysqli_free_result($aym_sql_list_news);?>