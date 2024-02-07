/* **************************** AYMCORE V: 14.0 ********************
# SCRIPT PARA BUSCAR USUARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
*/

/* BEGIN READY FUNCTION */
$(document).ready(function() {	
	$('input[name=use_nam]').keyup(function(){
		var usuario = $('input[name=use_nam]').val();
		var res = "";
		if(usuario.length>2){
			$.ajax({
				type: 'POST',
				url: '/admin/aym_complement/aym_user/aym_com_search_user.php',
				data:{use_nam: usuario},
				success: function(respuesta){
					if(respuesta===""){
						res = "<p class='aym_no_result'>Sin resultados</p>";
					} else {
						res = respuesta;
					}
					$("#aym_search_results").html(res);
					$("#aym_search_results").show();						
				}
			});
		} else {
			$("#aym_search_results").hide();
		}
	});

	$("#aym_search_results").on("click", ".aym_user_result", function(){
		var use_nam = $(this).find("input").val();
		var use_id = $(this).attr("id");
		$("#aym_search_results").hide();
		$("input[name=use_nam]").val(use_nam);
		$("input[name=use_id]").val(use_id);
		showUserDetails($(this), $(this).text());
	});

	function showUserDetails(var_this, email){
		$("#aym_user_detail").removeClass('aym_hidden');
		$("#aym_user_detail").html('');
		$("#aym_user_detail").html('<label>Email:</label><input class="aym_read_only" name="use_ema" type="email" value="'+email+'" readonly/>');
		$('.aym_hide').toggleClass('aym_hide');
	}
}); 
/* FIN READY FUNCTION */