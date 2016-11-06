<?php
$auto1 = 'BMW';
$auto2 = 'VW';
$auto3 = 'Mercedes';
$auto4 = 'KIA';

$marcas_autos = array($auto1, $auto2, $auto3, $auto4);

$marcas_dos[0] = $auto1;
$marcas_dos[1] = $auto2;
$marcas_dos[2] = $auto4;
$marcas_dos[3] = "Volvo";

echo "Fulano: ...A mi me gustan las marcas ".$marcas_autos[0].", ".$marcas_autos[1]." y ".$marcas_autos[2].".<br>";

echo "Mengano: ...prefiero ".$marcas_autos[3]." y ".$marcas_dos[0].".<br>";

echo "el primero tiene ".count($marcas_autos).".<br>";
echo "el segundo tiene ".count($marcas_dos).".<br>";

for ($i=0; $i < count($marcas_autos); $i++) { 
	echo "La marca en el indice $i, es: ".$marcas_autos[$i].".<br>";
}

echo "<hr>";
sort($marcas_autos);

for ($i=0; $i < count($marcas_autos); $i++) { 
	echo "La marca ordenada en el indice $i, es: ".$marcas_autos[$i].".<br>";
}

echo "<hr>";
$edades = array('Juan' => 40, 'Pedro' => 60, 'Pablo' => 25, 'Jose' => 66);

krsort($edades);

foreach ($edades as $persona => $edad) {
	echo "el nombre es ".$persona." y tiene ".$edad." anhos. <br>";
}

?>