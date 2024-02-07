

CKEDITOR.replace('editor', {
  extraPlugins: 'aym_finder,image2', // Cargar el complemento personalizado
  toolbar: [
    { name: 'document', items: [ 'Source' ] },
    { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt' ] },
    { name: 'tools', items: [ 'Maximize' ] },
    '/',
    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
    { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
    '/',
    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    { name: 'tools', items: [ 'ShowBlocks' ] },
    { name: 'about', items: [ 'About' ] },
    { name: 'aym_finder', items: [ 'aym_finder_button' ] } // Agregar el botón personalizado a la barra de herramientas
  ],
});

// Definir el complemento personalizado
CKEDITOR.plugins.add('aym_finder', {
init: function(editor) {
    // Agregar el comando que se ejecutará cuando se haga clic en el botón
    editor.addCommand('aym_finder_command', {
      exec: function(editor) {
          var randomNumber = Math.floor(Math.random() * 1000000);
          var url = '/aymcms/aym_module/aym_finder/aym_finder_interface.php?nocache=' + randomNumber;
          var params = {
              parametro1: 'valor1',
              parametro2: 'valor2'
          };
  
          $.post(url, params, function(response) {
              // Contenido recibido, abrir nueva ventana emergente con el contenido
              $('#aym_folder_modal')
              .html(response)
              .dialog({
                  title: 'AyMFinder',
                  modal: true,
                  width:'80%',
                  left:'20%',
                  height: 510,
                  resizable: false,
                  open: function(event, ui) {
                      $(this).css('max-width', '100%');
                  }
              });
          });
        }
      });

        // Registrar el botón en la barra de herramientas
        editor.ui.addButton('aym_finder_button', {
        label: 'Mi Botón', // Etiqueta del botón
        command: 'aym_finder_command', // El comando que se ejecutará al hacer clic en el botón
        icon: '/aym_image/aym_ico/aym_finder.png' // Ruta de la imagen PNG para el icono
    });
}
});


$(document).ready(function(){

  $('input[type=submit],#editor').click(function(e) {
      const editorData = editor.getData();
      objectID= $('#editor').attr('data-id');
      $('#'+objectID).val(editorData);
  });

  $('#editor').keyup(function(e) {
      const editorData = editor.getData();
      objectID= $('#editor').attr('data-id');
      $('#'+objectID).val(editorData);
  });


});
