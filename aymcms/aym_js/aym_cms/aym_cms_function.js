$(function() {

	/*==================================================================================*/
	/*============================== AGREGAR / EDITAR PAGINAS ==========================*/
	/*==================================================================================*/

		/* ----------- AL SELECIONAR EL IDIOMA, MUESTRA LAS CATEGORIAS  --------------- */ 
		$("#frm_add_page #lan_id, #frm_edit_page #lan_id").change(function() {
			var lan_id = $(this).val();

			$('#aym_load_opacity').css('display','block');
			$.ajax({
				// INCLUSIÓN --> COMPLEMENTO QUE LISTA LAS CATEGORIAS
				url: "/aymcms/aym_complement/aym_cms/aym_com_list_all_page_category.php",
				cache: false,
				timeout: 5000,
				type: "get",
				data: { lan_id:lan_id },
				success: function(aym_response){
					$("#pag_cat_id").html(aym_response);
					$("#pag_cat_id").change();
					$('#aym_load_opacity').css('display','none');
				},
				error:function(jqXHR, textStatus){
					if(textStatus == 'timeout'){     
						alert(' El tiempo de espera ha superado 5 segundos. \n\n El sistema intentará procesar la solicitud nuevamente');         
						$("#lan_id").change(); 
					} else {
						alert("Failure");
						location.reload();
					}
				}
			});

			$('#aym_load_opacity').css('display','block');
			$.ajax({
				// INCLUSIÓN --> COMPLEMENTO QUE LISTA EL MENU
				url: "/aymcms/aym_complement/aym_cms/aym_com_list_menu.php",
				cache: false,
				timeout: 5000,
				type: "get",
				data: { lan_id:lan_id },
				success: function(aym_response){
					$("#aym_men_wrp").html(aym_response);
					$('#aym_load_opacity').css('display','none');
				},
				error:function(jqXHR, textStatus){
					if(textStatus == 'timeout'){     
						alert(' El tiempo de espera ha superado 5 segundos. \n\n El sistema intentará procesar la solicitud nuevamente');         
						$("#lan_id").change(); 
					} else {
						alert("Failure");
						location.reload();
					}
				}
			});

		});	

		$("#frm_add_page #lan_id").change();
	
	/*==================================================================================*/
	/*========================== CARGAR SUB PAGINAS Y PLANTILLAS =======================*/
	/*==================================================================================*/
	
		$("#frm_add_page #pag_cat_id, #frm_edit_page #pag_cat_id").change(function() {
			var pag_cat_id = $(this).val();

			$('#aym_load_opacity').css('display','block');
			$.ajax({
				// INCLUSIÓN --> COMPLEMENTO QUE LISTA LAS PAGINAS
				url: "/aymcms/aym_complement/aym_cms/aym_com_list_subpage.php",
				cache: false,
				timeout: 5000,
				type: "get",
				data: { pag_cat_id:pag_cat_id },
				success: function(aym_response){
					$("#pag_sub_id").html(aym_response);
					$('#aym_load_opacity').css('display','none');
				},
				error:function(jqXHR, textStatus){
					if(textStatus == 'timeout'){     
						alert(' El tiempo de espera ha superado 5 segundos. \n\n El sistema intentará procesar la solicitud nuevamente');         
						$("#aym_tamano_pagina").change(); 
					} else {
						alert("Failure");
						location.reload();
					}
				}
			});


			$('#aym_load_opacity').css('display','block');
			$.ajax({
				// INCLUSIÓN --> COMPLEMENTO QUE LISTA LAS PLANTILLAS
				url: "/aymcms/aym_complement/aym_cms/aym_com_list_page_templates.php",
				cache: false,
				timeout: 5000,
				type: "get",
				data: { pag_cat_id:pag_cat_id},
				success: function(aym_response){
					$("#pag_tem").html(aym_response);
					$('#aym_load_opacity').css('display','none');
				},
				error:function(jqXHR, textStatus){
					if(textStatus == 'timeout'){     
						alert(' El tiempo de espera ha superado 5 segundos. \n\n El sistema intentará procesar la solicitud nuevamente');         
						$("#aym_tamano_pagina").change(); 
					} else {
						alert("Failure");
						location.reload();
					}
				}
			});
		});
	
	/*=================================================================================*/ 
	/*========================== FUNCIONALIDAD DE EDITAR ===============================*/
	/*=================================================================================*/
	
		$("#frm_add_page, #frm_edit_page").on("click", "#aym_form_edit span", function(){
			if($('.aym_wrap_edit').hasClass('aym_edit')){
				$('.aym_wrap_edit').removeClass('aym_edit');
				$('.aym_wrap_edit select, .aym_wrap_edit input').each(function(){
					$(this).removeAttr('disabled');
				});
				$('.aym_wrap_edit .aym_add_item, .aym_wrap_edit .aym_delete_item').each(function(){
					$(this).removeClass('aym_inactive');
				});
				$('.aym_frm_submit').removeClass('aym_hidden');				
			}else{
				$('.aym_wrap_edit').addClass('aym_edit');
				$('.aym_wrap_edit select, .aym_wrap_edit input').each(function(){
					$(this).attr('disabled','disabled');
				});
				$('.aym_wrap_edit .aym_add_item, .aym_wrap_edit .aym_delete_item').each(function(){
					$(this).addClass('aym_inactive');
				});
				$('.aym_frm_submit').addClass('aym_hidden');
			}
		});
	
	/*=================================================================================*/ 
	/*===================== CLICK EN LISTA DE RESULTADOS BUSQUEDA =====================*/
	/*=================================================================================*/
		
		$("#aym_search_results").on("click", ".aym_page_result", function(){
			var pag_des = $(this).find("input").val();
			var pag_id = $(this).attr("id");
			var pag_cat_id = $('#pag_cat_id').val();
			var lan_id = $('#lan_id').val();
			var aym_page_size = $('#aym_page_size').val();
			var aym_page = $('#aym_page').val();
			var aym_order = $('#aym_order').val();
			var aym_order_type = $('#aym_order_type').val();
			$("#aym_search_results").hide();
			$("input[name=aym_tex_sea]").val(pag_des);
			window.location.href = '/aymcms/admcms/aym_edit_cms/'+pag_id+'/'+pag_cat_id+'/'+lan_id+'/'+aym_order+'/'+aym_order_type+'/'+aym_page_size+'/'+aym_page;
		});


	/*=================================================================================*/ 
	/*================================= LISTAR PAGINAS ================================*/
	/*=================================================================================*/
	
	
		$("#frm_list_page #lan_id").change(function() {
			$('.aym_wrap_list').addClass('preloader');
			var lan_id = $(this).val();
			var pag_cat_id = $('#pag_cat_id').val();

			$.ajax({
				// INCLUSIÓN --> COMPLEMENTO QUE LISTA LAS CATEGORIAS
				url: "/aymcms/aym_complement/aym_cms/aym_com_list_all_page_category.php",
				cache: false,
				timeout: 5000,
				type: "get",
				data: { lan_id:lan_id, pag_cat_id:pag_cat_id },
				success: function(aym_response){
					$("#pag_cat_id").html(aym_response);
					$('.aym_wrap_list').removeClass('preloader');
				},
				error:function(jqXHR, textStatus){
					if(textStatus == 'timeout'){     
						alert(' El tiempo de espera ha superado 5 segundos. \n\n El sistema intentará procesar la solicitud nuevamente');        
						$("#aym_tamano_pagina").change(); // ------> ACTUALIZA LA TABLA DESPUES DE ELIMINAR 
					} else {
						alert("Failure");
						location.reload();
					}
				}
			});
		});

	/*=================================================================================*/ 
	/*================================= AGREGAR IMAGEN ================================*/
	/*=================================================================================*/
	
		$('.aym_wrap_form').on('click','.aym_frm_image',function(){
			$(this).siblings('input[type=file]').click();
		});

		$('.aym_add_item').click(function(){
			var add = '<div class="aym_frm_images"><div><div class="aym_frm_row"><label>Descripción de imagen</label><input type="text" name="pag_ima_des[]" id="pag_ima_des"></div><div class="aym_frm_image"><figure class="con_ima_thumb"><img src="/admin/aym_image/aym_icon/aym_add_image.png"></figure>Agregar imagen</div><input class="aym_hidden aym_file" name="aym_fil[]" type="file" id="con_ima"></div><span class="aym_delete_item"></span></div>';
			$(this).parent().after(add);
			aym_change();
		});

		$('.aym_wrap_form').on('click','.aym_delete_item',function(){
			var attr = $(this).attr('data-id');
			if(typeof attr !== typeof undefined && attr !== false){
				return false;
			}else{
				$(this).parent().remove();
			}
		});
	
	/*==================================================================================*/
	/*=================================== ELIMINAR DATOS ===============================*/
	/*==================================================================================*/
 
		/* ----------- ELIMINAR EL REGISTRO --------------- 	*/ 
		$('#aym_list_page').on('click','#aym_delete a.aym_ico_delete',function() {
			var pag_id = (this).id;
			
			new AyM_window('¿Está seguro que desea eliminar este registro?', {
				title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
				titleClass: 'anim warning',
				modal: true,
				buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
				callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						var aym_url = '/aymcms/actioncms';
						var aym_request_response = 'aym_list_error';
						var aym_data = new Object();
						aym_data.pag_id = pag_id;
						aym_data.action = 'D';
						aym_data.aym_page = $("#aym_page").val();
						aym_data.aym_page_size = $("#aym_page_size").val();
						aym_process_component(aym_data,aym_url,aym_request_response); 
					}
				}
			});
		});
	
	/*==================================================================================*/
	/*=================== ACCION PARA ACTUALIZAR PAGINA BLOQUEADA ======================*/
	/*==================================================================================*/
		
		$("#aym_list_page").on('click','.aym_checkbox_block', function() { 
			var object = $(this);
			var aym_url = '/aymcms/actioncms';
			var aym_request_response = 'aym_list_error';
			var aym_data = new Object();
			aym_data.pag_id = object.attr('data-id');
			aym_data.pag_hol = $(this).is(':checked') ? 1 : 0;
			aym_data.action = "UH";
			aym_data.aym_page =  $("#aym_page").val();
			aym_data.aym_page_size = $("#aym_page_size").val();
			aym_process_component(aym_data,aym_url,aym_request_response); 
 
		});
	
	/*==================================================================================*/
	/*=================== ACCION PARA ACTUALIZAR PAGINA PUBLICADA ======================*/
	/*==================================================================================*/
		
		$("#aym_list_page").on('click','.aym_checkbox_publish', function() { 
			var object = $(this);
			var aym_url = '/aymcms/actioncms';
			var aym_request_response = 'aym_list_error';
			var aym_data = new Object();
			aym_data.pag_id = object.attr('data-id');
			aym_data.pag_pub = $(this).is(':checked') ? 1 : 0;
			aym_data.action = "US";
			aym_data.aym_page =  $("#aym_page").val();
			aym_data.aym_page_size = $("#aym_page_size").val();
			aym_process_component(aym_data,aym_url,aym_request_response); 
 
		});

}); /*------------- FIN READY FUNCTION  -------------*/