<?php
namespace Config\Database;

class DB{
	private static $conn;
		
	static function getConn(){
		if(is_null(self::$conn)){
			self::$conn = new PDO('mysql:host=localhost;dbname=source_client','root','');
			self::$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
				//Coloca como padrão o Fetch de Objetos, para a listagem
		}
		return self::$conn;
	}
}
