/* **************************** AYMCORE V: 14.0 ********************
# SCRIPT PARA CONTROLAR EL TIEMPO DE INACTIVIDAD
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
*/   

	//var appTimeDelay = 0.30; // MINUTOS PRUEBAS
    //var appTimeDelay2 = 1; // MINUTOS PRUEBAS
    
	var appTimeDelay = 30; // MINUTOS
	var appTimeDelay2 = 35; // MINUTOS  


	var appFunction = function () {
		new AyM_window("Actualmente su sesión se encuentra inactiva.<br>¿Desea ampliar el tiempo?", {
			title: '<img src="/admin/aym_image/aym_icon/aym_ico_alert.png"><span>ATENCIÓN</span>', 
			titleClass: 'anim warning out', 
			buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}],
			callback: function(val) {
				if (val > 0) { 
					window.location.replace("/admin/logout");
				} else { 
					return false;
				}
			}
		});
		$('.btn').addClass('out');
	};

	var appFunction2 = function () {
		new AyM_window("Su sesión ha caducado.", {
			title: '<img src="/admin/aym_image/aym_icon/aym_ico_alert.png"><span>ATENCIÓN</span>', 
			titleClass: 'anim warning out', 
			buttons: [{id: 0, label: 'Salir', val: 0}],
			callback: function(val) {
				window.location.replace("/admin/logout"); 
			}
		});
		$('.btn').addClass('out');   
		setTimeout(function () { window.location = '/admin/logout'; }, 10000);
	};

	var appTimeoutID = window.setTimeout(appFunction, appTimeDelay * 1000 * 60);
	var appTimeoutID2 = window.setTimeout(appFunction2, appTimeDelay2 * 1000 * 60);       

	//window.clearTimeout(timeoutID);

	// ================================================================ //