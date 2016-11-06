<?php
$hora = date("h");

if ($hora < "19") {
	echo "primer if";
} elseif ($hora > "02") {
	echo "elseif";
} else {
	echo "valor por defecto";
}
?>