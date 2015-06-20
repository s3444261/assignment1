<?php

if(basename($_SERVER['PHP_SELF'] == '/model/answer.php')){
	include '../../db.php';
} else {
	include '../db.php';
}

class Database extends PDO {
	private static $instance;

	public static function getInstance() {
		if (!isset(self::$instance)) {

			$database= array(
					'db_host' => DB_HOST,
					'db_user' => DB_USER,
					'db_pass' => DB_PW,
					'db_name' => DB_NAME);

			self::$instance = new Database('mysql:host='.$database['db_host'].';dbname='.$database['db_name'], $database['db_user'],$database['db_pass']);
			
			//comment out this line to disable PDO error messages
			self::$instance->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); 
		}
		return self::$instance;
	}
}
?>