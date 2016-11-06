<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<h1>Manejo de SESSIONS - Ver variables</h1>
<p>Las variables seteadas previamente</p>
<?php
// Mostrar las variables asignadas en la pagina anterior
echo "Color asignado " . $_SESSION["color"] . ".<br>";
echo "Animal asignado " . $_SESSION["animal"] . ".";
?>
<p>Otra forma de ver las variables seteadas es esta:</p>
<?php
print_r($_SESSION);
?>
<p>Para cambiar una variable SESSION, simplemente se puede sobreescribir. Refrescar para ver el cambio.</p>
<?php
$_SESSION["color"] = "Naranja";
print_r($_SESSION);
?>
</body>
</html>