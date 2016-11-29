<?php
/*
La interfaz para acceder a los diferentes metodos de BBDD
*/
interface Interfaz_BBDD
{
	public static function consulta($sql);
	public static function coleccion($campo);
	public function abm($sql);
}

?>