<?php
require_once 'funciones.php';

$user = $_POST['email'];
$password = $_POST['password'];

if (validarlogin($user,$password)) {
    header('Location: ../views/home.php');
}else{
    header('Location: ../index.php?error=true');
}

?>