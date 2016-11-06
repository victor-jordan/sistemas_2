<?php
// Forzar expirado del COOKIE
setcookie("usuario", null, -1, "/");
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Borrar COOKIE</h1>
<?php
echo "Cookie 'usuario' eliminada.";
?>
</body>
</html>