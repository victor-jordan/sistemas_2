<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Nombre: <input type="text" name="fnombre" required>
  <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recogemos el valor del campo nombre
    $nombre = $_REQUEST['fnombre'];
    if (empty($nombre)) {
        echo "Nombre no establecido.";
    } else {
        echo $nombre;
    }
}
?>

</body>
</html>