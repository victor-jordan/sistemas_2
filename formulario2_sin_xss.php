<!DOCTYPE html>
<html>
<head></head>
<body>
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
	echo "Nombre: ".$_POST["nombre"]."<br>";
	echo "Email: ".$_POST["email"]."<br>";
	echo "Genero: ".$_POST["genero"]."<br>";
	echo "Sitio web:".$_POST["sitio_web"]."<br>";
	echo "Comentario: ".$_POST["comentario"]."<br>";
}
 ?>
</body>
</html>