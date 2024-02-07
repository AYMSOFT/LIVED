
<main id="aym_wrap_content">
    <section class="aym_wrap_page_content">
        <h2  class="aym_title"><?= $row_get_pag['pag_tit'];?></h2>
        <?php  
            if (!isset($_GET['new_id'])) {
                # INCLUSIÓN --> LISTADO DE NOTICIAS
                include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_news/aym_show_head_news.php';
            } else  {
                # INCLUSIÓN --> DETALLE DE LA NOTICIA
                include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_news/aym_det_news.php';
            }
        ?>
    </section>
    
</main> 