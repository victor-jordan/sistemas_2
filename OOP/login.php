<?php
require('Controladores\cl_login.php');
session_start();
$error = null;
$usuario = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$denominacion = $_POST["user"];
	$clave = $_POST["pass"];
	$usuario = LoginCtrl::acceder($denominacion, $clave);
	// si se le asigna un rol o grupo al usuario, tambien se puede setear aca.
	// ejemplo $_SESSION['grupo'] = $grupo; donde grupo seria algo traido de la BBDD.
	if ($usuario->activo == 1) {
		$_SESSION['usuario'] = $usuario;
	} elseif ($usuario->activo == 0) {
		$error = 'Usuario inactivo';
	} else {
		$error = 'Usuario inexistente o contraseña incorrecta';
	}
}
include('Vistas\login.html');
?>
