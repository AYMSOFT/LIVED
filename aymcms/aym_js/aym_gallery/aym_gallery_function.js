$(document).ready(function() {
	
	/*==================================================================================*/
	/*========================== ELIMINAR DATOS CATEGORIA ==============================*/
	/*==================================================================================*/
	
		$('#aym_list_gallery_category').on('click','#aym_delete a.aym_ico_delete',function() {
			var gal_cat_id = (this).id;
			new AyM_window('¿Está seguro que desea eliminar este registro?', {
			title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
			titleClass: 'anim warning',
			modal: true,
			buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
			callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						var aym_url = '/aymcms/actiongallery';
						var aym_request_response = 'aym_list_error';
						var aym_data = new Object();
						aym_data.gal_cat_id = gal_cat_id;
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
	/*=========================== ELIMINAR DATOS SUBCATEGORIA ==========================*/
	/*==================================================================================*/
 
		$('#aym_list_gallery_subcategory').on('click','#aym_delete a.aym_ico_delete',function() {
			var gal_sub_cat_id = (this).id;
			new AyM_window('¿Está seguro que desea eliminar este registro?', {
			title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
			titleClass: 'anim warning',
			modal: true,
			buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
			callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						var aym_url = '/aymcms/actiongallery';
						var aym_request_response = 'aym_list_error';
						var aym_data = new Object();
						aym_data.gal_sub_cat_id = gal_sub_cat_id;
						aym_data.action = "DS";
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
	/*=========================== ELIMINAR DATOS FOTOS ==========================*/
	/*==================================================================================*/
 
		$('#aym_list_gallery_image').on('click','#aym_delete a.aym_ico_delete',function() {
			var gal_id = (this).id;
			new AyM_window('¿Está seguro que desea eliminar este registro?', {
			title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
			titleClass: 'anim warning',
			modal: true,
			buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
			callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						var aym_url = '/aymcms/actiongallery';
						var aym_request_response = 'aym_list_error';
						var aym_data = new Object();
						aym_data.gal_id = gal_id;
						aym_data.action = "DI";
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
		
		$("#aym_search_results").on("click", ".aym_galley_result", function(){
			var gal_des = $(this).find("input").val();
			var gal_id = $(this).attr("id");
			var lan_id = $('#lan_id').val();
			var gal_cat_id = $('#gal_cat_id').val();
			var gal_sub_cat_id = $('#gal_sub_cat_id').val();
			var aym_order = $('#aym_order').val();
			var aym_order_type = $('#aym_order_type').val();
			var aym_page_size = $('#aym_page_size').val();
			var aym_page = $('#aym_page').val();
			$("#aym_search_results").hide();
			$("input[name=aym_tex_sea]").val(gal_des);
			window.location.href = '/aymcms/admgalley/aym_edit_galley/'+gal_id+'/'+lan_id+'/'+gal_cat_id+'/'+gal_sub_cat_id+'/'+aym_order+'/'+aym_order_type+'/'+aym_page_size+'/'+aym_page;
		});
	
	
	/*==================================================================================*/
	/*======================== ACCION PARA ACTUALIZAR ESTADO ===========================*/
	/*==================================================================================*/
		
		$(".aym_wrap_list").on('click', '.aym_checkbox_status',function() { 
	
			var object = $(this);
			var aym_url = '/aymcms/actiongallery';
			var aym_request_response = 'aym_list_error';
			var aym_data = new Object();
			aym_data.gal_id = object.attr('data-id');
			aym_data.gal_fea = $(this).is(':checked') ? 1 : 0;
			aym_data.action = "US";
			aym_data.aym_page =  $("#aym_page").val();
			aym_data.aym_page_size = $("#aym_page_size").val();
			aym_data.aym_order = $("#aym_order").val();
			aym_data.aym_order_type = $("#aym_order_type").val();
			aym_process_component(aym_data,aym_url,aym_request_response); 
 
		});
	
	
	
	/*=================================================================================*/ 
	/*================================= AGREGAR IMAGEN ================================*/
	/*=================================================================================*/
	
		$('.aym_wrap_form').on('click','.aym_frm_image',function(){
			$(this).siblings('input[type=file]').click();
		});

		$('.aym_add_item').click(function(){
			var add = '<div class="aym_frm_images"><div><div class="aym_frm_row"><label>Descripción de imagen</label><input type="text" name="gal_des[]" id="gal_des"></div><div class="aym_frm_image"><figure class="con_ima_thumb"><img src="/admin/aym_image/aym_icon/aym_add_image.png"></figure>Agregar imagen</div><input class="aym_hidden aym_file" name="aym_fil[]" type="file" id="con_ima"></div><span class="aym_delete_item"></span></div>';
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
	
	
	
	$('#aym_list_gallery_image').on('click','.aym_ico_img', function() {
			var aym_url = $(this).attr("url");
			AyM_window.img(aym_url);
		});
	/*==================================================================================*/
	/*============== AL SELECIONAR EL IDIOMA, MUESTRA LA CATEGORIA / GALERIA ===========*/
	/*==================================================================================*/

		$("#frm_add_gallery_subcategory #lan_id, #frm_edit_gallery_subcategory #lan_id, #frm_list_gallery_subcategory #lan_id, #frm_add_gallery_image #lan_id , #frm_list_gallery_image #lan_id,#frm_edit_gallery_image #lan_id").change(function() {
			$('#aym_load_opacity').css('display','block');
			var lan_id = $(this).val();
			$.ajax({
				// INCLUSIÓN --> COMPLEMENTO QUE LISTA LAS CATEGORIAS
				url: "/aymcms/complement/gallery/list_all_gallery_category",
				type: "get",
				data: { lan_id:lan_id},
				success: function(aym_response){
					$("#gal_cat_id").html(aym_response);
					$("#gal_cat_id").change();
					$("#aym_page_size").change();
					$('#aym_load_opacity').css('display','none');
				},
				error:function(){
					alert("failure");
				}
			});

		}); 
		$("#frm_add_gallery_subcategory #lan_id,#frm_list_gallery_subcategory #lan_id ,#frm_add_gallery_image #lan_id ,#frm_edit_gallery_image #lan_id" ).change();
			
	/*==================================================================================*/
	/*================= AL SELECIONAR GALERÍA, MUESTRA LOS ALBUMES =====================*/
	/*==================================================================================*/
	
	$("#frm_add_gallery_image #gal_cat_id, #frm_edit_gallery_image #gal_cat_id , #frm_list_gallery_image #gal_cat_id").change(function() {
		var gal_cat_id = $('#gal_cat_id').val();
		var lan_id = $(this).val();
		
		$.ajax({
			url: "/aymcms/complement/gallery/list_all_gallery_subcategory",
			type: "get",
			data: { gal_cat_id:gal_cat_id,lan_id:lan_id },
			success: function(aym_response){
				$("#gal_sub_cat_id").html(aym_response);
			},
			error:function(){
				alert("failure");
			}
		});
	});

	
}); /*------------- FIN READY FUNCTION  -------------*/

$(document).ready(function(){

	var extensionesValidas = ".png, .gif, .jpeg, .jpg";

	// Cuando cambie #fichero
	$("#con_ima").change(function () {
		$('#msg_validate').text('');
		if(validarExtension(this)) {
		    verImagen(this);
		}
	});
	
	$("#frm_add_gallery_image").submit(function (){ 
		$('#con_ima').next(".aym_file_msg").remove();
		if($("#con_ima").val() == '')
		{
			$('#con_ima').parent().append('<p class="aym_file_msg">El archivo es obligatorio.</p>');
			return false;
		}
	});
	// Validacion de extensiones permitidas

	function validarExtension(datos) {
		
		var ruta = datos.value;
		var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
		var extensionValida = extensionesValidas.indexOf(extension);

		if(extensionValida < 0) {
				$("#con_ima").prev().addClass("aym_error_dashed");
			 	$('#con_ima').parent().append('<p class="aym_file_msg">El archivo .'+extension+' no es una imagen.</p>');
				$("#con_ima").val('');
				$("#con_ima_thumb").removeClass("aym_thumb_img");
				$('#con_ima_thumb').attr('src', "");
			 	$('#con_ima_thumb img').attr('src', "/admin/aym_image/aym_icon/aym_add_image.png");			
				return false;
			} else {
				$("#con_ima").prev().removeClass("aym_error_dashed");
				$('#con_ima').next(".aym_file_msg").remove();
				$('#con_ima_thumb img').attr('src', "");
				$('#con_ima_thumb').attr('src', ruta);
				$("#con_ima_thumb").addClass("aym_thumb_img");
			  	return true;
		}
	}
	 // Vista preliminar de la imagen.
	function verImagen(datos) {

	    if (datos.files && datos.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#con_ima_thumb img').attr('src', e.target.result);
	        };
	        reader.readAsDataURL(datos.files[0]);
	    }
	}
	
});

