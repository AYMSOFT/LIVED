/* **************************** AYMCORE V: 14.0 ********************
# SCRIPT PARA LA ADMINISTRACIÓN DE LAS FUNCIONES DE LOS PERFILES
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
*/


/* BEGIN READY FUNCTION */
$(document).ready(function() {

		/* ELIMINAR EL REGISTRO */ 
		$('#aym_list_profile').on('click','#aym_delete a.aym_ico_delete',function() {
			var pro_id = (this).id;
			new AyM_window('¿Está seguro que desea eliminar este registro?', {
			title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
			titleClass: 'anim warning',
			modal: true,
			buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
			callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						var aym_url = '/admin/actionprofile';
						var aym_request_response = 'aym_list_error';
						var aym_data = new Object();
						aym_data.pro_id = pro_id;
						aym_data.sta_id = $(this).is(':checked') ? 1 : 0;
						aym_data.action = "D";
						aym_data.aym_page =  $("#aym_page").val();
						aym_data.aym_size_page = $("#aym_size_page").val();
						aym_data.aym_order = $("#aym_order").val();
						aym_data.aym_order_type = $("#aym_order_type").val();
						aym_process_component(aym_data,aym_url,aym_request_response); 
					}
				}
			});
		});

		/* VALIDA LAS FUNCIONES SELECCIONADAS */
		$('#frm_add_funcion_profile button').click(function(){

			new AyM_window('¿Está seguro que desea Asignar / Quitar las funciones seleccionadas a este perfil?', {
				title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
				titleClass: 'anim warning',
				modal: true,
				buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
				callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						$('#frm_add_funcion_profile').submit();
					}
				}
			});
		});
	
		
		$("#frm_list_profile #aym_search_results").on("click", ".aym_profile_result", function(){
			var pro_nam = $(this).find("input").val();
			var pro_id = $(this).attr("id");
			var aym_page_size = $('#aym_page_size').val();
			var aym_page = $('#aym_page').val();
			var aym_order = $('#aym_order').val();
			var aym_order_type = $('#aym_order_type').val();
			$("#aym_search_results").hide();
			$("input[name=aym_tex_sea]").val(pro_nam);
			window.location.href = '/admin/admprofile/aym_edit_profile/'+pro_id+'/'+aym_order+'/'+aym_order_type+'/'+aym_page_size+'/'+aym_page;
		});

	
}); 
/* END READY FUNCTION */

