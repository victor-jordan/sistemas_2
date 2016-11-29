<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Las Peliculas</title>
</head>
<body>
<?php
require('Modelos\cl_usuario.php');
require('Controladores\cl_interfaz.php');
session_start();
if (!isset($_SESSION['usuario']))
{
	header('Refresh: 0; URL = login.php');
	exit();
} else {
	$usuario = $_SESSION['usuario'];
}
echo $usuario->denominacion;
$sentencia = "select alquiler_id, nombre, apellido, titulo, fecha_alquiler, precio_alquiler, iva_10, sub_total, situacion, denominacion from vista_alquiler;";

$resultado = Interfaz::consulta($sentencia);
$clientes = Interfaz::coleccion('cliente_id, nombre', 'cliente');
$peliculas = Interfaz::coleccion('pelicula_id, titulo', 'pelicula');
$situaciones = array('Vigente', 'Mora', 'Vencido');

// definir variables para tomar valores del POST
$alquiler_id = $cliente_id = $pelicula_id = $fecha_alquiler = $situacion = $creado_por = $modificado_por = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cliente_id = xss_test($_POST["cliente_id"]);
  $pelicula_id = xss_test($_POST["pelicula_id"]);
  $fecha_alquiler = xss_test($_POST["fecha_alquiler"]);
  $situacion = xss_test($_POST["situacion"]);
  $creado_por = xss_test($_POST["creado_por"]);
  $modificado_por = xss_test($_POST["modificado_por"]);
}

function xss_test($dato) {
  $dato = trim($dato);
  $dato = stripslashes($dato);
  $dato = htmlspecialchars($dato);
  return $dato;
}
?>
<form id="formulario" method="POST" action="<?php $_SERVER["PHP_SELF"];?>">
	<h5 id="tform">Agregar alquiler</h5>
	<div>
	<label for="clientes">Cliente: </label><input type="text" name="cliente_id" list="clientes" autocomplete="off">
	<datalist id="clientes">
	<?php
	if ($clientes && $clientes->num_rows > 0) {
		while ($fila = $clientes->fetch_assoc()) {
			echo "<option value='".$fila['cliente_id']."'>".$fila['nombre']."</option>";
		}
		$clientes->free();
	} else {
		echo "<option>No hay registros</option>";
	}
	?>		
	</datalist>
	<label for="peliculas">Peliculas: </label><input type="text" name="pelicula_id" list="peliculas" autocomplete="off">
	<datalist id="peliculas">
	<?php
	if ($peliculas && $peliculas->num_rows > 0) {
		while ($fila = $peliculas->fetch_assoc()) {
			echo "<option value='".$fila['pelicula_id']."'>".$fila['titulo']."</option>";
		}
		$peliculas->free();
	} else {
		echo "<option>No hay registros</option>";
	}
	?>		
	</datalist>
	<input type="hidden" name="fecha_alquiler" value="<?php echo date("Y-m-d"); ?>">
	<label for="situacion">Situacion: </label><input type="text" name="situacion" list="situaciones">
	<datalist id="situaciones">
	<?php
	foreach ($situaciones as $valor) {
		echo "<option value='".$valor."'>".$valor."</option>";
	}
	?>
	</datalist>
	<input type="hidden" name="creado_por" value="<?php echo $usuario->usuario_id; ?>">
	<input type="hidden" name="modificado_por" value="<?php echo $usuario->usuario_id; ?>">
	<input id="accion" type="submit" value="Agregar">
	</div>
</form>
<br>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$sentencia = "insert into alquiler(cliente_id, pelicula_id, fecha_alquiler, situacion, creado_por, modificado_por) values (".$cliente_id.", ".$pelicula_id.", '".$fecha_alquiler."', '".$situacion."', ".$creado_por.", ".$modificado_por.");";
	$insercion = Interfaz::abm($sentencia);
	if (strpos($insercion, 'correctamente') !== FALSE) {
	 	echo "<div class='correcto'>".$insercion."</div>";
	 	header("Refresh:3");
	} else {
	 	echo "<div class='error'>".$insercion."</div>";;
	}
}
?>
<br>
<table>
	<caption>ALQUILERES</caption>
	<thead>
		<tr><th>Id</th><th>nombre</th><th>apellido</th><th>titulo</th><th>fecha_alquiler</th><th>precio_alquiler</th><th>iva_10</th><th>sub_total</th><th>situacion</th><th>usuario</th></tr>
	</thead>
	<tbody>
	<?php
	if ($resultado && $resultado->num_rows > 0) {
		while ($fila = $resultado->fetch_assoc()) {
			echo "<tr><td>".$fila['alquiler_id']."</td><td>".$fila['nombre']."</td><td>".$fila['apellido']."</td><td>".$fila['titulo']."</td><td>".$fila['fecha_alquiler']."</td><td>".$fila['precio_alquiler']."</td><td>".$fila['iva_10']."</td><td>".$fila['sub_total']."</td></td><td>".$fila['situacion']."</td><td>".$fila['denominacion']."</td></tr>";
		}
		$resultado->free();
	} else {
		echo "<tr><td colspan='10'>No hay registros</td></tr>";
	}
	?>		
	</tbody>
</table>
</body>
</html>