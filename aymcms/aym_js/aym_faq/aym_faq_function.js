$(function(){
	
	/*==================================================================================*/
	/*=================================== ELIMINAR DATOS ===============================*/
	/*==================================================================================*/
 
		/* ----------- ELIMINAR EL REGISTRO --------------- 	*/ 
		$('#aym_list_faq_category').on('click','#aym_delete a.aym_ico_delete',function() {
			var faq_cat_id = (this).id;
			new AyM_window('¿Está seguro que desea eliminar este registro?', {
				title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
				titleClass: 'anim warning',
				modal: true,
				buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
				callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						var aym_url = '/aymcms/actionfaq';
						var aym_request_response = 'aym_list_error';
						var aym_data = new Object();
						aym_data.faq_cat_id = faq_cat_id;
						aym_data.action = 'DC';
						aym_data.aym_page = $("#aym_page").val();
						aym_data.aym_page_size = $("#aym_page_size").val();
						aym_process_component(aym_data,aym_url,aym_request_response); 
					}
				}
			});
		});
	
		/* ----------- ELIMINAR EL REGISTRO --------------- 	*/ 
		$('#aym_list_faq').on('click','#aym_delete a.aym_ico_delete',function() {
			var faq_id = (this).id;
			new AyM_window('¿Está seguro que desea eliminar este registro?', {
				title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
				titleClass: 'anim warning',
				modal: true,
				buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
				callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						var aym_url = '/aymcms/actionfaq';
						var aym_request_response = 'aym_list_error';
						var aym_data = new Object();
						aym_data.faq_id = faq_id;
						aym_data.action = 'D';
						aym_data.aym_page = $("#aym_page").val();
						aym_data.aym_page_size = $("#aym_page_size").val();
						aym_process_component(aym_data,aym_url,aym_request_response); 
					}
				}
			});
		});
	
	/*=================================================================================*/ 
	/*===================== CLICK EN LISTA DE RESULTADOS BUSQUEDA =====================*/
	/*=================================================================================*/
		
		$("#aym_search_results").on("click", ".aym_faq_result", function(){
			var faq_que = $(this).find("input").val();
			var faq_id = $(this).attr("id");
			var aym_page_size = $('#aym_page_size').val();
			var aym_page = $('#aym_page').val();
			var aym_order = $('#aym_order').val();
			var aym_order_type = $('#aym_order_type').val();
			var faq_cat_id = $('#faq_cat_id').val();
			$("#aym_search_results").hide();
			$("input[name=aym_tex_sea]").val(faq_que);
			window.location.href = '/aymcms/admfaq/aym_edit_faq/'+faq_id+'/'+faq_cat_id+'/'+aym_order+'/'+aym_order_type+'/'+aym_page_size+'/'+aym_page;
		});
	
});