/***************************** AYMCMS V: 7.0 ********************
# SCRIPT PARA LA ADMINISTRACIÓN DE CORREOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023
*/

$(function(){
	/*=================================================================================*/ 
	/*=================================== DATEPICKER ==================================*/
	/*=================================================================================*/

		$("#lis_dat_ini").datepicker({dateFormat: 'yy-mm-dd',minDate:0,changeMonth: true,changeYear: true,inline: true});
		$('#lis_dat_ini').on('change', function () { $('#lis_dat_fin').datepicker('option', { minDate: $('#lis_dat_ini').val() }); });
		$("#lis_dat_fin").datepicker({dateFormat: 'yy-mm-dd',minDate:0,changeMonth: true,changeYear: true,inline: true});
	
	/*==================================================================================*/
	/*=================================== ELIMINAR DATOS ===============================*/
	/*==================================================================================*/
 
		/* ----------- ELIMINAR EL REGISTRO --------------- 	*/ 
		$('#aym_list_mail').on('click','#aym_delete a.aym_ico_delete',function() {
			var lis_id = (this).id;
			new AyM_window('¿Está seguro que desea eliminar este registro?', {
				title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
				titleClass: 'anim warning',
				modal: true,
				buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
				callback: function(id) { 
					if (id > 0) { 
						return false; 
					} else {
						var aym_url = '/aymcms/actionlistmail';
						var aym_request_response = 'aym_list_error';
						var aym_data = new Object();
						aym_data.lis_id = lis_id;
						aym_data.action = 'D';
						aym_data.aym_page = $("#aym_page").val();
						aym_data.aym_page_size = $("#aym_page_size").val();
						aym_process_component(aym_data,aym_url,aym_request_response); 
					}
				}
			});
		});
	
});