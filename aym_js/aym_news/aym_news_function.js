$(function(){
	
	$('#aym_selector_value #num_news').on('change', function(){
		
		var num_news = $('#num_news').val();
		var new_cat_id = $('#new_cat_id').val();

		$.ajax({			
			// INCLUSIÃ“N --> COMPLEMENTO QUE LISTA LAS CATEGORIAS DE LOS PROYECTOS
			url: "/aymcms/complement/news/list_news_out",
			cache: false,
			timeout: 5000,
			type: "get",
			data: {num_news:num_news, new_cat_id:new_cat_id},
			success: function(aym_response){
				$("#aym_wrap_press_head").html(aym_response);
			},
			error:function(jqXHR, textStatus){
				if(textStatus == 'timeout'){     
					alert(' El tiempo de espera ha superado 5 segundos. \n\n El sistema intentarÃ¡ procesar la solicitud nuevamente');         
					$("#num_news").change(); // ------> ACTUALIZA LA TABLA DESPUES DE ELIMINAR 
				} else {
					alert("Failure");
					location.reload();
				}
			}
		});
		
		
	});
	
});



