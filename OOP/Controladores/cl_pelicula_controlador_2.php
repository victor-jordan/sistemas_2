<?php
require('cl_base_dato.php');
require('Modelos\cl_pelicula.php');

class Pelicula_Ctlr extends Database implements Interfaz_BBDD, Proteccion_XSS
{
	var static $pelicula;
	var static $peliculas = array();
	var static $coleccion = array();

	public static function obtener_uno($id) {
		$sentencia = "select pelicula_id, titulo, genero, anho, director, formato, precio_alquiler from pelicula where pelicula_id = ".$id.";";
		self::$pelicula = new Pelicula;
		$resultado = parent::getInstance()->getConnection()->query($sql);

		if ($resultado->num_rows > 0) {
			$fila = $resultado->fetch_assoc();
			self::$pelicula->pelicula_id = $fila['pelicula_id'];
			self::$pelicula->titulo = $fila['titulo'];
			self::$pelicula->genero = $fila['genero'];
			self::$pelicula->anho = $fila['anho'];
			self::$pelicula->director = $fila['director'];
			self::$pelicula->formato = $fila['formato'];
			self::$pelicula->precio_alquiler = $fila['precio_alquiler'];
			$resultado->free();
		} else {
			self::$pelicula = null;
		}
		return self::$pelicula;
	}

	public static function coleccion($campo) {
		$seleccion = "select distinct %s from pelicula;";
		$sentencia = sprintf($seleccion, $campo);
		$los_datos = parent::getInstance()->getConnection()->query($sentencia);
		
		if ($los_datos->num_rows > 0) {
			$fila = $los_datos->fetch_assoc();
			self::$pelicula->pelicula_id = $fila['pelicula_id'];
			self::$pelicula->titulo = $fila['titulo'];
			self::$pelicula->genero = $fila['genero'];
			self::$pelicula->anho = $fila['anho'];
			self::$pelicula->director = $fila['director'];
			self::$pelicula->formato = $fila['formato'];
			self::$pelicula->precio_alquiler = $fila['precio_alquiler'];
			$los_datos->free();
		} else {
			self::$pelicula = null;
		}
		return self::$coleccion;
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
		}elseif (strpos($sql, 'call') !== false) {
			if ($exec->query($sql) == TRUE) {
				return "La operacion se realizó con éxito.";	
			} else {
				return $exec->error;
			}
		} else {
			return "Operacion no permitida";
		}
	}
}

?>