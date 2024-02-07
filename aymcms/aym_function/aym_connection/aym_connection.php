<?php # **************************** AYMCORE V: 14.0 ********************
# FUNCIÓN PARA CONECTARSE  A LA BD
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

function aym_connect_cms() { 

   /* DESACTIVA ERRORRES DE MYSQL */
   $driver = new mysqli_driver();
   $driver->report_mode = MYSQLI_REPORT_OFF;

   if (!($link = mysqli_connect("localhost", "lived_user", "DBMySQL@AyMsoft&12031978&AyMsite", "lived_cms70") or trigger_error(mysqli_error($link),E_USER_ERROR))) { 
      echo "Error conectando a la base de datos.";
      exit(); 
   }
   
   /* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
   return $link; 
}
?>