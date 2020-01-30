<?php

class Database {

	protected $db;

 	public function __construct()
    {
        try {
        	$dsn = "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=".DB_CHARSET;
            $this->db = new PDO($dsn,DB_USERNAME,DB_PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}


?>