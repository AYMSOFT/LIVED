$(document).ready(function() {

		
/*=================================================================================== 
============================== CATEGORIA DE BANNER ================================== 
====================================================================================*/
	
/*==================================================================================*/
/*=================== ELIMINAR DATOS CATEGORIA DE BANNER ===========================*/
/*==================================================================================*/
 
	/* ----------- ELIMINAR EL REGISTRO --------------- */ 
	$('#aym_list_banner_category').on('click','#aym_delete a.aym_ico_delete',function() {
		var ban_cat_id = (this).id;
		new AyM_window('¿Está seguro que desea eliminar este registro?', {
			title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
			titleClass: 'anim warning',
			modal: true,
			buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
			callback: function(id) { 
				if (id > 0) { 
					return false; 
				} else {
					var aym_url = '/aymcms/actionbanner';
					var aym_request_response = 'aym_list_error';
					var aym_data = new Object();
					aym_data.ban_cat_id = ban_cat_id;
					aym_data.action = "DC";
					aym_data.aym_page =  $("#aym_page").val();
					aym_data.aym_page_size = $("#aym_page_size").val();
					aym_data.aym_order = $("#aym_order").val();
					aym_data.aym_order_type = $("#aym_order_type").val();
					aym_process_component(aym_data,aym_url,aym_request_response); 
				}
			}
		});
	});
	
/*==================================================================================*/
/*=======  AL SELECIONAR EL IDIOMA, MUESTRA LA CATEGORIA, Y CARGA LA TABLA =========*/
/*==================================================================================*/

	$("#frm_list_banner_category #lan_id").change(function() {
		$("#aym_page_size").change();
	}); /*FIN CATEGORIA DE BANNER*/
/*=================================================================================== 
===================================== BANNER ======================================== 
====================================================================================*/
	
	/*=================================================================================== 
	============================== ACTIVA DATETIMEPICKER ================================ 
	====================================================================================*/
	
	$('#ban_dat_tim_ini, #ban_dat_tim_fin').datetimepicker({		
		changeMonth: true,
		changeYear: true,
		controlType: 'select',
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss',
		currentText: 'Ahora',
		closeText: 'Listo',
		timeText: '',
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo','Junio', 'Julio', 'Agosto', 'Septiembre','Octubre', 'Noviembre', 'Diciembre'],
		monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr','May', 'Jun', 'Jul', 'Ago','Sep', 'Oct', 'Nov', 'Dic']
	});
	
	$('#ban_dat_tim_ini').on('change', function () { $('#ban_dat_tim_fin').datetimepicker('option', { minDate: $('#ban_dat_tim_ini').val()}); $('#ban_dat_tim_fin').val($('#ban_dat_tim_ini').val()); });

	
	/*==================================================================================*/
	/*=================================== ELIMINAR DATOS ===============================*/
	/*==================================================================================*/
 
		/* ----------- ELIMINAR EL REGISTRO --------------- */ 
		$('#aym_list_banner').on('click','#aym_delete a.aym_ico_delete',function() {
			var ban_id = (this).id;
			new AyM_window('¿Está seguro que desea eliminar este registro?', {
				title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
				titleClass: 'anim warning',
				modal: true,
				buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
				callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						var aym_url = '/aymcms/actionbanner';
						var aym_request_response = 'aym_list_error';
						var aym_data = new Object();
						aym_data.ban_id = ban_id;
						aym_data.ban_sta = $(this).is(':checked') ? 1 : 0;
						aym_data.action = "D";
						aym_data.aym_page =  $("#aym_page").val();
						aym_data.aym_page_size = $("#aym_page_size").val();
						aym_data.aym_order = $("#aym_order").val();
						aym_data.aym_order_type = $("#aym_order_type").val();
						aym_process_component(aym_data,aym_url,aym_request_response); 
					}
				}
			});
		});
	
	
	/*=================================================================================*/ 
	/*===================== CLICK EN LISTA DE RESULTADOS BUSQUEDA =====================*/
	/*=================================================================================*/
		
		$("#aym_search_results").on("click", ".aym_banner_result", function(){
			var ban_des = $(this).find("input").val();
			var ban_id = $(this).attr("id");
			var ban_cat_id = $('#ban_cat_id').val();
			var lan_id = $('#lan_id').val();
			var aym_page_size = $('#aym_page_size').val();
			var aym_page = $('#aym_page').val();
			var aym_order = $('#aym_order').val();
			var aym_order_type = $('#aym_order_type').val();
			$("#aym_search_results").hide();
			$("input[name=aym_tex_sea]").val(ban_des);
			window.location.href = '/aymcms/admbanner/aym_edit_banner/'+ban_id+'/'+ban_cat_id+'/'+lan_id+'/'+aym_order+'/'+aym_order_type+'/'+aym_page_size+'/'+aym_page;
		});
	
	
	/*==================================================================================*/
	/*======================== ACCION PARA ACTUALIZAR ESTADO ===========================*/
	/*==================================================================================*/
		
		$(".aym_wrap_list").on('click', '.aym_checkbox_status',function() { 
	
			var object = $(this);
			var aym_url = '/aymcms/actionbanner';
			var aym_request_response = 'aym_list_user_error';
			var aym_data = new Object();
			aym_data.ban_id = object.attr('data-id');
			aym_data.ban_sta = $(this).is(':checked') ? 1 : 0;
			aym_data.action = "US";
			aym_data.aym_page =  $("#aym_page").val();
			aym_data.aym_page_size = $("#aym_page_size").val();
			aym_data.aym_order = $("#aym_order").val();
			aym_data.aym_order_type = $("#aym_order_type").val();
			aym_process_component(aym_data,aym_url,aym_request_response); 
 
		});	
	/*==================================================================================*/
	/*================= AL SELECIONAR EL IDIOMA, MUESTRA LA CATEGORIA  =================*/
	/*==================================================================================*/

	$("#frm_add_banner #lan_id, #frm_edit_banner #lan_id" ).change(function() {
		$('#aym_load_opacity').css('display','block');
		var lan_id = $(this).val();
		
		$.ajax({
			// INCLUSIÓN --> COMPLEMENTO QUE LISTA LAS CATEGORIAS
			url: "/aymcms/aym_complement/aym_banner/aym_com_list_all_banner_category.php",
			type: "get",
			data: { lan_id:lan_id },
			success: function(aym_response){
				$("#ban_cat_id").html(aym_response);
				$('#aym_load_opacity').css('display','none');
			},
			error:function(){
				alert("failure");
			}
		});
	});
	
	$("#frm_add_banner #lan_id").change();
	
	/*==================================================================================*/
	/*========= AL SELECIONAR EL IDIOMA, MUESTRA LA CATEGORIA Y CARGA LA TABLA =========*/
	/*==================================================================================*/

		$("#frm_list_banner #lan_id").change(function() {
			$('.aym_wrap_list').addClass('preloader');
			var lan_id = $(this).val();
			
			$.ajax({
				// INCLUSIÓN --> COMPLEMENTO QUE LISTA LAS CATEGORIAS
				url: "/aymcms/aym_complement/aym_banner/aym_com_list_all_banner_category.php",
				cache: false,
				timeout: 5000,
				type: "get",
				data: { lan_id:lan_id },
				success: function(aym_response){
					$("#ban_cat_id").html(aym_response).change();
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


	
		$('#aym_list_banner').on('click','.aym_ico_img', function() {
			var aym_url = $(this).attr("url");
			AyM_window.img(aym_url);
		});
	
}); /*------------- FIN READY FUNCTION  -------------*/