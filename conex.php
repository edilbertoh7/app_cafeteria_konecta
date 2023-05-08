<?php
 global $conex;

 function conectar(){
 	global $conex;
 	$conex = mysqli_connect("localhost","root","14152680","prueba-konecta");
     mysqli_set_charset($conex,"utf8");
 	if (mysqli_connect_errno()) {
 		echo "Error al conectar con la base de datos: ".mysqli_connect_error();
 	}
 }

 function query($sql){
    conectar();
 	global $conex;
 	$result = $conex->query($sql);
 	return $result;
 }

 function data($sql){

     $result = query($sql); 
 	foreach ($result as $resp ) {
        $resp = $resp;
 	}
 	return $resp;
 }
 function disconnect()
 {
     global $conex;
     mysqli_close($conex);
 }

?>