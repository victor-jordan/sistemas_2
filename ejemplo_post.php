<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Nombre: <input type="text" name="fnombre">
  <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tomar valor de POST
    $nombre = $_POST['fnombre'];
    if (empty($nombre)) {
        echo "Vacio.";
    } else {
        echo $nombre;
    }
}
?>

</body>
</html>