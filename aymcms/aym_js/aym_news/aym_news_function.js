$(function(){

	
	/*==================================================================================*/
	/*================================== AGREGAR NOTICIAS  =============================*/
	/*==================================================================================*/
	
		$("#frm_add_news #lan_id, #frm_edit_news #lan_id, #frm_list_news #lan_id").change(function() {
			var lan_id = $(this).val();
			$.ajax({
				// INCLUSIÓN --> COMPLEMENTO QUE LISTA TODAS LAS CATEGORIAS DE LAS NOTICIAS
				url: "/aymcms/aym_complement/aym_news/aym_com_list_all_news_category.php",
				type: "get",
				data: { lan_id:lan_id },
				success: function(aym_response){
					$("#new_cat_id").html(aym_response);
					$('#aym_page_size').change();
				},
				error:function(){
					alert("failure");
				}
			});
		});	
	
		$("#frm_add_news #lan_id").change();
	
	/*==================================================================================*/
	/*======================== ACCION PARA ACTUALIZAR ESTADO ===========================*/
	/*==================================================================================*/
		
		$(".aym_wrap_list").on('click', '.aym_checkbox_status',function() { 
	
			var object = $(this);
			var aym_url = '/aymcms/actionnews';
			var aym_request_response = 'aym_list_error';
			var aym_data = new Object();
			aym_data.new_id = object.attr('data-id');
			aym_data.new_sta = $(this).is(':checked') ? 1 : 0;
			aym_data.action = "US";
			aym_data.aym_page =  $("#aym_page").val();
			aym_data.aym_page_size = $("#aym_page_size").val();
			aym_data.aym_order = $("#aym_order").val();
			aym_data.aym_order_type = $("#aym_order_type").val();
			aym_process_component(aym_data,aym_url,aym_request_response);
		});	
	
	
	/*==================================================================================*/
	/*======================== ACCION PARA ACTUALIZAR COVER ============================*/
	/*==================================================================================*/
	
		$(".aym_wrap_list").on('click', '.aym_checkbox_cover',function() { 
	
			var object = $(this);
			var aym_url = '/aymcms/actionnews';
			var aym_request_response = 'aym_list_error';
			var aym_data = new Object();
			aym_data.new_id = object.attr('data-id');
			aym_data.new_cov = $(this).is(':checked') ? 1 : 0;
			aym_data.new_cat_id = $('#new_cat_id').val();
			aym_data.action = "UC";
			aym_data.aym_page =  $("#aym_page").val();
			aym_data.aym_page_size = $("#aym_page_size").val();
			aym_data.aym_order = $("#aym_order").val();
			aym_data.aym_order_type = $("#aym_order_type").val();
			aym_process_component(aym_data,aym_url,aym_request_response); 
		});	

	/*=================================================================================*/ 
	/*===================== CLICK EN LISTA DE RESULTADOS BUSQUEDA =====================*/
	/*=================================================================================*/
		
		$("#aym_search_results").on("click", ".aym_news_result", function(){
			var new_des = $(this).find("input").val();
			var new_id = $(this).attr("id");
			var aym_page_size = $('#aym_page_size').val();
			var aym_page = $('#aym_page').val();
			var aym_order = $('#aym_order').val();
			var aym_order_type = $('#aym_order_type').val();
			var new_cat_id = $('#new_cat_id').val();
			var lan_id = $('#lan_id').val();
			$("#aym_search_results").hide();
			$("input[name=aym_tex_sea]").val(new_des);
			window.location.href = '/aymcms/admnews/aym_edit_news/'+new_id+'/'+new_cat_id+'/'+lan_id+'/'+aym_order+'/'+aym_order_type+'/'+aym_page_size+'/'+aym_page;
		});
	
	
	/*==================================================================================*/
	/*=================================== ELIMINAR DATOS ===============================*/
	/*==================================================================================*/
 
		/* ----------- ELIMINAR EL REGISTRO --------------- 	*/ 
		$('#aym_list_news').on('click','#aym_delete a.aym_ico_delete',function() {
			var new_id = (this).id;
			new AyM_window('¿Está seguro que desea eliminar este registro?', {
				title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
				titleClass: 'anim warning',
				modal: true,
				buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
				callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						var aym_url = '/aymcms/actionnews';
						var aym_request_response = 'aym_list_error';
						var aym_data = new Object();
						aym_data.new_id = new_id;
						aym_data.action = 'D';
						aym_data.aym_page = $("#aym_page").val();
						aym_data.aym_page_size = $("#aym_page_size").val();
						aym_process_component(aym_data,aym_url,aym_request_response); 
					}
				}
			});
		});
	
	
	/*==================================================================================*/
	/*=================================== ELIMINAR DATOS ===============================*/
	/*==================================================================================*/
 
		/* ----------- ELIMINAR EL REGISTRO --------------- 	*/ 
		$('#aym_list_news_category').on('click','#aym_delete a.aym_ico_delete',function() {
			var new_cat_id = (this).id;
			new AyM_window('¿Está seguro que desea eliminar este registro?', {
				title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
				titleClass: 'anim warning',
				modal: true,
				buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
				callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						var aym_url = '/aymcms/actionnews';
						var aym_request_response = 'aym_list_error';
						var aym_data = new Object();
						aym_data.new_cat_id = new_cat_id;
						aym_data.action = 'DC';
						aym_data.aym_page = $("#aym_page").val();
						aym_data.aym_page_size = $("#aym_page_size").val();
						aym_process_component(aym_data,aym_url,aym_request_response); 
					}
				}
			});
		});
});