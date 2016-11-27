<?php
/**
* La clase para el login con BBDD
*/
require('cl_base_dato.php');

class Login extends Database
{
	public static function acceder($sql) {
		$usuario = parent::getInstance()->getConnection()->query($sql);
		return $usuario;
	}
}