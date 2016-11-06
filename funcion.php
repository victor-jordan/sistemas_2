<?php
function funcion1 ($apellido = "Chavez", $ciudad = "Potrero Apu'a") {
	echo "El apellido de la familia es $apellido, oriundos de $ciudad <br>";
}

funcion1('Perez', "Asuncion");
funcion1("Ramirez", "Yaguaron");
funcion1("Gonzalez", 'CDE');
funcion1('Garay', 'Nanawa');
funcion1();
funcion1();
?>