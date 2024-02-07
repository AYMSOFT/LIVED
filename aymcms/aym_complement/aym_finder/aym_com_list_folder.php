<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA ADMINISTRAR LOS ARCHIVOS AYMFINDER
# © 2023, AYMSOFT SAS
# JHOAN MARTINEZ AGO/29/2023 
session_start(); 

# ZONA HORARIA
date_default_timezone_set('America/Bogota');

#VALIDACIÓN --> PARA INGRESAR AL APLICATIVO
include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

session_start(); 



    function aym_get_files($aym_array,$aym_route){    
        if ( is_dir( $aym_route ) ) {
            //ESCANEAMOS CARPETA TEMPORAL
            $dir = scandir( $aym_route );
            //EMPEZAMOS VARIABLE CONTABLE EN 1
            
            //VERIFICAMOS QUE SI TENGA ARCHIVOS
            if ( count( $dir ) > 2 ) {
                foreach ( glob( $aym_route . "*" ) as $files_dir ) {
                    //LIMPIAMOS EL DOCUMEN ROOT
                    $files_dir =  str_replace($_SERVER['DOCUMENT_ROOT'], "" , $files_dir);
                    if (is_dir($_SERVER['DOCUMENT_ROOT'] . $files_dir)) {
                            // ES UNA CARPETA
                        } else {
                            // ES UN ARCHIVO
                            $aym_image = ['png', 'jpg', 'jpeg', 'gif'];
                            $aym_extension = pathinfo($files_dir, PATHINFO_EXTENSION);
                            $tipo = in_array($aym_extension, $aym_image) ? 'imagen' : 'documento';
                        }
                        // GUARDAMOS EN EL ARRAY CON INFORMACIÓN ADICIONAL DEL TIPO
                        $aym_array[] = array(
                            "ruta" => $files_dir,
                            "tipo" => $tipo
                        );
                }
                return $aym_array;
            }
        }
    }



    # VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';

    $aym_array = array();

    $aym_dir =  $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_image/aym_finder/aym_files/';

    $aym_dir_2 =  $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_image/aym_finder/aym_imagen/';

    $aym_array = aym_get_files($aym_array,$aym_dir);
   
    $aym_array = aym_get_files($aym_array,$aym_dir_2);

    // SI EXISTE CARPETA TEMPORAL
    
        // Convertir el array de archivos a JSON para enviar al cliente

    echo json_encode(array_values($aym_array));
?>