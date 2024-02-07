

$(function(){
	
	/* =================================================================================
	============================ EDITAR VALORES DESDE LA TABLA =========================
	==================================================================================== */

	/* ------------- EVENTO -> PARA EDITAR LOS DATOS DESDE LA TABLA ------------- */ 
		$('[id^=aym_list_]').on('dblclick','.aym_write', function () {
			
			var parent_list = $(this).closest('[id^=aym_list_]');
			var object = $(this);
			var parent = object.parent('tr');
			var parent_id = parent.attr('data-id');
			var field = $('#'+object.attr('data-name'));
			var fieldclass = field.attr('class');
			var field_type = field.attr('type');
			var field_id = parent_list.find('[id=data-id]');
			var add_Height=0;
			var tagName = field.prop('tagName');

			if(tagName === "TEXTAREA"){ 
				add_Height=140; 
			}//Tamaño en alto del textarea

			field_id.val(parent_id);
			parent.children('.aym_write').each(function(index, element) { 
				$('#'+$(element).attr('data-name')).val($(element).text()); 
				  
			});
			
			if(tagName == 'SELECT'){
				field.on('change',  sendData);
				var value = object.attr('data-value');
				if(value!=''){
					$("#"+object.attr('data-name')).val(value);
				}
			}else if(fieldclass == 'aym_input_color'){
				field.on('change',  sendData);
				var value = object.attr('data-value');
				if(value!=''){
					$("#"+object.attr('data-name')).val(value);
				}

				parent.children('.aym_input_color').each(function(index, element) { 
					$('#'+$(element).attr('data-name')).select();
					new jscolor($(element).attr('data-name'));
				});
				
			}else{
				parent.children('.aym_write').each(function(index, element) { 
					$('#'+$(element).attr('data-name')).val($(element).text()); 
					$('#'+$(element).attr('data-name')).select();
				});
			} 

			field.css({ left:object.offset().left, top:object.offset().top, height:object.height()+20, width:object.width()+20 });
			field.addClass('show');
			field.trigger('focus');
			if(field_type !== "datetime" && field_type !== "date" && field_type !== "timestamp"){
				field.on('blur',  sendData);
				
				field.on('keyup', function (e) { if (e.keyCode === 13) { field.trigger('blur'); field.off('keyup'); } });
			}
		});

		$('.aym_date_time').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			onClose: sendData
		});
		
	
});
	/* =================================================================================
	 ================ FUNCION PARA ENVIAR AL COMPONENTE (SIMPLE) =====================
	 ================================================================================= */
	
	 function aym_process_component(aym_data,aym_url,aym_request_response,aym_change = null){
		$.ajax({
			// INCLUSIÓN --> COMPLEMENTO QUE LISTA LAS CATEGORIAS aym_change es para hacer proceso de actualización en algún campo
			url: aym_url,
			type: "POST",
			data: aym_data,
			success: function(aym_response){
				// VENTANA VIEJA
				// if(aym_response.ReturnStatus>0 || aym_response.ReturnStatus === null){
				// 	var html = new AyM_window(aym_response.Msg, {
				// 		modal: true,
				// 		title: '<img src="/admin/aym_image/aym_icon/aym_ico_alert.png"><span>ATENCIÓN</span>', 
				// 		titleClass: 'anim warning', 
				// 		buttons: [{id: 0, label: 'Aceptar', val: 'X'}]
				// 	});
				// }
				
				
				/*$('#aym_page_size').val(0);*/
				$('#aym_page_size').change();
				if(aym_change)
					$('#'+aym_change).change();
				aym_push_common(aym_response,aym_request_response);
			},
			error:function(error){
				Alert.error(error,"Error Interno",{displayDuration: 600, pos: 'top'});
				console.log(error);
			}
		});
	}

/* =================================================================================
============= FUNCION PARA ENVIAR AL COMPONENTE (EDIT TABLE) ====================
================================================================================= */

	

function sendData() {
			$('.aym_wrap_list').addClass('preloader');
			var form = $(this).parent('form');
			var field = $(this);
			var parent = $('tr[data-id='+$('#data-id').val()+']');
			var object = parent.children('td[data-name='+field.attr('name')+']');
			object.addClass('aym_small_load_opacity');
			field.removeClass('show');
			$('#aym_loading').addClass('show');

			$.ajax({
				url: form.attr('action'),
				cache: false,
				type: form.attr('method'),
				data: form.serialize(),
				success: function(aym_response){ 
					aym_push_common(aym_response);
					// VENTANA ANTIGUA
					// aym_response=JSON.parse(aym_response); 
					// if(aym_response.ReturnStatus>0){
					// 	$('#aym_list_error').html(aym_response.Msg);
					// }
					$('#aym_loading').removeClass('show');
					/*$('#aym_page_size').val(0);*/
					$('.aym_wrap_list').removeClass('preloader');
					object.removeClass('aym_small_load_opacity');
					$('#aym_page_size').change();
				}
			});

		field.off('blur');

	}

