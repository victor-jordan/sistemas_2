<?php
/**
* La prueba de la clase
*/
require('cl_interfaz.php');

$sentencia = "select * from vista_alquiler";

$resultado = Interfaz::consulta($sentencia);
echo "<hr>";
echo "<h1>Listado de alquileres</h1>";
echo "<hr>";
if ($resultado && $resultado->num_rows > 0) {
	while ($fila = $resultado->fetch_assoc()) {
		echo "<b><i>alquiler_id:</i></b> ".$fila['alquiler_id']."<br>";
		echo "<b><i>Cliente:</i></b> ".$fila['nombre']." ".$fila['apellido']."<br>";
		echo "<b><i>Pelicula:</i></b> ".$fila['titulo']."<br>";
		echo "<b><i>Empleado:</i></b> ".$fila['denominacion']."<br><br>";
		echo "<b><i>Detalle del alquiler</i></b><br>";
		echo "-----------------------------------------------------<br>";
		echo "Precio: ".$fila['precio_alquiler']." + Impuesto: ".$fila['iva_10']." = <b>Total:</b> ".$fila['sub_total']."<br>";
		echo "-----------------------------------------------------<br>";
		echo "<hr>";
	}
	$resultado->free();
} else {
	echo "Nada para mostrar...";
}
?>