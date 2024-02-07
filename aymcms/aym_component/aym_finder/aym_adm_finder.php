<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA ADMINISTRAR LOS ARCHIVOS AYMFINDER
# © 2023, AYMSOFT SAS
# JHOAN MARTINEZ AGO/29/2023 
session_start(); 

# ZONA HORARIA
date_default_timezone_set('America/Bogota');

#VALIDACIÓN --> PARA INGRESAR AL APLICATIVO
include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';
	
#===================================================================================================
#===================================== AYMFINDER ===================================================
#===================================================================================================
if ($_POST['action'] == 'I') {  
	#VALIDACION --> CARGA DE LA IMAGEN AL SERVIDOR
    aym_create_folder();
    if ($_FILES['aym_file_upload_file']) {

        $file = $_FILES['aym_file_upload_file'];
        $fileName = basename($file['name']);
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        //Validación de archivo
        if(aym_extension($ext,1)){
            //Creamos directorio en caso de no existir
            aym_create_folder();

            // ES UN ARCHIVO
            $aym_tipo_doc = aym_extension($ext);
            
            $aym_tipo_doc = $aym_tipo_doc == 'imagen' ? 'aym_imagen' : 'aym_files';

            aym_create_folder($aym_tipo_doc);

            // Ruta de la carpeta donde se almacenará el archivo cargado
            
            $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_image/aym_finder/'.$aym_tipo_doc.'/';
            $targetFilePath = $uploadDir . $fileName;
            // Obtener el nombre y la extensión del archivo
           
        
            // Mover el archivo cargado a la ubicación deseada
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                // La carga fue exitosa, aquí puedes realizar acciones adicionales si es necesario
        
                // Envía una respuesta al cliente (puede ser un mensaje o datos adicionales si es necesario)
                echo 'Archivo cargado exitosamente';
            } else {
                // Ocurrió un error durante la carga
                header('HTTP/1.1 500 Internal Server Error');
                echo 'Error al cargar el archivo';
            }
        }else{
            echo "extensión no valida";
        }
    } else {
        // No se ha recibido ningún archivo para cargar
        header('HTTP/1.1 400 Bad Request');
        echo 'No se ha proporcionado ningún archivo para cargar';
    }
}


# VALIDACIÓN --> SI ES ELMINAR
if ($_POST['action']=='D') { 
    $ext = pathinfo($_POST['aym_finder_id'], PATHINFO_EXTENSION);

    $aym_tipo_doc = aym_extension($ext);

    $aym_tipo_doc = $aym_tipo_doc == 'imagen' ? 'aym_imagen' : 'aym_files';
	if(!unlink($_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_image/aym_finder/'.$aym_tipo_doc.'/'.$_POST['aym_finder_id'])){
		$ReturnStatus =1;
		$Msg = "No se pudo establecer la carpeta de destino <br /><br /> <strong> Motivo:</strong> La carpeta raiz no contiene la imagen.<br/><br/> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.";
	}

}

# VALIDACIÓN --> SI ES INSERTAR CARPETA
if ($_POST['action']=='IF') { 
    aym_create_folder($_POST['aym_folder']);
}




//FUNCIONES RECURSIVAS

function aym_extension($aym_extension,$aym_validate = null){
    $aym_image = [
        'png', 'jpg', 'jpeg', 'gif'
    ];
    
    $aym_files = [
        'pdf', 'doc', 'docx', 'ppt', 'pptx',   // Documentos
        'xls', 'xlsx', 'csv',                  // Hojas de cálculo
        'txt', 'rtf',                          // Texto
    ];

    $tipo = in_array($aym_extension, $aym_image) ? 'imagen' : 'documento';

    if ($aym_validate) {
        $aym_permitidos = array_merge($aym_image, $aym_files);

        if (in_array($aym_extension, $aym_permitidos)) {
            return true;
        } else {
            return false;
        }
    }

    return $tipo; 
    
}

function aym_create_folder($aym_new_folder = null){

    $ruta = $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_image/aym_finder';
    if($aym_new_folder)
        $ruta .= '/'.$aym_new_folder;

    // Verificar si la carpeta no existe y crearla
    if (!is_dir($ruta)) {
        mkdir($ruta, 0777, true);
        return true;
    } else 
        return false;
}


