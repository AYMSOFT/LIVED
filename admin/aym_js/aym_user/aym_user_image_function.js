/* **************************** AYMCORE V: 14.0 ********************
# SCRIPT PARA LA ADMINISTRACIÓN DE IMAGENES USUARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
*/

/* BEGIN READY FUNCTION */
$(document).ready(function() {
	
	/* FUNCION PARA HABILITAR EL BOTON DE ENVIAR */
	$('body').on('click change', '#aym_wrap_image_crop, .cr-slider, .aym_file', function(){
		$('.aym_button_crop').removeClass('disabled');
	});

	/*ABRE VENTANA PARA SUBIR IMAGEN*/
	$('body').on('click', '.aym_open_file', function(){
		$('input[name=doc_nom]').click();
	});

	$('body').on('click', '#aym_link_delete', function() {
		var aym_url = $(this).attr("url");
		new AyM_window('¿Está seguro que desea eliminar esta foto?', {
			title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
			titleClass: 'anim warning',
			modal: true,
			buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
			callback: function(id) { 
				if (id > 0) { 
					return false; 
				} else {
					window.location.replace(aym_url);
					return false; 
				}
			}
		});
	});
}); 
/* FIN READY FUNCTION */