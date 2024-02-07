<?php   # **************************** AYMSHOP V: 6.0 ********************
# MODULO LISTAR PREGUNTAS FRECUENTES
# AYMSOFT SAS
# diego suaza jun/09/20

    # PROCEDIMIENTO--> LISTA CATEGORIA DE FAQ
    include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_list_all_faq_category_out.php'; 

    while ($row_list_faq_category = mysqli_fetch_array($aym_sql_list_faq_category)) {

        # EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
        $_GET['faq_cat_id'] = $row_list_faq_category['faq_cat_id'];
        include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_list_faq_out.php';
?>
        <h3><?=$row_list_faq_category['faq_cat_nam'];?></h3>

        <?php while($row_show_faq=mysqli_fetch_assoc($aym_sql_list_faq)){$con++;?>
            <h4 class="aym_title_accordeon" data-id="<?=$row_show_faq['faq_id'];?>"><i class="fa-solid fa-angle-down"></i><?=$row_show_faq['faq_que'];?></h4>      
            <div class="aym_content_accordeon" id="aym_content_accordeon_<?=$row_show_faq['faq_id'];?>">
                <p><?=$row_show_faq['faq_ans'];?></p>
            </div>  
        <?php } mysqli_free_result($aym_sql_list_faq);?>

<?php } mysqli_free_result($aym_sql_list_faq_category); ?>

