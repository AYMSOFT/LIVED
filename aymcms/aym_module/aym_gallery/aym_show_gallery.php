<?php
	# INCLUSION -> LISTAR LOS ALBUNES DE UNA CATEGORÍA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_list_gallery_subcategory_out.php';
	

	if($aym_num_rows>0){
?>
	<div class="aym_wrap_list_subcategory aym_content">	
		<?php while($row_list_subcategory = mysqli_fetch_assoc($aym_sql_list_subcategory)){  ?>
			<button data-id="<?=  $row_list_subcategory['gal_sub_cat_id'] ?>" class="aym_select_subcategory <?= $row_count_subcategory == 0 ? 'active' : '' ?>"><?= $row_list_subcategory['gal_sub_cat_nam'] ?></button>
		<?php $row_count_subcategory++;} mysqli_free_result($aym_sql_list_subcategory); ?>
	</div>

	<div id="aym_list_images_gallery">
	</div>

	<form id="aym_frm_select_value" name="aym_frm_select_value">
		<input type="hidden" name="aym_page" id="aym_page" value="0">
		<input type="hidden" name="gal_sub_cat_id" id="gal_sub_cat_id" value="1">
		<input type="hidden" name="action_list" id="action_list" value="N">
	</form>
	<script type="text/javascript" src="/aym_js/aym_gallery/aym_gallery_function.js?<?= time();?>"></script>


<div id="aym_modal_gallery" class="modal">
  	<span class="close" onclick="closeModal()">&times;</span>
 	<div class="aym_modal_content aym_content">
	<div class="aym_count"></div>
	</div>
	<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>

<script>
	function openModal() {
	$("#aym_modal_gallery").css('display', 'block') ;
	$("body").addClass('overflow');
	}

	function closeModal() {
	$("#aym_modal_gallery").css('display', 'none') ;
	$("body").removeClass('overflow');
	}

	var slideIndex = 1;

	function plusSlides(n) {
	showSlides(slideIndex += n);
	}

	function currentSlide(n) {
	showSlides(slideIndex = n);
	}

	function showSlides(n) {
		var i;
		var slides =  $('#aym_modal_gallery .aym_slides'); 
		var captionText = $(slides).attr('data-count');

		
		if (n > slides.length) {slideIndex = 1}
		if (n < 1) {
			slideIndex = slides.length;
		}

		if(slides.length <= 1){
			$("#aym_modal_gallery .prev").css('display', 'none') ;
			$("#aym_modal_gallery .next").css('display', 'none') ;
		}else{
			$("#aym_modal_gallery .prev").css('display', 'block') ;
			$("#aym_modal_gallery .next").css('display', 'block') ;
		}
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
			slides[i].classList.remove("animateingallery");
		}
		let msg = slideIndex + ' / ' + slides.length;
		$("#aym_modal_gallery .aym_count").html(msg);
		slides[slideIndex-1].classList.add("animateingallery");
		slides[slideIndex-1].style.display = "flex";
	}
</script>


<?php 

}else{ ?>
	<p>&nbsp;</p>
    <center><h3>En este momento no hay álbumes disponibles.</h3></center>
	<p>&nbsp;</p>
<?php }?>
