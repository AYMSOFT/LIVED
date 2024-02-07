$(document).ready(function() {
	
		/*VALIDACIÓN AGREGAR CATEGORÍA DEE NOTICIAS*/
		$("#frm_add_news_category").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			
			rules: {
				lan_id: {required: true, min:1},
				new_cat_nam: {required: true, minlength: 2, maxlength:50},
				new_cat_des: {required: true, minlength: 3,maxlength:100},
				new_cat_ord: {required: true, number:true},
			},

			messages: {
				lan_id: { required: "El campo Idioma es obligatorio", min: "Seleccione un Idioma" },
				new_cat_nam: { required: "Nombre no válido", minlength: "Digite Mínimo 2 Caracteres." , maxlength: "Digite Mínimo 150 Caracteres" },
				new_cat_des: { required: "Descripción no válida", minlength: "Digite Mínimo 3 Caracteres." , maxlength: "Digite Mínimo 255 Caracteres" },
				new_cat_ord: { required: "El orden de la Categoría es obligatorio", number: "El orden debe ser un número" },
			},				

			// Mensaje de error
			errorPlacement: function(error, element) {				
				element.attr('placeholder', error.text());
				element.val('');
			},
			highlight: function(element) {	
				$(element).parent().addClass('error');
			},
			unhighlight: function(element) {
				$(element).parent().removeClass('error');
			}
		});
	
	
		/*VALIDACIÓN AGREGAR NOTICIA*/
		$("#frm_add_news").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			ignore: '',
			
			rules: {
				lan_id:{required:true,min:1},
				new_cat_id:{required:true,min:1},
				new_lea: {required: true, minlength: 3, maxlength:300},
				new_tit: {required: true, minlength: 3, maxlength:150},
				//doc_nom:{required:true}
			},

			messages: {
				lan_id:{required:"Por favor seleccione un Idioma.",min:"Por favor seleccione un Idioma válido."},
				new_cat_id:{required:"Por favor selecione la Categoría.",min:"Por favor selecione una Categoría válida."},
				new_tit: { required: "Digíte titulo", minlength: "Digite Mínimo 3 Caracteres." , maxlength: "Digite Mínimo 150 Caracteres" },
				new_lea: { required: "Digíte Subtitulo", minlength: "Digite Mínimo 3 Caracteres." , maxlength: "Digite Mínimo 300 Caracteres" },
				//doc_nom:{required:"Insertar imagen"},
				
			},				

			// Mensaje de error
			errorPlacement: function(error, element) {
				if(element.attr('type') !== 'file'){
					element.attr('placeholder', error.text());
					element.val('');
				}else{
					element.siblings('.aym_frm_image').addClass('error');
				}
			},
			highlight: function(element) {	
				$(element).parent().addClass('error');
			},
			unhighlight: function(element) {
				$(element).parent().removeClass('error');
			}
		});
		
		/*VALIDACIÓN EDITAR USAURIO*/
		$("#frm_edit_news").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			
			rules: {
				lan_id:{required:true,min:1},
				new_cat_id:{required:true,min:1},
				new_lea: {required: true, minlength: 3, maxlength:300},
				new_tit: {required: true, minlength: 3, maxlength:150}
			},

			messages: {
				lan_id:{required:"Por favor seleccione un Idioma.",min:"Por favor seleccione un Idioma válido."},
				new_cat_id:{required:"Por favor selecione la Categoría.",min:"Por favor selecione una Categoría válida."},
				new_tit: { required: "El campo titulo es obligatorio", minlength: "Digite Mínimo 3 Caracteres." , maxlength: "titulo No valido" },
				new_lea: { required: "El campo Subtitulo es obligatorio", minlength: "Digite Mínimo 3 Caracteres." , maxlength: "Subtitulo No valido" }
			},					

			// Mensaje de error
			errorPlacement: function(error, element) {				
				element.attr('placeholder', error.text());
				element.val('');
			},
			highlight: function(element) {	
				$(element).parent().addClass('error');
			},
			unhighlight: function(element) {
				$(element).parent().removeClass('error');
			}
		});
	
	
});