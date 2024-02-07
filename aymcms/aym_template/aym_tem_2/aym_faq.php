<main id="aym_wrap_content">
    <section class="aym_wrap_page_content">
        <h2  class="aym_title"><?= $row_get_pag['pag_tit'];?></h2>
        <article class="aym_faq">
            <?php 
                # INCLUSIÓN --> MODULO DE PREGUNRAS FRECUENTES
                include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_faq/aym_faq.php';
			?>
        </article>
    </section>
</main> 