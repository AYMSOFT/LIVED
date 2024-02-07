$(document).ready(function() {
	
		/* ============================== BOTON VOLVER / CANCELAR ============================== */
		$("#aym_btn_back").click(function() {	
			
			var aym_url = $(this).attr("dir");
			
			if (aym_url == '') { 
				return false; 
			} else {
				window.location.replace(aym_url);
				return false; 
			}
			
		});	
	
		
		/* ============================== BOTON ACEPTAR / ENVIAR ============================== */
		$("#aym_btn_submit").click(function() {	
			$('#aym_load_opacity').css('display','block');
		});	
	
	
		/* ============================== VENTANAS ============================== */
		
     
		
		// ---> ELIMINAR REGISTROS DESDE UNA TABLA 
        $('#aym_delete a.aym_ico_delete').on('click', function() {
		  var aym_url = $(this).attr("url");
          new AyM_window('¿ Está seguro que desea eliminar este registro ?', {
			  title: '!!! ATENCIÓN !!!',
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
		
		 
		// ---> ELIMINAR DESDE UN LINK 
        $('#aym_link_delete').on('click', function() {
		  var aym_url = $(this).attr("url");
          new AyM_window('¿Está seguro que desea eliminar este registro?', {
			  title: '!!! ATENCIÓN !!!',
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
		
		 $('#yes-cancel-buttons').on('click', function() {
		  var aym_url = $(this).attr("class");
          new AyM_window('¿ Está seguro que desea <strong>Asignar / Quitar</strong> las acciones a este registro ?', {
			  title: '!!! ATENCIÓN !!!',
			  titleClass: 'anim warning',
			  modal: true,
			  buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'Cancel', val:1}], 
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
    
       
		$('main').on('click', '.aym_load_url, .aym_load', function() {
			$('#aym_load_opacity').css('display','block');
			var aym_url = $(this).attr("url");
			AyM_window.load(aym_url);
			$('#aym_load_opacity').css('display','none');
        });
		
        $('.aym_load_img').on('click', function() {
			
			$('#aym_load_opacity').css('display','block');
			var aym_url = $(this).attr("url");
			AyM_window.img(aym_url);
			$('#aym_load_opacity').css('display','none');
        });
		
		$('#aym_load_image').on('click', function() {
			$('#aym_load_opacity').css('display','block');
			var aym_url = $(this).attr("url");
			AyM_window.img(aym_url);
			$('#aym_load_opacity').css('display','none');
        });
		
		
		$('#aym_devolver').on('click', function() {
			var aym_url = $(this).attr("class");
			AyM_window.load(aym_url);
        });
		
		$("#aym_img").on('click', function() {
            var aym_url = $(this).attr("url");
	        AyM_window.img(aym_url);
        });
		
		$('#aym_delete a.aym_ico_img').on('click', function() { 
			var aym_url = $(this).attr("url");
	        AyM_window.img(aym_url);
        });      
});