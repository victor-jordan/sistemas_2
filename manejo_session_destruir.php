<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Borrar todas las sesiones
session_unset(); 
echo "Destruido!";
// Destruir la sesion
session_destroy(); 
?>

</body>
</html>