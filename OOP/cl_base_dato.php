<?php
/*
* Clase Mysql para conexion a base de datos, con patron "singleton"
*/
class Database {
	private $_connection;
	private static $_instance; //La instancia única
	private $_host = "127.0.0.1";
	private $_username = "root";
	private $_password = "";
	private $_database = "video_club";
	/*
	Obtener una instancia de la Base de Datos
	@return Instancia
	*/
	public static function getInstance() {
		if(!self::$_instance) { // Si no hay instancia, crear una... singleton puro.
			self::$_instance = new self();
			//echo "Nueva instancia <br>";
		}
		//echo "Instancia existente <br>";
		return self::$_instance;
	}
	// Constructor
	private function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database);
	
		// Manejo de errores
		if (mysqli_connect_errno()) { 
 			die("Falla en la conexion a la base de datos MySQL: " . 
 				mysqli_connect_error() . " (" . 
 				mysqli_connect_errno() . ")" 
 				);
		}
	}
	// El método mágico "clone", vacío para evitar duplicacion de conexiones.
	private function __clone() {}
	// Obtener la conexion "mysqli".
	public function getConnection() {
		return $this->_connection;
	}

	public function __destruct() {
		return $this->_connection->close();
	}
}
?>