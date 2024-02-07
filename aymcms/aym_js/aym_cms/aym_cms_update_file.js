$(document).ready(function() { 

	/*==================================================================================*/
	/*============================ ELIMINAR IMAGENES DE PAGINA =========================*/
	/*==================================================================================*/

		$('#frm_edit_page').on('click','span.aym_delete_item',function() {
			var attr = $(this).attr('data-id');
			if(typeof attr !== typeof undefined && attr !== false){
				var pag_ima_id = $(this).attr('data-id');
				var pag_id = $(this).attr('data-pag');
				new AyM_window('¿Está seguro que desea eliminar este registro?', {
					title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
					titleClass: 'anim warning',
					modal: true,
					buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
					callback: function(id) { 
						if (id > 0) { 
							return false; 
						} else {

							var action = 'DFB';

							$.ajax({
								cache:false,
								timeout: 5000,
								// INCLUSIÓN --> COMPONENTE 
								url: "/aymcms/actioncms",
								type: "POST",
								data: { pag_ima_id:pag_ima_id, pag_id:pag_id,action:action},
								success: function(aym_response){
									$('#aym_return_files').change(); // ------> ACTUALIZA LA TABLA DESPUES DE ELIMINAR 
									//$('#aym_load_opacity').css('display','none');	
									$("#aym_list_cms_error").html(aym_response);
									return(false);
								},
								error:function(jqXHR, textStatus){
									if(textStatus == 'timeout'){     
										alert(' El tiempo de espera ha superado 5 segundos. \n\n El sistema intentará procesar la solicitud nuevamente');         
										$('#aym_return_files').change(); // ------> ACTUALIZA LA TABLA DESPUES DE ELIMINAR 
									} else {
										alert("Failure");
										location.reload();
									}
								}
							});
							return false; 
						}
					}
				});
			}
		});


	/*==================================================================================*/
	/*========================= AJAX EDITAR UNA IMAGEN DE PAGINA =======================*/
	/*==================================================================================*/
	
		$("body").on("submit","#aym_send_banner_file",function(e){
			e.preventDefault();

			var form = new FormData(this);
			$("#aym_popup_progress").show();
			$.ajax({
				xhr: function() {
					var xhr = new window.XMLHttpRequest();
					// Upload progress
					xhr.upload.addEventListener("progress", function(evt){
						if (evt.lengthComputable) {
							var percentComplete = Math.floor((evt.loaded / evt.total) * 100);

							$("#aym_popup_progress").val(percentComplete);
							$("#aym_popup_progress").data('value', percentComplete);
						}
					}, false);

					// Download progress
					xhr.addEventListener("progress", function(evt){
						if (evt.lengthComputable) {
							var percentComplete = Math.floor((evt.loaded / evt.total) * 100);

							$("#aym_popup_progress").val(percentComplete);
							$("#aym_popup_progress").data('value', percentComplete);
						}
					}, false);

					return xhr;
				},
				type: "POST",
				url: "/aymcms/actioncms",
				cache: false,
				contentType: false,
				processData: false,
				data: form,
				success: function(){
					$(".aym_layer").remove();
					$('#aym_return_files').change();		
					return false;
				}
			});		
		});

	/*==================================================================================*/
	/*============================ LISTAR IMAGENES DE PAGINAS ==========================*/
	/*==================================================================================*/
	
		$('#frm_edit_page').on('change','#aym_return_files',function(){
			var pag_id = $('#pag_id').val();
			var url = '/aymcms/aym_complement/aym_cms/aym_com_list_banner_files.php';
			$.ajax({
				type:'GET',
				timeout: 10000,
				url:url,
				cache:false,			
				data: {pag_id:pag_id},			
				success: function(aym_response){
					$('#aym_table_files').removeClass('aym_hidden').html(aym_response);
					var img = $('#aym_table_files').find('img');
					var row_src = Array();
					img.each(function(index){
						row_src[index] = $(this).attr('src');
						$(this).attr('src','/admin/aym_image/aym_icon/aym_cohetin.gif');
					});
					setTimeout(function(){
						img.each(function(index){
							$(this).attr('src',row_src[index]);
						});
					},1500);
				},
				error:function(jqXHR, textStatus){
					if(textStatus==="timeout"){
						alert("El tiempo de espera se ha agotado.");
						location.reload();
					} else if(jqXHR.status===0){
						alert("Se ha perdido su conexión a internet. Verifique su red.");
					}				
				}
			});
		});

	/*==================================================================================*/
	/*============================ EDITAR UNA IMAGEN DE PAGINA =========================*/
	/*==================================================================================*/

		$('#frm_edit_page').on('click','.aym_edit_item',function(){
			var pag_ima_id = $(this).attr('data-id');
			var pag_id = $(this).attr('data-pag');
			var url = '/aymcms/aym_complement/aym_cms/aym_com_update_banner_file.php';
			$.ajax({
				type:'GET',
				timeout: 10000,
				url:url,
				cache:false,			
				data: {pag_ima_id:pag_ima_id,pag_id:pag_id},			
				success: function(aym_response){
					$('body').append(aym_response);
				},
				error:function(jqXHR, textStatus){
					if(textStatus==="timeout"){
						alert("El tiempo de espera se ha agotado.");
						location.reload();
					} else if(jqXHR.status===0){
						alert("Se ha perdido su conexión a internet. Verifique su red.");
					}				
				}
			});
		});

		$("body").on("click","#aym_cancel_update_policy",function(){
			$(".aym_layer").remove();
			return false;
		});
 
	
}); // Fin Document Ready

	