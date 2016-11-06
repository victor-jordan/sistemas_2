<!DOCTYPE html>
<html>
<head>
<style type="text/css">
.error{
	background-color: red;
	color: yellow;
	border: all;
}
</style>
</head>
<body>
<?php
// definir variables para tomar valores del POST
$nombre = $email = $genero = $comentario = $sitio_web = "";
$nombreErr = $emailErr = $comentErr = $sitioErr = $genErr = "";
$error = 0;

// Funcion para validar cross site scripting
function xss_test($dato) {
  $dato = trim($dato);
  $dato = stripslashes($dato);
  $dato = htmlspecialchars($dato);
  return $dato;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["nombre"])) {
		$nombreErr = "Nombre requerido.";
		$error = $error + 1;
	}elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["nombre"])) {
		$nombreErr = "Se permite solo letras y espacio.";
		$error = $error + 1;
	} else {
		$nombre = xss_test($_POST["nombre"]);
	}

	if (empty($_POST["email"])) {
		$emailErr = "Email requerido.";
		$error = $error+1;
	} else {
		$email = xss_test($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Formato de email invalido.";
		}
	}

	if (empty($_POST["genero"])) {
		$genErr = "Seleccionar una opcion.";
	} else {
		$genero = xss_test($_POST["genero"]);
	}
  	
  	if (empty($_POST["comentario"])) {
  		$comentErr = "Comentar!";
  		$error = $error+1;
  	} else {
  		$comentario = xss_test($_POST["comentario"]);
  	}

  	if (empty($_POST["sitio_web"])) {
  		$sitio_web = "";
  	} else {
  		$sitio_web = xss_test($_POST["sitio_web"]);
  		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $sitio_web)) {
  			$sitioErr = "URL invalida.";
  		}
  	}
}

if ($error > 1) {
	echo "<h2 class='error'>Validacion de formulario en PHP con prueba de XSS</h2>";
} else {
	echo "<h2>Validacion de formulario en PHP con prueba de XSS</h2>";
}
?>
<form method="post" action="<?php $_SERVER["PHP_SELF"];?>">
	Nombre: <input type="text" name="nombre"><span class="error"><?php echo $nombreErr; ?></span><br>
	Email: <input type="text" name="email"><span class="error"><?php echo $emailErr; ?></span><br>
	Genero: <input type="radio" name="genero" value="F">Femenino
			<input type="radio" name="genero" value="M">Masculino <span class="error"><?php echo $genErr; ?></span><br>
	Sitio web: <input type="text" name="sitio_web"><span class="error"><?php echo $sitioErr; ?></span><br>
	Comentario: <textarea name="comentario" rows="5" cols="40"></textarea><span class="error"><?php echo $comentErr; ?></span><br><br>
	<input type="submit" name="enviar" value="Enviar">
</form><br>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($error > 1) {
		echo "<p class='error'>Hay errores! Verificar.</p>";
	} else {
	echo "<h2>Los datos</h2>";
	echo "Nombre: ".$nombre."<br>";
	echo "Email: ".$email."<br>";
	echo "Genero: ".$genero."<br>";
	echo "Sitio web:".$sitio_web."<br>";
	echo "Comentario: ".$comentario."<br>";
	}
}
 ?>
</body>
</html>