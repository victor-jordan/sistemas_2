<!DOCTYPE html>
<html>
<head>
	<title>Sistema basico de Login</title>
</head>
<body>
<?php
require('cl_login.php');
$usuario = $_POST["usuario"];
$pass = $_POST["pass"];

$validar = "CALL login_usuario('".$usuario."', '".$pass."');";

$validado = Login::acceder($validar);

if ($validado->num_rows > 0) {
	$fila = $validado->fetch_assoc();
	if ($fila['activo'] == '1') {
		// si se le asigna un rol o grupo al usuario, tambien se puede setear aca.
		$_SESSION['usuario'] = $usuario;
		// ejemplo $_SESSION['grupo'] = $grupo; donde grupo seria algo traido de la BBDD.
		
		/* aca pueden escribir una bienvenida, o bien un menu de navegacion, lo que quieran
		   pero mas abajo se utiliza la funcion para redirigir, asi que pueden replantearse
		   muchas cosas desde este punto */
		echo "<b><i>usuario:</i></b> ".$fila['denominacion']."<br>";
		echo "<b><i>nombre:</i></b> ".$fila['nombre']."<br>";
		echo "<b><i>apellido:</i></b> ".$fila['apellido']."<br>";
		echo "<b><i>activo:</i></b> ".$fila['activo']."<br>";
		echo "<hr>";
		$validado->free();
		header('Refresh: 2; URL = listado_peliculas.php');
	} else {
		echo "Usuario ".$fila['denominacion']." inactivo.<br>";
		echo "<hr>";
		$validado->free();
		header('Refresh: 2; URL = prueba_login.html');
		exit();
	}
} else {
	echo "Combinacion usuario/pass erronea o usuario inexistente.";
	echo "<hr>";
	header('Refresh: 2; URL = prueba_login.html');
	exit();
}
?>
</body>
</html>