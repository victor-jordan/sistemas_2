<?php
//Siempre setear o borrar COOKIES antes de la etiqueta o cuerpo HTML.
$nombre_cookie = "usuario";
$usuario_cookie = "Sancho";
setcookie($nombre_cookie, $usuario_cookie, time() + (86400 * 30), "/"); // 86400 = 1 dia de validez
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Manejo de cookies</h1>
<p>La primera vez que accedemos, la pagina mostrara un mensaje de que el cookie no esta seteado. Al refrescar, aparecera lo correspondiente.</p>
<?php
if(!isset($_COOKIE[$nombre_cookie])) {
    echo "COOKIE: '" . $nombre_cookie . "' no asignado o seteado!";
} else {
    echo "COOKIE: '" . $nombre_cookie . "'<br>";
    echo "VALOR: " . $_COOKIE[$nombre_cookie];
}
?>
<p>Para reasignar valores cookie, simplemente se vuelve a ejecutar el comando.</p>
</body>
</html>