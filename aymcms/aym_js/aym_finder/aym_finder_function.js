
$(document).ready(function() {
  // Hacer la solicitud AJAX al archivo PHP para obtener la lista de archivos

  $( "#aym_file_upload_file" ).on( "change", function() {
      aym_file_action('I');
  } );

  $( "#aym_trash" ).on( "click", function() {
      var id = $('.content-item-active .content-icon').attr('title');
      aym_file_action('D',id);
      $('.content-item').removeClass('content-item-active');
      $('.w-btn').removeClass('w-active');
  } );

  function aym_file_action(action,id=null){
    var formData = new FormData($("#aym_upload_file")[0]);
      formData.append('action', action);
      
      if(action == 'I')
        formData.append('aym_file_upload_file', $("#aym_file_upload_file")[0].files[0]);
      if(action == 'D')
        formData.append('aym_finder_id', id);

      $.ajax({
          url: 'aymfindermanage', // Ruta de tu archivo PHP para cargar el archivo
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            const aym_folder_delete = document.querySelectorAll('.aym_clone');
            // Recorre los elementos y elimínalos del DOM
            aym_folder_delete.forEach(element => {
                element.remove();
            });
            $('#aym_docs').html("");
            aym_view_files();
              // Realiza aquí las acciones adicionales que desees después de cargar el archivo
          },
          error: function(xhr, status, error) {
              console.log('Error al cargar el archivo:', error,xhr,status);
          }
      });
  }

  function aym_view_files(){
    var randomNumber = Math.floor(Math.random() * 1000000);
    $.ajax({
      url: '/aymcms/complement/finder/list_folder?nocache='+ randomNumber,
      dataType: 'json',
      success: function(data) {
        mostrarListaArchivos(data);
      },
      error: function(xhr, status, error) {
        console.error('Error al obtener la lista de archivos:', status, error);
      }
    });
  }

  aym_view_files();


//   aym_files = `
//   <div class="folder-list-item aym_clone" id="aym_finder_${aym_file}">
//     <i class="far fa-folder"></i>
//     <p>${aym_file}</p>
//   </div>         
// `;
// $('#aym_folders').append(aym_files);

  // Función para mostrar la lista de archivos en el contenedor
  function mostrarListaArchivos(archivos) {
    archivos.forEach(function(archivo) {
      var aym_ruta = archivo.ruta;
      var aym_file = aym_ruta.split('/').pop();
      // Obtener la extensión del archivo
      var extension = aym_file.split('.').pop();
        aym_files = `
          <div class="content-item">
            <div class="content-icon" title="${aym_file}" tipo="${archivo.tipo}" id="content-icon-${aym_file}">`;
              if(archivo.tipo == 'carpeta')
                aym_files += `<i class="far fa-file fa-3x"></i>`;
              else if (extension === 'jpg' || extension === 'jpeg' || extension === 'png' || extension === 'gif')
                aym_files += `<img src="${aym_ruta}" class="fa-3x" width="46" height="54">`;
              else
                aym_files += `<i class="far fa-file fa-3x"></i>`;
              aym_files +=
                `</div>
                <div class="content-description">
                  ${aym_file}
                </div>
            </div>`;
          $('#aym_docs').append(aym_files);
    });
  }


  $('#aym_docs').on("dblclick", ".content-icon", function() {
    var aym_file = $(this).attr('title'); // Obtener el nombre del archivo
    var tipo = $(this).attr('tipo'); // Obtener el nombre del archivo
    var aym_files =  '/aymcms/aym_image/aym_finder/aym_'+tipo+'/'+ aym_file; // Construir la ruta completa de la imagen

    // Insertar la imagen en el CKEditor
    var editor = CKEDITOR.instances.editor; // Cambia "editor" al ID real de tu instancia de CKEditor
    if (editor) {
      if(tipo == 'documento')
        var aym_item = `<a target="_blank" href="${aym_files}">Documento</a>`;
      else
        var aym_item = `<img src="${aym_files}" alt="Imagen" width="100">`;
      editor.insertHtml(aym_item);
    }
    $('.ui-icon-closethick').click();
  });

  $(document).ready(function() {
  // Color variables for sidebar list items
  var listSel = '#ADB0B2';
  
  // Give the "Documents" item an initial selected color
  $('#aym_general_doc').css({ 'background-color': listSel });
    $('.folder-list-item').click(function() {
        // Iterate items, give all normal color
        $('.content-item').removeClass('content-item-active');
        $('.w-btn').removeClass('w-active');

    });  

    $('#aym_docs').on("click", ".content-item", function() {
      $('.content-item').removeClass('content-item-active');
      $('.w-btn').addClass('w-active');
      $(this).toggleClass('content-item-active');
      console.log($(this).attr('title'));
    });
  });
});