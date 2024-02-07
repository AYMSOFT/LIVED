<?php # **************************** AYMSITE V: 5.0 ********************
# COMPLEMENTO PARA LISTAR LAS PAGINAS DE CONTENIDOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

session_start();
#INCLUSIÓN---> SQL QUE LISTA LOS profileS
include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_search_news_list.php';
while($new = mysqli_fetch_assoc($aym_sql_list_new)){
	$news = $news."<div class='aym_news_result' data-cat-id='".$new["new_cat_id"]."' data-lan-id='".$new["lan_id"]."' id='".$new["new_id"]."'><span>".$new["new_tit"]."</span><span>".$new["new_lea"]."</span></div>"; 
}mysqli_free_result($aym_sql_list_new);
echo $news;
?>