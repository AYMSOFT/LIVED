<?php 
    # PARA AGREGAR CLASES ESPECIFICAS
    $arr_class = [41 => 'aym_communications'];
?>
<main id="aym_wrap_content">

    <section class="aym_wrap_page_content">
        <h2  class="aym_title"><?= $row_get_pag['pag_tit'];?></h2>
        <article class="<?=$arr_class[$_GET['pag_id']];?>">
            <?= $row_get_pag['pag_con'];?>
        </article>
    </section>
    
</main> 
