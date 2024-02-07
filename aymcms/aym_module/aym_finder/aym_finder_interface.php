<link rel="stylesheet" href="/aymcms/aym_css/aym_finder/aym_finder.css?v=<?php echo(rand()); ?>">
<div class="doc-browser">
  <!-- Menu administrador de botones -->
  <div class="window-bar"> 
    <div class="aym_custom_file">
      <form id="aym_upload_file" enctype="multipart/form-data">
          <label for="aym_file_upload_file">
              <i class="fas fa-cloud-upload-alt"></i>
          </label>
          <input type="file" id="aym_file_upload_file" name="archivo" />
      </form>
    </div>
    <div class="w-close w-btn">
      <i class="fas fa-folder-plus"></i>
    </div>
    <div id="status"></div>
    <div class="w-close w-btn" id="aym_trash">
      <i class="fa fa-trash"></i>
    </div>
  </div>
  <!-- Contenido general de las carpetas -->
  <div class="window-content-view">
    
    <!-- Lista de carpetas-->
    <div class="sidebar-folder-list" id="aym_folders" aym_route="<?= $_SERVER['DOCUMENT_ROOT'] ?>">
      <div class="folder-list-item" id="aym_general_doc">
        <i class="far fa-folder"></i>
        <p>AymFinder</p>
      </div>
    </div>
    
    <!-- >.Fin lista de carpetas-->
    
    <!-- Main Content View (Documents) -->
    <div class="main-content-view" id="aym_docs"> </div> <!-- >.Vista de documentos-->

    <script type="text/javascript" src="/aymcms/aym_js/aym_finder/aym_finder_function.js"></script>