<?php
/**
*  the class creates the PDO DB connection
* 
* @return the DB connection
*/
define('DB_HOST','localhost');
define('DB_NAME','gorilla');
define('DB_USERNAME','root');
define('DB_PASSWORD','root');


class PDOAccess{
	 
	 public static $pdo;

	 function getPDO(){
	 	
	 	if(!isset($pdo)){
	 		$pdo= new PDO('mysql:host=' .DB_HOST.';dbname='.DB_NAME,DB_USERNAME,DB_PASSWORD);

	 		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	 		$pdo->exec('set session sql_mode = traditional');
	 		$pdo->exec('set session innodb_strict_mode = on');

	 	}
	 	return $pdo;
	 }

	
}
?>