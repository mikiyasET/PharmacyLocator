<?php
class Database {



    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "pharmacy";

	protected function c() {
		try {
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
			$pdo = new PDO($dsn,$this->user,$this->password);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

			return $pdo;
		}catch(PDOException $e) { die("Database can't connect"); }
	}
}

?>