<main id="aym_wrap_content">

    <section class="aym_wrap_page_content">
        <article>
            <div class="aym_title_contact"><?=$row_get_pag['pag_con'];?></div>
            <?php 
                # INCLUSIÓN --> MODULO DE CONTACTO
                include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_contact/aym_contact.php';
			?>
        </article>
    </section>
</main> 