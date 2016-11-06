<?php
function retorno ($x, $y, $o = 'suma') {
switch ($o) {
	case 'suma':
		$z = $x + $y;
		return "la suma es ".$z."<br>";
		break;
	
	case 'resta':
		$z = $x - $y;
		return "la resta es ".$z."<br>";
		break;

	case 'multi':
		$z = $x * $y;
		return "la multi es ".$z."<br>";
		break;

	case 'divi':
		$z = $x / $y;
		return "la divi es ".$z."<br>";
		break;

	default:
		return "El valor1 es $x, el valor2 es $y, la operacion no es valida para esta funcion.<br>";
}
}

echo retorno(2,2,'suma');
print retorno(8,2);
echo retorno(3,1,'resta');
print retorno(3,50,'multi');
echo retorno(15,3,'divi');
echo retorno(15,25,'potencia');
?>