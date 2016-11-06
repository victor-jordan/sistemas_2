<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Manejo de Fecha y Hora</h1>
<?php 
echo "Hoy es " . date("d/m/Y") . "<br>";
echo "Hoy es " . date("d.M.Y") . "<br>";
echo "Hoy es " . date("d-m-Y") . "<br>";
echo "Hoy es " . date("l") . "<br>";
?>
<h2>Tip: Copyright automatico con PHP</h2>
<?php 
echo "&copy; 2010 - " . date("Y") . "<br>";
?>
<h2>Hora</h2>
<?php
echo "Hora " . date("h:i:sa") . "<br>";
?>
</body>
</html>