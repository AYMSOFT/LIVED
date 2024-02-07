$(document).ready(function() {	
	var aym_restart = false;
	/*DETENER EL ENVIO DEL FORMULARIO CUANDO SE PRESIONA ENTER*/
	function stopRKey(evt) {
		var evt = (evt) ? evt : ((event) ? event : null);
		var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
		if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
	}
	document.onkeypress = stopRKey;
	
	/*CAPTURA TECLA QUE SE ESTA PRESIONANDO EN EL FILTRO*/
	$('input[name=aym_tex_sea]').on({
		click: function(){
			$('.aym_search').css('width', '300px');
		},
		blur: function(){
			$('.aym_search').css('width', '200px');
		}
	});
	$('input[name=aym_tex_sea]').keyup(function(event){
		var aym_tex_sea = $('input[name=aym_tex_sea]').val();
		var res = "";
		var aym_data_module = $(this).attr('data-module');
		if(aym_tex_sea.length==0 && aym_restart==true){
			$('[id^=frm_list_] #aym_page_size').change();
			aym_restart = false;
		}
		if(aym_tex_sea.length>2){
			
			aym_restart = true;
			
			if(event.which==13){
				$('#aym_page').val(0);
				$('[id^=frm_list_] #aym_page_size').change();
				$("#aym_search_results").hide();
			}else{		
				
				var aym_data = $('[id^=frm_list]').serialize();
					
				$.ajax({
					type: 'POST',
					url: '/admin/complement/'+aym_data_module+'/list/search',
					data: aym_data,
					success: function(respuesta){
						if(respuesta===""){
							res = "<div class='aym_no_result'>Sin resultados</div>";
						} else {
							res = respuesta;
						}
						$("#aym_search_results").html(res);
						$("#aym_search_results").show();						
					}
				});
			}
		} else {
			$("#aym_search_results").hide();
		}
	});
	
	
}); /*------------- FIN READY FUNCTION  -------------*/