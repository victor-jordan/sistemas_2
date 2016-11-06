<?php
/**
* La prueba de ABM
*/
require('cl_interfaz.php');

$sentencia = "insert into cliente (cliente_id, documento, nombre, apellido, fecha_nacimiento, direccion, telefono, celular, estado) values (NULL, '5612937', 'Agosto', 'Lopez', '1995-02-12', 'vecino de julio', '0971545456', '021450370', 0);";

$otro = "update cliente set documento = '3456789', nombre = 'Marcos', apellido = 'Caceres',  fecha_nacimiento = '2000-04-07', direccion = 'Potrero Lorito', telefono = 'N/R', celular = 'N/R', estado = 'Activo' where cliente_id = 2;";

$borrar = "delete from cliente where cliente_id = 5;";

$resultado = Interfaz::abm($borrar);

echo "Resultado: ".$resultado;

?>