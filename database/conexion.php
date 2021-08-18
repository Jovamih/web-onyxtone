<?php
// Notificar solamente errores de ejecución
//error_reporting(E_ERROR | E_PARSE);
try{
            $conexion=mysqli_connect("boutiquedkar.cuxsffuy95k9.us-east-1.rds.amazonaws.com","admin", "admin12345678", "boutique");
            if (!$conexion) {
                echo "Error de conexion: " . mysqli_connect_error();
                echo "NO TE PREOCUPES,INTENTA VOLVER A CARGAR LA PAGINA.EL SERVIDOR DE BASE DE DATOS PUEDE ESTAR OCUPADO";
                die();
            }else{
                //die("Conexion exitosa al servidor AWS");
            }
}catch(Exception $e){
    die("La conexion a una base de datos inexistente ha sido realizada");
}

?>