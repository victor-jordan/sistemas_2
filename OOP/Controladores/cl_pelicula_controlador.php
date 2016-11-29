<?php
/**
* Una clase que manejará las películas
*/
require('cl_base_dato.php');
require('interface_bbdd.php');
require('interface_xss.php');

class PeliculaControlador extends Database implements Interfaz_BBDD, Proteccion_XSS
{
	private $titulo;
	private $genero;
	private $anho;
	private $director;
	private $formato;
	private $precio;

	public static function nuevo() {
		self::$titulo = isset($_POST['titulo']) ? self::limpiar_dato($_POST['titulo']) : null;
		self::$genero = isset($_POST['genero']) ? self::limpiar_dato($_POST['genero']) : null;
		self::$anho = isset($_POST['anho']) ? self::limpiar_dato($_POST['anho']) : null;
		self::$director = isset($_POST['director']) ? self::limpiar_dato($_POST['director']) : null;
		self::$formato = isset($_POST['formato']) ? self::limpiar_dato($_POST['formato']) : null;
		self::$precio = isset($_POST['precio']) ? self::limpiar_dato($_POST['precio']) : null;
	}

	public static function consulta($sql) {
		$res = parent::getInstance()->getConnection()->query($sql);
		return $res;
	}

	public static function coleccion($campo) {
		$seleccion = "select distinct %s from pelicula;";
		$sentencia = sprintf($seleccion, $campo);
		$los_datos = parent::getInstance()->getConnection()->query($sentencia);
		return $los_datos;
	}

	public function abm($sql) {
		$exec = parent::getInstance()->getConnection();
		
		if (strpos($sql, 'insert') !== false) {
			if ($exec->query($sql) == TRUE) {
				return "El registro fue insertado correctamente.";	
			} else {
				return $exec->error;
			}
		} elseif (strpos($sql, 'update') !== false) {
			if ($exec->query($sql) == TRUE) {
				return "El registro fue modificado correctamente.";	
			} else {
				return $exec->error;
			}
		}elseif (strpos($sql, 'delete') !== false) {
			if ($exec->query($sql) == TRUE) {
				return "El registro fue eliminado correctamente.";	
			} else {
				return $exec->error;
			}
		} else {
			echo "Operacion no permitida";
		}
	}

	public function limpiar_dato($dato){
	  $dato = trim($dato);
	  $dato = stripslashes($dato);
	  $dato = htmlspecialchars($dato);
	  return $dato;
	}
}

?>