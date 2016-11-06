<?php
// Iniciar 'session'
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<h1>Manejo de SESSIONS - Crear variables</h1>
<p>La funcion "session_start" debe ser lo primero en ejecutarse, antes de setear sesiones.</p>
<?php
// Setear variables
$_SESSION["color"] = "Rojo";
$_SESSION["animal"] = "Perro";
echo "Variables de session seteadas.";
?>
<p>Las variables estaran disponibles durante toda la sesion activa del navegador.</p>
</body>
</html>