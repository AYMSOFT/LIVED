<?php # **************************** AYMCORE V: 14.0  ********************
# COMPONENTE PARA MATAR LA SESION DEL USUARIO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

session_start(); 
session_destroy();
header('Location: https://'.$_SERVER['HTTP_HOST'].'/admin');
?>