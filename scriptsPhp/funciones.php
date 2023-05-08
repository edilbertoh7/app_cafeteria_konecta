<?php
include '../conex.php';

function validarlogin($user,$password)
{
    $sql = "SELECT * FROM users WHERE email = '$user' AND password = '$password'";
    $result = query($sql);
    if (mysqli_fetch_row($result)) {
        session_start();
        $_SESSION['user']=$user;
        return true;
    }
    return false;
}
function sessionStarted()
{
	session_start();
	return isset($_SESSION['user']);
}
?>
