/* **************************** AYMCORE V: 14.0 ********************
# SCRIPT PARA LA ADMINISTRACIÓN DEL FEEDBACK
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
*/

/* BEGIN READY FUNCTION */
$(document).ready(function() {
	
	//aym_show_file();
	
	/* FUNCIONES (DRAG AND DROP) AND CHANGE */	

	function bytesToSize(bytes){
	   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	   if (bytes == 0) return '0 Byte';
	   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
	}	

	function labelOver(element, event) {
		element.classList.add("hover");
		element.setAttribute("data-message", "SUELTELO !!");
		event.preventDefault();
	}

	function labelLeave(element, event) {
		element.classList.remove("hover");
		element.setAttribute("data-message", "Arratre o cargue las imagenes aquí");
		event.preventDefault();
	}

	function labelDrop(element, event) {
		event.preventDefault();

		var input = element.firstElementChild;
		input.files = event.dataTransfer.files;

		//CONTROLAR EL DISPARO EN FIREFOX
		if(navigator.userAgent.toLowerCase().indexOf('firefox') > -1){
			var event = new Event('change'); 
			input.dispatchEvent(event); 
		}

	}

	function inputChange(input, event) {
		
		var _files = input.files;
		var element = input.parentElement;
		var allowedFiles = ["jpg", "jpeg", "png", "gif", "pdf"];
		element.classList.remove("hover");

		//VALIDACIÖN
		for(var v=0; v<_files.length; v++){

			if(_files[v]){

				//Extensión
				if(allowedFiles.indexOf(_files[v].type.split('/')[1])==-1){
					element.setAttribute("data-message", 'El archivo "'+_files[v].name+'" tiene una extensión NO válida..');
					element.style.backgroundColor = "rgba(225,141,142,0.3)";
					input.value = '';
					return false;
				}

				//Tamaño (Max 1)
				if(_files[v].size > 10485760){
					element.setAttribute("data-message", 'El archivo "'+_files[v].name+'" excede el tamaño maximo que es 1 MB');
					element.style.backgroundColor = "rgba(216,191,20,0.2)";
					input.value = '';
					return false;
				}

			}
		}

		//MOSTRAR LAS IMAGENES CARGADAS
		for(var i=0; i<_files.length; i++){

			if(_files[i]){

				var reader = new FileReader();
				reader.onload = (function(){
					return function(e){
						input.files[i] = e.dataTransfer;
						
						/*element.innerHTML+='<figure><img src="../../../admin/aym_js/aym_help/'+e.target.result+'" alt=""><figcaption>'+e.target.result.split(';')[0].split('/')[1]+' - '+bytesToSize(e.loaded)+'</figcaption></figure>';
						element.setAttribute("data-message", "BIEN HECHO");*/
					};
				})(_files[i]);

				reader.readAsDataURL(_files[i]);
				
				aym_upload_file(input.files[i]);
			}
		}	

	}
	
	
	function aym_upload_file(input) {
		var action = 'II';
		var fileFormData = new FormData();
		fileFormData.append('action', action);
		fileFormData.append('use_ima', input);
		
		$.ajax({
			// INCLUSIÓN --> COMPLEMENTO QUE ENVIA LA IMAGEN AL SERVIDOR
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				// Upload progress
				xhr.upload.addEventListener("progress", function(evt){
					if (evt.lengthComputable) {
						var percentComplete = Math.floor((evt.loaded / evt.total) * 100);
						
						$("#aym_progress").width(percentComplete+'%');
                        $("#aym_progress").data('value', percentComplete);
					}
				}, false);

				// Download progress
				xhr.addEventListener("progress", function(evt){
					if (evt.lengthComputable) {
						var percentComplete = Math.floor((evt.loaded / evt.total) * 100);

						$("#aym_progress").width(percentComplete+'%');
						$("#aym_progress").data('value', percentComplete);
					}
				}, false);

				return xhr;
			},
			url: "/admin/aym_component/aym_help/aym_adm_feedback.php",
			type: "POST",
			data: fileFormData,
			contentType: false,
			processData: false,
			success: function(aym_response){
				aym_show_file();
				$("#aym_progress").width('0');
			},
			error:function(){
				alert("Upload file failure");
			}
		});	
	}
	
	function aym_show_file() {
		
		$.ajax({
			// INCLUSIÓN --> COMPLEMENTO QUE ENVIA LA IMAGEN AL SERVIDOR
			url: "/admin/complement/help/list_file_feedback",
			type: "POST",
			success: function(aym_response){
				$('#aym_show_files').html(aym_response);
			},
			error:function(){
				alert("Show file failure");
			}
		});	
	}
	
	function aym_delete_file(url) {
		
		var action = "DF";
		
		$.ajax({
			// INCLUSIÓN --> COMPLEMENTO QUE ENVIA LA IMAGEN AL SERVIDOR
			url: "/admin/aym_component/aym_help/aym_adm_feedback.php",
			type: "POST",
			data: {url:url,action:action},
			success: function(aym_response){
				aym_show_file();
			},
			error:function(){
				alert("Delete File failure");
			}
		});	
	}
	
	$('.aym_open_file').on('click', function(){
		$('.aym_frm_images input[type=file]').click();
	});
	
	$('#aym_show_files').on('click', '.aym_delete', function(){
		var url = $(this).closest('a').attr('href');
		aym_delete_file(url);
		return false;
	});

	/* EVENTOS PARA ARRASTRAR LA IMAGEN (DRAG AND DROP) */	

	var chargeImage = document.querySelectorAll(".aym_label_image_multiple");

	for(var i=0; i<chargeImage.length; i++){
		chargeImage[i].addEventListener("dragover", function(e){
			labelOver(this, e);
		},false);

		chargeImage[i].addEventListener("dragleave", function(e){
			labelLeave(this, e);
		},false);

		chargeImage[i].addEventListener("drop", function(e){
			labelDrop(this, e);
		},false);
	}	
}); 
/* FIN READY FUNCTION */
