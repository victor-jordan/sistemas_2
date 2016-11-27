<html>
<body>

<?php 
require('cl_interfaz.php');

$sentencia = "delete from pelicula where pelicula_id = ".$_GET['pelicula_id'].";";

echo "La pelicula " . $_GET['pelicula_id'] . " sera borrada.<br><br>";

$borrame = Interfaz::abm($sentencia);

echo "La pelicula " . $_GET['pelicula_id'] . " fue borrada.";
?>

</body>
</html>