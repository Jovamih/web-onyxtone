<?php
    session_start();
    if(isset($_SESSION['user'])){
        session_unset();
        session_destroy();
        header("Location:../login_admin/");
    }else{
        header("Location:../login_admin/");
        //die("NO PUEDE ACCEDER A ESTE SITIO.VERIFIQUE SU CONEXION A INTERNET O SI TIENE PRIVILEGIOS DE ACCESO");
    }
?>