<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
// definir variables para tomar valores del POST
$nombre = $email = $genero = $comentario = $sitio_web = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = xss_test($_POST["nombre"]);
  $email = xss_test($_POST["email"]);
  $genero = xss_test($_POST["genero"]);
  $comentario = xss_test($_POST["comentario"]);
  $sitio_web = xss_test($_POST["sitio_web"]);
}

function xss_test($dato) {
  $dato = trim($dato);
  $dato = stripslashes($dato);
  $dato = htmlspecialchars($dato);
  return $dato;
}
?>
<h2>Validacion de formulario en PHP con prueba de XSS</h2>
<form method="post" action="<?php $_SERVER["PHP_SELF"];?>">
	Nombre: <input type="text" name="nombre"><br>
	Email: <input type="text" name="email"><br>
	Genero: <input type="radio" name="genero" value="F">Femenino
			<input type="radio" name="genero" value="M">Masculino<br>
	Sitio web: <input type="text" name="sitio_web"><br>
	Comentario: <textarea name="comentario" rows="5" cols="40"></textarea><br><br>
	<input type="submit" name="enviar" value="Enviar">
</form>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	echo "<h2>Los datos</h2>";
	echo "Nombre: ".$nombre."<br>";
	echo "Email: ".$email."<br>";
	echo "Genero: ".$genero."<br>";
	echo "Sitio web:".$sitio_web."<br>";
	echo "Comentario: ".$comentario."<br>";
}
 ?>
</body>
</html>