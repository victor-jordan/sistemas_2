<?php
/**
* La interfaz para acceder a los diferentes metodos de BBDD
*/
require('cl_base_dato.php');

class Interfaz extends Database
{
	public static function consulta($sql) {
		$res = parent::getInstance()->getConnection()->query($sql);
		return $res;
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
}

?>