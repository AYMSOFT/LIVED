<?php 
	# INCLUSIÓN --> MODULO QUE TRAE LA NOTICIA
	include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_get_news_out.php'; 
	
	# VARIABLES
	$_GET['new_cat_id'] = $row_get_news['new_cat_id'];
	
	# INCLUSIÓN --> MODULO QUE TRAE LA CATEGORIA DE LA NOTICIA
	include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_get_news_category_out.php'; 

?>
<article class="aym_wrap_detail_news">
	<h2><?=$row_get_news['new_tit']; ?></h2>
	<span><?=$row_get_news['new_lea'];?></span>
	<figure>
		<?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_news/'.$row_get_news['new_id'].'.png')){?>
			<img src="/aym_image/aym_news/<?=$row_get_news['new_id'];?>.png" alt="<?=$row_get_news['new_tit'];?>"/>
		<?php }else{ ?>
			<img src="/aym_image/aym_logo/aym_logo.png" alt="<?=$row_get_news['new_tit'];?>"/>
		<?php }?>
	</figure>
	<section class="aym_news_detail">
		<?=$row_get_news['new_des'];?>
	</section>
	<section class="aym_go_back">
		<a href="/prensa/blog/21">Volver</a>
	</section>
</article> 