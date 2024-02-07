/* **************************** AYMSHOP V: 6.0 ********************
# SCRIPT PARA CARGAR MULTIPLES ARCHIVOS
# © 2020, AYMSOFT SAS
# DIEGO SUAZA 
*/
$(document).ready(function() { 
	Dropzone.autoDiscover = false; 
});
var action = $("input[name='action']").val();    

$('.MultipleFiles').dropzone({
	url: '/file-upload/'+action ,
		accept: function(file, done) {
			var ExtensionesPermitidas = [".png",".jpeg",".gif",".jpg",".pdf",".PDF",".doc",".DOC",".docx",".DOCX",".xls",".XLS",".xlsx",".XLSX",".xlsm",".XLSM"];
			var filename = file.name;
			var extension = filename.substring(filename.lastIndexOf("."));
			if (file.size == 0) {
				done("El archivo esta vacio.");
				file.previewElement.querySelector("img").src =  "/admin/aym_image/aym_icon/aym_ico_empty_file.png";
			}
			else if (!ExtensionesPermitidas.includes(extension)){
				done("El archivo con extension "+extension +" No es permitido.");
			}
			else {done(); }
			},
			succes:function(file){},
	removedfile: function(file){
		var name = file.name;
		$.ajax({
			type: 'post',
			url: '/file-upload/'+action+'DE',
			data: {name:name},
			success: function(response){	
		var _ref;
		return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement): void 0;					  
		}   
		});
	}
});

function startUpload(){
	for (var i = 0; i < MultipleFiles.getAcceptedFiles().length; i++) {
		MultipleFiles.processFile(MultipleFiles.getAcceptedFiles()[i]);
	}
}
