<?php
/**
* La clase para el login con BBDD
*/
require('cl_base_dato.php');
require('Modelos\cl_usuario.php');

class LoginCtrl extends Database
{
	public static $usuario;

	public static function acceder($user, $password) {
		self::$usuario = new Usuario;
		$validar = "CALL login_usuario('".$user."', ".$password.");";
		$validado = parent::getInstance()->getConnection()->query($validar);

		if ($validado->num_rows > 0) {
			$fila = $validado->fetch_assoc();
			self::$usuario->usuario_id = $fila['usuario_id'];
			self::$usuario->denominacion = $fila['denominacion'];
			self::$usuario->nombre = $fila['nombre'];
			self::$usuario->apellido = $fila['apellido'];
			self::$usuario->activo = $fila['activo'];
			$validado->free();
		} else {
			self::$usuario->activo = 2;
		}
		return self::$usuario;
	}
}