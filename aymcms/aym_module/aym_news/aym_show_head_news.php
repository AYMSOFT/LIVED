<?php 
	# VARIABLES
	$_GET['new_cat_id'] = 2; # CATEGORIA DE NOTICIAS
	$_GET['num_news'] = 10; # NUMERO DE NOTICIAS A MOSTRAR

   	# INCLUSION -> QUE TRAE LAS NOTICIAS DEL HOME
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_head_news_home.php';
	
    # INCLUSIÓN --> MODULO QUE TRAE LA CATEGORIA DE LA NOTICIA
    include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_get_news_category_out.php';
    
    if ($aym_num_news > 0) { 
?>	
	<article class="aym_wrap_news">

		<div id="aym_selector_value">
			<form id="form1" name="form1" method="post">
				<label for="num_news">Mostrar</label>
				<select id="num_news" name="num_news">
				<option value="10" <?=$_GET['num_news'] == '10'?'selected':'';?> >10 Blogs</option>
				<option value="20" <?=$_GET['num_news']  == '20'?'selected':'';?> >20 Blogs</option>
				<option value="50" <?=$_GET['num_news']  == '50'?'selected':'';?> >50 Blogs</option>
				<option value="100" <?=$_GET['num_news']  == '100'?'selected':'';?> >100 Blogs</option>
				<option value="200" <?=$_GET['num_news']  == '200'?'selected':'';?> >200 Blogs</option>
				</select>
			</form>
		</div>
		<p>&nbsp;</p>
		<div class="aym_clear"></div>
		
		<section id="aym_wrap_press_head">
			<?php while ($row_head_news = mysqli_fetch_assoc($aym_sql_list_news)) { ?>				
				<article>
					<a href="/prensa/<?=aym_friendly_url($row_get_news_category['new_cat_nam']).'/'.aym_friendly_url($row_head_news['new_tit']).'/'.$row_head_news['new_id'];?>"><h3><?=$row_head_news['new_tit'] ?></h3></a>
					<figure>
						<?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_news/'.$row_head_news['new_id'].'.png')){?>
							<img src="/aym_image/aym_news/<?=$row_head_news['new_id'];?>.png" alt="<?=$row_head_news['new_tit'];?>"/>
						<?php }else{ ?>
							<img src="/aym_image/aym_logo/aym_logo.png" alt="<?=$row_head_news['new_tit'];?>" class="empty"/>
						<?php }?>
					</figure>
					<p><?=$row_head_news['new_lea']?></p>
					<a href="/prensa/<?=aym_friendly_url($row_get_news_category['new_cat_nam']).'/'.aym_friendly_url($row_head_news['new_tit']).'/'.$row_head_news['new_id'];?>" class="aym_see_more">Leer más</a>
				</article>
			<?php } mysqli_free_result($aym_sql_list_news);?>
		</section>
		<input id="new_cat_id" name="new_cat_id" type="hidden" value="<?=$_GET['new_cat_id'];?>"/>
		<script type="text/javascript" src="/aym_js/aym_news/aym_news_function.js"></script>
<?php } else { ?>
	<article class="aym_wrap_detail_news">
		<section id="aym_wrap_press_head">
			<p>&nbsp;</p>
			<center><h3>En este momento no tenemos <?=$row_get_pag['pag_tit']?>s disponibles</h3></center>
			<p>&nbsp;</p>
		</section>
<?php } ?>
</article>