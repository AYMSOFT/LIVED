$(document).ready(function() {
	

	/*==================================================================================*/
	/*========================= ACCION DEL CAMBIO DE PAGINA ============================*/
	/*==================================================================================*/
	
	/*------------- AL SELECIONAR TAMAÑO DE PAGINA, IDIOMA, FABRICANTE -------------*/ 
	$(`[id^=frm_list_] #aym_page_size, [id^=frm_list_] .aym_select`).change(function() {
		$('#aym_load_opacity').css('display','block');
		$('.aym_wrap_list').addClass('preloader');
		var aym_data_module = $('[id^=frm_list_]').attr('data-module');
		var aym_data_file = $('[id^=frm_list_]').attr('data-file');
		var aym_data = $('[id^=frm_list_]').serialize();
		var aym_url = "/aymcms/complement/"+aym_data_module+"/"+aym_data_file;
		var aym_request_response = 'aym_'+aym_data_file; 
		aym_process_list(aym_data,aym_url,aym_request_response);
	});
	
	
	
	/*==================================================================================*/
	/*========================== ACCION PARA PASAR DE PAGINA ===========================*/
	/*==================================================================================*/
	
		/* ----------- PAGINADOR DE LA TABLA --------------- */ 
		$("[id^=aym_list_]").on('click','.aym_wrap_paginador a',function() {
			$('.aym_wrap_list').addClass('preloader');
			$('#aym_page').val((this).id);
			var aym_data_module = $('[id^=frm_list_]').attr('data-module');
			var aym_data_file = $('[id^=frm_list_]').attr('data-file');
			var aym_data = $('[id^=frm_list_]').serialize();
			var aym_url = "/aymcms/complement/"+aym_data_module+"/"+aym_data_file;
			var aym_request_response = 'aym_'+aym_data_file; 
			aym_process_list(aym_data,aym_url,aym_request_response);

		});
	
	/*===============================================================*/
	/*============== FILTRO DE ASCEDENTE O DESCENDENTE ==============*/
	/*===============================================================*/
	
	$(".aym_wrap_list").on('click','#aym_delete span.filter_field',function(){
		var id_field = $(this).parent().attr('id');
		var aym_order = $('#aym_order').val();
		var aym_order_type = $('#aym_order_type').val();
		
		if(aym_order == id_field){
			if(aym_order_type == 0){
				$('#aym_order_type').val(1);
				$(this).addClass('asc');
				
			}else{
				$('#aym_order_type').val(0);
				$(this).removeClass('asc');
			}
		}else{
			$('#aym_order').val(id_field);
			$('#aym_order_type').val(0);
			$(this).addClass('asc');
		}
		$('#aym_load_opacity').css('display','block');
		$('.aym_wrap_list').addClass('preloader');
		var aym_data_module = $('[id^=frm_list_]').attr('data-module');
		var aym_data_file = $('[id^=frm_list_]').attr('data-file');
		var aym_data = $('[id^=frm_list_]').serialize();
		var aym_url = "/aymcms/complement/"+aym_data_module+"/"+aym_data_file;
		var aym_request_response = 'aym_'+aym_data_file; 
		aym_process_list(aym_data,aym_url,aym_request_response);
	});
	
	/*==================================================================================*/
	/*=========================== TRAER DATOS POR PRIMERA VEZ ==========================*/
	/*==================================================================================*/
	
	$("[id^=frm_list_] #aym_page_size").change();

	
}); // Fin Document Ready

	/*==================================================================================*/
	/*====================== FUNCION PARA TRAER DATOS DE LISTA =========================*/
	/*==================================================================================*/
		
	 
		function aym_process_list(aym_data,aym_url,aym_request_response){
			$.ajax({			
				// INCLUSIÓN --> COMPLEMENTO QUE LISTA LAS CATEGORIAS DE LOS PROYECTOS
				url: aym_url,
				cache:false,
				timeout: 5000,
				type: "get",
				data: aym_data,
				success: function(aym_response){
					$("#"+aym_request_response).html(aym_response);
					$('.aym_wrap_list').removeClass('preloader');
					$('#aym_load_opacity').css('display','none');
					return(false);
				},
				timeout: 600000, // sets timeout to 60 seconds
				error:function(jqXHR, textStatus){
					if(textStatus == 'timeout'){     
						//alert(' El tiempo de espera ha superado 5 segundos. \n\n El sistema intentará procesar la solicitud nuevamente');         
						$("#frm_list_cabin #aym_page_size").change(); // ------> ACTUALIZA LA TABLA DESPUES DE ELIMINAR 
					} else {
						//alert("Failure");
						//location.reload();
					}
				}
			});
		}