<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Las Peliculas</title>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['usuario']))
{
	header('Refresh: 3; URL = prueba_login.html');
	exit();
}
require('cl_interfaz.php');

$sentencia = "select pelicula_id, titulo, genero, anho, director, formato, precio_alquiler from pelicula;";

$resultado = Interfaz::consulta($sentencia);
$directores = Interfaz::coleccion('director');
$generos = Interfaz::coleccion('genero');
$formatos = Interfaz::coleccion('formato');

// definir variables para tomar valores del POST
$pelicula_id = $titulo = $genero = $anho = $director = $formato = $precio = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pelicula_id = xss_test($_POST["pelicula_id"]);
  if($pelicula_id !== ''){
  	$pelicula_id = "NULL";
  }
  $titulo = xss_test($_POST["titulo"]);
  $genero = xss_test($_POST["genero"]);
  $anho = xss_test($_POST["anho"]);
  $director = xss_test($_POST["director"]);
  $formato = xss_test($_POST["formato"]);
  $precio = xss_test($_POST["precio_alquiler"]);
}

function xss_test($dato) {
  $dato = trim($dato);
  $dato = stripslashes($dato);
  $dato = htmlspecialchars($dato);
  return $dato;
}
echo $_SESSION['usuario'];
?>
<form id="formulario" method="POST" action="<?php $_SERVER["PHP_SELF"];?>">
	<h5 id="tform">Agregar películas</h5>
	<div>
	<label for="titulo">Titulo: </label><input type="text" name="titulo">
	<label for="genero">Género: </label><input type="text" name="genero" list="generos" autocomplete="off">
	<datalist id="generos">
	<?php
	if ($generos && $generos->num_rows > 0) {
		while ($fila = $generos->fetch_assoc()) {
			echo "<option value='".$fila['genero']."'>".$fila['genero']."</option>";
		}
		$generos->free();
	} else {
		echo "<option>No hay registros</option>";
	}
	?>		
	</datalist>
	<label for="anho">Año: </label><input type="text" name="anho">
	<label for="director">Director: </label><input type="text" name="director" list="directores" autocomplete="off">
	<datalist id="directores">
	<?php
	if ($directores && $directores->num_rows > 0) {
		while ($fila = $directores->fetch_assoc()) {
			echo "<option value='".$fila['director']."'>".$fila['director']."</option>";
		}
		$directores->free();
	} else {
		echo "<option>No hay registros</option>";
	}
	?>		
	</datalist>
	<label for="formato">Formato: </label><input type="text" name="formato" list="formatos" autocomplete="off">
	<datalist id="formatos">
	<?php
	if ($formatos && $formatos->num_rows > 0) {
		while ($fila = $formatos->fetch_assoc()) {
			echo "<option value='".$fila['formato']."'>".$fila['formato']."</option>";
		}
		$formatos->free();
	} else {
		echo "<option>No hay registros</option>";
	}
	?>
	</datalist>
	<label for="precio_alquiler">Precio: </label><input type="text" name="precio_alquiler">
	<label for="pelicula_id" id="pid"></label><input type="hidden" name="pelicula_id">
	<input id="accion" type="submit" value="Agregar">
	</div>
</form>
<br>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$sentencia = "call upsert_pelicula(".$pelicula_id.", '".$titulo."', '".$genero."', '".$anho."', '".$director."', '".$formato."', ".$precio.");";
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
	<caption>LAS PELICULAS</caption>
	<thead>
		<tr><th>Id</th><th>Título</th><th>Género</th><th>Año</th><th>Director</th><th>Formato</th><th>Precio</th><th>Acciones</th></tr>
	</thead>
	<tbody>
	<?php
	if ($resultado && $resultado->num_rows > 0) {
		while ($fila = $resultado->fetch_assoc()) {
			echo "<tr onclick='javascript:llenarForm(this);'><td>".$fila['pelicula_id']."</td><td>".$fila['titulo']."</td><td>".$fila['genero']."</td><td>".$fila['anho']."</td><td>".$fila['director']."</td><td>".$fila['formato']."</td><td>".$fila['precio_alquiler']."</td><td onclick='event.stopPropagation();return false;'><a href='borrar_pelicula.php?pelicula_id=".$fila['pelicula_id']."'>Borrar</a></td></tr>";
		}
		$resultado->free();
	} else {
		echo "<tr><td colspan='8'>No hay registros</td></tr>";
	}
	?>		
	</tbody>
</table>
<script type="text/javascript">
	function llenarForm(row){
		var fila=row.cells;
		document.getElementById("pid").innerHTML = fila[0].innerHTML;
		document.getElementsByName("titulo")[0].value = fila[1].innerHTML;
		document.getElementsByName("genero")[0].value = fila[2].innerHTML;
		document.getElementsByName("anho")[0].value = fila[3].innerHTML;
		document.getElementsByName("director")[0].value = fila[4].innerHTML;
		document.getElementsByName("formato")[0].value = fila[5].innerHTML;
		document.getElementsByName("precio_alquiler")[0].value = fila[6].innerHTML;
		document.getElementsByName("pelicula_id")[0].value = fila[0].innerHTML;
		document.getElementById("accion").value = "Modificar";
		document.getElementById("tform").innerHTML = "Modificar pelicula";
	}
</script>
</body>
</html>