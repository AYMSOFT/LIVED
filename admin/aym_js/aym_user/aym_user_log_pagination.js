/* **************************** AYMCORE V: 14.0 ********************
# SCRIPT PARA PAGINAR EL LOG DE USUARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
*/

/* BEGIN READY FUNCTION */
$(document).ready(function() {
	
	/* AL SELECIONAR LA PAGINA, MUESTRA LA TABLA */ 
	$("body").on('click', '.aym_window .aym_wrap_paginador a', function() {

		$('#aym_load_opacity').css('display','block');
		
		var aym_page=(this).id;
		var aym_page_size=$("#aym_page_size").val();
		var use_id=$("#use_id").val();

		$.ajax({
			/* INCLUSIÓN --> COMPLEMENTO QUE LISTA EL REGISTRO DE ENTRADAS DE UN USUARIO */
			url: "/admin/aym_complement/aym_user/aym_com_list_user_log.php",
			type: "get",
			data: { aym_page:aym_page, aym_page_size:aym_page_size, use_id:use_id },
			success: function(aym_response){
				$("#aym_list_user_log").html(aym_response);	
				$("#aym_page").val(aym_page);		
				$('#aym_load_opacity').css('display','none');				
			},
			error:function(jqXHR, textStatus){
				if(textStatus == 'timeout'){ 
					alert('Failed from timeout');} 
				else {
					alert("Failure, the complement does not exist!");
					location.reload();
				}
			}
		});
		
	});


}); 
/* FIN READY FUNCTION */