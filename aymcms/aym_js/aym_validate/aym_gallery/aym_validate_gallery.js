$(document).ready(function() {
	

		/*VALIDACIÓN EDITAR CATEGORÍA DE UNA GALERIA*/
		$("#frm_add_gallery_category, #frm_edit_gallery_category").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			
			rules: {
				gal_cat_nam:{required:true,minlength:2, maxlength:150},
				gal_cat_des:{required:true,minlength:3, maxlength:255}
			},

			messages: {
				gal_cat_nam:{ required: " Digíte el Nombre", minlength:"Digíte mínimo 2 caracteres.", maxlength:"Digíte máximo 150 caracteres." },
				gal_cat_des:{ required: " Digíte la Descripción", minlength:"Digíte mínimo 3 caracteres.", maxlength:"Digíte máximo 255 caracteres."}
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
	
		
		/*VALIDACIÓN AGREGAR SUB-CATEGORÍA DE UNA GALERIA*/
		$("#frm_add_gallery_subcategory, #frm_add_gallery_subcategory").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			
			rules: {
				lan_id:{required:true,min:1},
				gal_cat_id:{required:true,min:1},
				gal_sub_cat_nam:{required:true,minlength:2, maxlength:150},
				gal_sub_cat_des:{required:true,minlength:3, maxlength:255}
			},
			
			messages:{
				lan_id:{required:"Por favor seleccione el Idioma.",min:"Por favor seleccione el Idioma."},
				gal_cat_id:{required:"Por favor seleccione la Galeria.",min:"Por favor seleccione la Galeria."},
				gal_sub_cat_nam:{ required: "Digíte el Nombre.", minlength:"Digíte mínimo 2 caracteres.", maxlength:"Digíte máximo 150 caracteres." },
				gal_sub_cat_des:{ required: "Digíte Descripción.",  minlength:"Digíte mínimo 3 caracteres.", maxlength:"Digíte máximo 255 caracteres."}
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
	
	/*FORMULARIO DE AGREGAR UNA GALERIA */
	$("#frm_add_gallery_image, #frm_edit_gallery_image").validate({
		onfocusout: function(element) {$(element).valid()},
		onkeyup: false,
		focusCleanup: true,
		focusInvalid: false,

		rules: {
			lan_id:{required:true,min:1},
			gal_cat_id:{required:true,min:1},
			gal_sub_cat_id:{required:true,min:1},
			gal_nam:{required:true,minlength:3},
			"gal_des[]":{required:true,minlength:3},
			gal_ima:{required:true,minlength:3},
			doc_nom:{required:true}
		},

		messages:{
			lan_id:{required:"Por favor seleccione el Idioma.",min:"Por favor seleccione el Idioma."},
			gal_cat_id:{required:"Por favor seleccione la Galeria.",min:"Por favor seleccione la Galeria."},
			gal_sub_cat_id:{required:"Por favor seleccione el Álbum.",min:"Por favor seleccione el Álbum."},
			gal_nam:{ required: " Digíte el Nombre.", minlength: "Digite Mínimo 2 Caracteres." , maxlength: "Digite Mínimo 150 Caracteres" },
			"gal_des[]":{ required: " Por favor digite la Descripción de la Foto.", minlength: "Digite Mínimo 3 Caracteres." , maxlength: "Digite Mínimo 255 Caracteres"},
			gal_ima:{required:"Por favor seleccione una Imagen.",min:"Por favor seleccione una ruta de la Imágen válida."},
			doc_nom:{required:"Insertar imagen"},
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